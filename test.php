<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HTML5aber</title>
	<meta name="language" content="en" /> 
	<meta name="viewport" content="width=320; user-scalable=0; initial-scale=1.0; maximum-scale=1.0;" /> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />

	<style>
		body {
			margin: 0; padding: 0;
		}

		body, #bg {
			background: #000;
			height: 480px;
			width: 320px;
		}

		#beam {
			position: absolute;
			width: 100%;
			background: -webkit-gradient(
				linear, left top, right top,
				color-stop(0%,#2bdcff), color-stop(20%,#FFFFFF),
				color-stop(80%,#FFFFFF), color-stop(100%,#2bdcff)
			);
			height: 0;
			top: 480px;
			-webkit-transition: all 0.3s linear;
			-webkit-transition-property: top, height;
		}
		#beam.extended {
			top: 0px;
			height: 480px;
		}
		audio {
			display: none;
		}
	</style>

</head>
<body>

	<div id="bg">
		<div id="beam"></div>
	</div>

	<script src="/js/jquery-1.4.4.min.js"></script>
	<script src="/js/jquery.jswipe-0.1.2.js"></script>
	<script>
		$(document).ready(function(){
			var sfxOn = document.createElement('audio');
			sfxOn.setAttribute('src', '/audio/on0.mp3');
			sfxOn.load();

			var sfxIdle = document.createElement('audio');
			sfxIdle.setAttribute('src', '/audio/idle0.mp3');
			sfxIdle.load();

			var sfxOff = document.createElement('audio');
			sfxOff.setAttribute('src', '/audio/off0.mp3');
			sfxOff.load();

			var beam = $('#beam');
			$('#bg').swipe({
				swipeUp:function(){
					if (!beam.hasClass('extended')) {
						beam.addClass('extended');
						sfxOn.play();
						sfxOn.addEventListener('ended',function(){
							sfxIdle.play();
							/* Cheap way of looping */
							/*
							sfxIdle.addEventListener('ended',function(){
								this.pause();
								this.currentTime = 0;
								this.play();
							});
							*/
						});
					}
				},
			});
			beam.swipe({
				swipeDown:function(){
					if (beam.hasClass('extended')) {
						beam.removeClass('extended');
						sfxIdle.pause();
						sfxOff.play();
					}
				}
			});
		});
	</script>
</body>
</html>
