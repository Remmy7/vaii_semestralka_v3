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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
</head>
<body>
<div id="pozadieSettings" class="backgroundDefaultFullscreen">
    <div class="container">
        <div class="row">
            <div class="col-6 col-xl-3 col-centered" style="margin-top: 5%;">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100" style="background-color: #03203A;">Main Page</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row g-2">
        <div class="col-6 col-md-3 text-center" style="margin-top: 5%">
            <button type="button" class="btn btn-primary"  style="background-color: #03203A" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
    <div class="center-page">
        <div class="row g-2" style="margin-top: 5%; width:100%; background-color: lightblue" >
            <div class="row">
                <p style="font-weight: bold; text-align: center">User page</p>
            </div>
            <div class="row">
                <p style="font-weight: bold">Name: {{$userData->name}}</p>
             </div>
            <form method="post" action="{{ route('changePassword') }}" id="changePasswordForm" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="mb-1" style="color: black">
                    @if($errors->has('inputPassword'))
                        <div class="alert alert-danger" style=" margin-bottom: 1px; border-radius: 0; padding: 0"  >
                            {{ $errors->first('inputPassword') }}
                        </div>
                    @endif
                    <label for="passwordStrength" class="form-label">Change password</label>
                    <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" required minlength="6">
                </div>
                <button type="submit" style="color: #03203A">Change password</button>
            </form>

            <form method="post" action="{{ route('changeEmail') }}" id="changeEmailForm" accept-charset="UTF-8">
                {{ csrf_field() }}

                <div class="mb-1" style="color: black">
                    <label for="email" class="form-label">Change email</label>
                    @if($errors->has('inputEmail'))
                        <div class="alert alert-danger" style=" margin-bottom: 1px; border-radius: 0; padding: 0"  >
                            {{ $errors->first('inputEmail') }}
                        </div>
                    @endif
                    <input type="email" class="form-control" id="email" placeholder="email@gmail.com" name="inputEmail">
                </div>
                <button type="submit" style="color: #03203A">Change email</button>
            </form>
        </div>
        <div class="row g-2">
            <div class="col-6 col-md-3 text-center" style="margin-top: 5%">
                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                    Delete user
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
                                    <button class="btn btn-danger w-100">Delete user</button>
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
