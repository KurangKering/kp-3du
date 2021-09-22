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
            <strong> REKAP PEMINJAMAN BARANG <br>
                FAKULTAS PSIKOLOGI
            </strong>

        </p>
        <p style="margin-top: 4px;"><?php echo $subtitle; ?></p>
    </div>


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
            <?php foreach ($dataPeminjaman as $data) : ?>
                <tr>
                    <td style="text-align: center;"><?php echo $nomor++; ?></td>
                    <td>
                        <?php echo $data->nama_barang ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $data->jumlah . " " . $data->satuan ?>
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