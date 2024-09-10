<?php
$query = mysqli_query($koneksi,"SELECT * from kategori ORDER BY id DESC");


?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Kategori</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3" align="right">
                        <a href="?pg=tambah-kategori" class="btn btn-primary">Tambah </a>
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
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1; while($rowKategori = mysqli_fetch_assoc($query)): ?>

                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?= $rowKategori['nama_kategori'] ?></td>
                                    <td><?= $rowKategori['keterangan']?></td>
                                    <td><a href="?pg=tambah-kategori&edit=<?=$rowKategori['id']?>"
                                            class="btn btn-warning btn-sm">Edit</a> | <a
                                            href="?pg=tambah-kategori&delete=<?=$rowKategori['id']?>"
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