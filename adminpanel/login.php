<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <style>
       body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg,
                #ff9aa2,
                #F5F5F5
            );
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-box {
            width: 420px;
            background: #f7fbff;
            padding: 35px 40px;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .login-title {
            font-size: 26px;
            font-weight: 600;
            color: #ff9aa2;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: #eef3f8;
            margin-bottom: 18px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #ff9aa2;
            background: #fff;
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #f8c8dc;
            color: white;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #f4b6cf;
        }
    </style>

</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <h2 class="login-title">Login Admin</h2>
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-login form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        
        <div class="mt-3" style="width: 500px">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username= '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);              
                    if($countdata>0){
                        if ($password === $data['password']) {
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login']= true;
                            header('location: ../adminpanel');
                         
                        }
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                Password salah
                            </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Akun tidak tersedia
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>