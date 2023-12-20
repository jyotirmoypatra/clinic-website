<?php
    include "db.php";
	// Check if the cookie exists
if(isSet($_COOKIE["email"]) && isSet($_COOKIE["password"]) )
	{

		$user=$_COOKIE["email"];
		$pass=$_COOKIE["password"];
        
        $cookielogin="select * from users where  email='$user'  && pass='$pass' ";
       
        $cookie_login_query=mysqli_query($con,$cookielogin);
       
        $email_pass= mysqli_fetch_assoc($cookie_login_query);
        
        if(mysqli_num_rows($cookie_login_query)==1)
		{
        $_SESSION['username']=$email_pass['name'];
        $_SESSION['role']=$email_pass['role'];
		} else{
			// header("Location: login.php");
			header("Location: " . $hostUrl . "/sanjiban-xray/admin/login.php");
		}

	} else{
		// header("Location: login.php");
		header("Location: " . $hostUrl . "/sanjiban-xray/admin/login.php");
	}

?>