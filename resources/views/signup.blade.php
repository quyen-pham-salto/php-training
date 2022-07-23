<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>sign up</title>
</head>


<body class="text-center">
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif
    <h1 class="h3 mt-5 mb-3 font-weight-normal">新規作成画面</h1>
    <form class="w-25 mx-auto" action="/signup_exec" method="post">
        @csrf
        <label for="username" class="sr-only"></label>
        <input class="form-control" id="username" type="text" name="name" placeholder="NAME" required autofocus/>

        <label for="email" class="sr-only"></label>
        <input class="form-control" id="email" type="text" name="email" placeholder="MAIL" required autofocus/>

        <label for="password" class="sr-only"></label>
        <input class="form-control" id="password" type="password" name="password" placeholder="PASSWORD" required/>
        <input class="btn btn-outline-primary my-1" type="submit" value="Sign In"/><br>
        <a class="btn btn-outline-primary my-1" href="/login">Log Inがまだの方はこちらから</a>
    </form>
</body>