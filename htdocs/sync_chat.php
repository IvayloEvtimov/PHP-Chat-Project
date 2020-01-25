<?php
	require "database.php";
	session_start();

	function read_chat($recipient1_check,$find_file_result,$output,$db){

		$row=mysqli_fetch_array($find_file_result);
  	$file_path="content/chat/";
    $file_path.=$row['file_name'];

    $file=fopen($file_path,'r');

    if($_POST['refresh']=='true'){
      if($recipient1_check==TRUE){
        fseek($file,$row['recipient1_read']);
      }else{
        fseek($file,$row['recipient2_read']);
      }
    }

    while(!feof($file)){
      $output.=fgets($file);
    }
		
		$update='';
		$file_pos = ftell($file);
		if($recipient1_check==true){
      $update = "UPDATE message_file SET recipient1_read = $file_pos WHERE file_name=?";
    }else{
      $update = "UPDATE message_file SET recipient2_read = $file_pos WHERE file_name=?";
    }

		$sql=$db->prepare($update);
		$sql->bind_param('s',$row['file_name']);
		$sql->execute();
		$res=$sql->get_result();
		

		fclose($file);
		mysqli_close($db);
    return $output;
  }

  if(isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_POST['receiver_name'])&& !empty($_POST['receiver_name'])){
		$sender_id=$_SESSION['id'];
		$receiver_name=$_POST['receiver_name'];
				
		$find_id=$db->prepare("SELECT id FROM users WHERE username=?");
		$find_id->bind_param('s',$receiver_name);
		$find_id->execute();

		$find_id_result=$find_id->get_result();

		$output="";
    
		if(mysqli_num_rows($find_id_result)!=0){
			$row=mysqli_fetch_array($find_id_result);
			$receiver_id=$row['id'];
	
			if($_POST['refresh']=='false'){
				$output="<style>#id".$sender_id."{\ntext-align: right;\npadding-right:7px;\nmargin-top:0px;\n}\n";
				$output.="#id".$receiver_id."{\ntext-align: left;padding-left:7px;\nmargin-top:0px;\n}\n";
				$output.="#img-id".$sender_id."{\nmargin: auto 72%;\nwidth:320px;margin-bottom:8px;\n}\n";
				$output.="#img-id".$receiver_id."{\nmargin: auto 1%;\nwidth:320px;\n}\n";
				$output.="#vid-id".$sender_id."{\nmargin: auto 72%;\nmargin-bottom: 8px;\n}\n";
				$output.="#vid-id".$receiver_id."{\nmargin: auto 1%;\n}\n</style>\n";
			}
			
			$find_file=$db->prepare("SELECT file_name, recipient1_read,recipient2_read FROM message_file WHERE recipient1=? AND recipient2=?");
			$find_file->bind_param('ii',$sender_id,$receiver_id);
			$find_file->execute();
			$find_file_result=$find_file->get_result();
			if(mysqli_num_rows($find_file_result)!=0){
				echo read_chat(TRUE,$find_file_result,$output,$db);
			}
			else{
				$find_file->bind_param('ii',$receiver_id,$sender_id);
				$find_file->execute();
				$find_file_result=$find_file->get_result();
				if(mysqli_num_rows($find_file_result)!=0){
					echo read_chat(FALSE,$find_file_result,$output,$db);
				}
			}
	}
  }else{
		mysqli_close($db);
    echo "";
  }


?>