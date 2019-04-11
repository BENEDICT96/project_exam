<?php
include 'inc.php';
$class=$_GET['class'];
$subject=$_GET['subject'];
 $select="SELECT * FROM questions WHERE class='$class' AND subject='$subject'";
 $query=mysql_query($select);
 while($array=mysql_fetch_array($query)){
 	$title=$array['title'];
 	echo "<div class='list-group-item'>$title</div>";

 }
 ?>