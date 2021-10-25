<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="/static/css/<?php  echo $filename; ?>.css">
	<meta content="https://flox.xyz/pepeL.png" property="og:image" />
	<link rel="shortcut icon" href="https://flox.xyz/favicon.ico"/>
	<link rel="manifest" href="https://flox.xyz/manifest.json"/>
	<title>flox.xyz - asd</title>
    <?php
    if($filename == "video") {
    echo '
    <script type="text/javascript" src="/static/js/jwplayer.js"></script>
    <script type="text/javascript" src="/static/js/jwplayer.core.controls.html5.js"></script>	
    <script type="text/javascript" src="/static/js/player.js"></script>
    ';
    }
    ?> 
</head>