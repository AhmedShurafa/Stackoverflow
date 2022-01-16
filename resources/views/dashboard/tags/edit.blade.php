@extends('dashboard.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">تعديل العلامة</h1>

    <div class="card shadow mb-4 p-3">
        <form method="POST" action="{{route("tags.update",$tag->id)}}">
            <div class="card-body">
                @csrf
                @method('put')

                @include('dashboard.tags._form',[
                    'button' => 'Update'
                ])

            </div>

        </form>
    </div>
</div>
</div>
<!-- /.container-fluid -->

@endsection
