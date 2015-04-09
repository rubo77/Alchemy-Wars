<?php
include("conf.inc.php");
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/min.css">
<link rel="stylesheet" type="text/css" href="css/a.css.php">
<meta charset="utf-8">
</head>
<body>
<div id="a"></div>
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script>
<?php
// all elements in $conf are transferred to js vars:
foreach($conf as $key=>$val) echo $key.'="'.$val.'";'.NL;
?>
$( document ).ready(function() {
// --begin jquery

var a=$('#a');
a.html('<h1>Alchemy Wars</h1>');

var api = "get.php?";
$.getJSON( api, {
	player: "1",
	game: "testgame",
	x: "3",
	y: "7"
}).done(function( e ) {
	//console.log(e);
	e.forEach(function(o,i){
		fid='f'+o.x+'_'+o.y
		a.append('<div id="'+fid+'">'+o.c+'</div>');
		f=$('#'+fid);
		f.css({
			"backgroundColor":o.c,
			"top": ((parseInt(o.x)*parseInt(fheight))+parseInt(marginTop ))+"px",
			"left":((parseInt(o.y)*parseInt(fwidth)) +parseInt(marginLeft))+"px"
		}).addClass('field');
	});
});


// --end jquery
});


</script>
</body>
</htm>