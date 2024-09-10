<?php
// $queryUser = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id DESC");
$queryUser = mysqli_query($koneksi, "SELECT level.nama_level, user.* FROM user LEFT JOIN level ON level.id = user.id_level ORDER BY id DESC");

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">Data User</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-user" class="btn btn-primary">Tambah</a>
                    </div>
                    <?php if (isset($_GET['tambah'])) : ?>
                    <div class="alert alert-success">Data Berhasil Ditambah</div>
                    <?php endif ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Level</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowUser = mysqli_fetch_assoc($queryUser)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $rowUser['nama_level'] ?></td>
                                <td><?= $rowUser['nama_lengkap'] ?></td>
                                <td><?= $rowUser['email'] ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning"
                                        href="?pg=tambah-user&edit=<?= $rowUser['id'] ?>">Edit</a>
                                    <a onclick="return confirm('Apakah anda ingin menghapus data ini?')"
                                        href="?pg=tambah-user&delete=<?= $rowUser['id'] ?>"
                                        class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>