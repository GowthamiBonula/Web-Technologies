<?php 
session_start();
$user=$_SESSION['username'];
$conn=mysqli_connect('localhost','root','','facebook');
if(!$conn)
{
   die("Connection Unsuccesfull");
}
?>
<?php
            if(isset($_POST["sus"])){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["sus"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                echo "<br>";
                $uploadOk = 1;
            } else
             {
                echo "File is not an image.";
                echo "<br>";
                $uploadOk = 0;
            }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            echo "<br>";
            $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["file"]["size"] > 50000000) {
            echo "Sorry, your file is too large.";
            echo "<br>";
            $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            echo "<br>";
            $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            echo "<br>";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
                $img = $target_file;
                $userr=$_SESSION['username'];
                $server_name="localhost";
                $username="root";
                $password="";
                $database_name="facebook";

                $conn=mysqli_connect($server_name,$username,$password,$database_name);
                $mys = "insert into images(uname,img,likes) values('$user','$img',0) ";
                if(mysqli_query($conn,$mys)){
                    echo "Image stored in database";
                    header('location:profile.php');
                }
                else{
                    echo "Error: ".$sql."".mysqli_error($conn);
                }
                ?>
                <br>
               <!-- <img src = "images/<?php echo $_FILES['file']['name'] ;?>" width="400px" height="200px">;-->
            <?php echo "<br>";
            } else {
                echo "Sorry, there was an error uploading your file.";
                echo "<br>";
                ?>
     <script>alert('image not uploaded');</script>
     <meta http-equiv="refresh" content="0.5;url=profile.php">
     <?php 
            }
            }}
            ?>