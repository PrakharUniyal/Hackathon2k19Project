<?php
$username= $_POST["Searchbox"];

$db = mysqli_connect("localhost","root","", "user");

$username=stripcslashes($username);
$username=mysqli_real_escape_string($db,$username);

// mysql_select_db("students");

$result=mysqli_query($db,"select * from Sellerdb where DrugName='$username' ")
   or die("failed to connect".mysql_error());
$row=mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
echo ($row['name']);
if($count>=1){
 
}
else
   echo "Medicines Out of Stock";
?>