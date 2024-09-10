<?php

if (isset($_GET['editAnggota'])) {
    $id = $_GET['editAnggota'];
    $editAnggota = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id = '$id'");
    // var_dump($editanggota);
    $rowAnggota = mysqli_fetch_assoc($editAnggota); //mysqli_fetch_assoc mengambil data dari hasil query dalam bentuk data
}
if (isset($_POST['simpan'])) {
    // jika param edit ada maka update, selian itu maka tambah
    $id = isset($_GET['editAnggota']) ? $_GET['editAnggota'] : '';
    $nisn = $_POST['nisn'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $no_telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];

    if (!$id) {
        $insert = mysqli_query($koneksi, "INSERT INTO anggota (nisn, nama_lengkap, no_telp, jenis_kelamin, alamat) VALUES ('$nisn', '$nama_lengkap', '$no_telp', '$jenis_kelamin', '$alamat')");
    } else {
        $update = mysqli_query($koneksi, "UPDATE anggota SET nisn = '$nisn', nama_lengkap = '$nama_lengkap', no_telp = '$no_telp', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat' WHERE id = '$id'");
    }


    header("location:?pg=anggota&tambah=berhasil");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM anggota WHERE id = '$id'");
    header("location:?pg=anggota&hapus=berhasil");
}
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">Data Anggota</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">NISN</label>
                            <input value="<?php echo $rowAnggota['nisn'] ?? '' ?>" type="text" class="form-control"
                                name="nisn">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input value="<?php echo $rowAnggota['nama_lengkap'] ?? '' ?>" type="text"
                                class="form-control" name="nama_lengkap">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="" class="form-control">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki"
                                    <?php echo isset($rowAnggota['jenis_kelamin']) && ($rowAnggota['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : '' ?>>
                                    Laki-Laki</option>
                                <option value="Perempuan"
                                    <?php echo isset($rowAnggota['jenis_kelamin']) && ($rowAnggota['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">No Telp</label>
                            <input value="<?php echo ($rowAnggota['no_telp'] ?? '') ?>" type="number"
                                class="form-control" name="no_telp">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control"
                                id=""><?php echo ($rowAnggota['alamat'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" name="simpan" vlue="Simpan">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>