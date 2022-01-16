<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware(Auth::user()->profile == 'admin')
    }

    public function index()
    {
        $user      = User::where('role','user')->count();
        $question  = Question::count();
        $tag       = Tag::count();
        $badge     = Badge::count();
        return view('dashboard.index',compact('user','question','tag','badge'));
    }

    public function users()
    {
        $users = User::where('role','user')->paginate(5);
        return view('dashboard.user',compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('success','User Deleted Successfuly');//message
        return redirect()->back();
    }

    public function questions()
    {
        $questions = Question::with(['user','votes'])->get();
        return view('dashboard.question',compact('questions'));
    }

}
