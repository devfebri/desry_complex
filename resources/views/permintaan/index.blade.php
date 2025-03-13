@extends('layouts.app')
 @section('content')
 <div class="app-content-header">
     <!--begin::Container-->
     <div class="container-fluid">
         <!--begin::Row-->
         {{-- <div class="row">
             <center>
                 <h3>Setting Data Permintaan </h3>
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
         @if(session('success'))
             <div class="alert alert-success">
                 {{ session('success') }}
             </div>
         @endif
         @if(session('error'))
             <div class="alert alert-danger">
                 {{ session('error') }}
             </div>
         @endif
         <!--begin::Row-->
         <div class="row">
             <!--begin::Col-->
             <div class="col-md-12">
                 <div class="card mb-4">
                     <div class="card-header">
                         <div class="card-title">
                            <h3>Setting Data Permintaan</h3>
                         </div>
                         <div class="card-tools">
                             <a href="{{ route(auth()->user()->role.'_permintaan.create') }}" class="btn btn-primary">Tambah Data</a>

                         </div>
                     </div>
                     <!-- /.card-header -->
                     
                     <div class="card-body">
                         <table id="permintaanTable" class=" table-bordered table-striped text-center">

                             <thead class="bg-primary text-white">
                                 <tr>
                                     <th class=" text-center">No</th>
                                     <th class=" text-center">Nama</th>
                                     <th class=" text-center">Actions</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach($permintaans as $key=>$permintaan)
                                 <tr>
                                     <td><center>{{ ++$key }}</center></td>
                                     <td>{{ $permintaan->nama }}</td>
                                     <td>
                                         
                                         <a href="{{ route(auth()->user()->role.'_permintaan.edit', $permintaan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                         <form action="{{ route(auth()->user()->role.'_permintaan.destroy', $permintaan->id) }}" method="POST" style="display:inline;">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                         </form>
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
         $('#permintaanTable').DataTable();

     }); 
</script>
 @endsection
