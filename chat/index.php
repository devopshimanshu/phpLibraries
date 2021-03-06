<html>
<head>
	<style>
	body{width:600px;font-family:calibri;}
	.error {color:#FF0000;}
	.chat-connection-ack{color: #26af26;}
	.chat-message {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;
	}
	#btnSend {background: #26af26;border: #26af26 1px solid;	border-radius: 4px;color: #FFF;display: block;margin: 15px 0px;padding: 10px 50px;cursor: pointer;
	}
	#chat-box {background: #fff8f8;border: 1px solid #ffdddd;border-radius: 4px;border-bottom-left-radius:0px;border-bottom-right-radius: 0px;min-height: 300px;padding: 10px;overflow: auto;
	}
	.chat-box-html{color: #09F;margin: 10px 0px;font-size:0.8em;}
	.chat-box-message{color: #09F;padding: 5px 10px; background-color: #fff;border: 1px solid #ffdddd;border-radius:4px;display:inline-block;}
	.chat-input{border: 1px solid #ffdddd;border-top: 0px;width: 100%;box-sizing: border-box;padding: 10px 8px;color: #191919;
	}
	</style>	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="notification.js"></script>
	<script>  
	function showMessage(messageHTML) {
		//$('#chat-box').append(messageHTML);
		console.log(messageHTML);
		var options = {
                body: messageHTML,
                //icon: "icon.jpg",messageJSON
                dir : "ltr"
             };
        var notification = new Notification("Hi there",options);
	}

	function showMessageWin(messageHTML){
		$('#chat-box').append(messageHTML);
	}
	
	$(document).ready(function(){
		websocket = new WebSocket("ws://localhost:5678/dusty/chat/php-socket.php"); 
		websocket.onopen = function(event) { 
			showMessageWin("<div class='chat-connection-ack'>Connection is established!</div>");		
		}
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
			//showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
			showMessage(Data.message);
			$('#chat-message').val('');
		};
		
		websocket.onerror = function(event){
			showMessageWin("<div class='error'>Problem due to some Error</div>");
		};
		websocket.onclose = function(event){
			showMessageWin("<div class='chat-connection-ack'>Connection Closed</div>");
		}; 
		
		$('#frmChat').on("submit",function(event){
			event.preventDefault();
			$('#chat-user').attr("type","hidden");		
			var messageJSON = {
				chat_user: $('#chat-user').val(),
				//chat_session_Id: $('#chat-session').val();
				chat_message: $('#chat-message').val()
			};
			websocket.send(JSON.stringify(messageJSON));
		});



	});


	$(document).on('click','#myclick', function(){
		//alert('i m inside');
		console.log('i m hit');
		var data = {
			id : 987,
			method : 'getName'
		}
		websocket.send(JSON.stringify(data));
		
	});



	</script>
	</head>
	<body>
		<form name="frmChat" id="frmChat">
			<div id="chat-box"></div>
			<input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />
			<input type="hidden" name="session" id="chat-session" value="sadfjkjgsfhuwcbiewcwoc"/>
			<input type="text" name="chat-message" id="chat-message" placeholder="Message"  class="chat-input chat-message" required />
			<input type="submit" id="btnSend" name="send-chat-message" value="Send" >
		</form>

		<button id="myclick">getName</button>
</body>
</html>