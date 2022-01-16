<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use App\Models\Vote;
use App\Notifications\AnwserCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    /**
     * Display a Votes Answer.
     *
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        $request->validate([
            'answer_id' =>'required|int|exists:answers,id',
            'score' =>'required|int|in:1,-1',
        ]);


        $vote = Vote::where(['user_id'=>Auth::user()->id,
                            'voteable_type'=>Answer::class,
                            'voteable_id' =>$request->answer_id
                        ])->first();

        if($vote){
            $score = $vote->score + intval($request->post('score'));
            // dd($score);
        }

        Vote::updateOrCreate(
            ['user_id'      => Auth::user()->id,
            'voteable_type' => Answer::class,
            'voteable_id'   => $request->answer_id
            ]
            ,[
            'voteable_type' => Answer::class,
            'voteable_id'   => $request->answer_id,
            'score'         =>  isset($score) ? strval($score) : $request->post('score')
        ]);

        session()->flash('message','Voted successfully');

        return redirect()->back();
    }

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
            'question_id' => 'required|integer|exists:questions,id',
            'content' => 'required|min:1',
        ]);
        $request->merge([
            'user_id' =>Auth::user()->id,
        ]);

        $answer = Answer::create($request->all());

        $user = User::findOrFail(Auth::id());
        $user->addScore($user,20);

        // Notification

        $user = User::where('id',$answer->question->user->id)->first();

        $user->notify(new AnwserCreatedNotification($answer));


        session()->flash('message','Answer Created successfully');
        return redirect()->route('question.show',$request->question_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $answer = Answer::findOrFail($id);
        if(Auth::user()->id == $answer->user_id){
            $question = Question::findOrFail($answer->question_id)->first();

            return view('main.edit_answer',compact('answer','question'));
        }else{
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'question_id' => 'required|integer|exists:questions,id',
            'content' => 'required|min:1',
        ]);

        $answer = Answer::findOrFail($id);
        $answer->update($request->all());

        session()->flash('message','Answer Updated Successfully');
        return redirect()->route('question.show',$answer->question_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::findOrFail($id)->delete();

        session()->flash('message','Answer Deleted Successfully');
        return redirect()->back();
    }

    public function accepted($id)
    {

        $answer = Answer::findOrFail($id);

        $answers = Answer::where([
            ['question_id',$answer->question_id],
            ['accepted','yes']
        ])->get();

        if($answer->accepted == 'no'){

            foreach($answers as $value){
                $value->update([
                    'accepted' => 'no',
                ]);
            }

            $answer->update([
                'accepted' => 'yes',
            ]);
        }else{
            foreach($answers as $value){
                $value->update([
                    'accepted' => 'no',
                ]);
            }
        }
        session()->flash('message','Answer Accepted Successfully');
    }
}
