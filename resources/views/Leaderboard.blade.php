<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
</head>
<body>
<div id="pozadieLeaderboard" class="backgroundDefaultFullscreen">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3 text-center col-centered">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100">Naspäť na hlavnú stránku</button>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive-md table-fixed">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Rank</th>
                <th scope="col">Username</th>
                <th scope="col">WPM</th>
                <th scope="col">Games played</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="col">1</th>
                <th scope="col">Reimu</th>
                <th scope="col">240</th>
                <th scope="col">364852</th>
            </tr>
            <tr>
                <th scope="col">2</th>
                <th scope="col">Hakurei</th>
                <th scope="col">239</th>
                <th scope="col">128489</th>
            </tr>

        </table>
    </div>
    <footer class="fixed-bottom">
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>
</div>

</body>

</html>
