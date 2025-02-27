@extends('layouts.app')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <center>
                <h3>Form Permintaan Fasilitas IT</h3>
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
            <div class="col-12">
                <!--begin::Small Box Widget 1-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <!--end::Header-->
                    <!--begin::Form-->
                    <div class="card-header">
                        <center>
                            <h5>Pemohon</h5>
                        </center>

                        @if($draft->count() != 0)

                        <div class="alert alert-primary">Data permintaan sedang dalam persetujuan manager dan senior manager</div>
                        @endif
                        @if(auth()->user()->manager_id==null && auth()->user()->senior_manager_id==null)
                        <div class="alert alert-primary">Akun ini belum memiliki Manager dan Senior Manger, silahkan hubungi operator/admin untuk menambahkan manager dan senior manager pada akun ini.</div>
                        @endif

                    </div>
                    @if(auth()->user()->manager_id!=null && auth()->user()->senior_manager_id!=null)

                    <form action="{{ route(auth()->user()->role.'_dashboardstore') }}" method="post" >

                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama Pemohon</label>
                                        <div class="col-sm-8">
                                            @if($draft->count() != 0)
                                            <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" value="{{ $draft[0]->nama_pemohon }}" required />
                                            @else
                                            <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" required />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kontak_pemohon" class="col-sm-4 col-form-label">Kontak Pemohon</label>
                                        <div class="col-sm-8">
                                            @if($draft->count() != 0)
                                            <input type="number" class="form-control" name="kontak_pemohon" id="kontak_pemohon" value="{{ $draft[0]->kontak_pemohon }}" required />
                                            @else
                                            <input type="number" class="form-control" name="kontak_pemohon" id="kontak_pemohon" required />
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                   <div class="row mb-3">
                                       <label for="inputEmail3" class="col-sm-4 col-form-label">Devisi</label>
                                       <div class="col-sm-8">
                                           @if($draft->count() != 0)
                                           <input type="text" class="form-control" id="inputEmail3" name="devisi" value="{{ $draft[0]->devisi }}" required />
                                           @else
                                           <input type="text" class="form-control" id="inputEmail3" name="devisi" required />
                                           @endif
                                       </div>
                                   </div>
                                   <div class="row mb-3">
                                       <label for="inputEmail3" class="col-sm-4 col-form-label">Sub Devisi</label>
                                       <div class="col-sm-8">
                                           @if($draft->count() != 0)
                                           <input type="text" class="form-control" id="inputEmail3" name="sub_devisi" value="{{ $draft[0]->sub_devisi }}" required />
                                           @else
                                           <input type="text" class="form-control" id="inputEmail3" name="sub_devisi" required />
                                           @endif
                                       </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                           <center>
                               <h5>Rekomendasi Fasilitas IT</h5>
                           </center>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-4 col-form-label">Nama </label>
                                        <div class="col-sm-8">
                                            
                                            <input type="text" class="form-control" id="nama" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="npp" class="col-sm-4 col-form-label">NPP </label>
                                        <div class="col-sm-8">
                                           
                                            <input type="text" class="form-control" id="npp" />
                                        </div>
                                    </div>
                                    


                                    <div class="row mb-3">
                                        <label for="exampleInputEmail1" class="col-form-label col-sm-4 ">Permintaan Fasilitas IT</label>
                                        <div class="col-sm-8">
                                            <select class="permintaan form-control"  style="width: 100%;" data-placeholder="- pilih -">
                                                <option value="">- pilih -</option>
                                               
                                                @foreach($permintaan as $item)
                                                <option value="{{ $item->id }}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama" class="col-sm-4 col-form-label">Keterangan </label>
                                        <div class="col-sm-8">
                                            <textarea  class="form-control" id="keterangan" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="row ">
                                        @if($draft->count() != 0)
                                            <button type="button" class="btn btn-primary btn-block" disabled>Tambah</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table" id="tableFasilitas">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NPP</th>
                                                <th>Fasilitas</th>
                                                <th>Keterangan</th>
                                                <th style="width: 40px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($draft->count() != 0)

                                            @php
                                                $variable=App\Models\DraftPermintaan::where('draft_id',$draft[0]->id)->get();

                                            @endphp
                                            @foreach($variable as $key => $value)
                                                <tr>
                                                    <td>{{$value->nama}}</td>
                                                    <td>{{$value->npp}}</td>
                                                     <td><span class="badge text-bg-primary">{{ $value->permintaan->nama }}</span> </td>

                                                    <td>{{$value->keterangan}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btnEdit"><i class="bi bi-pencil-square"></i></button>
                                                        <button type="button" class="btn btn-sm btn-danger btnDelete"><i class="bi bi-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            <!-- Rows will be added dynamically here -->
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                        <div class="card-header">
                            <center>
                                <h5>Informasi Penting</h5>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-md-10">

                                    <ol>
                                        <li>Divisi IT berhak menolak permintaan tanpa persetujuan para pihak</li>
                                        <li>Permohonan penggunaan fasilitas IT sementara/temporary periode pemakaian di msukkan dalam kolom deskripsi pekerjaan</li>
                                        <li>Permohonan akses aplikasi harus mendapat persetujuan ari ystem owner sesuai nota dinas integrasi system/aplikasi PAM JAYA yang berlaku</li>
                                        <li>System owner wajib mengisi level akses yang diberikan, jika dibutuhkan penjelasan atas level akses yang diberikan dapat iisi alam kolom catatan.</li>
                                        <li>Keterangan tentang informasi diatas wajib diisi dengan benar an dengan menandatangani form ini. Permohon dianggap elah membaca dan menyetujui Kebijakan Fasilitas IT.</li>
                                    </ol>
                                    <b><i>
                                            *) Untuk penerima Fasilitas TI dari eksternal PAM JAYA mengisi Nomor Induk Kependudukan (NIK) dan membuat surat Non-Disclosure Agreement (NDA)
                                        </i></b>

                                </div>
                                {{-- <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3">
                                    @if($draft->count() != 0)
                                        {{ $draft[0]->keterangan }}

                                @endif
                                </textarea> --}}
                            </div>
                            <div class="callout callout-primary">
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck2" style="padding:10px;" @if($draft->count() != 0) @if($draft[0]->approval_manager=='disetujui') checked @endif @endif name="approval_manager" disabled />


                                            <h3 class="form-check-label" for="gridCheck2">
                                                Manager
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck2" style="padding:10px;" name="approval_senior_manager" @if($draft->count() != 0) @if($draft[0]->approval_senior_manager=='disetujui') checked @endif @endif disabled />



                                            <h3 class="form-check-label" for="gridCheck2">
                                                Senior Manager
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-body text-center">
                            @if($draft->count() != 0)

                            <a href='{{ route(auth()->user()->role.'_preview_pdf', $draft[0]->id) }}' target="_blank" class="btn btn-warning">Preview</a>

                            <button type="submit" class="btn btn-warning" disabled>Simpan Draft</button>
                             @if($draft[0]->status == 'disetujui')
                             <a href="{{ route(auth()->user()->role.'_prosesit',$draft[0]->id) }}" class="btn btn-primary">Submit</a>
                             @endif

                            @else
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah data anda sudah benar?');">Simpan Draft</button>


                            @endif
                           
                        </div>
                        <!--end::Footer-->
                    </form>
                    @endif
                    <!--end::Form-->
                </div>
                <!--end::Small Box Widget 1-->
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.permintaan').select2();

        var key = 0;

        $('#btnTambah').on('click', function() {
            var nama = $('#nama').val();
            var npp = $('#npp').val();
            var permintaan = $('.permintaan').select2('data').map(item => item.text).join(', ');
            var permintaan_id = $('.permintaan').val();
            var keterangan = $('#keterangan').val();
            // alert(permintaan);
            if (!nama || !npp || !permintaan || !keterangan) {
                alert('Please fill in all fields.');
                return;
            }

            var newRow = `
                <tr class="align-middle">
                    <td>${nama} <input type="hidden" class="form-control" name="data[${key}][nama]" value="${nama}" /></td>
                    <td>${npp} <input type="hidden" class="form-control" name="data[${key}][npp]" value="${npp}" /></td>
                    <td><span class="badge text-bg-primary">${permintaan}</span> <input type="hidden" class="form-control" name="data[${key}][permintaan_id]" value="${permintaan_id}" /></td>
                    <td>${keterangan} <input type="hidden" class="form-control" name="data[${key}][keterangan]" value="${keterangan}" /></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning btnEdit"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger btnDelete"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
            `;

            $('#tableFasilitas tbody').append(newRow);
            key++;
            clearForm();
        });

        $('#tableFasilitas').on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });

        $('#tableFasilitas').on('click', '.btnEdit', function() {
            var row = $(this).closest('tr');
            $('#nama').val(row.find('td:eq(0)').text());
            $('#npp').val(row.find('td:eq(1)').text());
            $('#keterangan').val(row.find('td:eq(3)').text());
            $('.permintaan').val(row.find('td:eq(2) .badge').text().split(', ')).trigger('change');
            row.remove();
        });

        function clearForm() {
            $('#nama').val('');
            $('#npp').val('');
            $('#keterangan').val('');
            $('.permintaan').val(null).trigger('change');
        }
    });
</script>
@endsection

