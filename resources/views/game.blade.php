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
    <script src="{{ asset('/app.js')}}" defer></script>
</head>
<body>
<div id="pozadieForums" class="backgroundDefaultFullscreen">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 text-center col-centered">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100" style="margin-top:5%">Naspäť na hlavnú stránku</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row text-center center-page">
        <div class="gameTimer" id="gameTimer">0</div>
    </div>
    <div class="col-6 col-md-3 text-center col-centered">
        <form method="post" action="{{ route('viewGame') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <button class="btn btn-primary w-100" style="margin-top:5%; margin-bottom:5%">new text</button>
        </form>
    </div>
    <div class="center-page">
        <div class="background_game">
            <div class="row">
                <div class="col-12">
                    <div class="textAreaForArticle" id="textAreaArticle" style="user-select: none">{{$game_text}}</div>
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

    <footer class="row fixed-bottom">
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>
</div>
</body>
</html>
