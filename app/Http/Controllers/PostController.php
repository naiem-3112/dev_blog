<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Category;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        if (Auth::user()->status == 1) {
            return view('post.index', compact('posts'));
        }
    }

    public function create()
    {
        $categories = Category::all();
        if (Auth::user()->status == 1) {
            return view('post.create', compact('categories'));
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->status == 1) {
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required'
            ]);
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->category_id = $request->category_id;
            $post->user_id = Auth::id();
            if (Auth::id() == 1) {
                $post->status = 1;
            }
            $post->save();
            return redirect()->route('post.index')->with('message', 'Post inserted successfully');
        }
    }


    public function edit($id)
    {
        if (Auth::user()->status == 1) {
            $post = Post::findOrfail($id);
            if (Auth::id() == 1 || Auth::id() == $post->user_id) {
                return view('post.edit', compact('post'));
            } else {
                return back();
            }
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->status == 1) {
            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required'
            ]);
            $post = Post::findOrfail($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->category_id = $request->category_id;
            if (Auth::id() != 1) {
                $post->status = 0;
            }
            $post->save();
            return redirect()->route('post.index')->with('message', 'Post updated successfully');
        }
    }

    public function delete($id)
    {
        $post = Post::findOrfail($id);
        if (Auth::id() == 1 || Auth::id() == $post->user_id) {
            $post->comments()->delete();
            $post->delete();
            return redirect()->route('post.index')->with('message', 'Post deleted successfully');
        }
    }

//welcome page showing
    public function show()
    {
        $categories = Category::all();
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->with('user')->take(10)->paginate('4');
        return view('welcome', compact('posts', 'categories'));
    }

    //same category post
    public function sameCatPost($id)
    {
        $categories = Category::all();
        $sameCatPost = Post::with('user')->where('category_id', $id)->get();
        return view('post.sameCatPost', compact('sameCatPost', 'categories'));
    }

    //post details
    public function singleView($id)
    {
        $post = Post::findOrfail($id);
        $cat = $post->category_id;
        $sameCats = DB::table('posts')->where('status', 1)->where('category_id', $cat)->paginate(2);
        return view('post.singleView', compact('post', 'sameCats'));
    }

    //post Comment storing
    public function commentStore(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
        $post = Post::findOrfail($id);
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $post->id;
        $comment->save();
        return back();
    }

//post reject by admin(SoftDelete)
    public function rejected()
    {
        $rejects = Post::onlyTrashed()->get();
        return view('post.reject', compact('rejects'));
    }

    public function rejectedPostView($id)
    {
        $rejectView = Post::onlyTrashed()->find($id);
        return view('post.rejectedPostView', compact('rejectView'));
    }

    public function rejectedPostEdit($id)
    {
        $rejectEdit = Post::onlyTrashed()->find($id);
        return view('post.rejectedPostEdit', compact('rejectEdit'));
    }

    public function rejectedPostUpdate(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        $rejectEdit = Post::onlyTrashed()->find($id);
        $rejectEdit->restore();
        $rejectEdit->title = $request->title;
        $rejectEdit->body = $request->body;
        $rejectEdit->category_id = $request->category_id;
        if (Auth::id() != 1) {
            $rejectEdit->status = 0;
        }
        $rejectEdit->save();
        return redirect()->route('post.index')->with('message', 'Post updated successfully');
    }

    public function rejectedPostDelete($id)
    {
        $rejectDelete = Post::withTrashed()->find($id);
        $rejectDelete->forceDelete();
        return back()->with('message', 'Post deleted successfully');

    }

    //post approve by admin
    public function approve($id)
    {
        if (Auth::id() == 1) {
            $post = Post::findOrfail($id);
            $post->status = 1;
            $post->save();
        }
        return back()->with('message', 'Post Approved successfully');

    }

    //search specific post
    public function search(Request $request)
    {
        $this->validate($request, [
           'searchData' => 'required'
        ]);

        $searchData = $request->searchData;
        if ($searchData) {
            $datas = Post::where('title', 'like', '%' . $searchData . '%')
                /*->orWhere('body', 'like', '%' . $searchData . '%')*/
                ->orWhereHas('category', function ($category) use ($searchData) {
                    $category->where('name', 'like', '%' . $searchData . '%');
                })
                ->get();
            return view('post.search', compact('datas'));
        }else{
            return back();
        }
    }
    public function authPostView($id)
    {
        $post = Post::findOrfail($id);
        return view('post.authPostView', compact('post'));
    }

}
