<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request) {
        $loginUser = Auth::user();
        $blogs = Blog::get();
        return view('blog.index')
            ->with('login_user', $loginUser)
            ->with('blogs', $blogs);
    }

    public function create(Request $request) {
        $loginUser = Auth::user();

        return view('blog.create')
            ->with('login_user', $loginUser);
    }

    public function createExec(Request $request) {
        $loginUser = Auth::user();
        $requests = $request->all();
        Blog::insert([
            'user_id' => $loginUser->id,
            'title' => $requests['title'],
            'body' => $requests['body'],
            'photo_name' => $requests['photo_name'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/blog');
    }

    public function detail($blogId, Request $request) {
        $loginUser = Auth::user();
        $blog = Blog::where('id', $blogId)
            ->get();
        $comments = Comment::get();

        return view('blog.detail')
            ->with('login_user', $loginUser)
            ->with('blog', $blog[0])
            ->with('comments', $comments)
            ->with('blog_id', $blogId);
    }

    public function commentExec($blogId, Request $request) {
        $loginUser = Auth::user();
        $requests = $request->all();

        Comment::insert([
            'user_id' => $loginUser->id,
            'blog_id' => $blogId,
            'display_name' => $requests['display_name'],
            'comment' => $requests['comment'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect('/blog/detail/' . $blogId);
    }

    public function update($blogId, Request $request) {
        $loginUser = Auth::user();

        return view('blog.update')
            ->with('login_user', $loginUser)
            ->with('blog_id', $blogId);
    }
    
    public function updateExec($blogId, Request $request) {
        $loginUser = Auth::user();
        $requests = $request->all();
        var_dump($blogId);

        Blog::where('id', $blogId)
            ->where('user_id', $loginUser->id)
            ->update([
                'user_id' => $loginUser->id,
                'title' => $requests['title'],
                'body' => $requests['body'],
                'photo_name' => $requests['photo_name'],
            ]);

        return redirect('/blog');
    }

    public function deleteExec($blogId, Request $request) {
        $loginUser = Auth::user();
        $requests = $request->all();
        Blog::where('id', $blogId)->delete();

        return redirect('/blog');
    }
}
