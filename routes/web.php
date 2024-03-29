<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\typeracerController;
use App\Http\Controllers\postController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [typeracerController::class, 'index']);

Route::post('/', [typeracerController::class, 'viewIndex'])->name('viewIndex');

Route::post('/viewGame', [typeracerController::class, 'viewGame'])->name('viewGame');

Route::get('/viewGame', [typeracerController::class, 'viewGame'])->name('viewGame');

Route::post('/saveGame',[typeracerController::class, 'saveGame'])->name('saveGame');

Route::post('/testModal',[typeracerController::class, 'testModal'])->name('testModal');

Route::post('/getGameTexts', [typeracerController::class, 'getGameTexts'])->name('getGameTexts');


Route::post('addText', [typeracerController::class, 'addText'])->name('addText');

//Route::get('/addText/{category}/{difficulty}/{text}',function($category, $difficulty, $text) {
//    return 'addText'.$category.$difficulty.$text;
//})->name('addText');

Route::post('/addCategory', [typeracerController::class, 'addCategory'])->name('addCategory');

Route::post('/addDifficulty', [typeracerController::class, 'addDifficulty'])->name('addDifficulty');

Route::post('/viewAdminMenu', [typeracerController::class, 'viewAdminMenu'])->name('viewAdminMenu');

Route::get('viewAdminMenu', [typeracerController::class, 'viewAdminMenu'])->name('viewAdminMenu');

Route::post('/addArticle', [typeracerController::class, 'addArticle'])->name('addArticle');

Route::post('/forums', [typeracerController::class, 'viewForums'])->name('viewForums');

Route::post('/leaderboard', [typeracerController::class, 'viewLeaderboard'])->name('viewLeaderboard');

Route::post('/login', [typeracerController::class, 'viewLogin'])->name('viewLogin');

Route::get('/login', [typeracerController::class, 'viewLogin'])->name('viewLogin');

Route::post('/loginUser', [typeracerController::class, 'loginUser'])->name('loginUser');

Route::get('/loginUser', [typeracerController::class, 'loginUser'])->name('loginUser');

Route::post('/userLogout', [typeracerController::class, 'userLogout'])->name('userLogout');

Route::post('/register', [typeracerController::class, 'viewRegister'])->name('viewRegister');

Route::get('/register', [typeracerController::class, 'viewRegister'])->name('viewRegister');

Route::post('/viewRegister', [typeracerController::class, 'registerUser'])->name('registerUser');

Route::post('/deleteUser', [typeracerController::class, 'deleteUser'])->name('deleteUser');

Route::post('/settings', [typeracerController::class, 'viewSettings'])->name('viewSettings');

Route::post('/changePassword', [typeracerController::class, 'changePassword'])->name('changePassword');

Route::post('/changeEmail', [typeracerController::class, 'changeEmail'])->name('changeEmail');

Route::post('/saveItem', [typeracerController::class, 'saveItem'])->name('saveItem');

Route::post('/markCompleteRoute/{id}', [typeracerController::class, 'markComplete'])->name('markComplete');

Route::post('/categories', [typeracerController::class, 'deleteCategory'])->name('deleteCategory');

Route::post('/difficulties', [typeracerController::class, 'deleteDifficulty'])->name('deleteDifficulty');

Route::post('/deleteText', [typeracerController::class, 'deleteText'])->name('deleteText');

Route::post('/updateText', [typeracerController::class, 'updateText'])->name('updateText');

Route::post('/updateCategory', [typeracerController::class, 'updateCategory'])->name('updateCategory');

Route::post('/updateDifficulty', [typeracerController::class, 'updateDifficulty'])->name('updateDifficulty');

Route::post('/createPost', [PostController::class, 'createPost'])->name('createPost');

Route::post('/createComment', [PostController::class, 'createComment'])->name('createComment');

Route::post('/posts', [PostController::class, 'viewPosts'])->name('viewPosts');

Route::get('/showComments/{post}', [PostController::class, 'showComments'])->name('showComments');

Route::post('/showComments/{post}/comments', [PostController::class, 'createComment'])->name('createComment');





