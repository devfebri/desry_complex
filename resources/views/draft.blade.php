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
                        <table id="draftTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">NPP</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Permintaan</th>
                                    <th colspan="2">Persetujuan</th>
                                    <th rowspan="2">status</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Manager</th>
                                    <th>Senior Manager</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drafts as $draft)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $draft->npp }}</td>
                                    <td>{{ $draft->nama }}</td>
                                    <td>
                                        @php
                                            $data=\App\Models\DraftPermintaan::where('draft_id',$draft->id)->get();
                                        @endphp
                                        @foreach($data as $row)
                                            <span class="badge text-bg-primary">{{$row->permintaan->nama}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $draft->approval_manager }}</td>
                                    <td>{{ $draft->approval_senior_manager }}</td>
                                    <td>{{ $draft->status }}</td>

                                    <td>
                                        
                                        @if($draft->status == 'proses')
                                        <button style="margin: 5px;" id="btnsetuju" data-id="{{ $draft->id }}" data-original-title="Setujui" class="tabledit-edit-button btn btn-sm btn-success edit"><i class="bi bi-check-lg"></i></button>





                                        <a href="#" style="margin: 5px;" onclick="return confirm('Apakah anda yakin ?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tidak disetujui" class="tabledit-edit-button btn btn-sm btn-danger"><span class="bi bi-x-lg"></span></a>


                                        @endif
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
        $('#draftTable').DataTable();
    });
</script>
@endsection
