<style>
.swiper-mainvisual { width:100%; min-width:1200px; max-width:1919px; height:567px; position:relative; margin:0 auto; z-index:1; }

.cacheArea { width: 1200px; margin: 0 auto; position: relative; z-index: 2; }
.cacheArea > img { position: absolute; }
.cacheArea > img:first-child { top: 191px; left: 423px; }
.cacheArea > img:last-child { top: 282px; left: 283px; }

.main_next,
.main_prev { width: 120px; height: 54px; display: inline-block; position: absolute; top: 257px; cursor: pointer; outline: none; z-index: 2; }
.main_next { right: 0; }
.main_prev { left: 0; }

.bg { width: 0; height: 100%; position: absolute; background: #fff; transition: .3s all ease-in-out; }
.letter { position: absolute; top: 15px; font-size: 15px; color: #fff; }
.line { width: 46px; height: 2px; position: absolute; top: 25px; background: #fff; }

.main_next:hover > .bg,
.main_prev:hover > .bg { width: 100%; }
.main_next:hover > .letter,
.main_prev:hover > .letter { color: #000; }
.main_next:hover > .line,
.main_prev:hover > .line { background: #000; }
</style>

<div class="swiper-container swiper-mainvisual" >
	<div class="cacheArea">
		<img src="/res/images/mainvisual/cache/cache1.png" alt="캐치1" class="wow fadeInUp" data-wow-delay="0.3s" />
		<img src="/res/images/mainvisual/cache/cache2.png" alt="캐치2" class="wow fadeInUp" data-wow-delay="0.6s" />
	</div>

	<div class="swiper-wrapper">
		<?for($i=1; $i<=6; $i++){?>
			<div style="background:url('/res/images/mainvisual/<?=$i?>.jpg');width:100%;background-position:center center;" class="swiper-slide" >
			</div>
		<?}?>
	</div>

	<div class="main_next">
		<div class="bg" style="right:0;"></div>
		<div class="letter" style="left: 29px;">NEXT</div>
		<div class="line" style="right:0;"></div>
	</div>
	<div class="main_prev">
		<div class="bg" style="left:0;"></div>
		<div class="letter" style="right: 29px;">PREV</div>
		<div class="line" style="left:0;"></div>
	</div>
</div>

<script>
	var swiper_mainvisual = null;
	$(function(){
		swiper_mainvisual = new Swiper('.swiper-mainvisual', {
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
							transitionStart:function(){ },
							transitionEnd:function(){
								this.autoplay.stop();
								this.autoplay.start();
							}
						},
						navigation: {
							nextEl: '.main_next',
							prevEl: '.main_prev',
						},
		});
	});
</script>