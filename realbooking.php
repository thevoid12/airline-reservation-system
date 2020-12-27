<?php session_start(); ?>
<?php if(isset($_POST['checkout'])){
  $db = mysqli_connect('localhost','root','','airlines system') or die("could not connect to database");
  $Pname=array();
  $Gender=array();
  $type=$_GET['type'];
  echo $type;
  $paid_by=$_SESSION['uname'];
  $Day_ID=$_SESSION['dayid'];
  $Class=$_SESSION['class'];
  $Time_ID=$_SESSION['Time_ID'];
  echo $Day_ID;
  $Pname=$_POST['Pname'];
  $Gender=$_POST['Gender'];
  $reduce="UPDATE flight_info SET Seats=Seats-{$_SESSION['num']}
  WHERE Flight_ID=(SELECT Flight_ID FROM travel_info WHERE Travel_code={$_SESSION['tcode']})";



  if(mysqli_query($db,$reduce)){

    //Reduce seats messages!
   echo "Seats reduced successfully  sucessfully";
  }


  for ($i=0; $i < $_SESSION['num']; $i++) {
    $query="INSERT INTO passenger_info (Travel_code,Pname,Gender,paid_by,Day_ID,Type,Time_ID)
           VALUES ({$_SESSION['tcode']},'$Pname[$i]','$Gender[$i]','$paid_by',$Day_ID,'$Class','$Time_ID')";
           if(mysqli_query($db,$query)){

             //Record Created messages!
            echo "Recorded added sucessfully";
           }

  }

  $result=mysqli_query($db,"SELECT Price FROM cprice_info WHERE Travel_code={$_SESSION['tcode']} AND Cno='$type'" );
    $row=mysqli_fetch_assoc($result);
    $Price=$row['Price'];
header("Location:payment.php?Price=$Price");

}
if(isset($_POST['pbtn'])){
  header("Location:ticket.php");
}

?>
