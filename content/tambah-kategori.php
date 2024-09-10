<?php
$query = mysqli_query($koneksi,"SELECT * from kategori ORDER BY id DESC");


if(isset($_POST['simpan'])){
    $id = isset($_GET['edit'])?$_GET['edit'] : '';
    $nama_kategori = $_POST['nama_kategori'];
    $keterangan = $_POST['keterangan'];

    if(!$id){
        $queryInsert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori,keterangan)  VALUES ('$nama_kategori','$keterangan')");
        if($queryInsert){
            header("location:index.php?pg=kategori&tambah=berhasil");
        }
    }else{
        $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$nama_kategori', keterangan = '$keterangan' WHERE id = $id");
        if($update){
            header("location:index.php?pg=kategori&edit=berhasil");
        }
    }
}   
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id = $id");
    if($queryDelete){
        header("location:index.php?pg=kategori&hapus=berhasil");
    }
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id = $id");
    $dataEdit = mysqli_fetch_assoc($queryEdit);
}
?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Kategori</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori"
                                value="<?= $dataEdit['nama_kategori']??'' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan"
                                value="<?= $dataEdit['keterangan']??'' ?>">
                        </div>
                </div>
                <div class="card-footer">
                    <input class="btn btn-primary" name="simpan" value="Simpan User" type="submit" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>