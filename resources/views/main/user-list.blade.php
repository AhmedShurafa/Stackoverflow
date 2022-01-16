@extends('layouts.main')
@section('content')
<!-- ================================
         START QUESTION AREA
================================= -->
<section class="question-area pt-40px pb-40px">
    <div class="container">
        <div class="filters pb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between pb-3">
                <h3 class="fs-22 fw-medium">Users</h3>
                <a href="{{ route('question.create') }}" class="btn theme-btn theme-btn-sm">Ask Question</a>
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <form method="get" action="{{ route('search.users') }}" class="mr-3 w-25">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form--control
                        form-control-sm h-auto lh-34" type="text" name="name" placeholder="Filter by user">
                        <button class="form-btn" type="submit"><i class="la la-search"></i></button>
                    </div>
                </form>
            </div>
        </div><!-- end filters -->
        <div class="row">
            @forelse ($users as $user)
                <div class="col-lg-3 responsive-column-half">
                    <div class="media media-card p-3">
                        <a href="{{ route('profile', $user->id) }}" class="media-img d-inline-block flex-shrink-0">
                            <img src="images/company-logo.png" onerror="this.src='img/user.png'" alt="company logo">
                        </a>
                        <div class="media-body">
                            <h5 class="fs-16 fw-medium"><a href="{{ route('profile', $user->id) }}">{{ $user->name }}</a></h5>
                            <small class="meta d-block lh-24 pb-1"><span>New York, United States</span></small>
                            <p class="fw-medium fs-15 text-black-50 lh-18">1,200</p>
                        </div><!-- end media-body -->
                    </div><!-- end media -->
                </div><!-- end col-lg-3 -->
            @empty
                <p class="ml-4 d-flex justify-content-center"> Not Found :(</p>
            @endforelse

        </div><!-- end row -->

        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
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
