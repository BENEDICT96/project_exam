<?php
include 'header.php';

include 'inc.php';
error_reporting(0);
if(isset($_POST['login']))
{
	$user=$_POST['user'];
	$username=$_POST['username'];
	$pwd=$_POST['pwd'];
	if($user=="parent/student"){
		$select="SELECT * FROM students WHERE adm=$username AND password='$pwd'";
		$query=mysqli_query($connect,$select);
		if(mysqli_num_rows($query)>0){
			echo "<script>window.open('user.php','_self')</script>";
		    $_SESSION['username']=$username;
		}
		
		
	}
	
	
	
	
	
	
		elseif($user=="Teacher"){
		$select="SELECT * FROM staff WHERE idNo='$username' AND password='$pwd'";
		$query=mysqli_query($connect,$select);
		if(mysqli_num_rows($query)>0){
			echo "<script>window.open('exam.php','_self')</script>";
		    $_SESSION['username']=$username;
		}
		
		
	}
	elseif($user=="Administrator"){
		$select="SELECT * FROM staff WHERE idNo='$username' AND password='$pwd'";
		$query=mysqli_query($connect,$select);
		if(mysqli_num_rows($query)>0){
			echo "<script>window.open('usersec.php','_self')</script>";
		    $_SESSION['username']=$username;
		}
		
		
	}
}
		   
?>
<div class="navbar"style="background-color: #006dcc;box-shadow: 4px 10px 15px grey;">
	<?php include 'navbar.php'; ?>
</div>
<div class="row">
	<div class="col-sm-4">
		
	</div><!--End of col-sm-4-->
	<div class="col-sm-4 well">
		<div style="padding: 20px auto;box-shadow: 2px 3px 4px 4px grey;">
			<div class="panel-heading"style="background-color: #006dcc;border-radius: 5px;position: relative;top: -30px;">
				<h4 style="text-align: center;padding: 10px;color: white;"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h4>
			</div><!--End of panel heading-->
			<div class="panel-body">
				<form method="POST"action="login.php">
				<div class="form-group">
				<label for="user"class="control-label"><i class='fa fa-user-circle'></i>&nbsp;&nbsp;Username</label>
				<select name="user" class="form-control">
					<option>parent/student</option>
					<option>Teacher</option>
					
										<option>Administrator</option>

				</select>
			</div><!--End of form group-->
			<div class="form-group">
				<label for="username"class="control-label"><i class='fa fa-user-circle'></i>&nbsp;&nbsp;Username</label>
				<input type="text"name="username"class="form-control"/>
			</div><!--End of form group-->
			<div class="form-group">
				<label for="password"class="control-label"><i class='fa fa-lock'></i>&nbsp;&nbsp;Password</label>
				<input type="password"name="pwd"class="form-control"/>
			</div><!--End of form group-->
			<div class="form-group">
				<input type="checkbox"value="remember"name="remember"/> Remember Me 
				<span class="form-helper"><br /><a href="#"style="color: #006dcc;">Forgot your password?</a></span>
			</div><!--End of form group-->
			<div class="form-group">
					 		<input type="submit"name="login"value="LOGIN"class="btn pull-right"style="background-color: #006dcc;padding: 15px 30px;color: white;margin-right: 20px;"/>
					 	</div><!--End of form group-->
		</form>
			</div><!--End of panel body-->
		</div><!--End of div-->
	</div><!--End of col-sm-4-->
</div><!--End of row-->
<?php include 'footer.php';?>