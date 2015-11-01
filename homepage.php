
<?php
session_start();
if(isset($_SESSION['username']))
{
	
}
else
{
	header('Location: index.php');
}
?>

<!doctype html>
<html>
    <head>
        <style>
            body
            {
                background-color:rgb(221, 226, 226);
            } 
            .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
            .popup-box
            {
				overflow: scroll;
                display: block;
                position: fixed;
                bottom: 120px;
                right: 400px;
                height: 500px;
                background-color: white;
                width: 600px;
                border: 1px solid black;
                z-index:1000;  
				
		    }
          .btn
		  {
				position: fixed;
                bottom: 50px;
                right: 400px;
                height: 40px;
                width: 600px;
                border: 1px solid black;
				font-weight: bold;
                font-size: 30px;
				z-index:1000;  
		  }
		  .nm
		  {
				position: fixed;
                bottom: 420px;
                right: 1100px;
                height: 200px;
                width: 200px;
                border: 1px solid black;
				background-color: black;
				z-index:1000;  
		  }
        </style>	
	<script>
		function scroll_to(div)
		 {
          document.getElementById(div).scrollTop+=document.getElementById(div).scrollHeight;
		 }
		function msgupdate(e)
		{			
		if(e.keycode==13 || e.which==13)
		{
			var tb=document.getElementById("tet").value;
			var ori="";
			ori=encodeURIComponent(tb);
			var xmlhttp;
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			    document.getElementById("tet").value="";
				document.getElementById("showmsg").innerHTML=document.getElementById("showmsg").innerHTML + xmlhttp.responseText;
		        scroll_to("showmsg");	    
			}
			}
			xmlhttp.open("GET","msg.php?msg="+ori,true);
			xmlhttp.send();
			scroll_to("showmsg");
		}
		}
    </script>
    </head>
    <body>
		<div id="showmsg" class="popup-box">
		<?php
				require 'connection.php';
				$user=$_SESSION['username'];
				$check=mysqli_query($con,"select chatno from `registration-table` where username='$user'");
				$row1=mysqli_fetch_assoc($check);
				$chatno=$row1['chatno'];
				$check1=mysqli_query($con,"select * from `message-table`");
				while($row2=mysqli_fetch_assoc($check1))
				{
					if($row2['chatno']==$chatno)
					{
						$u=$row2['user'];
					    $check3=mysqli_query($con,"select name from `registration-table` where username='$u'");
						$res=mysqli_fetch_assoc($check3);
						$name=$res['name'];
						$m = $row2['message'];
						echo '<div class="sidebar-name" style="padding:10px 20px";>
							  <span ><h style="font-size:20px";><b>Name ='.$name.'</b>&nbsp;&nbsp;<b>('.$u.') :</b></h></span>	
							  <span ><h style="font-size:20px; color:red";><b>'.$m.'</b></h></span>
							  </div>';
					}
				}
		?>
		</div>
		<br>
		<div class="btn">
		<input type="text" type="text" id="tet"  placeholder="Type here.." class="btn"  name="text" onkeypress="msgupdate(event)"/>
		</div>
		<div class="nm">
			<h style="color:white;font-size:40px"; align="center";><b>Welcome <?php echo $_SESSION['username'];?></b></h>
			<h style="color:white;font-size:40px"; align="center";><b>U r using Channel :
			<?php 
					require 'connection.php';
					$var=$_SESSION['username'];
					$check=mysqli_query($con,"select chatno from `registration-table` where username='$var'");
					$row=mysqli_fetch_assoc($check);
					$chatno=$row['chatno'];
					echo $chatno;
			?></b></h>
		</div>
		<div style="float:right; background-color:yellow; width :300px; padding 0px 200px";>
					<div align="center"><a href="mid_logout.php">LOGOUT</a></div>
		</div>
			<br><br>
        <div id="sidebar"  style="float:right; width :300px; padding 0px 200px";>
					<div style="background-color:red ";>
						<h style="font-size:30px;"; ><b>Registered Users</b></h>
					</div>
					<div style=" background-color:pink ;overflow: scroll; ";>
						<?php
								require 'connection.php';
								$var=$_SESSION['username'];
								$check=mysqli_query($con,"select chatno from `registration-table` where username='$var'");
								$row=mysqli_fetch_assoc($check);
								$chatno=$row['chatno'];
								$check1=mysqli_query($con,"select * from `registration-table`");
								while($row1=mysqli_fetch_assoc($check1))
								{
									if($row1['username']!=$var&& $row1['chatno']==$chatno)
									{
										$frnd=$row1['username'];
										$name = $row1['name'];
										$user=$frnd;
										echo '<div class="sidebar-name" align="center" >
										<span ><h style="font-size:20px";><b>'.$name.'</b></h></span>	
										</div>';
									}
								}
						?>
					</div>
        </div>
    </body>
</html>




			
