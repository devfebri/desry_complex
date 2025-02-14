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
                                    <th>No</th>
                                    <th>NPP</th>
                                    <th>Nama</th>
                                    <th>Permintaan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drafts as $key=>$draft)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $draft->npp }}</td>
                                    <td>{{ $draft->nama }}</td>
                                    <td>
                                        @php
                                        $data=\App\Models\DraftPermintaan::where('draft_id',$draft->id)->get();
                                        @endphp
                                        @foreach($data as $row)
                                        @if($row->status=='proses')
                                        <span class="badge text-bg-primary">{{$row->permintaan->nama}}</span>
                                        @elseif($row->status=='disetujui')
                                        <span class="badge text-bg-success">{{$row->permintaan->nama}}</span>
                                         @elseif($row->status=='tidak disetujui')
                                        <span class="badge text-bg-danger">{{$row->permintaan->nama}}</span>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $draft->status }}</td>
                                    @if(auth()->user()->role == 'managerit'||auth()->user()->role == 'managerseniorit')

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

