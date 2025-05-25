@php
function indoDate($date){
  return \Carbon\Carbon::parse($date)->locale('id')->isoFormat('dddd D MMMM Y');
}
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= strtoupper($requestType->name) ?></title>
  <link rel="icon" href="{{ asset('storage/settings/logo.png') }}">
  <style>
        
    @page {
        margin-top: 0;
        margin-left: 3rem;
        margin-right: 3rem;
        }
        
    body {
      font-family: 'Times New Roman', Times, serif;
      /* margin: 50px; */
      font-size: 15.5px;
    }
    .center {
      text-align: center;
    }
    .bold {
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      vertical-align: top;
      padding: 4px;
    }
    .signature-table {
      margin-top: 60px;
      width: 100%;
    }
    .signature-table td {
      width: 50%;
      text-align: center;
      vertical-align: top;
    }
    .logo {
      width: 70px;
      height: auto;
    }

  </style>
</head>
<body>

@include('cms.my-request.print.header')

  <table width="100%" border="0">
    <tr style="margin: 0px;">
      <td class="center bold"><h4 style="margin: 0px;"><u><?= strtoupper($requestType->name) ?></u></h4></td>
    </tr>
    <tr style="margin: 0px;">
      <td class="center" >No: {{ $requestLetter->document_number }}</td>
    </tr>
  </table>
  <table width="100%" border="0" style="margin-top: 50px;">
      <tr>
          <td colspan="3">Yang bertanda tangan dibawah ini : </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Nama</span></td>
          <td width="1%">:</td>
          <td>Budi Triyono, S.Sos.MM </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Jabatan</span></td>
          <td>:</td>
          <td>Lurah Jantiharjo </td>
      </tr>
      <tr>
          <td colspan="3">Yang Menerangkan dengan sesungguhnya bahwa : </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Nama</span></td>
          <td width="1%">:</td>
          <td>{{ $data->name }}</td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Tempat/Tanggal Lahir</span></td>
          <td>:</td>
          <td>{{ $data->pob }}, {{ indoDate($data->dob) }} </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Pekerjaan</span></td>
          <td>:</td>
          <td>{{ $data->occupation }} </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Jenis Kelamin</span></td>
          <td>:</td>
          <td>{{ $data->gender }} </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Agama</span></td>
          <td>:</td>
          <td>{{ $data->religion }} </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Status Perkawinan</span></td>
          <td>:</td>
          <td>{{ $data->marital_status }} </td>
      </tr>
      <tr>
          <td width="35%"><span style="margin-left: 40px;">Alamat</span></td>
          <td>:</td>
          <td>{{ $data->address }} </td>
      </tr>
      <tr>
          <td style="text-align: justify; line-height: 1.5;" colspan="3">
              <p style="text-align: justify;">Orang tersebut di atas adalah benar-benar warga kami yang berdomisili di {{ $resident->address }} RT {{ $resident->rt }} RW {{ $resident->rw }} Kecamatan Jantiharjo Kabupaten Karanganyar. </p>
              Demikian surat keterangan ini kami buat agar dapat digunakan sebagaimana mestinya.
          </td>
      </tr>
  </table>
  <table style="float: right; margin-top: 50px;" border="0">
      <tr>
          <td width="60%"></td>
          <td colspan="3" style="text-align: center;">Jatiharjo, {{ indoDate($requestLetter->created_at)}}
              <br>
              Lurah Jantiharjo
          </td>
      </tr>
      <tr>
          <td width="60%" style="text-align: center; padding-top: 100px;"></td>
          <td colspan="3" style="text-align: center; vertical-align: bottom;">Budi Triyono, S.Sos.MM</td>
      </tr>
  </table>

</body>
</html>



