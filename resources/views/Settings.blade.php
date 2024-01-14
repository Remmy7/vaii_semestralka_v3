    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
</head>
<body>
<div id="pozadieSettings" class="backgroundDefaultFullscreen">
    <div class="container">
        <div class="row">
            <div class="col-6 col-xl-3 col-centered" style="margin-top: 5%">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100">Main Page</button>
                </form>
            </div>
        </div>
    </div>
    <div class="center-page">
        <div class="row g-2">
            <div class="col-6 col-md-3 text-center" style="margin-top: 5%">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Logout
                </button>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you certain you want to log out?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay logged in</button>
                            <form method="post" action="{{ route('userLogout') }}" accept-charset="UTF-8">
                                {{ csrf_field() }}
                                <button class="btn btn-danger w-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-2 adminMenu" style="margin-top: 5%; width:100%" >
            <div class="row">
                <p id="textMainPage">Logged session data:</p>
            </div>
            <div class="row">
                <p>Name: </p>
             </div>
        </div>
        <div class="row g-2">
            <div class="col-6 col-md-3 text-center" style="margin-top: 5%">
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                    delete user
                </button>
                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you certain you want to log out?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Do not delete user</button>
                                <form method="post" action="{{ route('deleteUser') }}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger w-100">delete user</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="row fixed-bottom" >
        <p>Author: Tibor Michalov <a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>
        <!--<p><a href="mailto:michalov1@stud.uniza.sk">michalov1@stud.uniza.sk</a></p>-->
    </footer>
</div>

</body>
</html>
