<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HTML5aber</title>
	<meta name="language" content="en" /> 
	<meta name="viewport" content="width=device-width; user-scalable=0; initial-scale=1.0; maximum-scale=1.0;" /> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 

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
		#splash {
			margin: 70px auto;
			background: #222;
			height: 60px;
			width: 100px;
			text-align: center;
			font-family: sans-serif;
			color: #eee;
			border-radius: 5px;
			padding-top: 40px;
		}
	</style>

</head>
<body>

	<div id="splash">HTML5aber</div>

	<div id="bg">
		<div id="beam"></div>
	</div>

	<script src="/js/jquery-1.4.4.min.js"></script>
	<script src="/js/jquery.jswipe-0.1.2.js"></script>
	<script>
		$(document).ready(function(){
			var sfxIdle = null;
			var sfxOn = null;
			var sfxOff = null;
			var sfxSwings = [];
			var sfxStrikes = [];
			var playIdle = function(){};
			var playInterrupt = false;
			
			$('#splash').click(function(){
				sfxIdle = new Audio();
				sfxIdle.src = '/audio/idle0.mp3';
				sfxIdle.load();

				sfxOn = new Audio();
				sfxOn.src = '/audio/on0.mp3';
				sfxOn.load();

				sfxOff = new Audio();
				sfxOff.src = '/audio/off0.mp3';
				sfxOff.load();

				sfxSwings[0] = new Audio();
				sfxSwings[0].src = '/audio/swing0.mp3';
				sfxSwings[0].load();
				sfxSwings[1] = new Audio();
				sfxSwings[1].src = '/audio/swing7.mp3';
				sfxSwings[1].load();

				sfxStrikes[0] = new Audio();
				sfxStrikes[0].src = '/audio/strike1.mp3';
				sfxStrikes[0].load();
				sfxStrikes[1] = new Audio();
				sfxStrikes[1].src = '/audio/strike2.mp3';
				sfxStrikes[1].load();

				sfxOn.addEventListener('play', function(){

					var playIdle = function(){
						var rewind = function(){
							window.setTimeout(function(){
								if (!playInterrupt) {
									sfxIdle.currentTime = 0;
									rewind();
								}
							}, 2000);
						};
						sfxIdle.play();
						playInterrupt = false;
						rewind();
					};

					window.setTimeout(function(){
						/*sfxOn.removeEventListener('play', sfxOnEvent);*/
						/*
						sfxOn.src = '/audio/idle0.mp3';
						sfxOn.load();
						sfxOn.addEventListener('play',function(){
							
						});
						sfxOn.play();
						*/
						playIdle();
					}, 1500);

					window.ondevicemotion = function(event){
						if (event.accelerationIncludingGravity.x > 3 ||
							event.accelerationIncludingGravity.y > 3)
						{
							playInterrupt = true;
							if (event.accelerationIncludingGravity.x > 7.6 ||
								event.accelerationIncludingGravity.y > 7.6)
							{
								var randPlayerIdx = Math.floor(Math.random()*2);
								sfxStrikes[randPlayerIdx].addEventListener('ended', playIdle);
								sfxStrikes[randPlayerIdx].play();
							} else {
								var randPlayerIdx = Math.floor(Math.random()*2);
								sfxSwings[randPlayerIdx].addEventListener('ended', playIdle);
								sfxSwings[randPlayerIdx].play();
							}
						}
					}
				});

				var splash = $(this);
				sfxOn.addEventListener('loadeddata',function(){
					splash.hide();
				});
			});


			var beam = $('#beam');
			$('#bg').swipe({
				swipeUp:function(){
					if (!beam.hasClass('extended')) {
						beam.addClass('extended');
						sfxOn.play();
						/*

						if (sfxOn.currentTime > 0) {
							sfxOn.load();
							sfxOn.currentTime = 0;
						}
						sfxOn.addEventListener('play',function(){
							window.setTimeout(function(){
								sfxOn.pause();
								sfxOff.load();
								sfxOff.play();
							}, 1300);
						});
						sfxOn.play();*/
					}
				},
			});
			beam.swipe({
				swipeDown:function(){
					if (beam.hasClass('extended')) {
						beam.removeClass('extended');
						sfxIdle.pause();
						window.ondevicemotion = null;
						sfxOff.play();
					}
				}
			});
		});

							/*
							var rewind = function(){
								window.setTimeout(function(){
									sfxOn.currentTime = 0;
									rewind();
								}, 1000);
							};
							rewind();
							*/
							/*
							window.setTimeout(rewind, 700);
							sfxIdle.load({url: '/audio/on0.mp3'});
							sfxIdle.play();
							*/
							/* Cheap way of looping */
							/*
							sfxIdle.addEventListener('ended',function(){
								this.pause();
								this.currentTime = 0;
								this.play();
							});
							*/
	</script>
</body>
</html>
