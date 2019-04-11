<?php
include 'header.php';
include 'inc.php';
?>
<div class="navbar"style="background-color:#006dcc;box-shadow: 4px 10px 15px grey;">
	<?php include 'navbar.php'; ?>
</div>
<div class="container">
<div class="row">
	<div class="col-sm-3">
	<?php include 'sidebar.php';
	
	
	
	 ?>
	
	
	</div><!--end of col-->
	<div class="col-sm-9">
		<div class="well"style="box-shadow: 4px 10px 15px grey;">
		<?php
		if(isset($_GET['profile']))
		{
			include 'profile.php';
		}
		if(isset($_GET['activities']))
		{
			include 'activities.php';
		}
		if(isset($_GET['academics']))
		{
			include 'academics.php';
		}
		if(isset($_GET['health']))
		{
			include 'health.php';
		}
		if(isset($_GET['finance']))
		{
			include 'finance.php';
		}
		if(isset($_GET['library']))
		{
			include 'library.php';
		}
		if(isset($_GET['discipline']))
		{
			include 'discipline.php';
		}
		if(isset($_GET['pay_loan']))
		{
			include 'pay_loan.php';
		}
		if(isset($_GET['examreport']))
		{
			include 'examreport.php';
		}
			if(isset($_GET['startid'])){
			$id=$_GET['startid'];
			$check="SELECT * FROM examprogress WHERE exam_id='$id' AND student='$user'";
			if(mysqli_num_rows(mysqli_query($connect,$check))<1){
              $insert="INSERT INTO examprogress(exam_id,student,status)VALUES('$id','$user','In progress')";
              if(mysqli_query($connect,$insert)){

              }
			}
			
			
			
			include 'doexam.php';

		}
		if (isset($_GET['finished'])){
			
				foreach($_GET['idconfirm'] as $confirm_id){

					$s="SELECT * FROM questions WHERE id='$confirm_id'";
					$qq=mysqli_query($connect,$s);
					$a=mysqli_fetch_array($qq);
					$correct=$a['correct'];
				
					
				foreach ($_GET['choice'] as $choice_id) {
					
					
					
						foreach ($_GET['idexam'] as $idexam ) {
							if ($correct==$choice_id){
							$se="SELECT * FROM performances WHERE exam_id='$idexam' AND student='$user'";
							$query=mysqli_query($connect,$se);
							$arra=mysqli_fetch_array($query);
							$marks=$arra['marks'];
							$select="SELECT * FROM exams WHERE id='$idexam'";
							$mysqli_query=mysqli_query($connect,$select);
							$array=mysqli_fetch_array($mysqli_query);
							$subject=$array['subject'];
							if($subject !="Social Studies" && $subject !="CRE"){
								$add=2;
							}else{
								$add=1;
							}
							$newmarks=$marks+$add;
							$checkif="SELECT * FROM performances WHERE exam_id='$idexam' AND question_id='$confirm_id' AND student='$user'";
							$checkquery=mysqli_query($connect,$checkif);
							if(mysqli_num_rows($checkquery)<1){
							$update="INSERT INTO performances(exam_id,question_id,student,marks)VALUES('$idexam','$confirm_id','$user','$add')";
							if(mysqli_query($connect,$update)){
							    echo "<script>window.open('user.php?startid=$idexam')</script>";
								
								


							}	
							}else{

								echo "<script>alert('you already answered that')</script>";
								echo "<script>window.open('user.php?startid=$idexam')</script>";

							}
							


						}else{
						    echo "<script>window.open('user.php?startid=$idexam','_self')</script>";
							
						}





						
					}
					
				}





				
				
					
					
					
					
					
					
				
					
					
					
					
					
					
				}
				
				
			}
	
		
		
		if(!isset($_GET['profile'])&& !isset($_GET['activities'])&& !isset($_GET['examreport'])&&!isset($_GET['choice'])&&!isset($_GET['finished'])&&!isset($_GET['idconfirm'])&& !isset($_GET['startid'])&& !isset($_GET['finance']) && !isset($_GET['health']) && !isset($_GET['academics']) && !isset($_GET['discipline'])&& !isset($_GET['pay_loan'])&& !isset($_GET['library']) )
		{
			include 'academics.php';
		}
		?>
		</div><!--end of well-->
	</div><!--end of col-->
</div><!--End of row-->
</div><!--End of container-->
>
<?php include 'footer.php'; ?>