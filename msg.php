<style>
 .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
</style>
<?php
		session_start();
		require 'connection.php';
		$user = $_SESSION['username'];
		$check2=mysqli_query($con,"select chatno, name from `registration-table` where username='$user'");
		$res=mysqli_fetch_assoc($check2);
		$name=$res['name'];
		$chatno=$res['chatno'];
		$message = $_GET['msg'];
		$stmt = $dbh->prepare("insert into `message-table` (user,message,chatno) VALUES(:u,:m,:c)");
		$stmt->bindParam(':u',$user);
		$stmt->bindParam(':m',$message);
		$stmt->bindParam(':c',$chatno);
		$stmt->execute();
		echo '<div class="sidebar-name" style="padding:10px 20px";>
							  <span ><h style="font-size:20px";><b>Name ='.$name.'</b>&nbsp;&nbsp;<b>('.$user.') :</b></h></span>	
							  <span ><h style="font-size:20px ; color:red";><b>'.$message.'</b></h></span>
							  </div>';
?>
