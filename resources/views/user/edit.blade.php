@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <center>
                <h3>Edit Data User</h3>
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
                            <a href="{{ route(auth()->user()->role.'_user.index') }}" class="btn btn-secondary">Back</a>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    
                    <div class="card-body">
                        <form action="{{ route(auth()->user()->role.'_user.update', $user->id) }}" method="POST">

                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="managersenior" {{ $user->role == 'managersenior' ? 'selected' : '' }}>Senior Manager</option>
                                    <option value="managerit" {{ $user->role == 'managerit' ? 'selected' : '' }}>Manager IT</option>
                                    <option value="managerseniorit" {{ $user->role == 'managerseniorit' ? 'selected' : '' }}>Senior Manager IT</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            @if($user->role=='user')
                            <div class="mb-3">
                                <label for="email" class="form-label">Manager</label>
                                <select name="manager_id" id="manager_id" class="form-control" required>
                                    <option value="" >- pilih -</option>
                                    @foreach ($manager as $row1)
                                    <option value="{{ $row1->id }}" {{ $user->manager_id == $row1->id ? 'selected' : '' }}>{{ $row1->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Senior Manager</label>
                                <select name="senior_manager_id" id="senior_manager_id" class="form-control" required>
                                    <option value="" >- pilih -</option>
                                    @foreach ($senior as $row2)
                                    <option value="{{ $row2->id }}" {{ $user->senior_manager_id == $row2->id ? 'selected' : '' }}>{{ $row2->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            {{-- <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div> --}}
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
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
