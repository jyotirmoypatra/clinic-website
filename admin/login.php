<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="<?php echo $hostUrl ?>/sanjiban-xray/admin/images/logo.png" />
    <style>
        .container{
    width:40%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    border: 1px solid black;
    padding: 30px;
    border-radius: 20px;
    background: rgb(32, 32, 32);

}



h2 {
    margin-bottom: 40px;
    font-size: 40px;
    color: orange;
}

.forget_heading{
    margin-bottom: 40px;
    font-size: 40px;
    color: orange;
}
.link{
    margin-top: 35px;
    text-align: center;
    font-size: 17px;
    color: orange;
}

.user{
    color: orange;
    
}

.user:hover{
    color:orange;
}

.btn{
    width:100%;
    margin-top: 15x;
    background:orange;
    border: none;
    color: rgb(8, 8, 8);
    font-weight: bold;
    transition: all .3s ease;
   
}

.btn:hover{
    background-color:rgb(235, 235, 5);
    border: none;
}
.icon {
    padding: 10px;
    background:orange;
    color: rgb(253, 249, 249);
    min-width: 50px;
    text-align: center;
    border-radius: 5px;
    
  }

    

  .form-group{
    display: flex;
    width: 100%;
    margin-bottom: 15px;
    
  }

 .form-check{
     margin-bottom: 15px;
 } 

    </style>

</head>

<body>

    <div class="container">
        <div class="Login">
            
            <h2 class="text-center">Admin / Receptionist Login</h2>
             
            
            <form action="login.php" method="POST"> 
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter email"
                         required>
                        
                </div>
                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    
                     <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" 
                       required>
                </div>
                <div class="form-check">
                   <input class="form-check-input" type="checkbox" name="remember" id="gridCheck" >
                   <label class="form-check-label text-warning" for="gridCheck">  Remember me </label>
                </div>

                <button type="submit" class="btn " name="login">Login</button> <br>

                <!-- <div class="link">
                <a  class="user font-weight-bold" href="forget.php">forget password?</a> <br>
                <a id="btn1" class="user font-weight-bold" href="registration.php">New User? Create a account </a>
            
             </div> -->

            </form>
        </div>
     

    </div>

    <script src="main.js"></script>
</body>

</html>

<?php

include "db.php";

if(isset($_SESSION["username"]))
{
 header("location:index.php");
}
if(isset($_POST['login'])){
  
  
    $email =$_POST['email'];
   $password =$_POST['password'];

    
     

    //account activation check
    $login="select * from users where  email='$email'  && pass='$password' ";
    $loginquery=mysqli_query($con,$login);
     $login_count=mysqli_num_rows($loginquery);
    if($login_count)
    {
      $email_pass= mysqli_fetch_assoc($loginquery);
      $_SESSION['username']=$email_pass['name'];
      $_SESSION['role']=$email_pass['role'];
     // $pass_decode = password_verify($password,$db_pass);


        if(isset($_POST["remember"]))   
        {  
         setcookie ("email",$email,time()+ (10 * 365 * 24 * 60 * 60));  
         setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
         $_SESSION["username"] = $email_pass['name'];
         
        }else  
        {  
         if(isset($_COOKIE["email"]))   
         {  
          setcookie ("email","");  
         }  
         if(isset($_COOKIE["password"]))   
         {  
          setcookie ("password","");  
         }  
        }
        ?>
        <script>
            console.log('login');
        </script>
                <?php
        $_SESSION["username"] = $email_pass['name'];
        header("Location: index.php");
 
    }else{
        ?>
          <script>
          alert("Login Failed!");
          </script>
        <?php
    } 

 

}   

?>