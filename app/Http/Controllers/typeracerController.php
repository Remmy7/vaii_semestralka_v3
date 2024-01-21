<?php

namespace App\Http\Controllers;

use App\Models\leaderboard;
use App\Models\User;
use App\Models\categories;
use App\Models\difficulty;
use App\Models\GameTexts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Nette\Schema\ValidationException;
use function Laravel\Prompts\password;


class typeracerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $gameTexts = GameTexts::all();
        $difficulties = difficulty::all();
        $categories = categories::all();
        return view('index', ['user' => $user, 'gameTexts'=>$gameTexts,
            'difficulties'=>$difficulties,
            'categories'=>$categories]);
    }

    public function viewIndex()
    {
        $user = auth()->user();
        $gameTexts = GameTexts::all();
        $difficulties = difficulty::all();
        $categories = categories::all();
        return view('index', ['user' => $user,
            'gameTexts'=>$gameTexts,
            'difficulties'=>$difficulties,
            'categories'=>$categories]);
    }

    public function getGameTexts(Request $request)
    {
        $difficultyID = $request->input('difficultyID');
        $categoryID = $request->input('categoryID');

        $gameTexts = GameTexts::where('difficultiesId', $difficultyID)
            ->where('categoriesId', $categoryID)
            ->get(['id', 'textName', 'gameText']);

        // Return the data in JSON format
        return response()->json($gameTexts);
    }
    public function viewAdminMenu()
    {
        $categories = categories::all();
        $texts = GameTexts::all();
        $difficulties = difficulty::all();
        return view('admin', [
            'categories' => $categories,
            'texts' => $texts,
            'difficulties' => $difficulties]);
    }

    public function viewGame(Request $request)
    {
        $request->validate([
            'gameTextID' => 'required|numeric|exists:gameTexts,id',
        ]);
        $game_texts = GameTexts::all();
        //$game_text_random = GameTexts::inRandomOrder()->first();
        //$game_text_id = $game_text_random->id;
        //$game_text = $game_text_random->gameText;
        $gameTextID = $request->input('gameTextID');
        $game_texts_id = GameTexts::find($gameTextID);
        $game_text = $game_texts_id->gameText;

        return view('game', ['game_texts' => $game_texts,
            'gameTextId' => $game_texts_id->id,
            'gameText' => $game_text]);
    }

    public function saveGame(Request $request)
    {

        $request->validate([
            'gameTextID' => 'required|exists:GameTexts,id',
            'time' => 'required|numeric|min:0',
        ]);

        $newScore = new leaderboard();
        $newScore->gameTextID = $request->input('gameTextID');
        $newScore->playerID = auth()->user()->id;
        //$newScore->playerID = 2;
        $newScore->time = $request->input('time');
        //$newScore->time = 2;


        $newScore->save();

        return response()->json(['message' => 'Result saved successfully, want to try another text?']);
    }


    public function addText(Request $request)
    {
        \Log::info(json_encode($request->all()));

        $request->validate([
            'addText' => 'required',
            'category_id' => 'required|exists:categories,id',
            'difficulty_id' => 'required|exists:difficulties,id',
            'textName' => 'required',
        ]);


        $newArticle = new GameTexts();
        $newArticle->gameText = $request->input('addText');
        $newArticle->textName = $request->input('textName');
        $newArticle->categoriesId = $request->input('category_id');
        $newArticle->difficultiesId = $request->input('difficulty_id');


        $newArticle->save();



        return response()->json(['success' => true, 'message' => 'Text added successfully']);

    }

    public function addCategory(Request $request)
    {
        \Log::info(json_encode($request->all()));

        $newCategory = new categories();
        $newCategory->categoryTitle = $request->addCategory;
        $newCategory->save();

        return redirect('/viewAdminMenu');
    }

    public function addDifficulty(Request $request)
    {
        \Log::info(json_encode($request->all()));

        $newDifficulty = new difficulty();
        $newDifficulty->difficulty = $request->addDifficulty;
        $newDifficulty->save();

        return redirect('/viewAdminMenu');
    }

    public function viewLogin()
    {
        return view('Login');
    }

    public function deleteDifficulty(Request $request)
    {
        $request->validate([
            'difficulty_id_delete' => 'required|exists_in_difficulties:' . $request->input('difficulty_id_delete') //TODO - add check if text matches ID
        ], [
            'difficulty_id_delete.exists_in_difficulties' => 'Difficulty ID does not exist',
        ]);
        difficulty::find($request->difficulty_id_delete)->delete($request->difficulty_id_delete);
        return redirect('/viewAdminMenu');
    }

    public function deleteCategory(Request $request)
    {
        $request->validate([
            'category_id_delete' => 'required|exists_in_categories:' . $request->input('category_id_delete') //TODO - add check if text matches ID
        ], [
            'category_id_delete.exists_in_categories' => 'Category ID does not exist',
        ]);
        categories::find($request->category_id_delete)->delete($request->category_id_delete);
        return back();
    }

    public function deleteText(Request $request)
    {
        $request->validate([
            'text_id' => 'required|exists_in_game_texts:' . $request->input('text_id') //TODO - add check if text matches ID
        ], [
            'text_id.exists_in_game_texts' => 'Article ID does not exist',
        ]);
        GameTexts::find($request->text_id)->delete($request->text_id);
        return back();
    }

    public function updateCategory(Request $request)
    {
        $category = categories::find($request->category_id_update);
        $category->categoryTitle = $request->updateCategory;
        $category->save();
        return back();
    }

    public function updateDifficulty(Request $request)
    {

        $difficulty = difficulty::find($request->difficulty_id_update);
        $difficulty->difficulty = $request->updateDifficulty;
        $difficulty->save();
        return back();
    }

    public function loginUser(Request $request)
    {
        //\Log::info(json_encode($request->all()));

        $request->validate([
            'inputUsername' => 'required',
            'inputPassword' => 'required|min:6'
        ]);
        $username = $request->inputUsername;
        $password = $request->inputPassword;

        if (Auth::attempt(['name' => $username, 'password' => $password])) {
            // Authentication passed
            $user = Auth::user();

            return redirect('/');
        } else {
            // Authentication failed
            return back()->with('fail', 'Invalid username or password.');
        }
    }

    public function userLogout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
        return redirect('/');
    }

    public function viewRegister()
    {
        return view('/Register');
    }

    public function registerUser(Request $request)
    {
        \Log::info(json_encode($request->all()));

        try {
            $request->validate([
                'inputUsername' => 'required|unique:users,name',
                'inputEmail' => 'required|email|unique:users,email',
                'inputPassword' => 'required|min:6|confirmed',
            ], [
                'inputUsername' => 'name',
                'inputEmail' => 'email',
                'inputPassword' => 'password',
                'inputUsername.required' => 'Username is required.',
                'inputUsername.unique' => 'Username is not unique.',
                'inputEmail.required' => 'Email is required.',
                'inputEmail.email' => 'Email must be a valid email address.',
                'inputEmail.unique' => 'Email is not unique.',
                'inputPassword.required' => 'Password is required.',
                'inputPassword.min' => 'Password must be at least :min characters.',
                'inputPassword.confirmed' => 'Passwords do not match.',
            ]);


            $newUser = new User();
            $newUser->name = $request->input('inputUsername');
            $newUser->password = Hash::make($request->input('inputPassword'));
            $newUser->email = $request->input('inputEmail');
            $newUser->privilege = 1;
            $newUser->save();

            return redirect('/')->with('message', 'Succesfully registered!');
        }
        catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            if (Auth::check()) {
                Auth::user()->delete();
                Auth::logout();
            }

            session()->pull('privilege');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return redirect('/');
    }

    public function viewForums()
    {
        return view('Forums');
    }

    public function viewSettings()
    {
        $userId = session()->get('LoggedUser');

        $userData = User::find($userId);
        return view('Settings', ['userData' => $userData]);
    }

    public function viewLeaderboard()
    {
        $plays = leaderboard::with('gameText', 'player')->get();
        $difficulties = difficulty::all();
        $categories = categories::all();
        $plays = $plays->sortBy(function ($play) {
            return $play->gameTextID * 1000 + $play->time;
        });
        $counter = 0;
        $prevGameTextID = null;

        $sortedPlays = $plays->map(function ($play) use ($categories ,$difficulties, &$counter, &$prevGameTextID) {
            if ($prevGameTextID !== $play->gameTextID) {
                $counter = 0;
                $prevGameTextID = $play->gameTextID;
            }

            $gameText = $play->gameText;
            $difficultyId = $gameText->difficultiesId;
            $categoryId = $gameText->categoriesId;

            $difficulty = $difficulties->find($difficultyId)->difficulty;
            $category = $categories->find($categoryId)->categoryTitle;
            $counter++;
            return [
                'gameTextID' => $play->gameTextID,
                'counter' => $counter,
                'playerID' => $play->playerID,
                'time' => $play->time,
                'gameText' => $play->gameText->textName,
                'username' => optional($play->player)->name,
                'difficulty' => $difficulty,
                'category' => $category,
            ];
        });

        return view('Leaderboard', ['sortedPlays' => $sortedPlays, 'difficulties' => $difficulties, 'categories' => $categories]);
    }

    public function testModal()
    {

        return response()->json(['message' => 'Result saved successfully, want to try another text?']);
    }
}
