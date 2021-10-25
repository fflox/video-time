<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
	
<?php 
$filename = basename(__FILE__, '.php'); 
include("header.php");
?>
<body>
<a id="logout" href="logout.php">Log Out</a>
<?php 

if(!$_SESSION["login"]) {
	header("Location: https://asd.flox.xyz/");
	die();
} else {

$json = json_encode(array('link' => $_POST['link']));
file_put_contents("link.json", $json);	
$pass = "asd";   
$src = $_POST["link"];
} 




$asd = strripos($src,"/");
$title = substr($src,$asd+1,strripos($src,".")-1-$asd);


?>
<div id="title"><?php echo $title; ?> </div>
<div id="video"></div>
<script type="text/javascript">
const socket = new WebSocket("wss://flox.xyz/asd");
let sendMsg = true;
let me = false;
let playing = false;
socket.onopen = () => {
	socket.send(JSON.stringify({type: "pass", payload: "<?php echo $pass; ?>"}));
}

var videoInstance = jwplayer("video");
videoInstance.setup({
	sources:[{file: "<?php echo $src; ?>",label: 'HD P','type' : 'mp4'}]
})

socket.onmessage = (msg) =>{
	let data = JSON.parse(msg.data);
	console.log(data);
	if(data.type == "videoStream") {
		switch(data.payload.action) {

		case "play":
			if(!me)  {
				videoInstance.play();
			}
		break;

		case "pause":
			if(!me)  {
				console.log("pause");
				videoInstance.pause();
			}
		break;

		case "start":
			console.log("start");
			videoInstance.play();

		break;

		case "unregister":
			sendMsg = false;
			console.log(sendMsg,"message");
		break;

		case "buffering":
			videoInstance.pause();
		break;

		case "skip":
			if(!me)  {	
				videoInstance.seek(data.payload.time);
			}
		break;
		}
	}
}

videoInstance.on('error', () => {
console.log("err");
})

videoInstance.on("ready", () => {
	videoInstance.on('play',() => {
		if(sendMsg) {
			socket.send(JSON.stringify({type: "videoStream", payload:  {action: "start"}}));
				videoInstance.play();
			}	
		})

	videoInstance.on('pause',() => {
		if(sendMsg) {
			socket.send(JSON.stringify({type: "videoStream", payload: {action: "pause"}}));
			videoInstance.pause();

		}
	})
	<?php
	?>
	videoInstance.on('seek', (timers) => {
		if(sendMsg) {
			if(videoInstance.getPosition() != timers.offset && !me) {
				socket.send(JSON.stringify({type: "videoStream", payload: {action: "skip", time: timers.offset}}))
				me = true;
				let val = setInterval(() => {
					clearInterval(val);
					me = false;
				},500)
			}
		}
	})
})

</script>
</body>
</html>
