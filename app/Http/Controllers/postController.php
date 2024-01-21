<?php

namespace App\Http\Controllers;

use App\Models\leaderboard;
use App\Models\User;
use App\Models\categories;
use App\Models\difficulty;
use App\Models\GameTexts;
use App\Models\Comment;
use App\Models\FormPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Nette\Schema\ValidationException;
use function Laravel\Prompts\password;


class postController extends Controller
{
    public function viewPosts()
    {
        $posts = FormPost::with('comments', 'user')->latest()->paginate(10);
        return view('posts', compact('posts'));
    }

    public function createPost(Request $request)
    {
        $newPost = new FormPost();
        $newPost->post_name = $request->input('postHeader');
        $newPost->post_text = $request->input('postBody');
        $newPost->user_id = auth()->user()->id;

        $newPost->save();

        $posts = FormPost::with('comments', 'user')->latest()->paginate(10);

        return view('/posts', compact('posts'));
    }

    public function createComment(Request $request, FormPost $post)
    {
        $newComment = new Comment();
        $newComment->form_post_id = $post->id;
        $newComment->comment_text = $request->input('postBody');
        $newComment->user_id = auth()->user()->id;

        $newComment->save();

        $post->load('comments.user')->paginate(10);


        return view('showComments', compact('post'));

    }

    public function showComments(FormPost $post)
    {
        $post->load('comments.user');
        return view('showComments', compact('post'));
    }
}
