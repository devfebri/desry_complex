@extends('layouts.app')

@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        {{-- <div class="row">
            <center>
                <h3>Draft Permintaan Fasilitas IT</h3>
            </center>
        </div> --}}
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
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Draft Permintaan Fasilitas IT</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="draftTable" class=" table-bordered table-striped text-center">
                            <thead class="bg-primary text-white text-center">
                                <tr >
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Pemohon</th>
                                    <th class="text-center">Kontak Pemohon</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Jadwal Pengambilan</th>
                                    <th class="text-center">Approval</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($drafts as $key=>$draft)
                                <tr>
                                    <td><center>{{ ++$key }}</center></td>
                                    <td class="text-center">{{ $draft->nama_pemohon }}</td>
                                    <td class="text-center">{{ $draft->kontak_pemohon }}</td>
                                    <td class="text-center">{{ $draft->status }}</td>
                                    <td class="text-center">{{ $draft->waktu_pengambilan }}</td>
                                    {{-- @if(auth()->user()->role == 'manager' || auth()->user()->role == 'managersenior'||auth()->user()->role=='admin') --}}

                                    <td>
                                        <a href="{{ route(auth()->user()->role.'_preview_pdf', $draft->id) }}"  target="_blank" style="margin: 5px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="preview" class="tabledit-edit-button btn btn-sm btn-info edit"><span class="bi bi-eye"></span></a>
                                        <a href="{{ route(auth()->user()->role.'_permintaankeseluruhan_detail',$draft->id) }}" style="margin: 5px;" class="tabledit-edit-button btn btn-sm btn-success edit"><span class="bi bi-card-checklist"></span></a>
                                        {{-- @if(auth()->user()->role == 'manager' && $draft->approval_manager == 'proses'||auth()->user()->role == 'managersenior' && $draft->approval_senior_manager == 'proses'&&$draft->status!='tidak disetujui')

                                        <a href="{{ route(auth()->user()->role.'_permohonan_disetujui',$draft->id) }}"  style="margin: 5px;" onclick="return confirm('Apakah anda yakin ingin menyetujui permohonan ini ?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Setujui" class="tabledit-edit-button btn btn-sm btn-success edit"><span class="bi bi-check-lg"></span></a>
                                        <a href="{{ route(auth()->user()->role.'_permohonan_tidak_disetujui',$draft->id) }}" style="margin: 5px;" onclick="return confirm('Apakah anda yakin tidak menyetujui permohonan ini ?')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tidak disetujui" class="tabledit-edit-button btn btn-sm btn-danger"><span class="bi bi-x-lg"></span></a>
                                        
                                        @endif --}}


                                    </td>
                                    {{-- @endif --}}
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
