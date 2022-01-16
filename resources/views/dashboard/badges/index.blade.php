@extends("dashboard.layouts.app")

@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">الشارات</h1>
            <a href="{{route('badges.create')}}" class="btn btn-primary float-left">
                <i class="fa fa-plus"></i>
                شارة جديدة
            </a>
        </div>

        @if(Session::has('success'))
            <h5 class="alert alert-success">{{ Session::get('success') }}</h5>
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
                            <th>Type</th>
                            <th>Score</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Score</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($badges as $badge)
                            <tr>
                                <td>{{$badge->id}}</td>
                                <td>{{$badge->name}}</td>
                                <td>{{$badge->type}}</td>
                                <td>{{$badge->score}}</td>
                                <td>{{$badge->content}}</td>
                                <td>
                                    <a href="{{route('badges.edit',$badge->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("badges.destroy",$badge->id)}}'>
                                        <i class="fa fa-trash"></i>
                                    </button>
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
