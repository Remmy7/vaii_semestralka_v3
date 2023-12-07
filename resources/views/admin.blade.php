<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>TyperacerTheGame</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    <script src="{{ asset('/app.js')}}" defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
<div id="pozadieHlavnaStranka" class="backgroundDefaultFullscreen">
    <div class="container overflow-hidden">
        <div class="row g-2">
            <div class="col-6 col-md-3 text-center col-centered">
                <form method="post" action="{{ route('viewIndex') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <button class="btn btn-primary w-100" style="margin-top:5%">Naspäť na hlavnú stránku</button>
                </form>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="adminMenu">
            <form method="post" action="{{ route('addText') }}" accept-charset="UTF-8" onsubmit="return validateForm('addText')">
                {{ csrf_field() }}
                <textarea name="addText" class="textAreaForTyperacer" autofocus placeholder="Create new text!" required></textarea>
                <div class="row g-2">
                    <div class="col-6 col-md-3 text-center">
                        <select name="category_id" id="category" class="category" required>
                            <option disabled selected>--select category--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-md-3 text-center">
                        <select name="difficulty_id" id="difficulty" class="difficulty" required>
                            <option disabled selected>--select difficulties--</option>
                            @foreach($difficulties as $difficulty)
                                <option value="{{ $difficulty->id }}">{{ $difficulty->difficulty }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-3 text-center" >
                    <button>save article</button>
                </div>
            </form>
            <form method="post" action="{{ route('deleteText') }}" accept-charset="UTF-8" onsubmit="return validateForm('deleteText')">
                @csrf
                <select name="text_id" id="texts" class="texts" style="width:50%">
                    <option disabled selected>--search texts--</option>
                    @foreach($texts as $text)
                        <option value="{{ $text->id }}" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 20%;">
                            {{ Str::limit($text->gameText, 40) }}
                        </option>
                    @endforeach
                </select>
                <div class="col-6 col-md-3 text-center" >
                    <button>delete article</button>
                </div>
            </form>
            <div class="row g-2">
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('addCategory') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <textarea name="addCategory" class="textAreaForAdminInput" placeholder="Create category" required></textarea>
                        <button>save category</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('addDifficulty') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <textarea name="addDifficulty" class="textAreaForAdminInput" placeholder="Create difficulty" required></textarea>
                        <button>save difficulty</button>
                    </form>
                </div>
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('updateCategory')}}" accept-charset="UTF-8" onsubmit="return validateForm('updateCategory')">
                        {{ csrf_field() }}
                        <textarea name="updateCategory" class="textAreaForAdminInput" placeholder="Update category" required></textarea>
                        <select name="category_id_update" id="categoryUpdate" data-id="categoryUpdate" class="categoryUpdate">
                            <option disabled selected>--select category--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-id="{{$category->id}}">{{ $category->categoryTitle }}</option>
                            @endforeach
                        </select>
                        <button class="categoryUpdateButton" id="update_category" data-id="{{ $category->id }}">update category</button>
                    </form>
                </div>

                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('updateDifficulty')}}" accept-charset="UTF-8" onsubmit="return validateForm('updateDifficulty')">
                        {{ csrf_field() }}
                        <textarea name="updateDifficulty" class="textAreaForAdminInput" placeholder="Update difficulty" required ></textarea>
                        <select name="difficulty_id_update" id="updateDifficulty" data-id2="difficultyUpdate" class="difficultyUpdate">
                            <option disabled selected>--select difficulties--</option>
                            @foreach($difficulties as $difficulty)
                                <option value="{{ $difficulty->id }}" data-id2="{{$difficulty->id}}">{{ $difficulty->difficulty }}</option>
                            @endforeach
                        </select>
                        <button class="updateDifficultyButton" id="update_difficulty" data-id2="{{ $difficulty->id }}">update difficulty</button>
                    </form>
                </div>
            </div>


            <div class="row g-2">
                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('deleteCategory')}}" accept-charset="UTF-8" onsubmit="return validateForm('deleteCategory')">
                        {{ csrf_field() }}
                        <select name="category_id_delete" id="categoryDelete" data-id="categoryDelete" class="categoryDelete" required>
                            <option disabled selected>--select category--</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" data-id="{{$category->id}}">{{ $category->categoryTitle }}</option>
                            @endforeach
                        </select>
                        <button class="categoryDeleteButton" id="delete_category" data-id="{{ $category->id }}">delete category</button>
                    </form>
                </div>

                <div class="col-6 col-md-3 text-center">
                    <form method="post" action="{{ route('deleteDifficulty')}}" accept-charset="UTF-8" onsubmit="return validateForm('deleteDifficulty')">
                        {{ csrf_field() }}
                        <select name="difficulty_id_delete" id="difficultyDelete" data-id2="difficultyDelete" class="difficultyDelete" required >
                            <option disabled selected>--select difficulties--</option>
                            @foreach($difficulties as $difficulty)
                                <option value="{{ $difficulty->id }}" data-id2="{{$difficulty->id}}">{{ $difficulty->difficulty }}</option>
                            @endforeach
                        </select>
                        <button class="deleteDifficultyButton" id="delete_difficulty" data-id2="{{ $difficulty->id }}">deleteDifficulty</button>
                    </form>
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
