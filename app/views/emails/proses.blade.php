<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<h1>{{ $title }}</h1>

<strong>Informasi Bantuan Hukum</strong>
<table>
    <tr>
        <th align="left">Jenis Perkara</th>
        <?php
        $jenis_perkara = "";
        switch ($bankum->jenis_perkara){
            case 1:
                $jenis_perkara = 'Tata Usaha Negara';
                break;
            case 2:
                $jenis_perkara = 'Perdata';
                break;
            case 3:
                $jenis_perkara = 'Pidana';
                break;
            case 4:
                $jenis_perkara = 'Uji Materil Mahkamah Konstitusi';
                break;
            case 5:
                $jenis_perkara = 'Uji Materil Mahkamah Agung';
                break;
        }
        ?>
        <td>: {{ $jenis_perkara }}</td>
    </tr>
    <tr>
        <th align="left">Status Perkara</th>
        <td>: {{ $bankum->status_perkara }}</td>
    </tr>
    <tr>
        <th align="left">Status Pemohon</th>
        <?php
            $status_pemohon = "";
            switch ($bankum->status_pemohon){
                case 1:
                    $status_pemohon = "Tergugat";
                    break;
                case 2:
                    $status_pemohon = "Penggugat";
                    break;
                case 3:
                    $status_pemohon = "Interfent";
                    break;
                case 4:
                    $status_pemohon = "Saksi";
                    break;
                case 5:
                    $status_pemohon = "Pemohon";
                    break;
            }
        ?>
        <td>: {{ $status_pemohon }}</td>
    </tr>
</table>

<span>Telah diproses oleh bantuan hukum.</span>

</body>
</html>

