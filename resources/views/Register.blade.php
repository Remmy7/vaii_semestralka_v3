
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
</head>
<body>
<div id="pozadieRegister" class="backgroundDefaultFullscreen">
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
    <form method="post" action="{{ route('registerUser') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="center-page">
            <div class="mb-1">
                <label for="exampleInputUsername" class="form-label">Username</label>
                @if($errors->has('inputUsername'))
                    <div class="alert alert-danger" style=" margin-bottom: 1px; border-radius: 0; padding: 0"  >
                        {{ $errors->first('inputUsername') }}
                    </div>
                @endif
                <input type="text" class="form-control" id="exampleInputUsername" name="inputUsername" required minlength="6">
            </div>
            <div class="mb-1">
                <label for="passwordStrength" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordStrength" name="inputPassword" required minlength="6">
            </div>
            <div class="mb-1">
                <label for="repeatPassword" class="form-label" >Repeat password</label>
                @if($errors->has('inputPassword'))
                    <div class="alert alert-danger" style=" margin-bottom: 1px; border-radius: 0; padding: 0"  >
                        {{ $errors->first('inputPassword') }}
                    </div>
                @endif
                <input type="password"  class="form-control" id="repeatPassword" name="inputPassword_confirmation" required minlength="6">
            </div>
            <div class="mb-1">
                <label for="email" class="form-label">Email</label>
                @if($errors->has('inputEmail'))
                    <div class="alert alert-danger" style=" margin-bottom: 1px; border-radius: 0; padding: 0"  >
                        {{ $errors->first('inputEmail') }}
                    </div>
                @endif
                <input type="email" class="form-control" id="email" placeholder="email@gmail.com" name="inputEmail">
            </div>
            <button class="btn btn-primary">Register</button>
        </div>
    </form>




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
