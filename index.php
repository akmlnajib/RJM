<?php if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'login') {
        session_start();
        include 'src/config.php';
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string(
            $conn,
            $_POST['password']
        );
        $query = mysqli_query($conn, "SELECT * FROM tb_akun WHERE username='$username' AND password = '$password'");
        $cek = mysqli_num_rows($query);
        if ($cek > 0) {
            $data = mysqli_fetch_assoc($query);
            if ($data['jabatan'] == 'manager') {
                $_SESSION['username'] = $username;
                header("Location: manager/index.php");
                exit();
            } elseif ($data['jabatan'] == 'hrd') {
                $_SESSION['username'] = $username;
                header("Location: hrd/index.php");
                exit();
            } elseif ($data['jabatan'] == 'spv') {
                $_SESSION['username'] = $username;
                header("Location: spv/index.php");
                exit();
            }
        } else {
            header("Location: index.php?pesan=gagal");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Raharja Jaya Mandiri</title>
    <link rel="icon" type="image/png"
        href="src/assets/img/rjm.png">
    <link href="src/assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-5 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-2 pb-5">
                                <img src="src/assets/img/rjm.png" height="80" width="80" alt="">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <?php
                                if (isset($_GET['pesan'])) {
                                    if ($_GET['pesan'] == 'gagal') { ?>
                                        <div style="margin-bottom: -1px;" class="alert alert-danger" role="alert">Username
                                            dan
                                            Password
                                            salah</div>
                                        <?php
                                    }
                                }
                                ?>
                                <form action="index.php?aksi=login" method="post">
                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeEmailX">Username</label>
                                    <input type="text" id="typeEmailX" class="form-control form-control-lg" name="username" id="username" />
                                </div>

                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordX">Password</label>
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" id="password"/>
                                </div>
                                <input data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-light btn-lg px-5" type="submit" value="Login">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>