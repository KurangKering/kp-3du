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
            vertical-align: top;
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
                <th style="">Nama Peminjam</th>
                <th style="">Tanggal Mulai</th>
                <th style="">Tanggal Selesai</th>
                <th style="">Daftar Barang</th>
                <th style="">Jumlah Peminjaman</th>
                <th style="">Ket</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($dataPeminjaman) < 1) : ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif ?>
            <?php $nomor = 1; ?>
            <?php foreach ($dataPeminjaman as $idPeminjaman => $data) : ?>
                <?php $jumlahData = count($data); ?>
                <tr>
                    <td rowspan="<?= $jumlahData ?>" style="text-align: center;"><?php echo $nomor++; ?></td>
                    <td rowspan="<?= $jumlahData ?>">
                        <?php echo $data[0]->nama ?>
                    </td>
                    <td rowspan="<?= $jumlahData ?>">
                        <?php echo indoDate($data[0]->waktu_mulai, 'd-m-Y\, H:i', 'WIB') ?>
                    </td>
                    <td rowspan="<?= $jumlahData ?>">
                        <?php echo indoDate($data[0]->selesai, 'd-m-Y\, H:i', 'WIB') ?>
                    </td>
                    <td style="text-align: left;">
                        <?php echo $data[0]->nama_barang ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo $data[0]->jumlah . " " . $data[0]->satuan; ?>
                    </td>
                    <td rowspan="<?= $jumlahData ?>" style="white-space: nowrap; column-width: auto;">
                        <?php echo hStatusPeminjamanBarang($data[0]->status) ?>
                    </td>
                </tr>
                <?php unset($data[0]); ?>
                <?php foreach ($data as $item => $sisa) : ?>
                    <tr>
                        <td style="text-align: left;">
                            <?php echo $sisa->nama_barang ?>
                        </td>
                        <td style="text-align: center;">
                            <?php echo $sisa->jumlah . " " . $sisa->satuan; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
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