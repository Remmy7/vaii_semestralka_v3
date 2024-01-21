<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>TyperacerTheGame</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
</head>

<body>
<div id="pozadieHlavnaStranka" class="backgroundDefaultFullscreen" style="background-size:cover; overflow-y: auto">
    <div class="container">
    <div class="row g-2">
        <div class="col-6 col-md-3 text-center">
            <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <button class="btn btn-primary w-100" style="margin-bottom:2%; margin-top:2%; background-color: #03203A ">Return to main page</button>
            </form>
        </div>
        <div class="col-6 col-md-3 text-center">
            <button class="btn btn-primary w-100" style="margin-bottom:2%; margin-top:2%;  background-color: #03203A" data-bs-toggle="modal" data-bs-target="#createPostModal">
                Create New Post
            </button>
        </div>
    </div>
    </div>

    @foreach ($posts as $post)
        <div class="row g-2">
            <div class="col-10 col-md-6 text-left" style="background-color: #EAFCFF; margin:2%; padding-top: 5px;">
                <h2 style="background-color: #74889F">{{ $post->post_name }}</h2>
                <p>{{ $post->post_text }}</p>
                <p>Posted by: {{ $post->user->name }}</p>
                <p>Comments: {{ $post->comments->count() }}</p>
                <a href="{{ route('showComments', $post->id) }}" style="font-weight: bold">View Post</a>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}

    <form method="post" action="{{ route('createPost') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="modal fade" id="createPostModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Write whats on your mind!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <label style="color: deepskyblue">Name of new text</label>
                        <textarea name="postHeader" class="textAreaForAdminInput" style="margin-top: 0" placeholder="Topic" required></textarea>
                        <label style="color: deepskyblue">Body of new text</label>
                        <textarea name="postBody" class="textAreaForTyperacer" style="margin-top: 0" autofocus placeholder="What you want to talk about" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="chooseGameButton"  class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <footer class="row fixed-bottom" >
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>
</div>
</body>
</html>
