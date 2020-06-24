<?php
	require_once "database.php";
	if( isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		
		$find_user_id=$db->prepare("SELECT id,password FROM users WHERE username=?");
		$find_user_id->bind_param('s',$username);
		$find_user_id->execute();

		$result=$find_user_id->get_result();
		if(mysqli_num_rows($result)!=0){
			$row=mysqli_fetch_array($result);

			if(password_verify($password,$row['password'])){
				session_start();
				$_SESSION['id']= $row['id'];
				$_SESSION['username']=$username;
				
				exit();
			}else{
				echo "<script>alert('Wrong username or password')</script>";
			}
			}else{
				echo "<script>alert('Wrong username or password')</script>";
			}
		
  	}
	header("Location: main.php");

?>
