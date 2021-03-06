@extends('layouts.main')
@section('conetnt')

<!-- ================================

         START QUESTION AREA
================================= -->
<section class="question-area pt-40px">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="question-main-bar pb-45px">

                    <div class="filters pb-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                            <h3 class="fs-22 fw-medium">All Questions</h3>
                            <a href="{{ route('question.create') }}" class="btn theme-btn theme-btn-sm">Ask Question</a>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <p class="pt-1 fs-15 fw-medium lh-20">{{ $questions->count() }} questions</p>
                            {{-- <div class="filter-option-box w-10">
                                <select class="custom-select">
                                    <option value="newest" selected="selected">Newest </option>
                                    <option value="featured">Bountied (390)</option>
                                    <option value="frequent">Frequent </option>
                                    <option value="votes">Votes </option>
                                    <option value="active">Active </option>
                                    <option value="unanswered">Unanswered </option>
                                </select>
                            </div><!-- end filter-option-box --> --}}
                        </div>
                    </div><!-- end filters -->
                    <div class="questions-snippet border-top border-top-gray">

                        @forelse ($questions as $value)

                        <div class="media media-card rounded-0 shadow-none mb-0 bg-transparent py-3 px-0 border-bottom border-bottom-gray">
                            <div class="votes text-center votes-2">
                                <div class="vote-block">
                                    <span class="vote-counts d-block text-center pr-0 lh-20 fw-medium">{{ $value->votes->sum('score') }}</span>
                                    <span class="vote-text d-block fs-13 lh-18">votes</span>
                                </div>
                                <div class="answer-block answered my-2">
                                    <span class="answer-counts d-block lh-20 fw-medium">{{ $value->answers->count() }}</span>
                                    <span class="answer-text d-block fs-13 lh-18">answers</span>
                                </div>
                                <div class="view-block">
                                    <span class="view-counts d-block lh-20 fw-medium">{{ $value->views }}</span>
                                    <span class="view-text d-block fs-13 lh-18">views</span>
                                </div>
                            </div>
                            <div class="media-body">
                                <h5 class="mb-2 fw-medium"><a href="{{ route('question.show',$value->id) }}">{{ $value->title }}</a></h5>
                                <p class="mb-2 truncate lh-20 fs-15">{{ $value->description }}</p>
                                <div class="tags">
                                    @foreach ($value->tags as $tag)
                                        <a href="#" class="tag-link">{{ $tag->name }}</a>
                                    @endforeach
                                </div>
                                <div class="media media-card user-media align-items-center px-0 border-bottom-0 pb-0">
                                    <a href="user-profile.html" class="media-img d-block">
                                        <img src="{{ asset('assets/images/img3.jpg') }}" alt="avatar">
                                    </a>
                                    <div class="media-body d-flex flex-wrap align-items-center justify-content-between">
                                        <div>
                                            <h5 class="pb-1"><a href="user-profile.html">{{ $value->user->name }}</a></h5>

                                            <div class="stats fs-12 d-flex align-items-center lh-18">
                                                <span class="text-black pr-2" title="Reputation score">224</span>
                                                <span class="pr-2 d-inline-flex align-items-center" title="Gold badge"><span class="ball gold"></span>16</span>
                                                <span class="pr-2 d-inline-flex align-items-center" title="Silver badge"><span class="ball silver"></span>93</span>
                                                <span class="pr-2 d-inline-flex align-items-center" title="Bronze badge"><span class="ball"></span>136</span>
                                            </div>
                                        </div>
                                        <small class="meta d-block text-right">
                                            <span class="text-black d-block lh-18">asked</span>
                                            <span class="d-block lh-18 fs-12">{{ $value->created_at->diffForHumans() }}</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end media -->

                        @empty
                            <p>Not Found !</p>
                        @endforelse

                        <div class="mt-3">
                            {!! $questions->links() !!}
                        </div>

                    </div><!-- end questions-snippet -->

                    {{-- <div class="pager pt-30px px-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination generic-pagination pr-1">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true"><i class="la la-arrow-left"></i></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true"><i class="la la-arrow-right"></i></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <p class="fs-13 pt-2">Showing 1-10 results of 50,577 questions</p>
                    </div> --}}
                </div><!-- end question-main-bar -->
            </div><!-- end col-lg-9 -->
            <div class="col-lg-3">
                <div class="sidebar">
                    @include('main.right-sidebar')
                </div>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end question-area -->
<!-- ================================
         END QUESTION AREA
================================= -->
@endsection
