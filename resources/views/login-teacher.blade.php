<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .login-form {
            max-width: 400px;
            border: 1px solid #ddd;
            border-radius: 8px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .login-form .title {
            border-radius: 5px;
            padding: 15px 10px;
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            color: black;
            background-color: #ffffff;
        }

        .login-form .content {
            padding: 15px;
            background-color: #ffffff;
        }
        .btn-navy{
            border-radius: 5px;
            background-color: #00598F;
            font-weight: bold;
            width: 240px;
            height: 36px;
            -ms-transform: translateX(-50%);
            transform: translateX(25%);
        }

        .forgot-pass{
            -ms-transform: translateX(-50%);
            transform: translateX(28%);
            text-decoration: none; 
            color: #00598F;
        }
    </style>
</head>
<body>
<img src="assets-image\crop800-500_School_Building1.jpg" style="width:1519px; height:725px" alt="bg-ccs">

    <div class="login-form">
        <div class="title">
        <img src="assets-image\ccs-logo.jpg" style="width:130px; height:75px" alt="logo-ccs">
            <br>
            Teacher's Portal
        </div>

        <div class="content">

            <!-- <?=isset($msg) ? '<div class="alert alert-danger">'.$msg.'</div>' : ''?> -->

            

            <form method="post" action='/login'>
            @csrf
                <div class="mb-4">
                    <!-- <label for="exampleInputEmail1" class="form-label">Username</label> -->
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>

                <div class="mb-4">
                    <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn-navy" name="login" type='submit' style="text-decoration: none; color: white;">
                        <!-- <a href="/dash" style="text-decoration: none; color: white;">Login</a> -->
                         Login
                    </button>

                        <a href="#" class="forgot-pass">Forgot your password?</a>

                </div>
            </form>

        </div>
    </div>
    
</body>
</html>