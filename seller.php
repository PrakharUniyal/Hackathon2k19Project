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
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  font-size: 130%;
  text-decoration: none;
}

li a:hover {
  background-color: #111;

}
#logo{
	margin-left: 450%;
	font-size: 200%;
	margin-top:-20px;
	margin-bottom: -20px;
}
#X{
	font-size: 160%;
	color: red;
	font-weight: bold;
}
</style>
</head>

<html style="background: url(img/sellerbg.jpg) no-repeat center center fixed; -webkit-background-size:cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<title>Seller's Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
  <li><a href="logo" id="logo">Mede<span id = "X">X</span></a>
</ul>

<center>
<div class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="margin:0 auto; width: 40%; text-align: left">
    <h2 style="display: inline-block;">Seller's Name</h2>
    <button class="w3-button w3-right w3-section w3-green w3-ripple"> Logout </button>
</div>

<form action="/action_page.php" class="w3-container w3-card-4 w3-light-grey w3-text-black w3-margin" style="width: 40%">
<h2 class="w3-row">Add the Details of New Stock:</h2>
 
<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-heart"></i></div>
    <div class="w3-rest" style="width:75%">
      <input class="w3-input w3-border" name="Drug" type="text" placeholder="Name of Drug">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest" style="width:75%">
      <input class="w3-input w3-border" name="units" type="Number" placeholder="Number of units">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-calendar"></i></div>
    <div class="w3-rest" style="width:75%">
      <input class="w3-input w3-border" name="date" type="date" placeholder="Date of Expiry">
    </div>
</div>

<div class="w4-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-dollar"></i></div>
    <div class="w3-rest" style="width:75%">
      <input class="w3-input w3-border" name="price" type="Number" placeholder="Price">
    </div>
</div>


<div class="w3-col w3-center">
<button class="w3-button w3-section w3-blue w3-ripple"> Add another medicine </button>
<button class="w3-button w3-section w3-blue w3-ripple"> Done </button>
</div>
</form>

</center>
</body>
</html> 
