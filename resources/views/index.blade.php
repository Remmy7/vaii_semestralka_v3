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
    <script src="{{ asset('/app.js')}}" defer></script>


</head>

<body>

<div id="pozadieHlavnaStranka" class="backgroundDefaultFullscreen">
    <div class="container overflow-hidden">
        @if(auth()->check())
            <div class="row g-2">
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewSettings') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 settingsMenuButton">Settings</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewPosts') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 forumButton">Forum</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewLeaderboard') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 leaderboardMenuButton">Leaderboard</button>
                    </form>
                </div>
                @if($user->privilege == 4)
                    <div class="col-6 col-md-3 text-center">
                        <form method="post" action="{{ route('viewAdminMenu') }}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <button class="btn btn-primary w-100 adminMenuButton">Admin menu</button>
                        </form>
                    </div>
                @endif

            </div>

            <div class="row justify-content-center align-items-center">
                <div class="row mb-lg-5 mb-md-2"></div>
                <div class="row mb-lg-5 mb-md-2"></div>
                <div class="row mb-lg-5 mb-md-2"></div>
                <div class="row mb-lg-5 mb-md-2"></div>

                <div class="col-12 col-md-9 col-xl-5 text-center">
                    <label style="font-size: 30px; font-weight: bold; color:navajowhite">Type racer game</label>
                    <p id="textMainPage" class="mb-5">Unleash the Speed of Your Fingertips: Type Faster, Race Harder, and Conquer the Keyboard! Welcome to TypeRacer, where precision meets velocity.</p>
                    <button class="btn btn-primary w-100 playGameButton" data-bs-toggle="modal" data-bs-target="#choose_text">Ready, Set, Type!</button>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <form id="gameForm" method="post" action="{{ route('viewGame') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="modal fade" id="choose_text" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose your text</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                        <input type="hidden" name="gameTextID" id="gameTextIDInput" value="">
                                        <div class="row">
                                            <div class="col">
                                                <label for="difficultySelect" class="form-label">Difficulty</label>
                                                <select class="form-select" id="difficultySelect" name="difficultyID" required>
                                                    <option value="" selected disabled>Select Difficulty</option>
                                                    @foreach($difficulties as $difficulty)
                                                        <option value="{{ $difficulty->id }}">{{ $difficulty->difficulty }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="categorySelect" class="form-label">Category</label>
                                                <select class="form-select" id="categorySelect" name="categoryID" required>
                                                    <option value="" selected disabled>Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->categoryTitle }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="gameTextSelect" class="form-label">Game Text</label>
                                                <select class="form-select"  id="gameTextSelect" name="gameTextID" required>
                                                    <option value="" style="max-width: 70%" selected disabled>Select Game Text</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <h1 class="modal-title fs-5 text-left">Text preview</h1>
                                    <div id="textPreview" class="col-12 col-md-9 col-xl-5"></div>
                                    <button type="submit" id="chooseGameButton"  class="btn btn-primary">Play!</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="row g-2">
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewLogin') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 loginButton">Login</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewRegister') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 registerButton">Register</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewLeaderboard') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 leaderboardMenuButton">Leaderboard</button>
                    </form>
                </div>
            </div>
            <div class="row mb-5"></div>
            <div class="col-12 col-md-9 col-xl-5 text-center">
                <label style="font-size: 30px; font-weight: bold; color:navajowhite">Type racer game</label>
                <p id="textMainPage" class="mb-5">Unleash the Speed of Your Fingertips: Type Faster, Race Harder, and Conquer the Keyboard! Welcome to TypeRacer, where precision meets velocity.</p>
            </div>
        @endif
    </div>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <footer class="row fixed-bottom" >
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>

</div>
</body>
</html>
