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
  <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}">
  <style>

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
<table width="100%" border="0" style="margin-top: 30px;">
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
        <td>{{ $data->deceased_name }}</td>
    </tr>
    <tr>
        <td width="35%"><span style="margin-left: 40px;">Tempat/Tanggal Lahir</span></td>
        <td>:</td>
        <td>{{ $data->birth_place }}, {{ indoDate($data->birth_date) }} </td>
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
        <td width="35%"><span style="margin-left: 40px;">Alamat</span></td>
        <td>:</td>
        <td>{{ $data->address }} </td>
    </tr>
    <tr>
      <td colspan="3">Telah meninggal dunia pada :</td>
    </tr>
    <tr>
        <td width="35%"><span style="margin-left: 40px;">Hari/Tanggal</span></td>
        <td>:</td>
        <td>{{ indoDate($data->death_date) }} </td>
    </tr>
    <tr>
        <td width="35%"><span style="margin-left: 40px;">Tempat Kematian</span></td>
        <td>:</td>
        <td>{{ $data->death_place }} </td>
    </tr>
    <tr>
        <td width="35%"><span style="margin-left: 40px;">Sebeb Kematian</span></td>
        <td>:</td>
        <td>{{ $data->death_cause }} </td>
    </tr>
    <tr>
        <td style="text-align: justify; line-height: 1.5;" colspan="3">
            Demikian surat keterangan ini kami buat agar dapat digunakan sebagaimana mestinya.
        </td>
    </tr>
</table>
<table style="float: right; margin-top: 50px;" border="0">
    <tr>
        <td width="60%"></td>
        <td colspan="3" style="text-align: center;">Jatiharjo, {{ indoDate($requestLetter->created_at) }}
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



