
<?php 

require_once('config.php');

if(isset($_POST['registration_form'])){
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $password = $_POST['password'];

    $usernameCount = InputDataCount('user_name',$user_name);
    $emailCount = InputDataCount('email',$email);
    $mobileCount = InputDataCount('mobile',$mobile);

    if(empty($name)){
        $error = "Name is Required!";
    }
    elseif(empty($user_name)){
        $error = "User name is Required!";
    }
    elseif($usernameCount != 0){
        $error = "User name already used!";
    }
    elseif(empty($email)){
        $error = "Email is Required!";
    }
    elseif($emailCount != 0){
        $error = "Email already used!";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Use valid Email!";
    }
    elseif(empty($mobile)){
        $error = "Mobile number is Required!";
    }
    elseif($mobileCount != 0){
        $error = "Mobile number alredy used!";
    }
    elseif(!is_numeric($mobile)){
        $error = "Mobile number must be number!";
    }
    elseif(strlen($mobile) != 11){
        $error = "Mobile number must be number!";
    }
    elseif(empty($password)){
        $error = "Password is Required!";
    }
    elseif(strlen($password) < 6 || strlen($password) > 15){
        $error = "Password most be less then 8 to 15!";
    }

    else{
        $password = SHA1($password);
        $email_code = rand(111111,999999);
        $mobile_code = rand(111111,999999);
        $create_at = date('Y-m-d H:i:s');
        $user_name = strtolower($user_name);

        $insert = $connection->prepare("INSERT INTO user_data(name,user_name,email,mobile,password,businness_name,address,email_code,mobile_code,staus,gender,date_of_birth,create_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $insert->execute(array($name,$user_name,$email,$mobile,$password,$business_name,$address,$email_code,$mobile_code,"Pending",$gender,$date_of_birth,$create_at));

        if($insert == true){
            $success = "Registration Successfully!";

            header('location:verification.php');
        }
        else{
            $error = "Registration is Failed!";
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
    <title>BD Store - Registration</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
                <div class="col-xl-8">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="index.php"> <h2>Registration</h2></a>

                                <?php if(isset($error)): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(isset($success)): ?>
                                    <div class="alert alert-success">
                                        <?php echo $success; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="" method="POST" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control"  placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="user_name" class="form-control"  placeholder="User Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control"  placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mobile" class="form-control"  placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="business_name" class="form-control"  placeholder="Business Name">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="address" class="form-control" placeholder="Address" col="8"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="male">Gender</label>
                                        <br>
                                        <label for="male"><input type="radio" id="male" name="gender" checked value="male"> Male</label>
                                        <br>
                                        <label for="female"><input type="radio" id="female" name="gender" value="female"> Female</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date_of_birth" id="date" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <button type="submit" name="registration_form" class="btn login-form__btn submit w-100">Registration</button>
                                </form>
                                <p class="mt-5 login-form__footer">Create an Acount ?<a href="login.php" class="text-primary"> Login</a> now</p>
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





