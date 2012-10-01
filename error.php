<?php 
	function get_message_from_http_error($code) {
		switch($code) {
			case 400:
				return array("Bad Request", "This gateway, man. It's bad");
				break;
			case 401:
				return array("Unauthorized", "Hey, I don't know you. Could you authenticate before?");
				break;
			case 403:
				return array("Forbidden", "INTRUDER ALERT INTRUDER ALERT WE CALLED THE POLICE oh maybe not.");
				break;
			case 404:
				return array("Not Found", "Where did I leave that page? I can't find it anymore.");
				break;
			case 405:
				return array("Method Not Allowed", "Don't try fancy stuff, GET's cool.");
				break;
			case 406:
				return array("Not Acceptable", "I won't listen to you. Don't even try- NO, I SAID DON'T.");
				break;
			case 407:
				return array("Proxy Authentication Required", "Err, could you ask your neighbour to come see me?");
				break;
			case 408:
				return array("Request Time-out", "My hosting is so bad I couldn't answer you in time.");
				break;
			case 410:
				return array("Gone", "Looks like someone tried to give you a bad address.");
				break;
			case 500:
				return array("Internal Server Error", "Something went bad with the server. Probably my fault.");
				break;
			case 501:
				return array("Not Implemented", "We don't support strange stuff, sorry.");
				break;
			case 502:
				return array("Bad Gateway", "Your postman did a bad job.");
				break;
			case 503:
				return array("Service Unavailable", "We're gone for a moment, but just wait a moment and try again.");
				break;
			case 504:
				return array("Gateway Time-out", "Your postman is so slow I stopped waiting for him.");
				break;
			case 505:
				return array("HTTP Version not supported", "What browser are you using, Netscape? Haha.");
				break;
		}
	}
	
	$code_string = get_message_from_http_error($_GET['code']);

?>
<html>
	<head>
		<meta http-equiv="Content-Type" Content="text/html; charset=utf-8">
		<title>Err... woops.</title>
	</head>
	<body>
		<style type="text/css">
		
			body {
				text-align: center;
				font-family: Helvetica, Arial, serif;
			}

			#wrapper {
				position: absolute;
				top: 50%;
				height: 240px;
				margin-top: -140px;
				width: 99%;
			}

			#content {
				margin: auto;
			}
			
			#content h1, h1 small {
				font-size: 28px;
			}
			
			h1 small {
				color: lightgray;
			}
			
			.links a {
				text-decoration: none;
				color: gray;
			}
			
		</style>

		<div id="wrapper">
			<div id="content">
				<h1>Error <?php echo htmlspecialchars($_GET['code']); ?> <small><?php echo $code_string[0]; ?></small></h1>
				<p><?php echo $code_string[1]; ?></p>
				<div class="links"><a href="#" onclick="document.location.reload(true);">RETRY</a> | <a href="./">HOME</a> | <a href="#" onclick="history.go(0);">PREVIOUS</a></div>
			</div>
		</div>
	</body>
</html>