@extends('layouts.app')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        {{-- <div class="row">
            <center>
                <h3>Detail Permintaan Fasilitas IT</h3>
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
                     <div class="card-header">
                        <div class="card-title">
                            <h3>Detail Permintaan Fasilitas IT</h3>
                        </div>
                     </div>
                    <!-- /.card-header -->
                    @if(auth()->user()->role!='user')
                    <form action="{{ route(auth()->user()->role.'_permintaankeseluruhan_submit') }}" method="post">
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class=" m-b-20">
                                <div class="row text-center justify-content-center" >
                                    <div @if($data->approval_manager=='disetujui') style="background-color: #0d6efd;" @elseif($data->approval_manager=='tidak disetujui') style="background-color: #ff5733;" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-2" >
                                        <div class="card-body">
                                            <b>Manager</b> <br>
                                            <h6 style="color:white"><b><i>{{ $data->approval_manager }}</i></b> </h6>
                                            <h6 style="font-size:12px;color:white">{{ $data->tanggal_approval_manager }}</h6>

                                            @if($data->ket_manager!=null)
                                            <h6 style="font-size:12px;color:white">{{ $data->ket_manager }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div @if($data->approval_senior_manager=='disetujui') style="background-color: #0d6efd;" @elseif($data->approval_senior_manager=='tidak disetujui') style="background-color: #ff5733;" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-2" >
                                        <div class="card-body">
                                            <b>Senior Manager</b> <br>
                                            <h6 style="color:white"><b><i>{{ $data->approval_senior_manager }}</i></b> </h6>
                                            <h6 style="font-size:12px;color:white">{{ $data->tanggal_approval_sm }}</h6>
                                            @if($data->ket_sm!=null)
                                            <h6 style="font-size:12px;color:white">{{ $data->ket_sm }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                     <div @if($data->approval_teknisi=='disetujui') style="background-color: #0d6efd;" @elseif($data->approval_teknisi=='tidak disetujui') style="background-color: #ff5733;" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-2">
                                         <div class="card-body">
                                             <b>Teknisi</b> <br>
                                             <h6 style="color:white"><b><i>{{ $data->approval_teknisi }}</i></b> </h6>
                                             <h6 style="font-size:12px;color:white">{{ $data->tanggal_approval_teknisi }}</h6>
                                             @if($data->ket_teknisi!=null)
                                             <h6 style="font-size:12px;color:white">{{ $data->ket_teknisi }}</h6>
                                             @endif
                                         </div>
                                     </div>
                                    <div @if($data->approval_manager_it=='disetujui') style="background-color: #0d6efd;" @elseif($data->approval_manager_it=='tidak disetujui') style="background-color: #ff5733;" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-2">
                                        <div class="card-body">
                                            <b>Manager IT</b> <br>
                                            <h6 style="color:white"><b><i>{{ $data->approval_manager_it }}</i></b> </h6>
                                            <h6 style="font-size:12px;color:white">{{ $data->tanggal_approval_manager_it }}</h6>

                                            @if($data->ket_manager_it!=null)
                                            <h6 style="font-size:12px;color:white">{{ $data->ket_manager_it }}</h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div @if($data->approval_senior_manager_it=='disetujui') style="background-color: #0d6efd;" @elseif($data->approval_senior_manager_it=='tidak disetujui') style="background-color: #ff5733;" @else style="background-color: rgb(126, 126, 126);" @endif class="col-sm-3">
                                        <div class="card-body">
                                            <b>Senior Manager IT</b> <br>
                                            <h6 style="color:white"><b><i>{{ $data->approval_senior_manager_it }}</i></b> </h6>
                                            <h6 style="font-size:12px;color:white">{{ $data->tanggal_approval_sm_it }}</h6>

                                            @if($data->ket_sm_it!=null)
                                            <h6 style="font-size:12px;color:white">{{ $data->ket_sm_it }}</h6>
                                            @endif

                                        </div>
                                    </div@>

                                    

                                </div>
                            </div>

                            <div class="row justify-content-center mt-2">
                                <div class="col-sm-12 col-lg-5">
                                    <table style=" width: 100%;">
                                        <tr>
                                            <td><b>Nama Pemohon</b></td>
                                            <td>:</td>
                                            <td>{{ $data->nama_pemohon }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Kontak Pemohon</b> </td>
                                            <td>:</td>
                                            <td>{{ $data->kontak_pemohon }}</td>
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
                                            <td>
                                                
                                                <b>{{$data->status}}</b>
                                                @if($data->status=='selesai')
                                                <br>
                                                Permintaan sudah di ambil pada tanggal <br> <b>{{$data->tanggal_diambil->format('d/m/Y H:i:s')}}</b>

                                                @endif
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                @if($data->waktu_pengambilan != null)
                                <div class="col-sm-12 col-lg-4 text-center">
                                    @if ($data->status != 'selesai')
                                        
                                    <div class="badge badge-secondary bg-warning">
                                        <h5 class="text-black" >Waktu Pengambilan : {{ $data->waktu_pengambilan->translatedFormat('l, d-m-Y') }}</h5>
                                    </div>
                                    @endif
                                    @if(auth()->user()->role=='admin'&&$data->tanggal_diambil==null)
                                    <div class="badge badge-secondary  ">
                                        <a href="{{ route('admin_draft_disetujui',$data->id) }}" onclick="return confirm('Apakah anda yakin ingin menutup permintaan ini ?')" class="btn btn-primary btn-sm ">Tandai Sudah diambil</a>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="row justify-content-center mt-2">
                                @if(auth()->user()->role=='managerit' ||  auth()->user()->role=='admin')
                                    <div class="col-sm-12 col-lg-3">
                                        <div class="form-check ">
                                            @if($data->approval_manager_it=='proses' && auth()->user()->role=='managerit')

                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui"   />
                                            @elseif($data->approval_teknisi=='proses'&& auth()->user()->role=='admin')

                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui"  />
                                            @else
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable1" value="disetujui" disabled />
                                            @endif
                                            <label class="form-check-label" for="setingtable1"> Disetujui Semua </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-3">
                                        <div class="form-check ">
                                            @if($data->approval_manager_it=='proses'&& auth()->user()->role=='managerit' )
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"  />
                                            @elseif($data->approval_teknisi=='proses'&& auth()->user()->role=='admin')
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"  />
                                            @else
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable2" value="tidak disetujui"   disabled/>
                                            @endif
                                            <label class="form-check-label" for="setingtable2"> Tidak Disetujui Semua </label>

                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-3">
                                        <div class="form-check ">
                                            @if($data->approval_manager_it=='proses'&& auth()->user()->role=='managerit')
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" checked />
                                            @elseif($data->approval_teknisi=='proses' && auth()->user()->role=='admin')
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" checked />
                                            @else
                                            <input class="form-check-input" type="radio" name="setingtable" id="setingtable3" value="parsial" disabled  />
                                            @endif
                                            <label class="form-check-label" for="setingtable3"> Parsial </label>

                                        </div>
                                    </div>
                                @elseif(auth()->user()->role=='managerseniorit'||auth()->user()->role=='manager'||auth()->user()->role=='managersenior')
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-check ">
                                        @if($data->approval_senior_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="acc" value="disetujui" required />
                                        @else
                                        <input class="form-check-input" type="radio" name="setingtable" id="acc" value="disetujui" disabled required />

                                        @endif
                                        <label class="form-check-label" for="acc"> Terima Permohonan </label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-3">
                                    <div class="form-check ">
                                        @if($data->approval_senior_manager_it=='proses')
                                        <input class="form-check-input" type="radio" name="setingtable" id="tolak" value="tidak disetujui" required />
                                        @else
                                        <input class="form-check-input" type="radio" name="setingtable" id="tolak" value="tidak disetujui" disabled required />


                                        @endif
                                        <label class="form-check-label" for="tolak"> Tolak Permohonan </label>
                                    </div>
                                </div>
                               

                                @endif

                            </div>
                            <div class="row justify-content-center mt-2">

                                 <div class="col-sm-12 col-lg-3">
                                     <textarea name="ket" id="ket" class="form-control" cols="30" rows="1" placeholder="Keterangan"></textarea>
                                 </div>

                            </div>
                            <input type="hidden" name="draft_id" value="{{ $data->id }}">
                            <table id="draftTable" class=" table-bordered table-striped text-center">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama</th>
                                        <th rowspan="2">NPP</th>
                                        <th rowspan="2">Permintaan</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th colspan="2">Approval Teknisi</th>
                                        <th colspan="2">Approval Manager IT</th>
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
                                        <td><center>{{ ++$key }}</center></td>
                                        <td>{{ $draft->nama}}</td>
                                        <td>{{ $draft->npp}}</td>
                                        <td>{{ $draft->permintaan->nama }}</td>
                                        <td>{{ $draft->keterangan }}</td>
                                        <td><center><input type="radio" required approval='settingtable' role='admin' value='disetujui' @if(auth()->user()->role!='admin') disabled @endif @if($draft->approval_teknisi=='disetujui') checked disabled @endif  name="app-s-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" required approval='settingtable' role='admin' value='tidak disetujui' @if(auth()->user()->role!='admin') disabled @endif @if($draft->approval_teknisi=='tidak disetujui') checked disabled @endif name="app-s-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" required approval='settingtable' role='managerit' value='disetujui' @if(auth()->user()->role!='managerit') disabled @endif @if($draft->approval_manager_it=='disetujui') checked disabled @endif name="app-m-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td><center><input type="radio" required approval='settingtable' role='managerit' value='tidak disetujui' @if(auth()->user()->role!='managerit') disabled @endif @if($draft->approval_manager_it=='tidak disetujui') checked disabled @endif name="app-m-it-{{ $draft->id }}" style="padding:10px;" class="form-check-input"></center></td>
                                        <td  @if($draft->status=='disetujui') style="background-color: rgb(89, 255, 89);" @elseif($draft->status=='tidak disetujui') style="background-color: rgb(255, 89, 89);" @endif>{{$draft->status}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($data->status=='proses')
                                @if($data->approval_manager_it=='proses' && auth()->user()->role=='managerit' )
                                <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>
                                @elseif($data->approval_teknisi=='proses'&& auth()->user()->role=='admin' )
                                <button type="submit" class="btn btn-primary btn-block col-12" >Simpan</button>
                                @elseif($data->approval_senior_manager_it=='proses'&& auth()->user()->role=='managerseniorit' )
                                <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>
                                @elseif($data->approval_senior_manager=='proses'&& auth()->user()->role=='managersenior'  )
                                <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>
                                @elseif($data->approval_manager=='proses'&& auth()->user()->role=='manager' )
                                <button type="submit" class="btn btn-primary btn-block col-12">Simpan</button>

                                @else
                                <button type="submit" class="btn btn-primary btn-block col-12" disabled>Simpan</button>
                                @endif
                            @else
                                <button type="submit" class="btn btn-primary btn-block col-12" disabled>Simpan</button>
                            @endif
                        </div>
                        {{-- @if(auth()->user()->role=='user') --}}
                    </form>
                    {{-- @endif --}}

                   
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
            "scrollX": true,
            "scrollCollapse": true,
            "paging": true,
            "autoWidth": false,
            "columnDefs": [
                { "width": "5%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "20%", "targets": 4 },
                { "width": "10%", "targets": 5 },
                { "width": "10%", "targets": 6 },
                { "width": "10%", "targets": 7 },
                { "width": "10%", "targets": 8 },
                { "width": "20%", "targets": 9 }
            ]
        });
        $('#setingtable1').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][value=disetujui][role=managerit]').prop('checked', true);
            }else if(role=='admin'){
                $('input[type=radio][value=disetujui][role=admin]').prop('checked', true);
            }
            $('input[type=radio][approval=settingtable]').prop('disabled',true);
        });
        $('#setingtable2').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][value="tidak disetujui"][role=managerit]').prop('checked', true);
            }else if(role=='admin'){
                $('input[type=radio][value="tidak disetujui"][role=admin]').prop('checked', true);
            }
            $('input[type=radio][approval=settingtable]').prop('disabled',true);

        });
        $('#setingtable3').on('click', function() {
            if(role=='managerit'){
                $('input[type=radio][role=managerit]').prop('disabled',false);
                $('input[type=radio][role=admin]').prop('disabled',true);
            }else if(role=='admin'){
                $('input[type=radio][role=admin]').prop('disabled',false);
                $('input[type=radio][role=managerit]').prop('disabled',true);
            }
        });

    });

</script>
@endsection

