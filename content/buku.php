<?php
$queryBuku = mysqli_query($koneksi, "SELECT kategori.nama_kategori, buku.* FROM buku LEFT JOIN kategori ON kategori.id = buku.id_kategori ORDER BY id DESC");
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">Data Buku</div>
                <div class="card-body">
                    <div align="right" class="mb-3">
                        <a href="?pg=tambah-buku" class="btn btn-outline-primary">Tambah</a>
                    </div>
                    <?php if (isset($_GET['tambah'])) : ?>
                    <div class="alert alert-success">
                        Data Berhasil ditambah!
                    </div>
                    <?php endif ?>
                    <?php if (isset($_GET['ubah'])) : ?>
                    <div class="alert alert-info ">
                        Data Berhasil diedit!
                    </div>
                    <?php endif ?>
                    <?php if (isset($_GET['hapus'])) : ?>
                    <div class="alert alert-danger">
                        Data Berhasil dihapus!
                    </div>
                    <?php endif ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Judul Buku</th>
                                <th>Jumlah Buku</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            while ($rowBuku = mysqli_fetch_assoc($queryBuku)) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowBuku['nama_kategori'] ?></td>
                                <td><?php echo $rowBuku['judul'] ?> </td>
                                <td><?php echo $rowBuku['jumlah'] ?> </td>
                                <td><?php echo $rowBuku['penerbit'] ?> </td>
                                <td><?php echo $rowBuku['tahun_terbit'] ?> </td>
                                <td><?php echo $rowBuku['penulis'] ?> </td>
                                <td>
                                    <a href="?pg=tambah-buku&edit=<?php echo $rowBuku['id'] ?>"
                                        class="btn btn-sm btn-success">Edit</a> |

                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"
                                        href="?pg=tambah-buku&delete=<?php echo $rowBuku['id'] ?>"
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