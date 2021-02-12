<style>
.sub3_div { width: 1200px; margin: 0 auto; padding-bottom: 80px; }
.sub3_div > img { display: block; margin-bottom: 53px; }

.sub3_moreArea { width: 100%; display: inline-block; }
.sub3_moreArea > div { width: 289px; height: 393px; position: relative; float: left; margin-left: 14px; cursor: pointer; }
.sub3_moreArea > div:first-child { margin-left: 0; }

.sub3_img { width: 100%; position: relative; overflow: hidden; z-index: -1; }
.sub3_img > img { display: block; transition: .5s all ease-in-out; }
.sub3_tab:hover > span:nth-child(2n+1) { width: 100%; }
.sub3_tab:hover > span:nth-child(2n) { height: 100%; }
.sub3_tab:hover > .sub3_img > img { transform: scale(1.1); }

.sub3_more { position: absolute; bottom: -18px; right: -10px; display: none; }
.sub3_tab:hover > a > .sub3_more { display: block; }
</style>

<div class="sub3_div">
	<img src="/res/images/sub3/<?=$subNum?>.jpg" alt="건설기계종합정비 서브" />

	<div class="sub3_moreArea">
		<?for($i=1; $i<=4; $i++) {?>
			<div onclick="menulink('menu03-<?=$i?>')" class="sub3_tab">
				<? outLine() ?>

				<div class="sub3_img"><img src="/res/images/sub3/more/<?=$i?>.jpg" alt="건설기계종합정비 서브 탭" /></div>
				<img src="/res/images/sub3/more/title/<?=$i?>.jpg" alt="건설기계종합정비 서브 타이틀" />

				<a href="#menulink" onclick="menulink('menu()')"><img src="/res/images/m1/more.png" alt="더보기" class="sub3_more"/></a>
			</div>
		<?}?>
	</div>
</div>