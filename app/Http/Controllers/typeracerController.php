<?php

namespace App\Http\Controllers;

use App\Models\leaderboard;
use App\Models\User;
use App\Models\users;
use App\Models\categories;
use App\Models\difficulty;
use App\Models\game_texts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class typeracerController extends Controller
{
    public function index() {
        return view('index');
    }

    public function viewIndex() {
        return view('index' );
    }

    public function viewAdminMenu() {
        $categories = categories::all();
        $texts = game_texts::all();
        $difficulties = difficulty::all();
        return view('admin', [
            'categories' => $categories,
            'texts' => $texts,
            'difficulties' => $difficulties]);
    }

    public function viewGame() {
        $game_text_random = game_texts::inRandomOrder()->first();
        $game_text_id = $game_text_random->id;
        $game_text = $game_text_random->gameText;
        return view('game', ['game_text' => $game_text,
            'game_text_id' => $game_text_id]);
    }

    public function saveGame(Request $request) {

        $request->validate([
            'gameTextID' => 'required|exists:game_texts, id',
            'playerID' => 'required|exists:users, id',
            'time' => 'required',
        ]);

        $newScore = new leaderboard();
        $newScore->gameTextID = $request->input('addText');
        $newScore->playerID = $request->input('playerID');
        $newScore->time = $request->input('time');


        $newScore->save();

        return response()->json(['message' => 'Result saved successfully, want to try another text?']);
    }
    public function addText(Request $request) {
        \Log::info(json_encode($request->all()));

        //categoriesID and difficultiesID will not be null thanks to javascript
        //now you just need to check if they are in the database

        $request->validate([
            'addText' => 'required',
            'category_id' => 'required|exists:categories,id',
            'difficulty_id' => 'required|exists:difficulties,id',
        ]);


        $newArticle = new game_texts();
        $newArticle->gameText = $request->input('addText');
        $newArticle->categoriesId = $request->input('category_id');
        $newArticle->difficultiesId = $request->input('difficulty_id');


        $newArticle->save();


        return redirect('/viewAdminMenu');
    }

    public function addCategory(Request $request) {
        \Log::info(json_encode($request->all()));

        $newCategory = new categories();
        $newCategory->categoryTitle = $request->addCategory;
        $newCategory->save();

        return redirect('/viewAdminMenu');
    }

    public function addDifficulty(Request $request) {
        \Log::info(json_encode($request->all()));

        $newDifficulty = new difficulty();
        $newDifficulty->difficulty = $request->addDifficulty;
        $newDifficulty->save();

        return redirect('/viewAdminMenu');
    }

    public function viewLogin() {
        return view('Login');
    }

    public function deleteDifficulty(Request $request) {
        $request->validate([
            'difficulty_id_delete' => 'required|exists_in_difficulties:'.$request->input('difficulty_id_delete') //TODO - add check if text matches ID
        ], [
            'difficulty_id_delete.exists_in_difficulties' => 'Difficulty ID does not exist',
        ]);
        difficulty::find($request->difficulty_id_delete)->delete($request->difficulty_id_delete);
        return redirect('/viewAdminMenu');
    }

    public function deleteCategory(Request $request) {
        $request->validate([
            'category_id_delete' => 'required|exists_in_categories:'.$request->input('category_id_delete') //TODO - add check if text matches ID
        ], [
            'category_id_delete.exists_in_categories' => 'Category ID does not exist',
        ]);
        categories::find($request->category_id_delete)->delete($request->category_id_delete);
        return back();
    }

    public function deleteText(Request $request) {
        $request->validate([
            'text_id' => 'required|exists_in_game_texts:'.$request->input('text_id') //TODO - add check if text matches ID
        ], [
            'text_id.exists_in_game_texts' => 'Article ID does not exist',
        ]);
        game_texts::find($request->text_id)->delete($request->text_id);
        return back();
    }

    public function updateCategory(Request $request) {
        $category = categories::find($request->category_id_update);
        $category->categoryTitle = $request->updateCategory;
        $category->save();
        return back();
    }

    public function updateDifficulty(Request $request) {

        $difficulty = difficulty::find($request->difficulty_id_update);
        $difficulty->difficulty = $request->updateDifficulty;
        $difficulty->save();
        return back();
    }

    public function loginUser(Request $request) {
     //\Log::info(json_encode($request->all()));

       /*$request->validate([
            'inputUsername' => 'required',
            'inputPassword' => 'required|min:6'
        ]);
        $credentials = $request->only('inputUsername', 'inputPassword');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();
            $request->session()->put('LoggedUser', $user->id);
            $request->session()->put('privilege', $user->privilege);
            return redirect('/');
        } else {
            // Authentication failed
            return back()->with('fail', 'Invalid username or password.');
        }*/
        $userData = DB::table('users')->where('name', $request->inputUsername)->first();
        //$userData = users::where('name','=', $request->inputUsername);
        \Log::info(json_encode($userData));
        if ($userData) {
            //\Log::info(json_encode($request->input('inputPassword')));
            if (Hash::check($request->input('inputPassword'), $userData->password)) {
                $request->session()->put('LoggedUser', $userData->id);
                $request->session()->put('privilege', $userData->privilege);
                return redirect('/');
            } else {
                return back()->with('fail', 'Invalid username or password.');
            }
        } else {
            return back()->with('fail','Invalid username or password.');
        }
    }

    function userLogout(){
        if(session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            session()->pull('privilege');
            return redirect('/');
        }
        session()->pull('privilege');
        return redirect('/');
    }

    public function viewRegister() {
        return view('/Register');
    }

    public function registerUser(Request $request) {
        \Log::info(json_encode($request->all()));

        if ($request->inputPassword == $request->repeatPassword) {
            $request->validate([
                'inputUsername' => 'required',
                'inputEmail' => 'required|email',
                'inputPassword' => 'required|min:6',
            ]);


            $newUser = new User();
            $newUser->name = $request->input('inputUsername');
            $newUser->password = Hash::make($request->input('inputPassword'));
            $newUser->email = $request->input('inputEmail');
            $newUser->privilege = 1;
            $newUser->save();

            return redirect('/');
        }
        return back();
    }

    public function deleteUser(Request $request) {
        try {
            $user = $request->session()->get('LoggedUser');
            User::destroy($user);
            session()->pull('LoggedUser');
            session()->pull('privilege');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect('/');
    }
    public function viewForums() {
        return view('Forums');
    }

    public function viewSettings() {
        $userId = session()->get('LoggedUser') ;

        $userData = User::find($userId);
        return view('Settings',['userData' => $userData]);
    }

    public function viewLeaderboard() {
        return view('Leaderboard');
    }





}
