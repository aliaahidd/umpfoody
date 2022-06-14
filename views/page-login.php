<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Gymove - Fitness Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content" style="background-color: white;">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="../images/logo-full.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                    <form method="post" action="login-submit.php">
                                        <div class="form-group">
                                            <label class="mb-1 text-black"><strong>Username</strong></label>
                                            <input type="text" name="username" class="form-control" placeholder="Ex: CB20111" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-black"><strong>Password</strong></label>
                                            <input type="password" name="users_password" class="form-control" placeholder="Password" required>
                                        </div>
                                        <label class="mb-1 text-black"><strong>User Type</strong></label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="userType" value="General User">
                                                <label class="form-check-label">
                                                    General User
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="userType" value="Restaurant Owner">
                                                <label class="form-check-label">
                                                    Restaurant Owner
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="userType" value="Rider">
                                                <label class="form-check-label">
                                                    Rider
                                                </label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-black text-primary btn-block">Log In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/deznav-init.js"></script>

</body>

</html>