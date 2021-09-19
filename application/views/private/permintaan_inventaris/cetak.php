<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        #table-barang {
            width: 100%;
        }

        #table-barang,
        #table-barang th,
        #table-barang td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 5mm;">
        <p style="font-size: 18px; margin:0;">
            <strong> DAFTAR NAMA ALAT TULIS KANTOR KEPERLUAN PERKANTORAN <br>
                FAKULTAS PSIKOLOGI
            </strong>
        </p>
        <p style="margin-top: 10px;">Tanggal : <strong><?php echo indoDate($data->tanggal, 'j F Y'); ?></strong></p>
    </div>
    <table cellpadding="0" cellspacing="0" id="table-barang">
        <thead>
            <tr>
                <th >No</th>
                <th style="width: 40%;">Nama Barang</th>
                <th style="width: 30%;">Jumlah Kebutuhan</th>
                <th style="width: 20%;">Ket</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($data->det_permintaan_inventaris as $detail) : ?>
                <tr>
                    <td style="text-align: center;"><?php echo $nomor++; ?></td>
                    <td><?php echo $detail->daftar_inventaris->nama; ?></td>
                    <td style="text-align: center;"><?php echo $detail->jumlah; ?></td>
                    <td style="text-align: center;">-</td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <br>
    <br>
    <br>

    <div style="width: 100%;">
        <div style="width: 60%;">

        </div>
        <div style="width: 40%; float: right;">
            <div style="text-align: left !important;">
                Pekanbaru, <?php echo $tanggal ?? indoDate(date('Y-m-d'), 'd F Y'); ?> <br>
                <br>
                <br>
                <br>
                <br>
                <strong>H.A Bukhari, SH. MH <br>
                    NIP. 19650517 199102 1 001
                </strong>
            </div>
        </div>
    </div>
</body>

</html>