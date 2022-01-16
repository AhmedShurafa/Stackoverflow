<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Question;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $questions = Question::with(['user','answers','tags'])
            ->where('status','active')->latest()->paginate();
        return view('main.home',compact('questions'));
    }

    public function tags()
    {
        $tags = Tag::with('questions')->paginate();
        return view('main.tags',compact('tags'));
    }

    public function searchTag(Request $request)
    {
        $tags = Tag::with('questions')->where('name','like','%'.$request->tag.'%')->paginate();
        return view('main.tags',compact('tags'));
    }

     /**
     * This function l have a id tage , l need to get all question has this tage
     * first l get tag and use the relational with question
     */
    public function getQuestionByTag($id)
    {

        $tag = Tag::find($id);
        $questions= $tag->questions()->paginate();

        // $Questions = Tag::with('questions')->findOrFail($id); // another way

        return view('main.questions-tag',compact('questions'));
    }

    public function users()
    {
        $users = User::paginate();
        return view('main.user-list',compact('users'));
    }

    public function searchUsers(Request $request)
    {
        $users = User::where('name','like','%'.$request->name.'%')->paginate();
        return view('main.user-list',compact('users'));
    }


    public function search(Request $request)
    {
        $questions = Question::where('title','like','%'.$request->word.'%')

        ->orWhere('description','like','%'.$request->word.'%')
        
        ->orWhereHas('tags',function($q) use ($request){
            $q->where('name','like','%'.$request->word.'%');
        })
        ->paginate();

        return view('main.home',compact('questions'));
    }
    // Get All Badges
    public function badges()
    {
        $badges = Badge::paginate();
        return view('main.badges-list',compact('badges'));
    }

    // search for badges
    public function badgeSearch(Request $request)
    {
        $badges = Badge::where('name','like','%'.$request->badge.'%')
        ->orWhere('content','like','%'.$request->badge.'%')->paginate();
        // dd($badges);
        return view('main.badges-list',compact('badges'));
    }
}
