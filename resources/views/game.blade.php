<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forums</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/game.js')}}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<div id="pozadieForums" class="backgroundDefaultFullscreen">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 text-center col-centered">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100" style="margin-top:5%; background-color: #03203A">Naspäť na hlavnú stránku</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-9 col-xl-5 text-center">
        <div class="gameTimer" id="gameTimer">0</div>
    </div>
    <div class="col-6 col-md-3 text-center col-centered">
        <button class="btn btn-primary w-100" id="resetGame" style="margin-top:5%; margin-bottom:5%; background-color: #03203A">Try again</button>
        <form method="post" action="{{ route('viewGame') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
        </form>
        <button class="btn btn-primary w-100 playGameButton" style="margin-bottom: 2%; background-color: #03203A" data-bs-toggle="modal" data-bs-target="#choose_text">Play new map</button>
    </div>
    <div class="center-page">
        <div class="background_game">
            <div class="row">
                <div class="col-12">
                    <div class="textAreaForArticle" id="textAreaArticle" style="user-select: none">{{$gameText}}</div>
                    <input type="hidden" id="game_text_id" value="{{ $gameTextId }}">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <textarea id="textAreaTyperacer" class="textAreaForTyperacer" placeholder="Write what you see above over here!" autofocus></textarea>
                </div>
                <p id="CPM">CPM: 0</p>
            </div>
        </div>
    </div>

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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Text preview</h1>
                        <div id="textPreview" class="col-12 col-md-9 col-xl-5 mainPageText"></div>
                        <button type="submit" id="chooseGameButton"  class="btn btn-primary">Play!</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <footer class="row fixed-bottom">
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>
</div>
</body>
</html>
