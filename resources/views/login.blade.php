<h1>ログイン画面</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/login_exec" method="post">
    @csrf
    email:<input type="text" name="email">
    password:<input type="password" name="password">
    <input type="submit" value="login">
</form>