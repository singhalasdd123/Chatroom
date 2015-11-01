<?php
if(isset($_POST['password']) && isset($_POST['name']) &&  isset($_POST['username']) &&isset($_POST['password1']))
	{
	if(!empty($_POST['password']) && !empty($_POST['name']) &&  !empty($_POST['username']) &&!empty($_POST['password1']))
	{
	require 'connection.php';
	$password = $_POST['password'];
 	$password1 = $_POST['password1'];
	$name =$_POST['name'];
	$username = $_POST['username'];
	$check=mysqli_query($con,"select * from `registration-table`");
	$flag = 1;
	while($row=mysqli_fetch_assoc($check))
	{
		if($row['username']==$username)
		{
			echo '<script> alert("username already registered");</script>';
			$flag=2;
			break;
		}
	}
	if($flag===1)
	{
	if($password===$password1)
	{
		$stmt = $dbh->prepare("insert into `registration-table`(name,username,password) VALUES(:nam,:us,:p)");
		$stmt->bindParam(':nam',$name);
		$stmt->bindParam(':us',$username);
		$stmt->bindParam(':p',$password);
		$stmt->execute();
		header('Location: index.php');
	}
	else
	{
		echo '<script> alert("Password Do not Match");</script>';
    }
	}
}
else
{
	echo '<script> alert("please fill all the details");</script>';
}

}
?>
<!DOCTYPE html>
<html >
<head>
    <style>
	#admin123
	{
	position:fixed;
	top:500px;
	left:1000px;
	}

body{
  
   background-color: #cccccc;
}
</style>
  </head>
<body >
    <div>
         <div align="center" >
               <h2><b style="color:red;">CHATROOM</b></h2>
         </div>
         <div align="center">
                    <div style="width:400px; height:600px";>
                            <div style="background-color:#4B5AF7;">
								<strong>   Register Yourself </strong>  
                            </div>
                            <div style="background-color:rgb(221, 226, 226)">
                                <form  action="#" method="POST">
                                <br/>
                                        <div >
                                            <input type="text"  name="name" placeholder="Your Name" />
                                        </div>
										<br>
										<div>
                                            <input type="text"  name="username" placeholder="User Name" />
                                        </div>
										<br>
                                        <div>
                                            <input type="password"  name="password" placeholder="Enter Password" />
                                        </div>
										<br>
                                        <div >
                                            <input type="password"  name="password1" placeholder="Retype Password" />
                                        </div>
										<br>
										<input type="submit" name="submit" value="Register Me"/>
										<hr />
                                    Already Registered ?  <a href="index.php" >Login here</a>
                                </form>
                            </div> 
                    </div>
         </div>       
		</div>
</body>
</html>
