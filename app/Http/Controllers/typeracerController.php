<?php

namespace App\Http\Controllers;

use App\Models\users;
use App\Models\categories;
use App\Models\difficulty;
use App\Models\game_texts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;



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
        $game_text = game_texts::inRandomOrder()->first()->gameText;
        //$article = articleLibrary::find($id)->text;
        return view('game', ['game_text' => $game_text]);

    }

    public function addText(Request $request) {
        \Log::info(json_encode($request->all()));

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
        difficulty::find($request->difficulty_id_delete)->delete($request->difficulty_id_delete);
        return back();
    }

    public function deleteCategory(Request $request) {
        categories::find($request->category_id_delete)->delete($request->category_id_delete);
        return back();
    }

    public function loginUser(Request $request) {
        /*\Log::info(json_encode($request->all()));
        $userData = array(
            $login = $request->input('inputUsername'),
            //$password = Hash::make($request->input('inputPassword')),
            $password = $request->input('inputPassword')
        );

         if (Auth::attempt([
             'nickname' => $login,
             'password' => $password]
         )) {
            return redirect('/');
         } else {
            return redirect('viewLogin');
         }*/

        //\Log::info(json_encode($request->all()));

        $request->validate([
            'inputUsername' => 'required',
            'inputPassword' => 'required|min:6'
        ]);
        $userData = DB::table('users')->where('nickname', $request->inputUsername)->first();
        //$userData = users::where('nickname','=', $request->inputUsername);
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


            $newUser = new users();
            $newUser->nickname = $request->input('inputUsername');
            $newUser->password = Hash::make($request->input('inputPassword'));
            $newUser->email = $request->input('inputEmail');
            $newUser->privilege = 1;
            $newUser->save();

            return redirect('/');
        }
        return back();
    }

    public function deleteUser(Request $request) {

        $user = $request->session()->get('LoggedUser');
        session()->pull('LoggedUser');
        session()->pull('privilege');

        return redirect('/');

    }
    public function viewForums() {
        return view('Forums');
    }

    public function viewSettings() {
        return view('Settings');
    }

    public function viewLeaderboard() {
        return view('Leaderboard');
    }



}
