<?php
session_start();
include "function/helper.php";
include "config/koneksi.php";
if (!$_SESSION['ID']) {
    header("location: login.php");
    exit;
}
// echo "<h1>Selamat datang" . (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '')."</h1>";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selaamt Datang,<?php echo $_SESSION['NAMA_LENGKAP'] ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        nav.menu {
            background-color: #F8EDE3 !important;
            color: #fff;
            box-shadow: 0 0 3px #000;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a href="" class="navbar-brand">Perpustakaan</a>
                <!-- Toggle Button for Mobile View -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="?pg=pengembalian">Pengembalian</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?pg=user">User</a></li>
                                <li><a class="dropdown-item" href="?pg=level">Level</a></li>
                                <li><a class="dropdown-item" href="?pg=kategori">Kategori</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Transaksi
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?pg=buku">Buku</a></li>
                                <li><a class="dropdown-item" href="?pg=anggota">Anggota</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                hi, <?= (isset($_SESSION['NAMA_LENGKAP']) ? $_SESSION['NAMA_LENGKAP'] : '') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- content here -->
        <div class="container-fluid">
            <?php
            if (isset($_GET['pg'])) {
                # code...
                if (file_exists('content/' . $_GET['pg'] . '.php')) {
                    include 'content/' . $_GET['pg'] . '.php';
                }
            } else {
                include 'content/home.php';
            }
            ?>
        </div>

    </div>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script>
        $('#id_kategori').change(function() {
            let id = $(this).val();
            let option = ""
            $.ajax({
                url: "ajax/getBuku.php?id_kategori=" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    option += "<option value = ''>Pilih Buku</option>"
                    $.each(data, function(key, value) {
                        let tahun_terbit = $('#tahun_terbit').val(value.tahun_terbit)
                        option += "<option value=" + value.id + ">" + value.judul +
                            "</option>"
                    })
                    $('#id_buku').html(option)
                }
            })
        });
        $('#tambah-row').click(function() {
            if ($('#id_kategori').val() == "") {
                alert("mohon pilih kategori")
                return
            }
            if ($('#id_buku').val() == "") {
                alert("mohon pilih buku")
                return
            }
            let kategori_name = $('#id_kategori').find('option:selected').text(),
                nama_buku = $('#id_buku').find('option:selected').text(),
                tahun_terbit = $('#tahun_terbit').val(),
                id_kategori = $('#id_kategori').val(),
                id_buku = $('#id_buku').val()
            let tbody = $('tbody')
            let no = tbody.find('tr').length + 1
            let table = "<tr>"
            table += "<td>" + no + "</td>"
            table += "<td>" + kategori_name + "<input type='hidden' name='id_kategori[]' value='" + id_kategori +
                "'</td>"
            table += "<td>" + nama_buku + "<input type='hidden' name='id_buku[]' value='" + id_buku +
                "'</td>"

            table += "<td>" + tahun_terbit + "</td>"
            table += "<td><button type='button' class='btn btn-sm btn-success remove'>Delete</button></td>"
            table += "</tr>"
            tbody.append(table);
        })

        $('tbody').on('click', '.remove', function() {
            $(this).closest('tr').remove()
        })
        $('#kode_peminjaman').change(function() {
            let kode = $(this).val();
            let option = ""
            $.ajax({
                url: "ajax/get-data-transaksi.php?kode_transaksi=" + kode,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#nama_anggota').val(data.data.nama_lengkap)
                    $('#tanggal_kembali').val(data.data.tgl_kembali)
                    $('#tanggal_pinjam').val(data.data.tgl_pinjam)
                    let tanggal_kembali = new moment(data.data.tgl_kembali);
                    let tanggal_pengembalian = new moment('2024-08-16');
                    let selisih = tanggal_pengembalian.diff(tanggal_kembali, 'days');
                    let denda = 1000000;
                    if(selisih < 0){
                        selisih = 0;
                    }
                    let totalDenda = selisih * denda;
                    $('.total-denda').html("<h5>Rp. " + totalDenda.toLocaleString('id-ID') + "</h5>")
                    $('#denda').val(totalDenda);
                    console.log("Rp", totalDenda.toLocaleString('id-ID'));
                    $('#terlambat').val(selisih)

                    console.log("nilai sebelum di looping", data);
                    let tbody = $('tbody');
                    $newRow = ""
                    $.each(data.detail_pinjam, function(index, val) {
                        // console.log("nilai sesudah di looping", val);
                        $newRow += "<tr>"
                        $newRow += "<td>" + (index + 1) + "</td>"
                        $newRow += "<td>" + val.nama_kategori + "</td>"
                        $newRow += "<td>" + val.judul + "</td>"
                        $newRow += "<td>" + val.penerbit + "</td>"
                        $newRow += "</tr>"

                    })
                    tbody.html($newRow)

                }
            })
        });

        // let tanggalSekarang = new Data();
        // let formatIndonesia = new Intl.DataTimeFormat('id-ID', {
        //     year: 'numeric',
        //     month: '2-digit',
        //     day: '2-digit',
        // }).format(tanggalSekarang);

        // let tgl_kembali = $('$tgl_kembali').val();
        // let tgl_pengembalian = $('#tgl_pengmbalian').val();

        // let tanggal_1 = new moment(tgl_kembali);
        // let tanggal_2 = new moment('2024-08-12');

        // let selisih = tanggal_2.diff(tanggal_1, 'days');
        // console.log(selisih);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/moment.js"></script>
</body>

</html>