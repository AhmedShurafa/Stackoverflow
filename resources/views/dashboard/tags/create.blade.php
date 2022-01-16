@extends('dashboard.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">إضافة علامة</h1>

    <div class="card shadow mb-4 p-3">
        <form method="POST" action="{{route("tags.store")}}">
            <div class="card-body">
                @csrf

                @include('dashboard.tags._form',[
                    'button' => 'Create'
                ])
            </div>
        </form>
    </div>
</div>
</div>
<!-- /.container-fluid -->

@endsection
