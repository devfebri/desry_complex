@extends('layouts.app')
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
                        @if($draft->count() != 0)

                        <div class="alert alert-primary">Data permintaan sedang dalam persetujuan manager dan senior manager</div>
                        @endif
                    </div>
                    <form action="{{ route(auth()->user()->role.'_dashboardstore') }}" method="post" >

                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="npp" class="col-sm-2 col-form-label">NPP</label>
                                <div class="col-sm-10">
                                    @if($draft->count() != 0)
                                        <input type="text" class="form-control" name="npp" id="npp" value="{{ $draft[0]->npp }}" required />
                                    @else
                                        <input type="text" class="form-control" name="npp" id="npp" required />
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    @if($draft->count() != 0)
                                        <input type="text" class="form-control" name="nama" id="nama" value="{{ $draft[0]->nama }}" required />
                                    @else
                                        <input type="text" class="form-control" name="nama" id="nama" required />
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Permintaan</legend>
                                <div class="col-sm-10">
                                    @foreach($permintaan as $item)
                                        @if($draft->count() != 0)
                                            @php
                                                $data = \App\Models\DraftPermintaan::where('permintaan_id', $item->id)->count();
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" @if($data != 0) checked @endif type="checkbox" id="permintaan{{ $item->id }}" name="permintaan[]" value="{{ $item->id }}" />
                                                <label class="form-check-label" for="permintaan{{ $item->id }}">
                                                    {{ $item->nama }}
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="permintaan{{ $item->id }}" name="permintaan[]" value="{{ $item->id }}" />
                                                <label class="form-check-label" for="permintaan{{ $item->id }}">
                                                    {{ $item->nama }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Devisi</label>
                                <div class="col-sm-10">
                                    @if($draft->count() != 0)
                                        <input type="text" class="form-control" id="inputEmail3" name="devisi" value="{{ $draft[0]->devisi }}" required />
                                    @else
                                        <input type="text" class="form-control" id="inputEmail3" name="devisi" required />
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sub Devisi</label>
                                <div class="col-sm-10">
                                    @if($draft->count() != 0)
                                        <input type="text" class="form-control" id="inputEmail3" name="sub_devisi" value="{{ $draft[0]->sub_devisi }}" required />
                                    @else
                                        <input type="text" class="form-control" id="inputEmail3" name="sub_devisi" required />
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="3">
                                        @if($draft->count() != 0)
                                            {{ $draft[0]->keterangan }}
                                            
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                            <div class="callout callout-primary">
                                <div class="row justify-content-md-center">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck2" style="padding:10px;" name="approval_manager" disabled />
                                            <h3 class="form-check-label" for="gridCheck2">
                                                Manager
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck2" style="padding:10px;" name="approval_senior_manager" disabled />
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

                            <button type="submit" class="btn btn-warning" disabled>Simpan Draft</button>
                             @if($draft[0]->status == 'Disetujui')
                             <button type="button" class="btn btn-primary">Submit</button>
                             @endif

                            @else
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Apakah data anda sudah benar?');">Simpan Draft</button>


                            @endif
                           
                        </div>
                        <!--end::Footer-->
                    </form>
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
