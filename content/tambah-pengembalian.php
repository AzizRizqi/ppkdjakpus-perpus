<?php
// include "../function/helper.php";

if (isset($_POST['simpan'])) {
    // Mengambil data dari POST
    $id_peminjaman = $_POST['id_peminjaman'] ?? '';
    $kode_pengembalian = ''; // Anda tidak sepertinya tidak membutuhkan kode_pengembalian, atau Anda bisa menambahkannya jika diperlukan
    $tgl_pengembalian = $_POST['tgl_pengembalian'] ?? '';
    $terlambat = $_POST['terlambat'] ?? '';
    $denda = $_POST['denda'] ?? '';

    // Validasi input
    if (empty($id_peminjaman) || empty($tgl_pengembalian)) {
        echo "Data tidak lengkap.";
        exit;
    }

    // Insert into pengembalian
    $queryInsertPengembalian = mysqli_query($koneksi, "INSERT INTO pengembalian (id_peminjaman, kode_pengembalian, denda, tgl_pengembalian, terlambat) VALUES ('$id_peminjaman', '$kode_pengembalian', '$denda', '$tgl_pengembalian', '$terlambat')");

    if ($queryInsertPengembalian) {
        $update = mysqli_query($koneksi, "UPDATE peminjaman SET status = 2 WHERE id = '$id_peminjaman'");
        if ($update) {
            header("Location:?pg=pengembalian&tambah=berhasil");
            exit;
        } else {
            echo "Gagal memperbarui status peminjaman.";
        }
    } else {
        echo "Gagal menyimpan transaksi pengembalian.";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id = $id");
    header("location:?pg=peminjaman&delete=berhasil");
    exit;
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}

if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $detail = mysqli_query($koneksi, "SELECT anggota.nama_lengkap as nama_anggota ,peminjaman.*,user.nama_lengkap
        FROM peminjaman 
        LEFT JOIN anggota ON anggota.id=peminjaman.id_anggota 
        LEFT JOIN user ON user.id = peminjaman.id_user 
        WHERE peminjaman.id = '$id'");
    $rowDetail = mysqli_fetch_assoc($detail);

    // GetBuku
    $getDetaiBook = mysqli_query($koneksi, "SELECT * FROM detail_peminjam LEFT JOIN buku on buku.id = detail_peminjam.id_buku 
        LEFT JOIN kategori on kategori.id = buku.id_kategori WHERE id_peminjaman = '$id'");

    // menghitung durasi peminjaman
    $tangga_pinjam = $rowDetail['tgl_pinjam'];
    $tangga_kembali = $rowDetail['tgl_kembali'];
    $date_pinjam = new DateTime($tangga_pinjam);
    $date_kembali = new DateTime($tangga_kembali);
    $interval = $date_pinjam->diff($date_kembali);
    // echo "ini adalah jumlah hari peminjaman selama" . $interval->days . "hari";
}

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$queryPeminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status = 1 ORDER BY id DESC");

// kode transaksi
$mysqliQuery = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$kodeTransaksi = mysqli_fetch_assoc($mysqliQuery);
// $nomorUrut = $kodeTrans
?>
<div class="container">

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">Transaksi Pengembalian</div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="nama_petugas" class="form-label">Nama Petugas</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_petugas" id="nama_petugas" value="<?= $_SESSION['NAMA_LENGKAP'] ?>" readonly class="form-control">
                                    <input type="hidden" name="id_petugas" id="id_petugas" value="<?= $_SESSION['ID'] ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="kode_pengembalian" class="form-label">Kode Peminjaman</label>
                                </div>
                                <div class="col-sm-9">
                                    <select name="id_peminjaman" id="kode_peminjaman" class="form-select" required>
                                        <option value="" selected>Pilih Kode Peminjaman</option>
                                        <?php while ($rowPinjam = mysqli_fetch_assoc($queryPeminjaman)) : ?>
                                            <option value="<?= $rowPinjam['id'] ?>">
                                                <?= $rowPinjam['kode_transaksi'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label for="nama_anggota" class="form-label">Nama Anggota</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" readonly id="nama_anggota" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" readonly id="tanggal_pinjam" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" readonly id="tanggal_kembali" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <label for="terlambat" class="form-label">Terlambat</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" readonly id="terlambat" class="form-control">
                                            <input type="hidden" name="denda" id="denda">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 mt-5">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Tahun Terbit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Isi tabel jika diperlukan -->
                                </tbody>
                            </table>
                            <div align="right" class="total-denda"></div>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Simpan" class="btn btn-primary" name="simpan">
                            <a href="?pg=pengembalian" class="btn btn-secondary">Batal</a>
                        </div>
                    </div>
                </form>

                <!-- table -->

            </div>
        </div>