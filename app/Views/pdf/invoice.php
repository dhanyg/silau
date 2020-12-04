<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- <link rel="stylesheet" href="/assets/css/pdf-style.css"> -->

    <style>
        body {
            margin: 50px;
            padding: 0;
            font-family: 'poppins', sans-serif;
            /* max-width: 600px; */
        }

        h1,
        h2,
        h6 {
            margin: 0;
        }

        h1,
        h2,
        h6,
        th {
            color: #1f2937;
        }

        span,
        td {
            color: #6b7280;
        }

        h6,
        span,
        th,
        td {
            font-size: 0.8rem;
        }

        h1 {
            font-size: 1.4rem;
        }

        h2 {
            font-size: 1rem;
        }

        hr {
            background-color: #F5F5F5;
            color: #F5F5F5;
            height: 2px;
            border-color: transparent;
            margin-bottom: 2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }

        table tr th,
        table tr td {
            padding: 5px 12px;
        }

        table tr th {
            background-color: #eee;
            font-weight: 500;
        }

        table tr td {
            font-weight: 400;
        }

        table tr:nth-child(even) {
            background-color: #F5F5F5;
        }

        .section1::before,
        .section1::after {
            content: '';
            display: table;
        }

        .section1::after {
            clear: both;
        }

        .section-left div,
        .section-right div {
            margin-bottom: 0.5em;
        }

        .section-left {
            width: 50%;
            float: left;
        }

        .section-right {
            width: 50%;
            float: right;
            text-align: right;
        }

        .section2,
        .section4 {
            margin-top: 1em;
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h1>Transaksi #<?= $data['id'] ?></h1>
    </header>
    <hr>
    <section>
        <div class="section1">
            <div class="section-left">
                <div>
                    <h6>Pelanggan:</h6>
                    <span><?= $data['nama'] ?></span>
                </div>
                <div>
                    <h6>Layanan:</h6>
                    <span><?= $data['nama_layanan']; ?></span>
                </div>
                <div>
                    <h6>Status Transaksi:</h6>
                    <span>
                        <?php if ($data['status'] == 1) : ?>
                            Selesai
                        <?php else : ?>
                            Belum Selesai
                        <?php endif ?>
                    </span>
                </div>
                <div>
                    <h6>Pembayaran:</h6>
                    <span>
                        <?php if ($data['lunas'] == 1) : ?>
                            Lunas
                        <?php else : ?>
                            Non-lunas
                        <?php endif ?>
                    </span>
                </div>
            </div>
            <div class="section-right">
                <div>
                    <h6>Tanggal Masuk:</h6>
                    <span><?= date('d/m/Y', strtotime($data['tgl_masuk'])); ?></span>
                </div>
                <div>
                    <h6>Tanggal Selesai:</h6>
                    <span><?= date('d/m/Y', strtotime($data['tgl_selesai'])); ?></span>
                </div>
                <div>
                    <h6>Operator:</h6>
                    <span><?= $data['user_creator']; ?></span>
                </div>
            </div>
        </div>

        <div class="section2">
            <h6>Jumlah Item:</h6>
            <span><?= $data['jumlah_item']; ?></span>
        </div>

        <div class="section3">
            <table>
                <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left">Item</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-right">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($items as $item) : ?>
                        <tr>
                            <td class="text-left"><?= $no++; ?></td>
                            <td class="text-left"><?= $item['nama_item']; ?></td>
                            <td class="text-center"><?= $item['jumlah']; ?></td>
                            <td class="text-center"><?= $item['satuan']; ?></td>
                            <td class="text-right">Rp <?= number_format($item['harga']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="section4">
            <span>Total</span>
            <h2>Rp <?= number_format($data['total_harga']); ?></h2>
        </div>
    </section>

</body>

</html>