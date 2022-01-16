@extends('layouts.main')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/upvotejs.min.css')}}">
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
        .toggle.ios .toggle-handle { border-radius: 20px; }
        .toggle-on.btn{
            padding-right: 15px
        }
    </style>
@endsection
@section('conetnt')

<!--======================================
        START HERO AREA
======================================-->
<section class="hero-area bg-white shadow-sm overflow-hidden pt-40px pb-40px">
    <span class="stroke-shape stroke-shape-1"></span>
    <span class="stroke-shape stroke-shape-2"></span>
    <span class="stroke-shape stroke-shape-3"></span>
    <span class="stroke-shape stroke-shape-4"></span>
    <span class="stroke-shape stroke-shape-5"></span>
    <span class="stroke-shape stroke-shape-6"></span>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="hero-content">
                    <h2 class="section-title pb-2 fs-24 lh-34">Find the best answer to your technical question, <br>
                        help others answer theirs
                    </h2>
                    <p class="lh-26">If you are going to use a passage of Lorem Ipsum, you need to be sure there
                        <br> isn't anything embarrassing hidden in the middle of text.
                    </p>
                    <ul class="generic-list-item pt-3">
                        <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#6c727c"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"/></svg></span> Anybody can ask a question</li>
                        <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#6c727c"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg></span> Anybody can answer</li>
                        <li><span class="icon-element icon-element-xs shadow-sm d-inline-block mr-2"><svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 320 512" width="20px"><path fill="#6c727c" d="M41 288h238c21.4 0 32.1 25.9 17 41L177 448c-9.4 9.4-24.6 9.4-33.9 0L24 329c-15.1-15.1-4.4-41 17-41zm255-105L177 64c-9.4-9.4-24.6-9.4-33.9 0L24 183c-15.1 15.1-4.4 41 17 41h238c21.4 0 32.1-25.9 17-41z"></path></svg></span> The best answers are voted up and rise to the top</li>
                    </ul>
                </div><!-- end hero-content -->
            </div><!-- end col-lg-9 -->

        </div><!-- end row -->
    </div><!-- end container -->
</section>
<!--======================================
        END HERO AREA
======================================-->

<!-- ================================
         START QUESTION AREA
