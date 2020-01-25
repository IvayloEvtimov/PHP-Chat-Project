<?php
	require "database.php";
	session_start();
	
	$alowed_ext_img = array('jpg', 'png', 'gif','jpeg');
	$alowed_ext_vid= array('ogg', 'webm','mp4');
	
	$image=false;
	$video=false;
	
	$source="";
	
	if(isset($_FILES['file']) && $_FILES['file']['error']==0){
		$file_info = pathinfo($_FILES['file']['name']);
		if(array_search($file_info['extension'], $alowed_ext_img)!== false) {
			move_uploaded_file($_FILES['file']['tmp_name'], 'content/image/'.$_FILES['file']['name']);
			$source=("content/image/".$_FILES['file']['name']);
			$image=true;
		}if(array_search($file_info['extension'],$alowed_ext_vid)!==false){
			move_uploaded_file($_FILES['file']['tmp_name'], 'content/video/'.$_FILES['file']['name']);
			$source=("content/video/".$_FILES['file']['name']);
			$video=true;
		}
	}

	
	
	if($image || $video){
		$sender_id=$_SESSION['id'];
		$receiver_name=$_POST['receiver_name'];

		$find_id=$db->prepare("SELECT id FROM users WHERE username=?");
		$find_id->bind_param('s',$receiver_name);
		$find_id->exexute();
		$find_id_result=$find_id->get_result();
		
		if(mysqli_num_rows($find_id_result)!=0){
			$row=mysqli_fetch_array($find_id_result);

			$receiver_id=$row['id'];
			$chat_file_name="";

			$find_chat_text=$db->prepare("SELECT file_name FROM message_file WHERE recipient1=? AND recipient2=? OR recipient1=? AND recipient2=?");
			$find_chat_text->bind_param('iiii',$sender_id,$receiver_id,$receiver_id,$sender_id);
			$find_chat_text->execute();
			$find_chat_result=$find_chat_text->get_result();

			if(mysqli_num_rows($find_chat_result)!=0){
				$file_name_row=mysqli_fetch_array($find_chat_result);
				$chat_file_name=$file_name_row['file_name'];

				$chat_file_path="../PHP/content/chat/".$chat_file_name;
				$chat_file_write=fopen($chat_file_path,"a");

				$new_message="\n<p id='id".$_SESSION['id']."class='name_time'>".(idate('H')+1).":".idate('i')." ".$_SESSION['username']."</p>\n";
				if($image){
					$new_message.="<img id='img-id".$sender_id."' class='img-fluid rounded' src='".$source."' style='width:150px'>";
					}else if($video){
						$new_message.="<video width='320' controls id='vid-id".$sender_id."' <source src='content/video/".$_FILES['file']['name']."'>\n</video>";              
					}
					
					fwrite($chat_file_write,$new_message);
					fclose($chat_file_write);

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
	}
?>