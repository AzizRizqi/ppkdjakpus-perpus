<?php
$query = mysqli_query($koneksi,"SELECT * from level ORDER BY id DESC");


?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data User</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3" align="right">
                        <a href="?pg=tambah-level" class="btn btn-primary">Tambah </a>
                    </div>
                    <?php
                    if(isset($_GET['tambah']) && $_GET['tambah']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data berhasil di simpan
                    </div>
                    <?php endif;?>
                    <?php
                    if(isset($_GET['hapus']) && $_GET['hapus']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data berhasil di hapus
                    </div>
                    <?php endif;?>
                    <?php
                    if(isset($_GET['edit']) && $_GET['edit']=="berhasil") :  ?>
                    <div class="alert alert-success" role="alert">
                        Data Mengedit Data
                    </div>
                    <?php endif;?>

                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Level</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1; while($rowLevel = mysqli_fetch_assoc($query)): ?>

                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?= $rowLevel['nama_level'] ?></td>
                                    <td><?= $rowLevel['keterangan']?></td>
                                    <td><a href="?pg=tambah-level&edit=<?=$rowLevel['id']?>"
                                            class="btn btn-warning btn-sm">Edit</a> | <a
                                            href="?pg=tambah-level&delete=<?=$rowLevel['id']?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda ingin menghapus?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>