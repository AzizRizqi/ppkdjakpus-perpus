<?php
// include "../function/helper.php";
if (isset($_POST['simpan'])) {
    // jika param edit ada maka update, selain itu maka tambah
    $id = isset($_GET['edit']) ? $_GET['edit'] : '';

    $kode_transaksi = $_POST['kode_transaksi'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $id_user = $_POST['id_user'];
    $id_kategori = $_POST['id_kategori'];
    $queryInsert = mysqli_query($koneksi, "INSERT INTO peminjaman (kode_transaksi, id_anggota, tgl_pinjam, tgl_kembali,id_user,status) VALUES ('$kode_transaksi', $id_anggota, '$tgl_pinjam', '$tanggal_kembali',$id_user,'1') ");
    if ($queryInsert) {
        $id_peminjam = mysqli_insert_id($koneksi);
        foreach ($id_kategori as $key => $value) {
            $id_buku = $_POST['id_buku'][$key];
            $id_kategori = $_POST['id_kategori'][$key];
            $queryInsert = mysqli_query($koneksi, "INSERT INTO detail_peminjam (id_buku, id_peminjaman, id_kategori) VALUES ('$id_buku', '$id_peminjam', '$id_kategori') ");
        }
        header("Location:?pg=peminjaman&tambah=berhasil");
        exit; // add this to prevent further execution
    }
    if (!$id) {
        header("Location:?pg=peminjaman&tambah=berhasil");
    } else {
        $updateUser = mysqli_query($koneksi, "UPDATE user SET  nama_lengkap = '$nama_lengkap',  email = '$email', id_level = '$id_level', password ='$password' WHERE id ='$id' ");
        header("Location:?pg=user&edit=berhasil");
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = mysqli_query($koneksi, "UPDATE peminjaman SET deleted_at = 1 WHERE id = $id");
    header("location:?pg=peminjaman&delete=berhasil");
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $rowEdit = mysqli_fetch_assoc($edit);
}
if (isset($_GET['detail'])) {
    $id = $_GET['detail'];
    $detail = mysqli_query($koneksi,  "SELECT anggota.nama_lengkap as nama_anggota ,peminjaman.*,user.nama_lengkap
          FROM peminjaman 
          LEFT JOIN anggota ON anggota.id=peminjaman.id_anggota 
          LEFT JOIN user ON user.id = peminjaman.id_user 
  
          WHERE peminjaman.id = '$id'");
    $rowDetail = mysqli_fetch_assoc($detail);

    // GetBuku

    $getDetaiBook = mysqli_query($koneksi, "SELECT * FROM detail_peminjam LEFT JOIN buku on buku.id = detail_peminjam.id_buku 
     LEFT JOIN kategori on kategori.id = buku.id_kategori WHERE id_peminjaman = '$id' ");

    // menghitung durasi peminjaman

    $tangga_pinjam = $rowDetail['tgl_pinjam'];
    $tangga_kembali = $rowDetail['tgl_kembali'];
    $date_pinjam = new DateTime($tangga_pinjam);
    $date_kembali = new DateTime($tangga_kembali);
    $interval = $date_pinjam->diff($date_kembali);
    // echo "ini adalah jumlah hari peminjaman selama" . $interval->days . "hari";
}

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id DESC");
$kategoriBuku = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id DESC");

// kode transaksi

$mysqliQuery = mysqli_query($koneksi, "SELECT max(id) as id_transaksi FROM peminjaman");
$kodeTransaksi = mysqli_fetch_assoc($mysqliQuery);
$nomorUrut = $kodeTransaksi['id_transaksi'];
$nomorUrut++;

$format_transaksi = "PJ" . date("dmY") . sprintf("%03s", $nomorUrut);

?>
<?php if (isset($_GET['detail'])): ?>
    <div class="container">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Detail Transaksi Peminjaman</div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Kode Transaksi</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= $rowDetail['kode_transaksi'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Tanggal Pinjam</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= date("d, D M Y", strtotime($rowDetail['tgl_pinjam'])) ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Tanggal Kembali</label>
                                </div>
                                <div class="col-sm-9">
                                    <?php echo date("d, D M Y", strtotime($rowDetail['tgl_kembali'])) ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Durasi Peminjaman</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= $interval->days ?> hari
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Nama Anggota</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= $rowDetail['nama_anggota'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Nama Petugas</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= $rowDetail['nama_lengkap'] ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Status</label>
                                </div>
                                <div class="col-sm-9">
                                    <?= getStatus($rowDetail['status']) ?>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($rowDetailBook = mysqli_fetch_assoc($getDetaiBook)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $rowDetailBook['nama_kategori'] ?></td>
                                        <td><?= $rowDetailBook['judul'] ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- table -->

        </div>
    </div>
    </div>
<?php else: ?>
    <div class="container-fluid mt-5">

        <div class="row justify-content-center">
            <div class="col-sm-8">

                <div class="card">
                    <div class="card-header">Tambah Peminjam</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Kode Transaksi</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="kode_transaksi" readonly
                                        value="<?php echo ($format_transaksi) ?? '' ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Pilih Anggota</label>
                                </div>
                                <div class="col-sm-3">
                                    <select name="id_anggota" id="" class="form-control">
                                        <option value="">Pilih anggota</option>
                                        <?php while ($rowAnggota = mysqli_fetch_assoc($anggota)) : ?>
                                            <option value="<?= $rowAnggota['id'] ?>">
                                                <?= $rowAnggota['nama_lengkap'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal Pinjam</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tanggal_pinjam">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Tanggal Kembali</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" name="tanggal_kembali">
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-2">
                                    <label for="">Petugas</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="petugas"
                                        value="<?= (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') ?>"
                                        readonly>
                                    <input type="hidden" name="id_user"
                                        value="<?= (isset($_SESSION['ID']) ? $_SESSION['ID'] : '') ?>" id="">
                                </div>
                            </div>

                            <!-- get data kategori buku -->
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Kategori Buku</label>
                                </div>
                                <div class="col-sm-3">
                                    <select id="id_kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        <?php while ($rowKategori = mysqli_fetch_assoc($kategoriBuku)) : ?>
                                            <option value="<?= $rowKategori['id'] ?>">
                                                <?= $rowKategori['nama_kategori'] ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-2">
                                    <label for="">Nama Buku</label>
                                </div>
                                <div class="col-sm-3">
                                    <select id="id_buku" class="form-control">
                                        <option value="">Pilih Kategori</option>

                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="" id="tahun_terbit">
                            <div class="my-5">
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="button" class="btn btn-primary" id="tambah-row">Tambah</button>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Judul Buku</th>
                                            <th>Kategori Buku</th>
                                            <th>Tahun Terbit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>