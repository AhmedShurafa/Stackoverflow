@extends("dashboard.layouts.app")

@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">الأسئلة</h1>
        </div>

        @if(Session::has('success'))
            <h4 class="alert alert-success">{{ Session::get('success') }}</h4>
            {{-- <x-alert mesaage="{{ Session::get('success') }}"/> --}}
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>عدد التصويت</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>العنوان</th>
                            <th>الوصف</th>
                            <th>عدد التصويت</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($questions as $question)
                            <tr @if($question->status =='draft') style="background-color:#eee"  @endif>
                                <td>{{$question->id}}</td>

                                <td>{{$question->user->name}}</td>
                                <td>{{$question->title}}</td>
                                <td>{{$question->description}}</td>
                                <td>{{$question->votes->count()}}</td>
                                <td>
                                    <a href="{{route('question.show',$question->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.question.delete",$question->id)}}'>
                                        <i class="fa fa-trash"></i>
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <!-- Delete Modal-->
    @include('dashboard.delete')
@endsection

@push('script')
    <script>
        $(".delete").click(function () {
            var id = $(this).data('row');
            // alert(id);
            $('.modal_delete').attr('action',id);
        });

    </script>
@endpush
