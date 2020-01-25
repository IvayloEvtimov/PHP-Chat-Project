loadContacts();
var selected_contact;
console.log("clieck");

$(document).on("click","#send-button",function(){
	var message=$.trim($("#send-text").val());
	if(message!=""){
			$.ajax({
					url: "send_message.php",
					method: "POST",
					data:{message:message,receiver_name:selected_contact},
					success:function(data){
							$("#message").append(data);
							$("#send-text").val('');
					}
			});
	}
});

$(document).on("click","#contact-field",function(){
	syncChatBox(false,$(this).find("#contact").text());
	selected_contact=$(this).find("#contact").text();
});

$("#img-file").on("change",function(){
	if(!(typeof selected_contact === "undefined")){
			var file_data = $('#img-file').prop('files')[0];   
			var form_data = new FormData();                  
			form_data.append('file', file_data);
			form_data.append('receiver_name',selected_contact);
			$.ajax({
					url: 'upload.php', 
					dataType: 'text',  
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'POST',
					success: function(data){
							$("#message").append(data);
					}
			});
	}
});

$("#vid-file").on("change",function(){
	if(!(typeof selected_contanct === "undefined")){
			var file_data=$("#vid-file").prop('files')[0];
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('receiver_name',selected_contact);
			$.ajax({
					url: 'upload.php', 
					dataType: 'text',  
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'POST',
					success: function(data){
							$("#message").append(data);
					}
			});
	}
});

function syncChatBox(refresh=true,new_contact){
	$.ajax({
			url:"sync_chat.php",
			method:"POST",
			data:{receiver_name:new_contact,refresh:refresh},
			success:function(data){
					if(refresh==true){
							$("#message").append(data);
					}else{
							$("#message").html(data);
					}
			}
	});
}

function loadContacts(){
	$.ajax({
			url: "load_contacts.php",
			method: "POST",
			success:function(data){
				$(".contacts-box").append(data);
			}
	});
}