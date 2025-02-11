@extends('layouts.app')
@section('content')

<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">

            <!--begin::Col-->
            <div class="col-md-12">


                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Permintaan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route(auth()->user()->role.'_permintaan.store') }}" method="POST" class="form-horizontal">

                            @csrf
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" id="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary float-right">Save</button>
                                </div>
                            </div>
                        </form>
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
