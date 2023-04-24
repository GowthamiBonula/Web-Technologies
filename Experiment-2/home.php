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
 // Top 5 liked posts
 $sql="SELECT * from images order by likes DESC limit 5";
 $result=mysqli_query($conn,$sql);
?>
<html>
<head>
    <link rel="stylesheet" href="dashstyle.css">
    <title>HOME</title>
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
                <h1 align="center" style="color:white; margin-top:20px" >Welcome , <?php echo $name?></h1>
                <p style='color:white;'>Trending posts!!</p>
                <br>
                <div id="topy">
            <h1 class="sub-title" style="color:white">Top 5 liked Posts</h1>
             <div class="topy-list">
             <?php 
                while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div>
                    <h2 align="center"><?php echo $row['uname'];?>   </h2>
                    <img src="<?php echo $row['img']?>" alt=""> 
                    <i class="fa-regular fa-heart" style="color: black;"></i>
                    <i class="fa-regular fa-comment" style="color: black;"></i>
                    <br>
                    <span style="color:black;"><?php echo $row['likes']." ";?> Likes</span>
                    <?php 
                    $imn=$row['imgno'];
                    $sql="SELECT * from comtab where imgno='$imn'";
                    $z=mysqli_query($conn,$sql);
                    while($comr = mysqli_fetch_assoc($z)){                    
                    ?>
                    <nav>
                        <h4 style="display: inline-block;color:black;"><?php echo $comr['com'];?> </h4>
                        <h3 style="display: inline-block;color:black;"><?php echo $comr['comm'];?></h4>
                    </nav>
                    <?php }?>
                </div>
                <?php 
            }?>
        </div>
    </div>    
            </div>
        </div>          
    </div>
</body>
</html>