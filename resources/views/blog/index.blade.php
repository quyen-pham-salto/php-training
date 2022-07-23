@extends('blog.layout.template')

@section('title', '一覧表示')

@section('content')
<div class="container mt-5">
        <div class="float-end ms-3">ログイン名： {{ $login_user->name }}</div>
        <div class="float-end ms-3"><a href="/logout">Log Out</a></div>
        <h3 class="mb-3" style="text-align: center;">一覧表示</h3>

        <div class="mb-5"><a href="/blog/create" class="btn btn-primary btn-lg" style="color:white;text-decoration:none;">Create</a></div>

        <table class="table table-striped">
            <thead class="thead-dark">
                <tr><th>Title</th><th>Photo</th><th>Created at</th><th>Action</th><th colspan="2"></th></tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->photo_name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>
                            <a class="btn btn-outline-primary btn-sm" href="/blog/detail/{{ $blog->id }}">View</a>
                            <a class="btn btn-outline-primary btn-sm" href="/blog/update/{{ $blog->id }}">Edit</a>
                            <a class="btn btn-outline-primary btn-sm" href="/blog/delete/exec/{{ $blog->id }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection