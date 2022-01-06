<?php
   if (isset($_FILES['MyForm']))
   {
	    $file_name = $_FILES['MyForm']['name'];
	    $file_tmp =$_FILES['MyForm']['tmp_name'];
		move_uploaded_file($file_tmp, "../documents/conFirma/".$file_name);	
   }
?>

