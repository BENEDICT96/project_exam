

<?php
error_reporting(0);
include 'header.php';
include 'inc.php';




?>
<div class="navbar"style="background-color:#006dcc;box-shadow: 4px 10px 15px grey;">
  <?php include 'navbar.php'; ?>
</div>
<div class="row">
<div class="col-sm-3">
  <div class="thumbnail"style="background-color: #006dcc;color: white;text-align:center;margin-top: 10px;">
<img src="img/bank3.jpg"class="img-circle" style="height:150px;width:150px;"/>
      
    <p style="font-size: 18px;">Teacher <?php echo $user; ?></p>
    <p style="text-align: center;"></p>
  </div>
  
    <ul class="list-group noprint"style="margin-top: -20px;"id="quick_licks">
    <li class="list-group-item"><a href="exam.php">Add Exam</a></li>
      <li class="list-group-item"><a href="class2.php">search student</a></li>
      <li class="list-group-item"><a href="tod.php">students info</a></li>
        
    
      



          
    </ul>
</div>
<div class="col-sm-9" style="background-color:white">
  <div class="row" style="margin-right:5px;margin-left:5px">
<ul class="nav nav-tabs pull-right" id="tabs">

      
      <li><a href="#"class="dropdown-toggle active"data-toggle="dropdown" style="background-color: #006dcc;color:white;">Exam Details</a>
<ul class="dropdown-menu">
<?php
$sel="SELECT * FROM questions WHERE posted_by='$user' GROUP BY class ";
$query=mysqli_query($connect,$sel);
while($array=mysqli_fetch_array($query)){
  $class=$array['class'];
  $name=$array['title'];
  echo "<li><a href='questions.php?class=$class'>Class $class</a>
  

  </li>







  ";
 

 
  

}


 ?>
 

        
      </ul>
      </li>
      
    </ul>
    
        



