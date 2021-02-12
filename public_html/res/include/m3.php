<style>
.m3_div { width: 1200px; height: 317px; margin: 0 auto; padding: 88px 0 101px 0; position: relative; }

.m3_title { height: 53px; line-height: 32px; font-size: 35px; padding-bottom: 30px; }
.m3_title > div { float: left; margin-left: 14px; }
.m3_title > div:first-child { margin-left: 0; }
.m3_title > div:first-child > span { font-size: 50px; font-weight: bold; }
.m3_line { width: 244px; height: 2px; background: #000; margin: 20px 0; }

.m3_more { width: 171px; height: 53px; position: absolute; top: 80px; right: 16px;
			font-size: 16px; font-weight: 400; line-height: 53px; text-align: center;
			border-top: 1px solid #9f9f9f; border-bottom: 1px solid #9f9f9f; box-sizing: border-box; 
			cursor: pointer; z-index: 2; }
.m3_more::before { content:""; width: 17px; height: 53px; position: absolute; top: -1px; left: -16px; background: url('/res/images/more_before.png') no-repeat center top; }
.m3_more::after { content:""; width: 17px; height: 53px; position: absolute; top: -1px; right: -16px; background: url('/res/images/more_afterw.png') no-repeat center top; }

.m3_more > div { width: 0; height: 100%; position: absolute; background: #074dbf; transition: .6s all; z-index: -1; }
.m3_more:hover { color: #fff; }
.m3_more:hover > div { width: 70%; }

.m3_more > img { margin-left: 25px; }
</style>

<div class="m3_div">
	<div class="m3_title">
		<div>
			<span>NOTICE</span>&nbsp;&nbsp;공지사항
		</div>	
		<div class="m3_line"></div>
	</div>

	<div class="m3_more" onclick="menulink('menu05-1')">
		<div></div>
		READ MORE<img src="/res/images/m2/arrow.png" alt="화살표" />
	</div>
	
	<?=latest("basic", "5_1_1_1", 12, 35); ?>
</div>