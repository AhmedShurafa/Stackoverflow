<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|int|exists:questions,id',
            'content' => 'required|string',
        ]);

        $r = Comment::create([
            'user_id'          => Auth::user()->id,
            'commentable_type' => Question::class,
            'commentable_id'   => $request->question_id,
            'content'          => $request->content,
        ]);

        session()->flash('message','Created Comment Successfully');
        return redirect()->back();
    }


    public function storeAnwser(Request $request)
    {
        $request->validate([
            'answer_id' => 'required|int|exists:answers,id',
            'content' => 'required|string',
        ]);

        $r = Comment::create([
            'user_id'          => Auth::user()->id,
            'commentable_type' => Answer::class,
            'commentable_id'   => $request->answer_id,
            'content'          => $request->content,
        ]);

        session()->flash('message','Created Comment Successfully');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
