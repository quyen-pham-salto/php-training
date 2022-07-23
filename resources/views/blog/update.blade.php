@extends('blog.layout.template')

@section('title', '更新')

@section('content')
    <div class="container mt-5">
        <div class="float-end ms-3">ログイン名： {{ $login_user->name }}</div>
        <div class="float-end ms-3"><a href="/logout">Log Out</a></div>
        <h3 class="mb-3" style="text-align: center;">更新</h3>



        <form action="/blog/update/exec/{{ $blog_id }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
            <label for="exampleFormControlInput1" class="form-label">Photo</label>
                <input type="file" class="form-control" name="photo_name">
            </div>
            <div class="mt-3 text-center"><input class="btn btn-primary" type="submit" value="更新"></div>
        </form>
        
    </div>
@endsection