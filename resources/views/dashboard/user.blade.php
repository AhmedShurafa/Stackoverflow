@extends("dashboard.layouts.app")

@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div>
            <h1 class="h3 mb-4 text-gray-800 d-inline-block">المستخدمين</h1>
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
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>

                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->profile->phone}}</td>
                                <td>{{$user->profile->address}}</td>
                                <td>
                                    <a href="{{route('profile',$user->id)}}"
                                       class="btn btn-success text-white shadow">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <button class="btn btn-danger text-white shadow delete"
                                            data-target='#custom-width-modal' data-toggle='modal'
                                            data-row='{{route("dashboard.user.delete",$user->id)}}'>
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
