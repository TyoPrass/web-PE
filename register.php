<?php
// Database connection setup
include_once('Database/koneksi.php'); // Include the correct path to your connection file

session_start();

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi password
    if (empty($password)) {
        $error = "Password tidak boleh kosong!";
    } else {
        // Cek apakah username sudah digunakan
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Jika username sudah ada
            $error = "Username sudah digunakan, silakan pilih username lain!";
        } else {
            // Jika username belum digunakan, simpan data baru ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password
            $sql_insert = "INSERT INTO user (username, password) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $username, $hashed_password);
            if ($stmt_insert->execute()) {
                // Redirect ke login setelah registrasi berhasil
                header("Location: index.php");
                exit();
            } else {
                $error = "Terjadi kesalahan, coba lagi nanti!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>PE STAMPING ENGINEERING - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
</head>
<body class="loading authentication-bg" data-layout-config='{"darkMode":false}'>

<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">
                    <div class="card-header pt-4 pb-4 text-center bg-primary">
                        <a href="register.php">
                            <span><img src="assets/images/sjm_logo2.png"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign Up</h4>
                            <p class="text-muted mb-4">Enter your details to create an account.</p>
                        </div>

                        <!-- Form Register -->
                        <form action="register.php" method="POST">
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error; ?></div>
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" id="username" name="username" required="" placeholder="Enter your Username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required>
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Register </button>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Already have an account? <a href="index.php" class="text-muted ms-1"><b>Sign In</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    2018 - <script>document.write(new Date().getFullYear())</script> © PE.com
</footer>

<script src="assets/js/vendor.min.js"></script>
<script src="assets/js/app.min.js"></script>

</body>
</html>
