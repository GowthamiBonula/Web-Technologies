<?php
$server_name="localhost";
$username="root";
$password="";
$database_name="facebook";

$conn=mysqli_connect($server_name,$username,$password,$database_name);
$result='';

if(isset($_POST["sub"]))
{  
    $user=$_POST['username'];
    $psswd=$_POST['pwd'];
    
    if(!$conn)
    {
        die("Connection Failed:" . mysqli_connect_error());
    }
    else
    {
        $sql="select * from accounts where username='$user' and password='$psswd'";
        $result=mysqli_query($conn,$sql);
    }
    if (mysqli_num_rows($result) > 0) 
    {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name']=$row["name"];
        $_SESSION['username']=$row["username"];
        $_SESSION['email']=$row["email"];
        $_SESSION['phone']=$row["phone"];

        header('location:home.php');
    }
    else
     {  ?>
        <script>alert("invalid creds")</script><?php
       header("location: home.html");  
      }
    
    }

?>