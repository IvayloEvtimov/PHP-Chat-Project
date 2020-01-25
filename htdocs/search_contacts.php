<?php
  require "database.php";

  session_start();

  $name = $_POST['search_input'];

	$sql=$db->prepare("SELECT * FROM users WHERE username=?");
	$sql->bind_param("s",$name);
	$sql->execute();
	$res=$db->get-result();

  if(mysqli_num_rows($res)!=0){
    $output="";

    while(($datarow= mysqli_fetch_array($res))!=0){
      if($datarow['id']!=$_SESSION['id']){
        $output.="<div id='search-field'> <i class='material-icons' id='contact-icon'>person</i> <p id='search-contact'>";    
        $output.=$datarow['username'];
        $output.="</p> </div>";
        }
      }
		mysqli_close($db);
    echo $output;
  }else{
		mysqli_close($db);
    echo "";
  }  
?>