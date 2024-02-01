<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tambahkan link ke file CSS Bootstrap -->
    <link href="<?php echo base_url ('files/');?>css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <?php echo $this->session->flashdata("gagal");?>
                <div class="card rounded-4">
                    <div class="card-body p-5">
                        <h5 class="text-center mb-4 font-weight-bold text-primary">SELAMAT DATANG</h5>
                        <form method="POST" action="<?= base_url("Login/Auth")?>">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control rounded-0" id="username" name="username" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control rounded-0" id="password" name="password"placeholder="">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block bg-gradient-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan script untuk Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
