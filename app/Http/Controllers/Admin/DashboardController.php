<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use function foo\func;


class DashboardController extends Controller
{
    public function index()
    {
        $newUser = User::where('status', 0)->get()->count();
        $posts = Post::all()->count();
        $pending = Post::where('status', 0)->with('user')->whereHas('user', function ($q) {
                $q->where('role_id', 2);
        })->get();
        $categories = Category::all()->count();
        return view('admin.dashboard', compact('posts', 'categories', 'pending', 'newUser'));
    }

    public function pending()
    {
        $pendings = Post::with('user')->whereHas('user', function ($q) {
            $q->where('role_id', 2);
        })
            ->where('status', 0)
            ->get();
        /* $pendings = Post::where('status', 0)->where('role_id', 2)->get();*/

        return view('post.pending', compact('pendings'));
    }
    public function newRegistration()
    {
        $newRegisters = User::where('status', 0)->get();
        return view('admin.newRegister', compact('newRegisters'));
    }
    public function registrationApprove($id){
        $user = User::findOrfail($id);
        $user->status = 1;
        $user->save();
        return back()->with('message', 'User approved');
    }

    public function registrationDelete($id){
        $user = User::findOrfail($id);
        $user->delete();
        return back()->with('message', 'User Deleted');
    }


}