================================= -->
<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="question-main-bar mb-50px">
                    <div class="question-highlight">
                        <div class="media media-card shadow-none rounded-0 mb-0 bg-transparent p-0">
                            <div class="media-body">
                                <h5 class="fs-20 d-flex justify-content-between">
                                    <a href="#">{{ $question->title }}</a>

                                    @auth
                                        @if(Auth::user()->id == $question->user_id)
                                            <div>
                                                <a href="{{ route('question.edit',$question->id) }}"
                                                    class="btn btn-info text-white">
                                                    <i class="la la-edit"></i>
                                                Edit</a>

                                                <form class="d-inline" action="{{ route('question.destroy',$question->id) }}" method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <button type="submit"
                                                        class="btn btn-danger text-white">
                                                        <i class="la la-trash"></i>
                                                        Delete</a>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </h5>

                                <div class="meta d-flex flex-wrap align-items-center fs-13 lh-20 py-1">
                                    <div class="pr-3">
                                        <span>Asked</span>
                                        <span class="text-black">{{ $question->created_at->diffForHumans() }}</span>
                                    </div>
                                    {{-- <div class="pr-3">
                                        <span class="pr-1">Active</span>
                                        <a href="#" class="text-black">19 days ago</a>
                                    </div> --}}
                                    <div class="pr-3">
                                        <span class="pr-1">Viewed</span>
                                        <span class="text-black">{{ $question->views }} times</span>
                                    </div>
                                </div>
                                <div class="tags">
                                    @foreach ($question->tags as $tag)
                                        <a href="#" class="tag-link">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- end media -->
                    </div><!-- end question-highlight -->
                    <div class="question d-flex">
                        <div class="votes votes-styled w-auto">
                            <div id="vote" class="upvotejs">
                                @auth
                                    @if(Auth::user()->id != $question->user_id)
                                        @php
                                            $type = null;
                                            foreach ($question->votes as $key => $value) {
                                                if(Auth::user()->id == $value->user_id){
                                                    if($value->score > 0){
                                                        $type = "+";
                                                    }elseif ($value->score < 0) {
                                                        $type = "-";
                                                    }
                                                }
                                            }
                                        @endphp

                                        <form action="{{ route('question.vote') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="question_id" value="{{ $question->id }}">

                                        @if (!(is_null($type)))
                                            @if($type == "-")
                                                <input type="hidden" name="score" value="1">
                                                <button type="submit" style="border:none;background: none">
                                                    <a class="upvote"
                                                        data-toggle="tooltip"
                                                        data-placement="right" title="This question is useful"></a>
                                                </button>
                                            @endif

                                            <span class="count">{{ $question->votes->sum('score') }}</span>

                                            @if($type == "+")
                                                <input type="hidden" name="score" value="-1">
                                                <button type="submit" style="border:none;background: none">
                                                    <a class="downvote" data-toggle="tooltip"
                                                    data-placement="right" title="" data-original-title="This question is not useful">
                                                    </a>
                                                </button>
                                            @endif
                                        @else
                                            <input type="hidden" name="score" value="1">
                                            <button type="submit" style="border:none;background: none">
                                                <a class="upvote"
                                                    data-toggle="tooltip"
                                                    data-placement="right" title="This question is useful"></a>
                                            </button>
                                            </form>

                                            <span class="count">{{ $question->votes->sum('score') }}</span>

                                            <form action="{{ route('question.vote') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                <input type="hidden" name="score" value="-1">


                                            <button type="submit" style="border:none;background: none">
                                                <a class="downvote" data-toggle="tooltip"
                                                data-placement="right" title="" data-original-title="This question is not useful">
                                                </a>
                                            </button>
                                        @endif
                                    </form>
                                    @else

                                        <span class="count">{{ $question->votes->sum('score') }}</span>

                                    @endif

                                @else

                                <form action="{{ route('question.vote') }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">

                                    <button type="submit" style="border:none;background: none">
                                        <a class="upvote"
                                            data-toggle="tooltip"
                                            data-placement="right" title="This question is useful"></a>
                                    </button>

                                    <span class="count">{{ $question->votes->sum('score') }}</span>

                                    <input type="hidden" name="score" value="-1">
                                    <button type="submit" style="border:none;background: none">
                                        <a class="downvote" data-toggle="tooltip"
                                           data-placement="right" title="" data-original-title="This question is not useful">
                                        </a>
                                    </button>

                                </form>
                                @endauth


                                {{-- <a class="star" data-toggle="tooltip" data-placement="right" title="Bookmark this question."></a> --}}
                            </div>
                        </div><!-- end votes -->
                        <div class="question-post-body-wrap flex-grow-1">
                            <div class="question-post-body">
                                <p>I'm not able to get the data attribute from a button element.</p>
                                @php
                                    $des = trim($question->description, " \n ");
                                @endphp
                                @if(strpos($question->description,'<') != false)
                                    <pre class="code-block custom-scrollbar-styled">
                                        <code style="color: #e83e8c">{{ $des }}</code>
                                    </pre>
                                @else

                                <pre class="code-block custom-scrollbar-styled">{{ $des }}</pre>
                                @endif
                            </div><!-- end question-post-body -->

                            <div class="question-post-user-action">

                            </div><!-- end question-post-user-action -->
                            <div class="comments-wrap">
                                <ul class="comments-list">
                                    @foreach ($question->comments as $comment)

                                    <li>
                                        <div class="comment-body">
                                            <span class="comment-copy">{{ $comment->content }} ?</span>
                                            {{-- <code class="code">prodId</code> --}}
                                            <span class="comment-separated">-</span>
                                            <a href="user-profile.html" class="comment-user" title="15,467 reputation">{{ $comment->user->name }}</a>
                                            <span class="comment-separated">-</span>
                                            <a href="#" class="comment-date">{{ $comment->created_at->diffForHumans() }}</a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="comment-form">
                                    <div class="comment-link-wrap text-center">
                                        <a class="collapse-btn comment-link" data-toggle="collapse" href="#addCommentCollapse" role="button" aria-expanded="false" aria-controls="addCommentCollapse" title="Use comments to ask for more information or suggest improvements. Avoid answering questions in comments.">Add a comment</a>
                                    </div>
                                    <div class="collapse border-top border-top-gray mt-2 pt-3" id="addCommentCollapse">
                                        <form action="{{ route('comment.store') }}" method="post" class="row pb-3">
                                            @csrf
                                            <div class="col-lg-12">
                                                <h4 class="fs-16 pb-2">Leave a Comment</h4>
                                                <div class="divider mb-2"><span></span></div>
                                            </div><!-- end col-lg-12 -->
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                                                    <label class="fs-13 text-black lh-20">Message</label>
                                                    <div class="form-group">
                                                        <textarea class="form-control form--control form-control-sm fs-13"
                                                         name="content" rows="5" placeholder="Your comment here..."></textarea>
                                                        {{-- <div class="d-flex flex-wrap align-items-center pt-2">
                                                            <div class="badge bg-gray border border-gray mr-3 fw-regular fs-13">[named hyperlinks] (https://example.com)</div>
                                                            <div class="mr-3 fw-bold fs-13">**bold**</div>
                                                            <div class="mr-3 font-italic fs-13">_italic_</div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <button class="btn theme-btn
                                                theme-btn-sm float-right" type="submit">Add Comment</button>
                                            </div><!-- end col-lg-12 -->
                                        </form>
                                    </div><!-- end collapse -->
                                </div>
                            </div><!-- end comments-wrap -->
                        </div><!-- end question-post-body-wrap -->
                    </div><!-- end question -->
                    <div class="subheader d-flex align-items-center justify-content-between">
                        <div class="subheader-title">
                            <h3 class="fs-16">{{ $question->answers->count() }} Answer</h3>
                        </div><!-- end subheader-title -->
                        {{-- <div class="subheader-actions d-flex align-items-center lh-1">
                            <label class="fs-13 fw-regular mr-1 mb-0">Order by</label>
                            <div class="w-100px">
                                <select class="select-container">
                                    <option value="active">active</option>
                                    <option value="oldest">oldest</option>
                                    <option value="votes" selected="selected">votes</option>
                                </select>
                            </div>
                        </div><!-- end subheader-actions --> --}}
                    </div><!-- end subheader -->

                    {{-- Start Answers --}}

                    @forelse ($question->answers as $answer)

                    <div class="answer-wrap d-flex">
                        <div class="votes votes-styled w-auto">
                            <div id="vote2" class="upvotejs">
                                @auth
                                    @php
                                        $vote = 0;
                                        $type = null;
                                        foreach ($answer->votes as $key => $value) {
                                            if(Auth::user()->id == $value->user_id){
                                                if($value->score > 0){
                                                    $type = "+";
                                                }elseif ($value->score < 0) {
                                                    $type = "-";
                                                }
                                            }
                                        }
                                    @endphp

                                    @if (!(is_null($type)))
                                        <form action="{{ route('answer.vote') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">

                                        @if($type == "-")
                                                <input type="hidden" name="score" value="1">
                                                <button type="submit" style="border:none;background: none">
                                                    <a class="upvote"
                                                        data-toggle="tooltip"
                                                        data-placement="right" title="This Answer is useful"></a>
                                                </button>
                                            </form>
                                        @endif
                                        <span class="count d-block">{{ $answer->votes->sum('score') }}</span>

                                        @if($type == "+")
                                            <input type="hidden" name="score" value="-1">
                                            <button type="submit" style="border:none;background: none">
                                                <a class="downvote" data-toggle="tooltip"
                                                data-placement="right" title=""
                                                data-original-title="This Answer is not useful">
                                                </a>
                                            </button>
                                        </form>
                                        @endif

                                    @else
                                        <form action="{{ route('answer.vote') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                            <input type="hidden" name="score" value="1">

                                            <button type="submit" style="border:none;background: none">
                                                <a class="upvote"
                                                    data-toggle="tooltip"
                                                    data-placement="right" title="This Answer is useful"></a>
                                            </button>
                                        </form>

                                        <span class="count d-block">{{ $answer->votes->sum('score') }}</span>

                                        <form action="{{ route('answer.vote') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                            <input type="hidden" name="score" value="-1">

                                            <button type="submit" style="border:none;background: none">
                                                <a class="downvote"
                                                    data-toggle="tooltip"
                                                    data-placement="right" title="This Answer is useful"></a>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- check star-on --}}
                                    <a class="star accepted
                                    @if(Auth::user()->id == $question->user_id)
                                    check
                                        @if(Auth::user()->id == $question->user_id && $answer->accepted == 'yes')
                                        star-on
                                        @endif
                                    @endif "  data-toggle="tooltip" num="{{ $answer->id }}"
                                    data-placement="right" title="The question owner accepted this answer"></a>
                                @endauth

                                @guest
                                    <span class="count d-block">{{ $answer->votes->sum('score') }}</span>
                                    <a class="star accepted check
                                        @if($answer->accepted == 'yes')
                                        star-on
                                        @endif " data-toggle="tooltip"
                                        data-placement="right" title="The question owner
                                        accepted this answer"></a>
                                        @endguest
                                </div>
                        </div><!-- end votes -->
                        <div class="answer-body-wrap flex-grow-1">
                            <div class="answer-body">
                                {{-- <p>Since you're using an <code class="code">arrow-function</code>, <code class="code">this</code> does not refer to the <code class="code">button</code>:</p> --}}
                                    <p>{!! $answer->content !!}</p>

                            </div><!-- end answer-body -->
                            <div class="question-post-user-action">
                                @auth
                                    @if(Auth::user()->id == $answer->user_id)
                                        <div class="post-menu">
                                            <a href="{{ route('answer.edit',$answer->id) }}" class="btn">Edit</a>
                                            <form class="d-inline" action="{{ route('answer.delete', $answer->id) }}"
                                                 method="post">
                                                @csrf
                                                @method('Delete')
                                                <button type="submit" class="btn">Delete</a>
                                            </form>
                                        </div><!-- end post-menu -->
                                    @endif
                                @endauth
                                <div class="media media-card user-media align-items-center">
                                    <a href="user-profile.html" class="media-img d-block">
                                        <img src="{{ asset($answer->user->profile->image)}}" alt="avatar">
                                    </a>
                                    <div class="media-body d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="pb-1"><a href="user-profile.html">{{ $answer->user->name }}</a></h5>
                                            <div class="stats fs-12 d-flex align-items-center lh-18">
                                                <span class="text-black pr-2">15.5k</span>
                                                <span class="pr-2 d-inline-flex align-items-center"><span class="ball gold"></span>3</span>
                                                <span class="pr-2 d-inline-flex align-items-center"><span class="ball silver"></span>10</span>
                                                <span class="pr-2 d-inline-flex align-items-center"><span class="ball"></span>26</span>
                                            </div>
                                        </div>
                                        <small class="meta d-block text-right">
                                            <span class="text-black d-block lh-18">answered</span>
                                            <span class="d-block lh-18 fs-12">{{ $answer->created_at->diffForHumans() }}</span>
                                        </small>
                                    </div>
                                </div><!-- end media -->
                                @if( $answer->created_at != $answer->updated_at)
                                    <div class="media media-card user-media align-items-center">
                                        <div class="media-body d-flex align-items-center justify-content-end">
                                            <a href="revisions.html" class="meta d-block text-right fs-13 text-color">
                                                <span class="d-block lh-18">edited</span>
                                                <span class="d-block lh-18 fs-12">{{ $answer->updated_at->diffForHumans() }}</span>
                                            </a>
                                        </div>
                                    </div><!-- end media -->
                                @endif
                            </div><!-- end question-post-user-action -->

                            <!-- ================================
                                    START comments AREA
                            ================================= -->

                            <div class="comments-wrap">
                                <ul class="comments-list">
                                    @foreach ($answer->comments as $comment)
                                        <li>
                                            <div class="comment-actions">
                                                <span class="comment-score">1</span>
                                            </div>
                                            <div class="comment-body">
                                                <span class="comment-copy">{{ $comment->content }} ?</span>
                                                <span class="comment-separated">-</span>
                                                <a href="user-profile.html" class="comment-user owner" title="224,110 reputation">{{ $comment->user->name }}</a>
                                                <span class="comment-separated">-</span>
                                                <a href="#" class="comment-date">{{ $comment->created_at->diffForHumans() }}</a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="comment-form">
                                    <div class="comment-link-wrap text-center">
                                        <a class="collapse-btn comment-link" data-toggle="collapse" href="#addCommentCollapse{{ $loop->iteration }}"
                                        role="button" aria-expanded="false" aria-controls="addCommentCollapse{{ $loop->iteration }}" title="Use comments to ask for more information or suggest improvements. Avoid answering questions in comments.">Add a comment</a>
                                    </div>
                                    <div class="collapse border-top border-top-gray mt-2 pt-3" id="addCommentCollapse{{ $loop->iteration }}">
                                        <form action="{{ route('comment.storeAnwser') }}" method="post" class="row pb-3">
                                            @csrf
                                            <div class="col-lg-12">
                                                <h4 class="fs-16 pb-2">Leave a Comment</h4>
                                                <div class="divider mb-2"><span></span></div>
                                            </div><!-- end col-lg-12 -->
                                            <div class="col-lg-12">
                                                <div class="input-box">
                                                    <label class="fs-13 text-black lh-20">Message</label>
                                                    <input type="hidden" name="answer_id" value="{{ $answer->id }}">

                                                    <div class="form-group">
                                                        <textarea class="form-control form--control
                                                        form-control-sm fs-13" name="content" rows="5"
                                                        placeholder="Your comment here..."></textarea>
                                                        {{-- <div class="d-flex flex-wrap align-items-center pt-2">
                                                            <div class="badge bg-gray border border-gray mr-3 fw-regular fs-13">[named hyperlinks] (https://example.com)</div>
                                                            <div class="mr-3 fw-bold fs-13">**bold**</div>
                                                            <div class="mr-3 font-italic fs-13">_italic_</div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <button class="btn theme-btn theme-btn-sm float-right" type="submit">Add Comment</button>
                                            </div><!-- end col-lg-12 -->
                                        </form>
                                    </div><!-- end collapse -->
                                </div>
                            </div><!-- end comments-wrap -->
                        </div><!-- end answer-body-wrap -->
                    </div><!-- end answer-wrap -->
                    @empty
                        <p class="h4 text-center" style="color: red">No Answer</p>
                    @endforelse

                    @php
                        $answer = 'no';
                        foreach ($question->answers as $value) {
                            if($value->accepted == "yes"){
                                $answer = 'yes';
                                break;
                            }else {
                                $answer = 'no';
                            }
                        }
                    @endphp

                    @if($answer == 'no')
                        <div class="subheader">
                            <div class="subheader-title">
                                <h3 class="fs-16">Your Answer</h3>
                            </div><!-- end subheader-title -->
                        </div><!-- end subheader -->
                        <div class="post-form">
                            <form method="POST" action="{{ route('answer.store') }}" class="pt-3">
                                @csrf
                                <input type="hidden" name="question_id" value="{{ $question->id }}">

                                <div class="input-box">
                                    <label class="fs-14 text-black lh-20 fw-medium">Body</label>
                                    <div class="form-group">
                                        <textarea class="form-control form--control form-control-sm fs-13 user-text-editor"
                                        name="content" rows="6"></textarea>
                                    </div>
                                </div>
                                <button class="btn theme-btn theme-btn-sm" type="submit">Post Your Answer</button>
                            </form>
                        </div>
                    @endif

                </div><!-- end question-main-bar -->
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="fs-17 pb-3">Number Achievement</h3>
                            <div class="divider"><span></span></div>
                            <div class="row no-gutters text-center">
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color">980k</span>
                                        <p class="fs-14">Questions</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-2">610k</span>
                                        <p class="fs-14">Answers</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-3">650k</span>
                                        <p class="fs-14">Answer accepted</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6 responsive-column-half">
                                    <div class="icon-box pt-3">
                                        <span class="fs-20 fw-bold text-color-4">320k</span>
                                        <p class="fs-14">Users</p>
                                    </div><!-- end icon-box -->
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-12 pt-3">
                                    <p class="fs-14">To get answer of question <a href="signup.html" class="text-color hover-underline">Join<i class="la la-arrow-right ml-1"></i></a></p>
                                </div>
                            </div><!-- end row -->
                        </div>
                    </div><!-- end card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="d-flex align-items-center pb-3">
                                <svg class="mr-2" width="18" height="18" viewBox="0 0 18 18" fill="#6c727c"><path d="M1 6l8 5 8-5V4L9 9 1 4c0-1.1.9-2 2-2h12c1.09 0 2 .91 2 2v10c0 1.09-.91 2-2 2H3c-1.09 0-2-.91-2-2V6z"></path></svg>
                                <h3 class="fs-17">Love this site?</h3>
                            </div>
                            <div class="divider"><span></span></div>
                            <p class="fs-14 lh-20 py-3">Get the <span class="text-dark fw-medium">weekly newsletter!</span> In it, you'll get:</p>
                            <ul class="generic-list-item generic-list-item-bullet fs-14 pb-3">
                                <li class="lh-20">The week's top questions and answers</li>
                                <li class="lh-20">Important community announcements</li>
                                <li class="lh-20">Questions that need answers</li>
                            </ul>
                            <button class="btn theme-btn theme-btn-gray w-100">Sign up for the digest</button>
                            <p class="fs-14 pt-1 text-center">See an example newsletter</p>
                        </div>
                    </div><!-- end card -->
                    @include('main.right-sidebar')
                </div><!-- end sidebar -->
            </div><!-- end col-lg-3 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end question-area -->
<!-- ================================
         END QUESTION AREA
================================= -->
@endsection
@section('script')
    <script src="{{ asset('assets/js/upvote.vanilla.js')}}"></script>
    <script src="{{ asset('assets/js/upvote-script.js')}}"></script>

    <script>
        $(document).ready(function() {

          $('#switch').bootstrapToggle({
            on: 'Active',
            off: 'Draft'
          });

          $(".accepted").on('click', function() {
                var myElement= $(this);

                $.ajax({
                type: 'GET',
                url:'/user/Answer/accepted/'+$(this).attr('num'),
                data:{id:$(this).attr('num')},

                success: function (data) {
                    $(".accepted").css("background-position","-5px -265px");//delete

                    myElement.css('background-position',"-45px -265px");

                },
            });

          });

        });
      </script>
@endsection
