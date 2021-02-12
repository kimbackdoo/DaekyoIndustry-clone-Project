<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<?if(!defined("__INDEX")){?>
	<?if($bo_table){?>
	</div>
	<?}?>
	</section>
</section>
</div>
<?}?>

<? 
if(file_exists("{$g4[path]}/res/include/sub{$tott}full.php")) {
	include_once("$g4[path]/res/include/sub{$tott}full.php");
}else if(file_exists("{$g4[path]}/res/include/sub{$tot}full.php")) {
	include_once("$g4[path]/res/include/sub{$tot}full.php");
}else if(file_exists("{$g4[path]}/res/include/sub{$pageNum}full.php")) {
	include_once("$g4[path]/res/include/sub{$pageNum}full.php");
}?>

<style>
.infoArea { width: 100%; height: 71px; border-top: 1px solid #d4d4d4; }
.infoArea > div { width: 1200px; height: 100%; margin: 0 auto; }

.infoArea .infoAreaLeft { float: left; font-size: 16px; line-height: 71px; font-weight: 500; }
.infoArea .infoAreaLeft > img { vertical-align: middle; }

.infoArea .infoAreaRight { float: right; line-height: 71px; position: relative; }
.infoArea .infoAreaRight > li { float: left; }
.infoArea .infoAreaRight > li:not(:first-child)::before { content: ""; width: 1px; height: 24px; margin: 0 31px; display: inline-block; position: relative; top: 7px; background: #ccc; }

.infoArea .infoAreaRight > li > a { color: #000; font-size: 16px; }
.infoArea .infoAreaRight > li:first-child > a:hover { color: #fdbf5c; }
.infoArea .infoAreaRight > li:last-child > a:hover { color: #a0d5ea; }
.infoArea .infoAreaRight > li > a > img { vertical-align: middle; padding-right: 10px; }

.topBtn { position: fixed; bottom: 216px; right: 0; cursor: pointer; z-index: 99; }
.noneTop { display: none; }

.position > p { font-size: 15px; color: #b1b1b1; }
.position > p:nth-child(1) { line-height: 25px; }
.position > p:nth-child(2) { line-height: 55px; }
.position > p:nth-child(2) > img { cursor: pointer; }

.position2 { position: absolute; right: 0; top: 31px; }
.position2 > li { float: left; }
.position2 > li:not(:first-child)::before { content:""; width:1px; height:14px; position:relative; top:2px; display:inline-block; margin:0 16px; background:#fff; }
.position2 > li > a { color: #fff; font-size: 15px; }

.position3 { position: absolute; right: 0; top: 75px; }
</style>

<div class="infoArea">
	<div>
		<div class="infoAreaLeft">
			<img src="/res/images/bottom/ques.png" alt="Question" />
			계약자들의 편의를 위해 각종 안내 및 조회 서비스 제공해드립니다.
		</div>

		<ul class="infoAreaRight">
			<li><a  href="#menulink" onclick="menulink('menu05-2')"><img src="/res/images/bottom/ask.png" alt="문의" />견적문의</a></li>
			<li><a  href="#menulink" onclick="menulink('menu06-1')"><img src="/res/images/bottom/lib.png" alt="자료실" />자료실</a></li>
		</ul>
	</div>

	<img src="/res/images/bottom/top.png" alt="탑버튼" onclick="gotoTop()" class="topBtn" />
</div>

<div class="wrap-footer">
	<footer class="layout">
		<div class="position">
			<p>
				본사. 경기도 화성시 정남면 만년로 98번길 49-14&nbsp;&nbsp;&nbsp;제주사업장. 제주특별자치도 제주시 통물길 148-2<br/>
				법인등록번호. 134811-0510570&nbsp;&nbsp;&nbsp;사업자등록번호. 284-88-01319<br/>
				Tel. 031-8059-2011&nbsp;&nbsp;&nbsp;Fax. 031-8059-2012&nbsp;&nbsp;&nbsp;E-mail. daekyoco@naver.com
			</p>

			<p>
				Copyright &copy; 2020 <?=$g4{'title'}?>. All Rights Reserved.
				<img src="/res/images/bottom/it9.png" alt="아이티나인" onclick="it9()" />
			</p>
		</div>

		<ul class="position2">
			<li><a href="#copylink" onclick="guide2()">이용약관</a></li>
			<li><a href="#copylink" onclick="info2()">개인정보처리방침</a></li>
			<li><a href="#copylink" onclick="adm()">관리자페이지</a></li>
		</ul>

		<img src="/res/images/bottom/logo.png" alt="로고" class="position3" />
	</footer>
</div>

</div>
<?
include_once("$g4[path]/tail.sub.php");
?>