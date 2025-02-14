@extends('layouts.app')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <center>
                <h3>Detail Permintaan Fasilitas IT</h3>
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
                    <form action="{{ route(auth()->user()->role.'_permintaankeseluruhan_submit') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class=" m-b-20">
                                <div class="row text-center" >
                                    <div @if($data->approval_manager=='disetujui') style="background-color: rgb(89, 255, 89);" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-3" >

                                        <div class="card-body">
                                            <b>Manager</b> <br>
                                            <h5 class="badge badge-pill badge-success"><b><i>{{ $data->approval_manager }}</i></b> </h5>
                                        </div>
                                    </div>
                                    <div @if($data->approval_senior_manager=='disetujui') style="background-color: rgb(89, 255, 89);" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-3" >

                                        <div class="card-body">
                                            <b>Senior Manager</b> <br>
                                            <h5 class="badge badge-pill badge-success"><b><i>{{ $data->approval_senior_manager }}</i></b> </h5>

                                        </div>
                                    </div>
                                    <div @if($data->approval_manager_it=='selesai') style="background-color: rgb(89, 255, 89);" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-3">

                                        <div class="card-body">
                                            <b>Manager IT</b> <br>
                                            <h5 class="badge badge-pill badge-success"><b><i>{{ $data->approval_manager_it }}</i></b> </h5>

                                        </div>
                                    </div>
                                    <div @if($data->approval_senior_manager_it=='selesai') style="background-color: rgb(89, 255, 89);" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-3">



                                        <div class="card-body">
                                            <b>Senior Manager IT</b> <br>
                                            <h5 class="badge badge-pill badge-success"><b><i>{{ $data->approval_senior_manager_it }}</i></b> </h5>

                                        </div>
                                    </div@>

                                    

                                </div>
                            </div>

                            <div class="row justify-content-center mt-2">
                                <div class="col-sm-12 col-lg-5">
                                    <table style=" width: 100%;">


                                        <tr>
                                            <td><b>Nama</b></td>
                                            <td>:</td>
                                            <td>{{ $data->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>NPP</b> </td>
                                            <td>:</td>
                                            <td>{{ $data->npp }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Keterangan</b> </td>
                                            <td>:</td>
                                            <td>{{ $data->keterangan }}</td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="col-sm-12 col-lg-5">
                                    <table style=" width: 100%;">

                                        <tr>
                                            <td><b>Devisi</b> </td>
                                            <td>:</td>
                                            <td>{{ $data->devisi }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Sub Devisi</b></td>
                                            <td>:</td>
                                            <td>{{ $data->sub_devisi }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b> </td>
                                            <td>:</td>
                                            <td>{{ $data->status }}</td>
                                        </tr>
                                    </table>

                                </div>
                                

                                
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-check ">
                                        @if($data->approval_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui"   />
                                        @elseif($data->approval_senior_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui"  />
                                        @else
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui" disabled />

                                        @endif
                                        <label class="form-check-label" for="setingtable1"> Disetujui Semua </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-check ">
                                        @if($data->approval_manager_it=='proses' )
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"  />
                                        @elseif($data->approval_senior_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"  />
                                        @else
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"   disabled/>
                                        @endif
                                        <label class="form-check-label" for="setingtable2"> Tidak Disetujui Semua </label>

                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-check ">
                                        @if($data->approval_manager_i=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" checked />
                                        @elseif($data->approval_senior_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" checked />
                                        @else
                                        <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" disabled  />
                                        @endif
                                        <label class="form-check-label" for="setingtable3"> Parsial </label>

                                    </div>
                                </div>

                            </div>
                            <input type="hidden" name="draft_id" value="{{ $data->id }}">
                            <table id="draftTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Permintaan</th>
                                        <th colspan="2">Approval Manager IT</th>
                                        <th colspan="2">Approval Senior Manager IT</th>
                                        <th rowspan="2">Status</th>
                                    </tr>
                                    <tr>
                                        <td width='15%'>Disetujui</td>
                                        <td width='15%'>Tidak Disetujui</td>
                                        <td width='15%'>Disetujui</td>
                                        <td width='15%'>Tidak Disetujui</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($drafts as $key=>$draft)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $draft->permintaan->nama }}</td>
                                        <td><center><input type="radio" approval='settingtable' role='managerit' value='disetujui' @if(auth()->user()->role!='managerit') disabled @endif @if($draft->approval_manager_it=='disetujui') checked disabled @endif name="app-m-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" approval='settingtable' role='managerit' value='tidak disetujui' @if(auth()->user()->role!='managerit') disabled @endif @if($draft->approval_manager_it=='tidak disetujui') checked disabled @endif name="app-m-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" approval='settingtable' role='managerseniorit' value='disetujui' @if(auth()->user()->role!='managerseniorit') disabled @endif @if($draft->approval_senior_manager_it=='disetujui') checked disabled @endif  name="app-s-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" approval='settingtable' role='managerseniorit' value='tidak disetujui' @if(auth()->user()->role!='managerseniorit') disabled @endif @if($draft->approval_senior_manager_it=='tidak disetujui') checked disabled @endif name="app-s-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td>{{$draft->status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($data->approval_manager_it=='proses' )
                            <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>


                            @elseif($data->approval_senior_manager_it=='proses')

                            <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>
                            @else
                            <button type="submit" class="btn btn-primary btn-block col-12" disabled>Simpan</button>
                            @endif
                        </div>
                    </form>

                   
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
        var role = @json(auth()->user()->role);
        // alert(role);
        $('#draftTable').DataTable({
            "scrollX": true
        });
        $('#setingtable1').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][value=disetujui][role=managerit]').prop('checked', true);
            }else if(role=='managerseniorit'){
                $('input[type=radio][value=disetujui][role=managerseniorit]').prop('checked', true);
            }
            $('input[type=radio][approval=settingtable]').prop('disabled',true);
        });
        $('#setingtable2').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][value="tidak disetujui"][role=managerit]').prop('checked', true);
            }else if(role=='managerseniorit'){
                $('input[type=radio][value="tidak disetujui"][role=managerseniorit]').prop('checked', true);
            }
            $('input[type=radio][approval=settingtable]').prop('disabled',true);

        });
        $('#setingtable3').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][role=managerit]').prop('disabled',false);
                $('input[type=radio][role=managerseniorit]').prop('disabled',true);
            }else if(role=='managerseniorit'){
                $('input[type=radio][role=managerseniorit]').prop('disabled',false);
                $('input[type=radio][role=managerit]').prop('disabled',true);
            }
        });

    });

</script>
@endsection

