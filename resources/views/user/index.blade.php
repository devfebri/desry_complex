@extends('layouts.app')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <center>
                <h3>Setting Data User</h3>
            </center>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route(auth()->user()->role.'_user.create') }}" class="btn btn-primary">Tambah Data</a>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card-body">
                        <table id="userTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Manager</th>
                                    <th>Senior Manager</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key=>$user)
                                @php
                                    if($user->manager_id == null) {
                                        $manager = '';
                                    } else {
                                        $manager = \App\Models\User::where('id', $user->manager_id)->first()->name;
                                    }
                                    if($user->senior_manager_id == null) {
                                        $senior_manager = '';
                                    } else {
                                        $senior_manager = \App\Models\User::where('id', $user->senior_manager_id)->first()->name;
                                    }
                                   
                                @endphp
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $manager }}</td>
                                    <td>{{ $senior_manager }}</td>
                                    <td>
                                        <a href="{{ route(auth()->user()->role.'_user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route(auth()->user()->role.'_user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <!-- Pagination can be added here if needed -->
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content-->
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#userTable').DataTable();
    }); 
</script>
@endsection
