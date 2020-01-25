<?php  
    require_once 'navbar.php';
?>


<body>
<link rel="stylesheet" type="text/css" href="stylesheet/style.css" media="screen"/>

<style>
.left{
	margin-left:10px;
}

#contact-field{
	border-bottom: 1px solid black;
	cursor: pointer;
}

#contact-icon{
	margin-top:10px;
	font-size:32px;
}

#contact{
	position: relative;
	bottom:10px;
}

.chat-box{
	border: 1px solid blue;
	margin-left:10px;
	height:600px;
	width: 1000px;
	overflow: scroll;
	overflow-x: hidden;
}

.name_time{
    font-size: 13px;
    font-style: italic;
    margin-bottom:0px;
}
html {
overflow:hidden;
}

#send-icon{
    margin-top: 5px;
}

#img-icon,#video-icon{
    margin-top: 5px;
}

#img-button,#vid-button{
    position: relative;
    float: left;
    margin-right: 5px;
    transition-duration: 0.4s;
    border-radius: 4px;
    border: 1px solid black;  
    background-color: white; 
    padding-left: 5px;
    padding-right: 5px;
}

#img-button:hover,#vid-button:hover{
    background-color:#0084ff;
    color: white;
    cursor: pointer;
}
#send-text{
    height:40px;
    width: 870px;
}

#send-button{
    position: relative;
		bottom:8px;
    margin-left: 5px;
    transition-duration: 0.4s;
    background-color:#0084ff;
    color:white;
    border-radius: 4px;
    border: 1px solid blue;
}

#send-button:hover{
    background-color:white;
    color: black;
    border: 1px solid black;
}

.send-box{
	margin-top:10px;
	margin-left:10px;
}

</style>


	<div class="row">
		<div class="col-sm-2 left">
			<h2 class="display-4">Contacts</h2>
			<div class="contacts-box" style="border: 1px solid black; height:500px;"></div>
		</div>
		<div class="col-sm-8" style="margin-right:10px;margin-top:10px;">
			<div class="chat-box">
				<div id="message">

				</div>
			</div>

			<div class="send-box">
			<form method="post" enctype="multipart/form-data" action="">
            <label for="img-file" id="img-button" ><i class="material-icons orange600" id="img-icon">image</i></label>
            <input type="file" name="img-file" id="img-file" style="display:none">
        </form>

				<form method="post" enctype="multipart/form-data" action="">
            <label for="vid-file" id="vid-button" ><i class="material-icons" id="video-icon">video_library</i></label>
            <input type="file" name="vid-file" id="vid-file" style="display:none">
        </form>

				<textarea id="send-text" rows="3" cols="30"></textarea>
        <button id="send-button" type="button"><i class='material-icons' id="send-icon">send</i></button>
			</div>
		</div>

	</div>


</body>

