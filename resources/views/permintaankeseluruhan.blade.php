@extends('layouts.app')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <center>
                <h3>Draft Permintaan Fasilitas IT</h3>
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
        <!--begin::Row-->
        <div class="row">
            <!--begin::Col-->
            <div class="col-md-12">
                <div class="card mb-4">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="draftTable" class=" table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Kontak Pemohon</th>
                                    <th>Status</th>
                                    <th>Waktu Pengambilan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drafts as $key=>$draft)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $draft->nama_pemohon }}</td>
                                    <td>{{ $draft->kontak_pemohon }}</td>
                                   
                                    <td>{{ $draft->status }}</td>
                                    <td>@if($draft->waktu_pengambilan){{ $draft->waktu_pengambilan->translatedFormat('l, d-m-Y') }}@endif</td>

                                    @if(auth()->user()->role == 'managerit'||auth()->user()->role == 'managerseniorit'||auth()->user()->role == 'admin'||auth()->user()->role == 'user')


                                    <td>
                                        <a href="{{ route(auth()->user()->role.'_permintaankeseluruhan_detail',$draft->id) }}" style="margin: 5px;" class="tabledit-edit-button btn btn-sm btn-success edit"><span class="bi bi-card-checklist"></span></a>
                                    </td>
                                    @endif
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
        $('#draftTable').DataTable({
            "scrollX": true
        });
    });

</script>
@endsection

