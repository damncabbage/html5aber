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
<div id="s" style="width: 50px; height: 50px; background: #afa; position: absolute; bottom: 0;">Here</div>
	<div id="splash">HTML5aber</div>

	<div id="bg">
		<div id="beam"></div>
	</div>

	<script src="/js/jquery-1.4.4.min.js"></script>
	<script src="/js/jquery.jswipe-0.1.2.js"></script>
	<script>
		$(document).ready(function(){

			var audio = {
				idle: {
					src: '/audio/idle.mp3',
					looping: true, length: 3000,
					elt: null
				},
				on: {
					src: '/audio/on0.mp3',
					looping: false, length: 1800,
					elt: null
				},
				off: {
					src: '/audio/off0.mp3',
					looping: false, length: 1500,
					elt: null
				},
				swings: [
					{ src: '/audio/swing_edit1.mp3', looping: false,
					  length: 1000, elt: null },
					{ src: '/audio/swing_edit2.mp3', looping: false,
					  length: 1000, elt: null }
				],
				strikes: [
					{ src: '/audio/strike1.mp3', looping: false,
					  length: 1000, elt: null },
					{ src: '/audio/strike2.mp3', looping: false,
					  length: 1000, elt: null }
				]
			};

			var currentAudio = null;
			var currentAudioLoopTimeout = null;

			var loadAudioElements = function(types) {
				var loadElement = function(section){
					section.elt = new Audio();
					section.elt.src = section.src;
					section.elt.load();
				};
				loadElement(types.idle);
				loadElement(types.on);
				loadElement(types.off);
				for (ii in types.swings) {
					loadElement(types.swings[ii]);
				}
				for (ii in types.strikes) {
					loadElement(types.strikes[ii]);
				}
			};

			var playAudio = function(item, postItem) {
				if (currentAudio !== null) {
					if (currentAudioLoopTimeout !== undefined) {
						window.clearTimeout(currentAudioLoopTimeout);
					}
					currentAudio.removeEventListener('ended', playAudio);
					currentAudio.pause();
					if (currentAudio.currentTime) {
						currentAudio.currentTime = 0;
					}
				}

				currentAudio = item.elt;
				if (item.looping) {
					var rewind = function(){
						if (item.elt.src == currentAudio.src) {
							window.setTimeout(function(){
								item.elt.currentTime = 0.1; // 100ms from beginning, to skip fade-in.
								rewind();
							}, item.length);
						}
					};
					item.elt.play();
					rewind();
				} else {
					item.elt.play();
				}

				if (postItem !== undefined) {
					// Set up an event to follow it.
					item.elt.addEventListener('ended', function(){playAudio(postItem)});
				}
			};


			$('#splash').click(function(){
				loadAudioElements(audio);

				var splash = $(this);
				/* TODO: Set up loading spinner */
				audio.idle.elt.addEventListener('loadeddata',function(){
					/* TODO: Show instructions briefly. */
					splash.hide();
				});

			}); /* splash.click */


			var swingDetection = function(event){
				/* Woom, woom... Woom. (Slower swings) */
				if (event.accelerationIncludingGravity.x > 3 ||
					event.accelerationIncludingGravity.y > 3)
				{
					/* Really hacky, not indicative of a "strike" so much as a quicker swing. */
					if (event.accelerationIncludingGravity.x > 7.6 ||
						event.accelerationIncludingGravity.y > 7.6)
					{
						var randPlayerIdx = Math.floor(Math.random() * audio.strikes.length);
						playAudio(audio.strikes[randPlayerIdx], audio.idle);
					} else {
						var randPlayerIdx = Math.floor(Math.random() * audio.swings.length);
						playAudio(audio.swings[randPlayerIdx], audio.idle);
					}
				}
			};

			var beam = $('#beam');
			$('#bg').swipe({
				swipeUp:function(){
					if (!beam.hasClass('extended')) {
						beam.addClass('extended');
						playAudio(audio.on, audio.idle);
						window.ondevicemotion = swingDetection;
					}
				},
			});
			beam.swipe({
				swipeDown:function(){
					if (beam.hasClass('extended')) {
						beam.removeClass('extended');
						window.ondevicemotion = null;
						playAudio(audio.off);
					}
				}
			});

				$('#bg').click(function(){
						if (!beam.hasClass('extended')) {
							beam.addClass('extended');
							playAudio(audio.on, audio.idle);
							window.ondevicemotion = swingDetection;

							$('#s').click(function(){
								var randPlayerIdx = Math.floor(Math.random() * audio.swings.length);
								playAudio(audio.swings[randPlayerIdx], audio.idle);

							});
						} else {
							beam.removeClass('extended');
							window.ondevicemotion = null;
							playAudio(audio.off);
						}
				});


		}); /* document.ready */

	</script>
</body>
</html>
