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
                    <h3 class="fs-22 fw-medium">Badges</h3>
                    <p class="fs-15 lh-22 my-2">Besides gaining reputation with your questions and answers, you receive badges for being especially helpful.
                        <br> Badges appears on your profile page, questions & answers.
                    </p>
                </div>
                @if(Auth::check())
                    <a href="ask-question.html" class="btn theme-btn theme-btn-sm">Ask Question</a>
                @endif
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <form method="get" action="{{ route('badgeSearch') }}" class="mr-3 w-25">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form--control
                        form-control-sm h-auto lh-34"
                        type="text" name="badge" placeholder="Filter by badge name">
                        <button class="form-btn" type="submit"><i class="la la-search"></i></button>
                    </div>
                </form>
                {{-- <div class="btn-group btn--group mb-3" role="group" aria-label="Filter button group">
                    <a href="#" class="btn active">All</a>
                    <a href="#" class="btn">Bronze</a>
                    <a href="#" class="btn">Silver</a>
                    <a href="#" class="btn">Gold</a>
                </div> --}}
            </div>
        </div><!-- end filters -->
        <div class="row">
            @forelse ($badges as $badge)
                <div class="col-lg-3">
                    <div class="card card-item border border-gray">
                        <div class="card-body p-3">
                            <div class="badge-item">
                                <a href="#" class="badge badge-md badge-dark d-inline-flex align-items-center">

                                    <span class="ball"></span> {{ $badge->name }}</a>
                                <span class="item-multiplier fs-13 fw-medium">
                                                                <span>×</span>
                                                                <span>{{ $badge->score }}</span>
                                                            </span>
                                <p class="fs-13 lh-18 pt-2 text-black-50">{{ $badge->content }}</p>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-3 -->
            @empty
                <div>Not Found Any Badge</div>
            @endforelse

        </div><!-- end row -->
        {{ $badges->links() }}

        {{-- <div class="pager pt-20px">
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
