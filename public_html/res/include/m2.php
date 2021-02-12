<style>
.m2_div { width: 100%; height: 622px; background: #f5f5f5; }

.swiper-m2 { width:1200px; height: 100%; position:relative; margin:0 auto; z-index:1; }

.m2BtnArea { width: 200px; height: 65px; background: #222; position: absolute; right: 489px; bottom: 71px; z-index: 2; }
.m2BtnArea > div { position: absolute; top: 26px; cursor: pointer; outline: none; transition:.15s all ease-in-out; }
.m2BtnArea > div:first-child { left: 41px; }
.m2BtnArea > div:last-child { right: 41px; }

.m2BtnArea > div:first-child:hover { left: 31px; }
.m2BtnArea > div:last-child:hover { right: 31px; }

.m2_more { width: 171px; height: 53px; position: absolute; bottom: 136px; left: 16px;
			font-size: 16px; font-weight: 400; line-height: 53px; text-align: center;
			border-top: 1px solid #9f9f9f; border-bottom: 1px solid #9f9f9f; box-sizing: border-box; 
			cursor: pointer; z-index: 2; }
.m2_more::before { content:""; width: 17px; height: 53px; position: absolute; top: -1px; left: -16px; background: url('/res/images/more_before.png') no-repeat center top; }
.m2_more::after { content:""; width: 17px; height: 53px; position: absolute; top: -1px; right: -16px; background: url('/res/images/more_after.png') no-repeat center top; }

.m2_more > div { width: 0; height: 100%; position: absolute; background: #074dbf; transition: .6s all; z-index: -1; }
.m2_more:hover { color: #fff; }
.m2_more:hover > div { width: 70%; }

.m2_more > img { margin-left: 25px; }
</style>

<div class="m2_div">
	<div class="swiper-container swiper-m2" >
		<div class="swiper-wrapper">
			<?for($i=1; $i<=5; $i++){?>
				<div style="background:url('/res/images/m2/visual/<?=$i?>.jpg') no-repeat center center;" class="swiper-slide"></div>
			<?}?>
		</div>

		<div class="BtnArea">
			<div class="leftBtn"><img src="/res/images/m2/visual/left.png" alt="이전버튼" /></div>
			<div class="rightBtn"><img src="/res/images/m2/visual/right.png" alt="다음버튼" /></div>
		</div>

		<div class="m2_more" onclick="menulink('menu01-3')">
			<div></div>
			READ MORE<img src="/res/images/m2/arrow.png" alt="화살표" />
		</div>
	</div>
</div>

<script>
	var swiper_m2 = null;
	$(function(){
		swiper_m2 = new Swiper('.swiper-m2', {
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
							nextEl: '.rightBtn',
							prevEl: '.leftBtn',
						},
		});
	});
</script>