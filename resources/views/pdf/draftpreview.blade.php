<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Fasilitas TI</title>
    
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px">
    <center>
        <h3><u>PERMOHONAN FASILITAS IT</u><br>
            <span style="font-size: 12px;font-weight:normal">{{ $data->tanggal_submit->format('d/m/Y') }}</span>
        </h3>

        {{-- @if($data->tanggal_submit)
        <h5></h5>
        @endif --}}

    </center>
    <table style="width: 100%">

        <tr>
            <td style="width: 50%">

                <table style="width: 100%; text-align: left;" >

                    <tr>
                        <td style="width: 35%">Nama Pemohon</td>
                        <td style="width: 5%">:</td>

                        <td style="width: 60%">{{ $data->nama_pemohon }}</td>
                    </tr>
                    <tr>
                        <td style="width: 35%">Kontak Pemohon</td>
                        <td style="width: 5%">:</td>

                        <td style="width: 60%">{{ $data->kontak_pemohon }}</td>
                    </tr>
                   

                </table>
            </td>
            <td style="width: 50%">

                  <table style="width: 100%; text-align: left;">

                      <tr>
                          <td style="width: 35%">Devisi</td>
                          <td style="width: 5%">:</td>

                          <td style="width: 60%">{{ $data->devisi }}</td>
                      </tr>
                      <tr>
                          <td style="width: 35%">Sub Devisi</td>
                          <td style="width: 5%">:</td>

                          <td style="width: 60%">{{ $data->sub_devisi }}</td>
                      </tr>
                      

                  </table>

            </td>

            
        </tr>
    </table>
    {{-- <table style="width: 100%">

        <tr>
            <table style="width: 100%; text-align: left;">

                 <tr>
                     <td style="width: 118px">Keterangan</td>
                     <td style="width: 15px">:</td>

                     <td >{{ $data->keterangan }}</td>
                 </tr>

            </table>
            
        </tr>
    </table> --}}
    <style>
        .dd  {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        }
        .center {
        margin-left: auto;
        margin-right: auto;
        }

    </style>
   
    <br>
    <table style="width: 100%" class="dd center">

        <thead>
            <th class="dd">No</th>
            <th class="dd">Nama</th>
            <th class="dd">NPP</th>
            <th class="dd">Permintaan</th>
            <th class="dd">Keterangan</th>
            {{-- <th class="dd">Status</th> --}}
        </thead>
        <tbody>
            @foreach($dp as $key => $row)
            <tr>
                <td class="dd">{{ ++$key }}</td>
                <td class="dd">{{ $row->nama }}</td>
                <td class="dd">{{ $row->npp }}</td>
                <td class="dd">{{ $row->permintaan->nama }}</td>
                <td class="dd">{{ $row->keterangan }}</td>
                {{-- <td class="dd">{{ $row->status }}</td> --}}
            @endforeach
        </tbody>
    </table>
    <div style="font-size: 12px; margin-top: 20px; margin-bottom: 20px">

        <center>
            <h3>Informasi Penting</h3>
        </center>
    
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


    <table style="width: 40%; margin-top:40px" class="dd center">

        <thead>
            <tr>
                <th class="dd" style="width: 50%;">Manager</th>
                <th class="dd" style="width: 50%;">Senior Manager</th>
            </tr>
            <tr >
                <td class="dd" style="width: 50%;height:50px"><i><h3>{{ $data->approval_manager }}</h3></i></td>
                <td class="dd" style="width: 50%;"><i><h3>{{ $data->approval_senior_manager }}</h3></i></td>
            </tr>
        </thead>
    </table>



</body>
</html>

