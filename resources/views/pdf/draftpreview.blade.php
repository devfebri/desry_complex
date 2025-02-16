<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Fasilitas TI</title>
    
</head>
<body>
    <center>
        <h3>PERMOHONAN FASILITAS IT</h3>
    </center>
    <table style="width: 100%">

        <tr>
            <td style="width: 50%">

                <table style="width: 100%; text-align: left;" >

                    <tr>
                        <td style="width: 35%">Nama Pemohon</td>
                        <td style="width: 5%">:</td>

                        <td style="width: 60%">{{ $data->nama }}</td>
                    </tr>
                    <tr>
                        <td style="width: 35%">NPP</td>
                        <td style="width: 5%">:</td>

                        <td style="width: 60%">{{ $data->npp }}</td>
                    </tr>
                    <tr>
                        <td style="width: 118px">Keterangan</td>
                        <td style="width: 15px">:</td>

                        <td>{{ $data->keterangan }}</td>
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
    <table style="width: 50%" class="dd center">

        <thead>
            <th class="dd">No</th>
            <th class="dd">Permintaan</th>
            <th class="dd">Status</th>
        </thead>
        <tbody>
            @foreach($dp as $key => $row)
            <tr>
                <td class="dd">{{ ++$key }}</td>
                <td class="dd">{{ $row->permintaan->nama }}</td>
                <td class="dd">{{ $row->status }}</td>
            @endforeach
        </tbody>
    </table>

    <table style="width: 40%; margin-top:20px" class="dd center">

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

