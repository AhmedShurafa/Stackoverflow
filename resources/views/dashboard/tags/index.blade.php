@extends("dashboard.layouts.app")

@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">علامات</h1>
            <a href="{{route('tags.create')}}" class="btn btn-primary float-left">
                <i class="fa fa-plus"></i>
                علامة جديدة
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
                            <th>Discription</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Discription</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{Str::limit($tag->description, 50, '.....')}}</td>
                                <td>
                                    <a href="{{route('tags.edit',$tag->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("tags.destroy",$tag->id)}}'>
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
