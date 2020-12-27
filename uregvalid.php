<?php
session_start();
$db = mysqli_connect('localhost','root','','airlines system') or die("could not connect to database");
$errors=array();
if(isset($_POST['signup'])){
  $username = mysqli_real_escape_string($db,$_POST['name']);
  $uname = mysqli_real_escape_string($db,$_POST['uname']);
  $dob = mysqli_real_escape_string($db,$_POST['dob']);
  $eid = mysqli_real_escape_string($db,$_POST['eid']);
  $password = mysqli_real_escape_string($db,$_POST['password']);
  $cpassword = mysqli_real_escape_string($db,$_POST['cpassword']);
  $checkuni="SELECT * FROM us WHERE uname='$uname' LIMIT 1";
  $results = mysqli_query($db,$checkuni);
  $user=mysqli_fetch_assoc($results);
  $p=0;
  if ($user){
    if($user['uname']=== $uname){
    array_push($errors, "Username already exists ");
    $p=1;
    }
  }
  if($password!=$cpassword){
    array_push($errors, "password doesn't match");
    $p=1;

  }
  if($p==0){
    $query="INSERT INTO us (name,uname,dob,eid,password)
           VALUES ('$username','$uname','$dob','$eid','$password')";
    mysqli_query($db,$query);
    $_SESSION['register']="Registered Sucessfully! Please Login.";
    header("Location:signin.php");
  }
}

 ?>
