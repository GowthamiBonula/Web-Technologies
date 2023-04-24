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
 $sql="select * from images";
 $result=mysqli_query($conn,$sql);
?>
<html >
<head>
    <title>Feed</title>
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
    <div id="services">
        <div class="container">
            <h1 class="sub-title" style='color:white;'>Feed</h1>
             <div class="services-list">
                <?php 
                $imcc=200;
                $cnt=0;
                $ids=1;
                $idh=300;
                $idss=1000;
                $idsc=500;
                $idssch=600;
                $idscp=700;
                $butid=2000;
                $commid=3000;
                while($row = mysqli_fetch_assoc($result)) {  
                ?>
                <div>
                    <h2 align="center" id='<?php echo $idh;?>'><?php echo $row['uname'];?></h2>
                    <img  id ="<?php echo $imcc?>" src="<?php echo $row['img']?>" alt="">
                     <form action="likecom.php" method="post">
                        <button class='bute' type='submit' name=<?php echo $butid; ?> style="border:0px;outline:none;"> 
                        <?php 
                        $sql="select * from liketab where uname='$uname' and imgno='$ids'";
                        $res=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($res)==0){
                            ?>
                             <i class="fa-regular fa-heart" style="color: #ffffff; background-color: #262626;" ></i>
                            <?php
                        }
                        else{
                            ?>
                            <i class="fa-solid fa-heart" style="color: #fb3958; background-color: #262626;" ></i>
                            <?php
                        }
                        ?>
                    </button>
                        <i class="fa-regular fa-comment" style="color: #ffffff;"></i>
                    </form>      
                    <br>
                    <span> <label id="<?php echo $ids;?>"><?php echo $row['likes']." ";?></label>  Likes</span>
                    <form action="commiess.php" method='post'>
                        <table>
                            <tr>
                                <td><label for="">Add comment:</label></td>
                                <td><input type="text" name="<?php echo $idsc;?>" id="<?php echo $idsc;?>"></td>
                                <td><button  type='submit' name="<?php echo $commid;?>">Post</button></td>    
                            </tr>
                        </table>
                        </form>
                    <?php    
                    $sql="SELECT  * from comtab where imgno='$ids'";
                    $resii=mysqli_query($conn,$sql);
                    while($comrow=mysqli_fetch_assoc($resii)){
                    ?>
                    <nav class="nene">
                        <h4 style="display: inline-block;" id="<?php echo $idssch;?>" ><?php echo $comrow['com']?> </h4>
                        <p style="padding-right:500px" id="<?php echo $idscp;?>"><?php echo $comrow['comm'];?></p>
                    </nav>
<?php }?>
                </div>
                <?php $ids+=1;$idss+=1; $idsc+=1;
                $idssch+=1;$butid+=1;$commid+=1;
                $idscp+=1;$idh+=1;$cnt+=1;$imcc+=1; }
                $_SESSION['cnt']=$cnt;
                ?>
             </div>
        </div>
    </div>        
        </div>          
    </div>
</body>
</html>