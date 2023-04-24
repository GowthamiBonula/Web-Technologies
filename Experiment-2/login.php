
    <?php
	$flag = true;
    if(isset($_POST["regis"])) {

        $name = $_POST["name"];
        $user = $_POST["username"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $pwd = $_POST["pwd"];
        $conpwd = $_POST["conpwd"];

		if (empty($_POST["name"]))
         {
            echo "Name is Required";
            echo "<br>";
			$flag = false;
		} 
        else 
        {
            if(!preg_match("/^[a-zA-Z ]*$/",$name))
             {
                echo "Only letters and white spaces are allowed";
                echo "<br>";
                $flag = false;
            }
		}

		if (empty($email)) 
        {
			echo "Email is required";
            echo "<br>";
            $flag = false;
		} 
        else 
        {
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                echo "Invalid Email";
                echo "<br>";
                $flag = false;
            }
		}
        if (strlen($pwd)<8) 
        {
            echo "Must contain atleast 8 characters";
            echo "<br>";
            $flag = false;
        }
        if ($conpwd != $pwd) {
            echo "Must enter the above same password";
            echo "<br>";
            $flag = false;
        }
        if (empty($phone)) {
			echo "Phone is required";
            echo "<br>";
			$flag = false;
		} 
        else 
        {
            if(!preg_match("/^([0-9]{10})$/",$phone))
            {
			    echo "Invalid phone number";
                echo "<br>";
                $flag = false;
	    	}
		}
		if ($flag)
         {
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'facebook';

			$conn = mysqli_connect($host, $username, $password, $dbname);

			if ($conn)
             {
                echo "Connection successful.";
            }
            else
            {
                echo "Connection Failed.";
            }
			$sql = "INSERT INTO accounts ( name,username,email,phone,password) 
            VALUES('$name', '$user' , '$email', '$phone','$pwd') ";
            $upload = mysqli_query($conn,$sql); 
            if($upload)
            {
                echo "User details have been entered!";
                echo "<script> alert('data saved successfully');</script>";
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['username']=$_POST['username'];
                $_SESSION['phone']=$phone;
                header('location:home.php');
            }
            else{
                echo "Error:".$sql."".mysqli_error($conn);
            }
           }

		}
	
	?>