<div class="row">
<div class="col-sm-12">
<ul class="list-group">
<?php
if(isset($_GET['class'])){
	$classget=$_GET['class'];
	$s="SELECT * FROM questions WHERE class='$class' AND posted_by='$user' GROUP BY subject";
$q=mysqli_query($connect,$s);
while($a=mysqli_fetch_array($q)){
	$su=$a['subject'];

	echo "

	<div class='list-group-item'><a href='questions.php?classi=$classget&subject=$su'>$su</a></div>
	

	";
}



}
else if(isset($_GET['classi'])&&isset($_GET['subject'])){
		$newClass=$_GET['classi'];
		$newSubject=$_GET['subject'];
		$data="SELECT * FROM questions WHERE class='$newClass'AND subject='$newSubject'AND posted_by='$user' GROUP BY title";
		$check=mysqli_query($connect,$data);
		echo "<a href='questions.php?class=$newClass' class='btn btn-primary btn-sm' style='border-radius:0px'>Back</a><div class='panel-group'id='accordion'>";
		while($newArray=mysqli_fetch_array($check)){
			$tit=$newArray['title'];
			if(isset($_POST['delete'])){
	$delete="DELETE FROM questions WHERE title='$tit' AND class='$newClass' AND subject='$newSubject' AND posted_by='$user'";
	if(mysqli_query($connect,$delete)){
		
		echo "<div class='alert alert-success'>Deleted Successfully</div>";

	}else{
		echo "<div class='alert alert-danger'>Error Occurred</div>";
	}

}
			echo "
			<div class='list-group-item col-sm-12'>$tit&nbsp;&nbsp;<span><a href='#section$tit'data-parent='#accordion'data-toggle='collapse' class='btn btn-primary btn-sm' style='border-radius:0px'>Edit</a></span>&nbsp;&nbsp;<span><a href='#preview$tit'data-parent='#accordion'data-toggle='collapse' class='btn btn-primary btn-sm' style='border-radius:0px'>Preview</a></span>&nbsp;&nbsp;<span><form method='POST' action='' class='form-vertical'><button name='delete' type='submit' class='btn btn-danger btn-sm' style='border-radius:0px'>Delete</button></span></form><span><a href='#startexam$tit'data-parent='#accordion'data-toggle='collapse' class='btn btn-success btn-sm' style='border-radius:0px'>Start Exam</a></span></div>
</div><div class='row'><div class='col-sm-12'>
<div class='panel-body collapse panel-collapse'id='section$tit'>";

if(isset($_POST['delete'])){
	$delete="DELETE FROM questions WHERE title='$tit' AND class='$newClass' AND subject='$newSubject' AND posted_by='$user'";
	if(mysqli_query($connect,$delete)){

		echo "<div class='alert alert-success'>Deleted Successfully</div>";

	}else{
		echo "<div class='alert alert-danger'>Error Occurred</div>";
	}

}





$selection="SELECT * FROM questions WHERE class='$newClass'AND subject='$newSubject'AND title='$tit' AND posted_by='$user' ORDER BY id ASC";
$queryion=mysqli_query($connect,$selection);
$namba=mysqli_num_rows($queryion);
while($arrayion=mysqli_fetch_array($queryion)){
	$id=$arrayion['id'];
	$question=$arrayion['questions'];
	$A=$arrayion['choiceA'];
	$B=$arrayion['choiceB'];
	$C=$arrayion['choiceC'];
	$D=$arrayion['choiceD'];
	$co=$arrayion['correct'];
	
	echo "<div class='row'><div class='col-sm-12'><form method='POST' action=''><input type='text' name='id' value='$id' hidden='true'/><input type='text' name='updQuestion' value='$question' class='form-control'/></div></div>
	<div class='row'><div class='col-sm-3'><strong>A.</strong><input type='text' name='updchoiceA' value='$A' class='form-control'/></div><div class='col-sm-3'><strong>B.</strong><input type='text' name='updchoiceB' value='$B' class='form-control'/></div><div class='col-sm-3'><strong>C.</strong><input type='text' name='updchoiceC' value='$C' class='form-control'/></div><div class='col-sm-3'><strong>D.</strong><input type='text' name='updchoiceD' value='$D' class='form-control'/><strong>Correct.<input type='text' name='updcorrect' value='$co' class='form-control'/></strong></div>
<button type='submit' name='update' class='btn btn-primary btn-sm pull-right' style='border-radius:0px;'>Update</button></form>
	</div>";
	if(isset($_POST['update'])){
		$updId=$_POST['id'];
		$updQuestion=$_POST['updQuestion'];
		$updchoiceA=$_POST['updchoiceA'];
		$updchoiceB=$_POST['updchoiceB'];
		$updchoiceC=$_POST['updchoiceC'];
		$updchoiceD=$_POST['updchoiceD'];
		$updcorrect=$_POST['updcorrect'];
		$update="UPDATE questions SET questions='$updQuestion',choiceA='$updchoiceA',choiceB='$updchoiceB',choiceC='$updchoiceC',
		choiceD='$updchoiceD',correct='$updcorrect' WHERE id='$updId'";
		if(mysqli_query($connect,$update)){
			echo "<div class='alert alert-success'>Update Successfully</div>";

		}else{
			echo "<div class='alert alert-danger'>Error Occurred</div>";
		}

	}








}



						
				echo "</div><!--End of panel body-->
</div></div>
			";






echo "<div class='panel-body collapse panel-collapse'id='preview$tit'>";

$selection="SELECT * FROM questions WHERE class='$newClass'AND subject='$newSubject'AND title='$tit' AND posted_by='$user' ORDER BY id ASC";
$queryion=mysqli_query($connect,$selection);
$namba=mysqli_num_rows($queryion);
while($arrayion=mysqli_fetch_array($queryion)){
	$id=$arrayion['id'];
	$question=$arrayion['questions'];
	$A=$arrayion['choiceA'];
	$B=$arrayion['choiceB'];
	$C=$arrayion['choiceC'];
	$D=$arrayion['choiceD'];
	$co=$arrayion['correct'];
	
	echo "<div class='row'><div class='col-sm-12'>$question</div></div>
	<div class='row'><div class='col-sm-3'><strong>A.</strong>$A</div><div class='col-sm-3'><strong>B.</strong>$B</div><div class='col-sm-3'><strong>C.</strong>$C</div><div class='col-sm-3'><strong>D.</strong>$D<strong><br/>Correct. $co</strong></div>
	</div>";
	

}



						
				echo "</div><!--End of panel body-->
</div></div>
			";


			echo "<div class='panel-body collapse panel-collapse'id='startexam$tit'>";
			echo "<form method='POST' action='' class='form-horizontal'>
			<h4>Set Exam Duration</h4>
			<div class='form-group row'>
    <label for='hours' class='col-sm-1 col-form-label'>Hours</label>
    
    <div class='col-sm-3'>
      <select name='hours' class='form-control'>
<option value='0'>0</option>
<option value='1'>1</option>
<option value='2'>2</option>
<option value='3'>3</option>
      </select>

    </div>
    <label for='minutes' class='col-sm-1 col-form-label'>minutes</label>
    
    <div class='col-sm-3'>
      <select name='minutes' class='form-control'>
<option value='0'>0</option>
<option value='15'>15</option>
<option value='30'>30</option>
<option value='45'>45</option>
      </select>
      
    </div>
    <label for='Expiry date' class='col-sm-1 col-form-label'>Expiry Date</label>
    
    <div class='col-sm-3'>
      <input type='text' name='expiryDate' class='form-control' placeholder='eg 21/08/18'/>
      <button  type='submit' name='startBtn' class='btn btn-success btn-sm pull-right' style='border-radius:0px'>Start</button>
    </div>
  </div>

			</form>";

			if(isset($_POST['startBtn'])){
				$hours=$_POST['hours'];
				$minutes=$_POST['minutes'];
				$expirydate=$_POST['expiryDate'];
				$u="INSERT INTO exams(title,subject,class,teacher,hours,minutes,expirydate,status)VALUES('$tit','$newSubject','$newClass','$user','$hours','$minutes','$expirydate','active')";
				if(mysqli_query($connect,$u)){
					echo "<div class='alert alert-success'>$tit&nbsp;Exam $hours hours $minutes min is in Progress Now and will expire on $expirydate</div>";

				}else{
					echo "<div class='alert alert-danger'>Error</div>";
				}

			}





						
				echo "</div><!--End of panel body-->
</div></div>
			";

































			; }

		}

		 ?>











	


					<?php ?>
	</div><!--end of panel group-->
	</div>
</div><!--end of row-->
</div>

<?php include 'footer.php'?>









