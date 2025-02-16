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
                                    <th rowspan="2">Status</th>
                                    @if(auth()->user()->role == 'manager'||auth()->user()->role == 'managersenior')
                                    <th rowspan="2">Approval</th>
                                    @endif
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
                                    @if(auth()->user()->role == 'manager' || auth()->user()->role == 'managersenior')

                                    <td>
                                        @if(auth()->user()->role == 'manager' && $draft->approval_manager == 'proses'||auth()->user()->role == 'managersenior' && $draft->approval_senior_manager == 'proses'&&$draft->status!='tidak disetujui')

                                        <a href="{{ route(auth()->user()->role.'_permohonan_disetujui',$draft->id) }}"  style="margin: 5px;" onclick="return confirm('Apakah anda yakin ingin menyetujui permohonan ini ?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Setujui" class="tabledit-edit-button btn btn-sm btn-success edit"><span class="bi bi-check-lg"></span></a>
                                        <a href="{{ route(auth()->user()->role.'_permohonan_tidak_disetujui',$draft->id) }}" style="margin: 5px;" onclick="return confirm('Apakah anda yakin tidak menyetujui permohonan ini ?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tidak disetujui" class="tabledit-edit-button btn btn-sm btn-danger"><span class="bi bi-x-lg"></span></a>
                                        
                                        @endif
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
