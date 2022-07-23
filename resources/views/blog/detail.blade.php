@extends('blog.layout.template')

@section('title', '詳細')

@section('content')
    <div class="container mt-5">
        <div class="float-end ms-3">ログイン名： {{ $login_user->name }}</div>
        <div class="float-end ms-3"><a href="/logout">Log Out</a></div>
        <h3 class="mb-3" style="text-align: center;">詳細</h3>

        <h3 class="mt-5">タイトル</h3>
        <p>{{ $blog->title }}</p>

        <h3 class="mt-5">本文</h3>
        <p class="mb-5">{{ $blog->body }}</p>

        
        <h3 class="mt-5 border-bottom">Comments</h3>
        <div class="comments text-center">
            @foreach($comments as $comment)
            <p><span class="font-weight-bold">{{ $comment->display_name }}</span>：{{ $comment->created_at->format('Y/m/d') }}</p>
            <p>{{ $comment->comment }}</p>
            @endforeach
            <form action="/blog/detail/comment_exec/{{$blog_id}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label"><h3>Display Name</h3></label>
                    <input type="text" class="form-control" name="display_name" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label"><h3>Leave a comment</h3></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                </div>
                <div class="mt-3 text-center"><input class="btn btn-primary" type="submit" value="作成"></div>
            </form>
        </div>
    </div>
@endsection