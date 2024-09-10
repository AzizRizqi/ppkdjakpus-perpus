<?php

include "../config/koneksi.php";
if (isset($_GET['kode_transaksi'])) {
    $dataDetailPinjam = [];
    $id = $_GET['kode_transaksi'];
    $rowTrans = mysqli_query($koneksi, "SELECT * FROM peminjaman LEFT JOIN anggota on anggota.id=peminjaman.id_anggota WHERE peminjaman.id = '$id'");
    $dataTrans = mysqli_fetch_assoc($rowTrans);

    $queryDetailPinjam = mysqli_query($koneksi, "SELECT * FROM detail_peminjam LEFT JOIN kategori ON kategori.id = detail_peminjam.id_kategori
    LEFT JOIN buku ON buku.id = detail_peminjam.id_buku WHERE id_peminjaman = '$id'");
    while ($rowDetailPinjam = mysqli_fetch_assoc($queryDetailPinjam)) {
        $dataDetailPinjam[] = $rowDetailPinjam;
    }
    $respon = json_encode(['data' => $dataTrans, 'detail_pinjam' => $dataDetailPinjam]);
    echo $respon;
}
