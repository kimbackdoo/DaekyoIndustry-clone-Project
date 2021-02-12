<style>
.m1_div { width: 1200px; margin: 0 auto; padding-bottom: 73px; }

.m1_div-div1 { padding: 60px 0; color: #000; font-size: 35px; text-align: center; }
.m1_div-div1 > img { vertical-align: middle; }

.m1_div-div2 { width: 100%; height: 362px; }
.m1_div-div2 > div { width: 381px; height: 100%; position: relative; float: left; margin-left: 28px; cursor: pointer; box-shadow: 5px 10px 15px 0px rgba(0,0,0,0.3); }
.m1_div-div2 > div:first-child { margin-left: 0; }

.m1_div-div2 > div:hover > span:nth-child(2n+1) { width:100%; }
.m1_div-div2 > div:hover > span:nth-child(2n) { height: 100%; } 

.m1_more { position: absolute; bottom: -18px; right: -12px; display: none; }
.m1_div-div2 > div:hover > a > .m1_more { display: block; }
</style>

<div class="m1_div">
	<div class="m1_div-div1">
		<img src="/res/images/m1/logo.png" alt="로고" />
		(주)대교산업에 오신것을 환영합니다.
	</div>
	
	<div class="m1_div-div2">
		<?for($i=1; $i<=3; $i++) {?>
			<div style="background:url('/res/images/m1/m1_<?=$i?>.png') no-repeat center center;">
				<? outLine() ?>

				<a href="#menulink" onclick="menulink('menu01-<?=$i?>')"><img src="/res/images/m1/more.png" alt="더보기" class="m1_more"/></a>
			</div>
		<?}?>
	</div>
</div>