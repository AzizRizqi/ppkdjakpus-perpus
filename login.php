<?php
session_start();
include "config/koneksi.php";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        $dataUser = mysqli_fetch_assoc($result);
        if($password == $dataUser['password']){
            $_SESSION['NAMA_LENGKAP'] = $dataUser['nama_lengkap']; 
            $_SESSION['ID'] = $dataUser['id'];
            header("location:index.php");
        }
    } else {
        header("location:login.php?error=login");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Login Form</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <?php
                            if(isset($_GET['error']) && $_GET['error'] == "login") { ?>
                            <div class="alert alert-danger" role="alert">Email/Password salah</div>
                            <?php } ?>
                            <div class=" mb-3">
                                <label for="username">Email:</label>
                                <input type="email" class="form-control" id="username" name="email" required>
                            </div>
                            <div class=" mb-3">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input value="Login" type="submit" class="btn btn-primary" name="login" />
                        </form>
                    </div>
                    <div class="card-footer">
                        Belum punya akun? <a href="register.php">Daftar disini</a </div>
                    </div>
                </div>
            </div>
</body>

</html>