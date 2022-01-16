@extends('layouts.main')
@section('conetnt')
<!-- ================================
         START QUESTION AREA
================================= -->
<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="filters pb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                <div class="pr-3">
                    <h3 class="fs-22 fw-medium">Tags</h3>
                    <p class="fs-15 lh-22 my-2">A tag is a keyword or label that categorizes your question with other, similar questions.
                        <br> Using the right tags makes it easier for others to find and answer your question.</p>
                </div>
                <a href="{{ route('question.create') }}" class="btn theme-btn theme-btn-sm">Ask Question</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between">

                <form method="get" action="{{ route('tags.search') }}" class="mr-3 w-25">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form--control form-control-sm h-auto lh-34"
                         type="text" name="tag" placeholder="Filter by tag name">
                        <button class="form-btn" type="submit"><i class="la la-search"></i></button>
                    </div>
                </form>
                {{-- <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                    <a href="#" class="btn active">All</a>
                    <a href="#" class="btn">Popular</a>
                    <a href="#" class="btn">Name</a>
                    <a href="#" class="btn">New</a>
                </div> --}}
            </div>
        </div><!-- end filters -->
        <div class="row">
            @forelse ($tags as $tag)
                <div class="col-lg-3 responsive-column-half">
                    <div class="card card-item">
                        <div class="card-body">
                            <div class="tags pb-1">
                                <a href="{{ route('tag.question',$tag->id) }}" class="tag-link tag-link-md tag-link-blue">{{ $tag->name }}</a>
                            </div>
                            <p class="card-text fs-14 truncate-4 lh-24 text-black-50">
                                {{ $tag->description }}
                             </p>
                            <div class="d-flex tags-info fs-14 pt-3 border-top border-top-gray mt-3">
                                <p class="pr-1 lh-18">{{ $tag->questions->count() }} questions</p>
                                {{-- <p class="lh-18">901 asked today, 5319 this week</p> --}}
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-3 -->
            @empty
                <p>Not Found !!!</p>
            @endforelse
        </div><!-- end row -->
        {!! $tags->links() !!}
        {{-- <div class="pager pt-30px">
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
            <p class="fs-13 pt-2">Showing 1-20 of 50,577 results</p>
        </div> --}}
    </div><!-- end container -->
</section><!-- end question-area -->
<!-- ================================
         END QUESTION AREA
================================= -->
@endsection
