<?php
    require "database.php";
    session_start();

    if(isset($_SESSION['id'])&& !empty($_SESSION['id']) &&isset($_POST['receiver_name'])&& !empty($_POST['receiver_name'])){
      $file_path="content/chat/";
      $sender_id=$_SESSION['id'];
      $receiver_name=$_POST['receiver_name'];
			
			$find_id=$db->prepare("SELECT id FROM users WHERE username=?");
			$find_id->bind_param("s",$receiver_name);
			$find_id->execute();
			
			$find_id_result=$find_id->get_result();
			if(mysqli_num_rows($find_id_result)!=0){
				$find_id_row=mysqli_fetch_array($find_id_result);
				$receiver_id=$find_id_row['id'];
				
				$find_file=$db->prepare("SELECT file_name FROM message_file WHERE recipient1=? AND recipient2=? OR recipient1=? AND recipient2=?");
				$find_file->bind_param('iiii',$sender_id,$receiver_id,$receiver_id,$sender_id);
				$find_file->execute();
				$find_file_result=$find_file->get_result();
				
				if(mysqli_num_rows($find_file_result)!=0){
					$find_file_row=mysqli_fetch_array($find_file_result);
					$file_path.=$find_file_row['file_name'];

					$file_write=fopen($file_path,"a");
					$new_message="\n<p id='id".$_SESSION['id']."' class='name_time'>".(idate('H')+1).":".idate('i')." ".$_SESSION['username']."</p>";
					$new_message.="\n<p id='id".$_SESSION['id']."'>".$_POST['message']."</p>";

						
					fwrite($file_write,$new_message);
					fclose($file_write);
						
					$file_pos=filesize($file_path);
						
					$res = $db->query("SELECT file_name, recipient1_read FROM message_file WHERE recipient1=$sender_id AND recipient2=$receiver_id");
					if(mysqli_num_rows($res)!=0){
						$db->query( "UPDATE message_file SET recipient1_read = $file_pos WHERE file_name='$find_file_row[file_name]'");
					}
					else{
						$res= $db->query("SELECT file_name, recipient2_read FROM message_file WHERE recipient2=$sender_id AND recipient1=$receiver_id");
						if(mysqli_num_rows($res)!=0){
							$db->query("UPDATE message_file SET recipient2_read = $file_pos WHERE file_name='$find_file_row[file_name]'");
						}
					}

					mysqli_close($db);
					echo $new_message;
				}else{
					mysqli_close($db);
					echo "";
				}
			}else{
				mysqli_close($db);
				echo "";
			}
	}else{
		mysqli_close($db);
			echo "";
	}



    
?>