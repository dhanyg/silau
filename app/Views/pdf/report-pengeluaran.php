<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <style>
        body {
            margin: 0 25px;
            font-family: 'poppins', sans-serif;
        }

        h5,
        th {
            color: #1f2937;
        }

        span,
        td {
            color: #6b7280;
        }

        h5 {
            margin: 0;
            font-size: 1.2rem;
        }

        span,
        th,
        td {
            font-size: 0.8rem;
        }

        header {
            margin-top: 1em;
            text-align: center;
            text-transform: uppercase;
        }

        hr {
            height: 1px;
            background-color: #F5F5F5;
            border-color: transparent;
            color: #F5F5F5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background-color: #f3f3f3;
            padding: 10px 12px;
            border: solid 1px #F5F5F5;
        }

        table td {
            padding: 10px 12px;
            border: solid 1px #F5F5F5;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <header>
        <h5>Laporan Pengeluaran</h5>
        <span><?= date('d/m/Y', strtotime($tanggal_awal)); ?> - <?= date('d/m/Y', strtotime($tanggal_akhir)); ?></span>
    </header>
    <hr>
    <section>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($data as $row) : ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['keterangan']; ?></td>
                        <td class="text-center"><?= date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                        <td class="text-right">Rp <?= number_format($row['jumlah']); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div style="margin-top: 20px; margin-bottom: 20px;">
            <table>
                <tr>
                    <th colspan="2" class="text-center">REKAP DATA</th>
                </tr>
                <tr>
                    <td class="text-center"><strong>Total Pengeluaran</td>
                    <td class="text-center"><strong>Jumlah Data</td>
                </tr>
                <tr>
                    <td class="text-center">Rp <?= number_format($total_pengeluaran); ?></td>
                    <td class="text-center"><?= $jumlah_data; ?></td>
                </tr>
            </table>
        </div>
    </section>
</body>

</html>