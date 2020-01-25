<?php
	include "database.php";
	session_start();
	
	$output="";
			
	if(isset($_SESSION['id'])&& !empty($_SESSION['id'])){
		$sender_id=$_SESSION['id'];
		
		$find_recipient=$db->prepare("SELECT recipient1,recipient2 FROM message_file WHERE recipient1=? OR recipient2=?");
		$find_recipient->bind_param("ii",$sender_id,$sender_id);
		$find_recipient->execute();

		$find_recipient_result=$find_recipient->get_result();
			if(mysqli_num_rows($find_recipient_result)!=0){
				while(($row=mysqli_fetch_array($find_recipient_result))!=0){
				
				$find_username=$db->prepare("SELECT username FROM users WHERE id= ?");
					if($row['recipient2']!=$sender_id){
						$find_username->bind_param("i",$row['recipient2']);
					}else{
					$find_username->bind_param("i",$row['recipient1']);
				}
				
				$find_username->execute();
				$find_username_result=$find_username->get_result();

				if(mysqli_num_rows($find_recipient_result)!=0){
					$username_row=mysqli_fetch_array($find_username_result);
					$output.="<div id='contact-field'> <i class='material-icons' id='contact-icon'>person</i> <p class='d-inline p-1' id='contact'>";
					$output.=$username_row['username'];
					$output.="</p> </div>";
				}
			}
		}
	}
    echo $output;
?>