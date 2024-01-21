<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>TyperacerTheGame</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            </div>
            <div class="row">
                <div class="col-12 col-md-9 col-xl-5 mainPageText">
                    <p id="textMainPage" >Unleash the Speed of Your Fingertips: Type Faster, Race Harder, and Conquer the Keyboard! Welcome to TypeRacer, where precision meets velocity. Ready, Set, Type!</p>
                </div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <button class="btn btn-primary w-100 playGameButton" data-bs-toggle="modal" data-bs-target="#choose_text">Play</button>
                <div class="modal fade" id="choose_text" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose your text</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="gameForm" method="post" action="{{ route('viewGame') }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <!-- Make sure you have an input field with the name "gameTextID" -->
                                    <input type="hidden" name="gameTextID" id="gameTextIDInput" value="">

                                    <div class="btn-group row g-2" role="group" id="gameTextID">
                                        @foreach($gameTexts as $gameText)
                                            <button type="button" class="btn btn-primary game-button" data-value="{{ $gameText->textName }}" data-id="{{$gameText->id}}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 20%;">
                                                {{ Str::limit($gameText->textName, 40) }}
                                            </button>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
            </div>
            <div class="row">
                <div class="col-12 col-md-9 col-xl-5 mainPageText">
                    <p id="textMainPage" >Unleash the Speed of Your Fingertips: Type Faster, Race Harder, and Conquer the Keyboard! Welcome to TypeRacer, where precision meets velocity. Ready, Set, Type!</p>
                </div>
            </div>

        @endif
        @if(auth()->check())
            @if($user->privilege == 4)
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('viewAdminMenu') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <button class="btn btn-primary w-100 adminMenuButton">Admin menu</button>
                    </form>
                </div>
            @endif
        @endif
            <div class="col-6 col-md-3 text-center">
                <form method="post" action="{{ route('viewLeaderboard') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100 leaderboardMenuButton">Leaderboard</button>
                </form>
            </div>
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
