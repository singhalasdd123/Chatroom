<?php
session_start();
if(isset($_SESSION['username']))
{
	header('Location: homepage.php');
}
else
{
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['chatno']))
{
	if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['chatno']))
	{
		require 'connection.php';
		$username = $_POST['username'];
		$password = $_POST['password'];
		$chatn=$_POST['chatno'];
		$flag=1;
		$check=mysqli_query($con,"select * from `registration-table` where username='$username' and password= '$password'");
		while($row=mysqli_fetch_assoc($check))
		{
			if($row['password']==$password && $row['username']==$username)
			{
				$flag=2;
			}
		}
		if($flag==2)
		{	
			$row=mysqli_fetch_assoc($check);
			$_SESSION['username'] = $username;
			$check2=mysqli_query($con,"update `registration-table` set chatno='$chatn' where username='$username'");
			$row2=mysqli_fetch_assoc($check2);
			header("Location: homepage.php?");
		}
	}
	else
	{
		echo '<script> alert("please fill all the details");</script>';
	}
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
	#admin123
	{
	position:fixed;
	top:500px;
	left:1000px;
	}
body{
    background-image: url("img1.jpg");
    background-color: #cccccc;
}
</style>
 
    <title>Sign In</title>
  </head>

  <body >

    <div align="center">

      <form  action="#" method="POST">
        <h1>CHATROOM <small></small></h1>
		<div>
			<h><b>Username :</b></h>
			<input type="username" id="inputusername"  placeholder="username" name="username" >
		</div>
		<br><br>
		<div>
			<h><b>Password :</b></h>
			<input type="password" id="inputPassword"  placeholder="Password" name="password">
		</div>
		<br><br>
		 <div >
		 <h><b>Room no(1-100) :</b></h>
			<input type ="text"  placeholder="room no." name="chatno" >
        </div>
		<br><br>
        <div >
            <input type="checkbox" value="remember-me"> Remember me</input>
        </div>
		<br>
        <button  type="submit" style="background-color:black";><h style="color:white";>Sign in</button>
		<br><br><br>
		<div>
         <a href="signup.php"style="color:black;padding:0px 50px" align ="center"><b style="color:red;">Not Member?Register Here</b></a>
		 </div>
      </form>

    </div>
  </body>
</html>
