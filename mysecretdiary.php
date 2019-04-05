<?php
session_start();
$errormessage= "";
if($_POST){
    if(array_key_exists('signup',$_POST)){


    if($_POST['emailto'] == ''){
        $errormessage.= "Email field cannot be empty"."<br>";
    }
    if($_POST['password1'] == ''){
        $errormessage.= "Password cannot be empty"."<br>";
    }
        if (!filter_var($_POST['emailto'], FILTER_VALIDATE_EMAIL)) {
    $errormessage.= "Enter Valid Email address"."<br>";
}
    if($errormessage!=""){
        $errormessage = "<div class='alert alert-danger' role='alert'>"."These were error(s) in your form:"."<br>".$errormessage."</div>";
    }
    else{
        $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
        $password = md5($_POST['password1']);
        $query = "INSERT INTO `users` (`Email`, `Password`) VALUES ('".mysqli_real_escape_string($link, $_POST['emailto'])."', '".mysqli_real_escape_string($link,$password)."')";
        if(mysqli_query($link,$query)){
            if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
            $_SESSION['email'] = $_POST['emailto'];
            header("Location: mainpage.php");
        }
  
    }
}
    else if(array_key_exists('login',$_POST)){
        if($_POST['emailto'] == ''){
        $errormessage.= "Email field cannot be empty"."<br>";
    }
    if($_POST['password1'] == ''){
        $errormessage.= "Password cannot be empty"."<br>";
    }
        if (!filter_var($_POST['emailto'], FILTER_VALIDATE_EMAIL)) {
    $errormessage.= "Enter Valid Email address"."<br>";
}
    if($errormessage!=""){
        $errormessage = "These were error(s) in your form:"."<br>".$errormessage;
    }
else{
        $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
    $password = md5($_POST['password1']);
    $query = "SELECT `Id` FROM `users` WHERE Email = '".mysqli_real_escape_string($link,$_POST['emailto'])."' AND Password = '".mysqli_real_escape_string($link,$password)."'";
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result)>0){
        if(array_key_exists('cookie1',$_POST)){
                setcookie("customerID","1234",time()+60*60*1);
            }
        $_SESSION['email'] = $_POST['emailto'];
        header("Location: mainpage.php");
    }
    else{
        
            $errormessage.="<div class='alert alert-danger' role='alert'>"."Incorrect Email ID or Password"."</div>";
    }
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<title>Secret Diary</title>  
    <style type="text/css">
        html{
            background: url(background.jpg) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
        }
        body{
            background: none;
        }
        .container{text-align: center;
                    margin-top: 200px;
            color: azure;
            width:380px;
                    }
        #signpara{
            display: none;
        }
        #signbutton{
            display: none;
        }
        .interchange{
            color:blue;
            text-decoration: none;
        }
        a:hover{
            color:green;
            text-decoration: none;
        }
        #lo{
            display: none;
        }
        #X{
            font-size: 200%;
            color:red; 
        }
        #heading{
            font-size:260%;
        }
        
    </style>
</head>
<body>
<div class = "container">
<h1 id = "heading">Mede<span id="X">X</span></h1>
    <p>Share your thoughts permanently and securely.</p>
    <p id = "logpara">Log in using email id and password</p>
    <p id = "signpara">Interested? Sign up now.</p>
    <form method = "post">
  <div class="form-group">      
<input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name = "emailto">
    </div>
<div class="form-group">
<input type = "password" class="form-control" placeholder = "Password" name = "password1">
        </div>
        <p><? echo $errormessage ?></p>
    <p id="emailHelp" class="form-text">We'll never share your email with anyone else.</p>
        <p><input type = "checkbox" name = "cookie1" value = "setcookie"> Stay Logged in</p>
       <p> <input type="submit" name = "signup" class="btn btn-success" value = "Sign Up!" id="signbutton"></p>
        <p><input type="submit" class="btn btn-primary" value = "Login" id="loginbutton" name = "login">
        </p>
    </form>
    <p>
    <a class = "interchange" id = "lo">Log in</a>
    </p>
    <p>
    <a class = "interchange" id = "si">Sign in</a>
    </p>
 </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
    <script type = "text/javascript">
        $("#si").click(function(){
            $("#logpara").fadeOut("fast");
            $("#signpara").fadeIn("fast");
            $("#loginbutton").fadeOut("fast");
            $("#signbutton").fadeIn("fast");
            $(this).fadeOut("fast");
            $("#lo").fadeIn("fast");
        })
        $("#lo").click(function(){
            $("#signpara").fadeOut("fast");
            $("#logpara").fadeIn("fast");
            $("#signbutton").fadeOut("fast");
            $("#loginbutton").fadeIn("fast");
            $(this).fadeOut("fast");
            $("#si").fadeIn("fast");
        })
    </script>
</body>
</html>