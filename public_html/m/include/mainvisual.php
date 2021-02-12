<style>

.swiper-mainvisual-container {margin:0 auto; width:100%; height:370px; position:relative; left:0; top:0; right:0; z-index:1; overflow:hidden; }

.swiper-pagination { width:80% !important; left:112px !important; top:21px !important; text-align:right; }
.swiper-pagination .swiper-pagination-bullet { width:32px !important; height:32px !important; background:none; opacity:1; border-radius:0px !important; box-sizing:border-box; border:1px solid #fff; color:#fff; line-height:28px; font-size:20px; text-align:center; outline:none; }
.swiper-pagination .swiper-pagination-bullet-active { background:#fff; border-radius:0px !important; opacity:1; color:#000; }

</style>

<div class="swiper-mainvisual-container swiper-mainvisual-container1" >


	 <div class="swiper-wrapper">
		<?for($i=1; $i<=3; $i++){?>
			<div style="background:url('/m/images/mainvisual/<?=$i?>.jpg');width:100%;background-position:center center;" class="swiper-slide" >
				&nbsp;
			</div>
		<?}?>
	</div>

	
	
	<div class="swiper-pagination swiper-pagination-m swiper-pagination-bullets"></div>
</div>


<script>

	window.onload = function(){
	var swiper_mainvisual = null;

	$(function(){

		swiper_mainvisual = new Swiper('.swiper-mainvisual-container1', {
						spaceBetween: 0,
						centeredSlides: true,
						autoplay: {
							delay: 4000,
						},
						disableOnInteraction: false,
						effect:'fade',
						speed: 1000,
						loop:true,
						loopAdditionalSlides:1,
						loopedSlides:1,
						slidesPerView:'auto',
						observer:true,
						simulateTouch: false,
						on:{
						transitionEnd:function(){
							this.autoplay.stop();
							this.autoplay.start();
							}
						},
						touchRatio:0,
						pagination: {
							el: '.swiper-pagination',
							type: 'bullets',
							bulletElement: 'span',
							clickable: 'false',
							renderBullet: function (index, className) {
								return '<span class="' + className + '">' + (index + 1) + '</span>';
							 },
						 },
						
						
						
					});


		

	});
	}

</script>

