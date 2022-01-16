<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Throwable;

class QuestionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }
    /**
     * vote to question
     *
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        $request->validate([
            'question_id' =>'required|int|exists:questions,id',
            'score' =>'required|int|in:1,-1',
        ]);

        $vote = Vote::where(['user_id'=>Auth::user()->id,
                            'voteable_type'=>Question::class,
                            'voteable_id' =>$request->question_id
                        ])->first();

        if($vote){
            $score = $vote->score + intval($request->post('score'));
        }
        // dd(strval($score));

        Vote::updateOrCreate(
            ['user_id'      => Auth::user()->id,
            'voteable_type' => Question::class,
            'voteable_id'   => $request->question_id
            ]
            ,[
            'voteable_type' => Question::class,
            'voteable_id'   => $request->question_id,
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
        $tags = Tag::all();
        return view('main.add_Question',compact('tags'));
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
            'title' => 'required|string|min:3|max:255',
            'tags' => 'required|max:255',
            'description' => 'required|min:3|max:255',
        ]);

        $request->merge([
            'user_id' =>Auth::user()->id,
        ]);

        if($request->hasFile('images')){
            $request->merge([
                $request->file('images')->store('questions','public'),
            ]);
        }

        $Question = Question::create($request->all());

        if ($request->tags){
            $Question->tags()->attach($request->tags);
        }

        session()->flash('message','Data Create Successfully');
        return redirect()->route('question.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with(['user.profile','answers.user','answers.votes','tags',
        'votes','comments','answers.comments'])->findOrFail($id);

        // l add number by session to know he show question or no
        // if not have number l will add and plus a view +1, if he hava a number dont add views
        if (!(session()->has('number'.$question->id))) {
            session()->put('number'.$question->id,uniqid());
            $question->increment('views');
        }

        $test = $question->tags->pluck('id')->toArray();// whererIn

        $r = DB::table('question_tag')->whereIn('tag_id',$test)->take(5)->get();

        // dd($r);

        return view('main.question-details',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $question = Question::with(['user','answers','tags:id'])->findOrFail($question->id);
        $tags = Tag::all();

        return view('main.edit_question',compact('question','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $validator = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'tags' => 'required|max:255',
            'description' => 'required|min:3|max:255',
        ]);

        $data = $request->only(['title','description']);

        if($request->hasFile('images')){
            $image = $request->images->store('questions','public');
            Storage::disk('public')->delete($question->images);
            $data['images'] = $image;
        }

        if($request->tags){
            $question->tags()->sync($request->tags);
        }

        $question->update($data);

        session()->flash('message','Question Updata successfully');
        return redirect()->route('question.edit',$question->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        session()->flash('message','Question Deleted successfully');
        return redirect()->route('main');
    }

    public function status(Request $request,$id)
    {
        $id = $request->Qid;

        $question = Question::find($id);

        if(Auth::user()->id == $question->user_id){
            if($question->status == 'active'){
                $question->update([
                    'status' => 'draft'
                ]);
            }else{
                $question->update([
                    'status' => 'active'
                ]);
            }

        }else{
            abort(403);
        }
        session()->flash('message','Change Status Successfully');
        return redirect()->back();
    }
}
