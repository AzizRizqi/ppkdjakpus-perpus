<?php
$query = mysqli_query($koneksi,"SELECT * from level ORDER BY id DESC");


if(isset($_POST['simpan'])){
    $id = isset($_GET['edit'])?$_GET['edit'] : '';
    $nama_level = $_POST['namaLevel'];
    $keterangan = $_POST['keterangan'];

    if(!$id){
        $queryInsert = mysqli_query($koneksi, "INSERT INTO level (nama_level,keterangan)  VALUES ('$nama_level','$keterangan')");
        if($queryInsert){
            header("location:index.php?pg=level&tambah=berhasil");
        }
    }else{
        $update = mysqli_query($koneksi, "UPDATE level SET nama_level = '$nama_level', keterangan = '$keterangan' WHERE id = $id");
        if($update){
            header("location:index.php?pg=level&edit=berhasil");
        }
    }
}   
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $queryDelete = mysqli_query($koneksi, "DELETE FROM level WHERE id = $id");
    if($queryDelete){
        header("location:index.php?pg=level&hapus=berhasil");
    }
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM level WHERE id = $id");
    $dataEdit = mysqli_fetch_assoc($queryEdit);
}
?>

<div class=" mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Level</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Level</label>
                            <input type="text" class="form-control" name="namaLevel"
                                value="<?= $dataEdit['nama_level']??'' ?>">
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