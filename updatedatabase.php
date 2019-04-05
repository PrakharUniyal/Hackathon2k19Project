<?php
session_start();
if(array_key_exists("content",$_POST)){
    $link = mysqli_connect('localhost','root','','user');
            if(mysqli_connect_error()){
                die("Connection Unsuccessful!");
            }
    $query = "UPDATE `users` SET `Diary` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE Email = '".mysqli_real_escape_string($link, $_SESSION['email'])."' LIMIT 1";
    mysqli_query($link,$query);
}
?>
