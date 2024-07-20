<h1>Data Transaksi</h1>

<table border="1" width="100%" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Total Harga</th>
        <th>Alamat</th>
        <th>Ongkir</th>
        <th>Status</th>
    </tr>

    <?php
    $no = 1;
    foreach ($transaksi as $index => $transaksi_index):
        ?>
        <tr>
            <td align="center"><?= $index + 1 ?></td>
            <td><?= $transaksi_index['username'] ?></td>
            <td align="right"><?= "Rp " . number_format($transaksi_index['total_harga'], 2, ",", ".") ?></td>
            <td align="center"><?= $transaksi_index['alamat'] ?></td>
            <td align="center">
                <?= $transaksi_index['ongkir'] ?>
            </td>
            <td align="center">
                <?= $transaksi_index['status'] ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
Downloaded on <?= date("Y-m-d H:i:s") ?>