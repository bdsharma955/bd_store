

<?php 

require_once('config.php');


if(isset($_POST['login_form'])){

    $user_name = $_POST['username'];
    $password = $_POST['password'];

   if(empty($user_name)){
        $error = "User name is Required!";
    }
    elseif(empty($password)){
        $error = "Password is Required!";
    }
    else{
        $password = SHA1($password);

        $loginCount = $connection->prepare("SELECT user_name,password FROM user_data WHERE user_name=? AND password=?");
        $loginCount->execute(array($user_name,$password));
        $loginCount = $loginCount->rowCount();

        $insert = $connection->prepare("INSERT INTO user_data(name,user_name,email,mobile,password,businness_name,address,email_code,mobile_code,staus,gender,date_of_birth,create_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert->execute(array($name,$user_name,$email,$mobile,$password,$business_name,$address,$email_code,$mobile_code,"Pending",$gender,$date_of_birth,$create_at));

        if($insert == true){
            $success = "Login Successfully!";
        }
        else{
            $error = "login is Failed!";
        }

    }

}

?>

<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BD Store Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.php"> <h2>Verifaication</h2></a>
        
                                <form action="" method="POST" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input name="username" type="text" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button type="submit" name="login_form" class="btn login-form__btn submit w-100">Login</button>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="registration.php" class="text-primary">Registration</a> now</p>
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





