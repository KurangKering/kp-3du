<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        #table-info,
        #table-info td {
            padding-bottom: 2px;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 5mm;">
        <p style="font-size: 18px; margin:0;">
            <strong> DAFTAR PEMINJAMAN BARANG <br>
                FAKULTAS PSIKOLOGI
            </strong>
        </p>
    </div>

    <table cellpadding="0" cellspacing="0" id="table-info"> 
        <tr>
            <td style="text-align: left; width: 200px;">Nama Peminjam</td>
            <td>: <?php echo $data->nama ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Kegiatan</td>
            <td>: <?php echo $data->kegiatan ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Tanggal Pinjam</td>
            <td>: <?php echo indoDate($data->waktu_mulai, 'j F Y \P\u\k\u\l H:i') ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Tanggal Pengembalian</td>
            <td>: <?php echo indoDate($data->waktu_pengembalian, 'j F Y \P\u\k\u\l H:i') ?></td>
        </tr>
        <tr>
            <td style="text-align: left;">Keterangan</td>
            <td>: <?php echo $data->status == 2 ? 'Sudah dikembalikan' : 'Belum dikembalikan' ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table cellpadding="0" cellspacing="0" id="table-barang">
        <thead>
            <tr>
                <th>No</th>
                <th style="width: 40%;">Nama Barang</th>
                <th style="width: 30%;">Jumlah Peminjaman</th>
                <th style="width: 20%;">Ket</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1; ?>
            <?php foreach ($data->det_peminjaman_barang as $detail) : ?>
                <tr>
                    <td style="text-align: center;"><?php echo $nomor++; ?></td>
                    <td>
                        <?php echo $detail->daftar_barang->nama_barang;
                        ?>
                    </td>
                    <td style="text-align: center;"><?php 
                    echo $detail->jumlah . " " . $detail->daftar_barang->satuan
                    ?>
                    </td>
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
                <strong>Kabbag</strong>
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