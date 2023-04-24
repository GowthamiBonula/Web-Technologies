<?php 
session_start();
$name=$_SESSION['name'] ;
$email=$_SESSION['email'] ;
$uname=$_SESSION['username'];
$phone=$_SESSION['phone'];

 $conn=mysqli_connect('localhost','root','','facebook');
 if(!$conn)
 {
    die("Connection Unsuccesfull");
 }
?>
<html>
<head>
    <title>User Photos</title>
    <link rel="stylesheet" href="dashstyle.css">
    <script src="https://kit.fontawesome.com/202dba6802.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="header">
        <div class="logo">
            <li><strong>facebook</strong></li>
       </div>
        <div class="container">
            <nav id='menu'>
                <ul id="sidemenu">
                <li><a href="home.php">Home</a></li>
                    <li><a href="profile.php">User Photos</a></li>
                    <li><a href="feed.php">Feed</a></li>
                    <li><a href="logof.php">Logout</a></li>
                </ul>
            </nav>
            <div class="header-text">
            <?php 
                $sql="select * from images where uname='$uname'";
                $result=mysqli_query($conn,$sql);

            ?>
        <div id=' ups'>
             <div id="topy">
                <h1 class="sub-title" style='color:white;'>User Photos</h1>
                <div class="topy-list">
                    <?php 
                        while($row = mysqli_fetch_assoc($result)) {
                     ?>
                <div>
                    <h2 align="center"><?php echo $row['uname'];?>   </h2>
                    <img src="<?php echo $row['img']?>" alt="">
                    
                    <i class="fa-regular fa-heart" style="color:black;"></i>
                    <i class="fa-regular fa-comment" style="color:black;"></i>
                    <br>
                    <span style="color:black"><?php echo $row['likes']." ";?> Likes</span>
                    <?php 
                        $imn=$row['imgno'];
                        $sql="SELECT * from comtab where imgno='$imn'";
                        $z=mysqli_query($conn,$sql);
                        while($comr = mysqli_fetch_assoc($z)){                    
                    ?>
                    <nav>
                        <h3 style="display: inline-block;color:black;"><?php echo $comr['com'];?> </h3>
                        <h3 style="color:black;"><?php echo $comr['comm'];?></h3>
                    </nav>
                    <?php }?>
                </div>
            <?php }?>
          </div>
          </div>
            </div>
        </div>        
    </div>
<div id='los'>
    <div id="services">
        <div class="container">
             <div class="services-list">
                <div>
                    
                    <h2 align="center" style='color:white'>Upload Your Posts Here !!</h2>
                    <center>
                    <form action="imgup.php"method='post' enctype="multipart/form-data">
                        <table cellspacing="15px" cellpadding="0px">
                         <tr>
                            <td><Label>Upload Your Image : </Label></td><br>
                            <td><input type="file" name="file" id='file'></td>
                         </tr>
                        </table>
                        <input type="submit" name="sus" id="buts" value="Post" style="padding: 5px 10px">
                    </form>
                </center>
                </div>
                <div><br><br>
                    <h1 style='color:white'">User Details</h2>
                    <br><br>
                    <table>
                        <tr>
                            <td><label for="">Name: </label></td>
                            <td><label for=""><?php echo $name;?> </label></td>
                        </tr>
                        <tr>
                            <td><label for="">Username : </label></td>
                            <td><label for=""><?php echo $uname;?></label></td>
                        </tr>
                        <tr>
                            <td><label for="">Email: </label></td>
                            <td><label for=""><?php echo $email;?></label></td>
                        </tr>
                        <tr>
                            <td><label for="">phone: </label></td>
                            <td><label for=""><?php echo $phone;?></label></td>
                        </tr>
                        
                    </table>
                
                </div>
                
             </div>
        </div>

    </div>
    </div>
</body>
</html>
