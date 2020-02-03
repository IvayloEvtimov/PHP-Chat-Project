<?php
    include "header.php";
    include "ChromePhp.php";
?>

<body>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>  


</style>

<div class= "main-grid">
    
    <div class="contacts-box"></div>

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

    <div class="search-box">
        <div id="search-tag"><i id="search-icon" class="material-icons">search</i><p id="search-p">Search</p></div>
        <textarea id="search-text" rows="2" cols="30";></textarea>
        <div id="search-result"></div>
    </div>
</div>

<script src="js/script.js"></script>


</body>

</body>

