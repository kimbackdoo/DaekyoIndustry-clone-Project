<?
	$imgNumber = glob("$g4[path]/res/images/sub2/sub2_".$subNum."/sub2_".$subNum."_".$ssNum."/*.jpg");
	$pageCnt = 	count($menu["tott"][$pageNum][$subNum]);
?>

<style>
.sub2_div { width: 1200px; margin: 0 auto; padding-bottom: 80px; }

.sub2_tab { width: 100%; height: 72px; margin: 0 auto; margin-bottom: 51px; background: #f5f5f5; }
.sub2_tab > li { height: 100%; box-sizing: border-box; float: left;  border-right: 1px solid #ccc; font-size: 20px; line-height: 72px; text-align: center; }
.sub2_tab > li:last-child { border: 0; }
.sub2_tab > li > a { display: block; color: #000; }
.sub2_tab > li.on > a { color: #fff; background: #074dbf; }

.swiper-sub2 { width:100%; height:593px; position:relative; margin:0 auto; z-index:1; }

.sub2BtnArea { width: 200px; height: 65px; background: #222; position: absolute; right: 40px; top: 131px; z-index: 2; }
.sub2BtnArea > div { position: absolute; top: 22px; cursor: pointer; outline: none; transition:.15s all ease-in-out; }
.sub2BtnArea > div:first-child { left: 41px; }
.sub2BtnArea > div:last-child { right: 41px; }

.sub2BtnArea > div:first-child:hover { left: 31px; }
.sub2BtnArea > div:last-child:hover { right: 31px; }

.sub2_dowunload { width: 83px; height: 83px; position: absolute; bottom: 121px; right: 111px; z-index: 3; }
</style>

<div class="sub2_div">
	<ul class="sub2_tab">
		<?foreach($menu["tott"][$pageNum][$subNum] as $ssn => $ssnStr) {?>
			<li style="width:<?=1200/$pageCnt?>px" <?=$tott == $pageNum."_".$subNum."_".$ssn ? "class='on'" : ""?>>
				<a href="#menulink" onclick="menulink('menu<?=sprintf("%02d", $pageNum)?>-<?=$subNum?>-<?=$ssn?>')"><?=$ssnStr?></a>
			</li>
		<?}?>
	</ul>

	<div class="swiper-container swiper-sub2">
		<?if($subNum==1) {?>
			 <div class="swiper-wrapper">
				<?for($i=1; $i<=count($imgNumber); $i++){?>
					<div style="background:url('/res/images/sub2/sub2_<?=$subNum?>/sub2_<?=$subNum?>_<?=$ssNum?>/<?=$i?>.jpg');width:100%;background-position:center center;" class="swiper-slide" ></div>
				<?}?>
			</div>

			<div class="sub2BtnArea">
				<div class="leftBtn"><img src="/res/images/m2/visual/left.png" alt="이전버튼" /></div>
				<div class="rightBtn"><img src="/res/images/m2/visual/right.png" alt="다음버튼" /></div>
			</div>
		<?} else {?>
			<div style="background:url('/res/images/sub2/sub2_<?=$subNum?>/<?=$ssNum?>.jpg') no-repeat center center; width:100%; height:593px;" class="sub2_bg"></div>
		<?}?>
		
		<?
			$down_botable = "9_1_1_1";
			$down_wrid = "";
			$down_no = "";
			if($ssNum == 1){
				$down_wrid = "1";
				$down_no = "0";
			}else if($ssNum == 2){
				$down_wrid = "2";
				$down_no = "0";
			}else if($ssNum == 3){
				$down_wrid = "2";
				$down_no = "1";
			}
		?>
			<a href="<?=$g4["bbs_path"]?>/download.php?bo_table=<?=$down_botable?>&wr_id=<?=$down_wrid?>&no=<?=$down_no?>" class="sub2_dowunload"></a>
	</div>
</div>

<script>
	function downloadLink(link, file) {
		document.location.href=link;
	}

	var swiper_sub2 = null;

	$(function() {
		swiper_sub2 = new Swiper('.swiper-sub2', {
						spaceBetween: 0,
						centeredSlides: true,
						autoplay: {
							delay: 3000,
						},
						disableOnInteraction: false,
						effect:'fade',
						speed: 1000,
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