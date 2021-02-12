<style>
.swiper-sub1_3 { width:100%; min-width:1200px; max-width:1919px; height:905px; position:relative; margin:0 auto; z-index:1; }

.sub1_3-div { position: absolute; right: 0; top: 363px; z-index: 3; }
.sub1_3-div > div { float: left; margin-left: 276px; }
.sub1_3-div > div:first-child { margin-left: 0; }

.sub1_3-btnArea > img { outline: none; cursor: pointer; margin-right: 9px; }
.sub1_3-btnArea > img:last-child { margin-right: 0; }

.sub1_3-numArea { position: relative; }
.sub1_3-numArea .sub1_3-line { display: inline-block; margin: 0 13px 8px 0; width: 32px; height: 2px; background: #000; }
.sub1_3-numArea .current_num { display: inline-block; padding-right: 20px; font-size: 24px; color: #000; background: url('/res/images/sub1_3/slash.png') no-repeat top 5px right; }
.sub1_3-numArea .total_num { font-size: 15px; color: #9a9a9a; position: absolute; bottom: 0;}
</style>

<div class="swiper-container swiper-sub1_3" >
	<div style="width: 1200px; margin:0 auto; position: relative;">
		<div class="sub1_3-div">
			<div class="sub1_3-btnArea">
				<img src="/res/images/sub1_3/left.png" alt="이전 버튼" onmouseover="this.src='/res/images/sub1_3/lefta.png'" onmouseout="this.src='/res/images/sub1_3/left.png'" class="sub1_3-prev" />
				<img src="/res/images/sub1_3/stop.png" alt="플레이 버튼" class="sub1_3-play" onclick="sub1_3Stop()"/>
				<img src="/res/images/sub1_3/right.png" onmouseover="this.src='/res/images/sub1_3/righta.png'" onmouseout="this.src='/res/images/sub1_3/right.png'" alt="다음 버튼" class="sub1_3-next" />
			</div>
			
			<div class="sub1_3-numArea">
				<div class="sub1_3-line"></div>
				<span class="current_num"></span>
				<span class="total_num">05</span>
			</div>
		</div>
	</div>

	<div class="swiper-wrapper">
		<?for($i=1; $i<=5; $i++){?>
			<div style="background:url('/res/images/sub1_3/<?=$i?>.jpg');background-position:center center;" class="swiper-slide" >
			</div>
		<?}?>
	</div>
</div>

<script>
	function sub1_3Stop() {
		swiper_sub1_3.autoplay.stop();
		$(".sub1_3-play").attr({"src" : "/res/images/sub1_3/play.png", "onclick" : "sub1_3Play()"});
	}

	function sub1_3Play() {
		swiper_sub1_3.autoplay.start();
		$(".sub1_3-play").attr({"src" : "/res/images/sub1_3/stop.png", "onclick" : "sub1_3Stop()"});
	}

	$(".sub1_3-prev, .sub1_3-next").click(function() {
		$(".sub1_3-play").attr({"src" : "/res/images/sub1_3/stop.png", "onclick" : "sub1_3Stop()"});
	});

	var swiper_sub1_3 = null;
	$(function(){
		swiper_sub1_3 = new Swiper('.swiper-sub1_3', {
						spaceBetween: 0,
						centeredSlides: true,
						autoplay: {
							delay: 3000,
						},
						disableOnInteraction: false,
						effect:'fade',
						speed: 800,
						loop:true,
						slidesPerView:'auto',
						observer:true,
						simulateTouch: false,
						on:{
							transitionStart:function(){ 
								var idx = this.realIndex + 1;
								$(".current_num").html("0" + idx);
							},
							transitionEnd:function(){
								this.autoplay.stop();
								this.autoplay.start();
							}
						},
						navigation: {
							nextEl: '.sub1_3-next',
							prevEl: '.sub1_3-prev',
						},
		});
	});
</script>