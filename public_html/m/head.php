<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once($g4[mpath]."/head.sub.php");
include_once($g4['path']."/lib/calendar.php");
set_session("ss_is_pc_view", "");

if($p){
$ppage=explode("_",$p);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

if($bo_table){
	$ppage=explode("_",$bo_table);
	$pageNum=$ppage[0];
	$subNum=$ppage[1];
	$ssNum=$ppage[2];
	$tabNum=$ppage[3];
}

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

$tot=$pageNum."_".$subNum;
$tott=$pageNum."_".$subNum."_".$ssNum;

$cartcnt = get_cart_count(get_session("ss_on_uid"));

// 모바일 변수설정
$board_skin_mpath = $g4[mpath]."/skin/board/".$board[bo_skin];


//모바일 실시간채팅
$ninetalk_key = sql_fetch("SELECT site_key FROM ninetalk_site_key limit 0,1", false);
$talk_link = "location.href='".$g4["mpath"]."/ninetalk.php?site_key=".$ninetalk_key[site_key]."&return_url=".$_SERVER[HTTP_HOST].urlencode($_SERVER[REQUEST_URI])."'";



$menu = array();

$menu["pageNum"][1] = "대메뉴1번";
	$menu["tot"][1][1] = "인사말";
		$menu["tott"][1][1][1] = $menu["tot"][1][1];
			$menu["p"][1][1][1][1] = $menu["tott"][1][1][1];
			$menu["p"][1][1][1][2] = "인사말 TabNum2";
		$menu["tott"][1][1][2] = "둘째인사말2";
		$menu["tott"][1][1][3] = "셋째인사말3";
		$menu["tott"][1][1][4] = "넷째인사말4";
	$menu["tot"][1][2] = "사업소개";


$menu["pageNum"][2] = "객실정보";
	$menu["tot"][2][1] = "A룸";
	$menu["tot"][2][2] = "B룸";
	$menu["tot"][2][3] = "C룸";


$menu["pageNum"][3] = "부대시설";
	$menu["tot"][3][1] = "야외수영장";
	$menu["tot"][3][2] = "카페";
	$menu["tot"][3][3] = "바베큐";


?>


<?if(defined("__INDEX")){
//팝업관리
if(file_exists("$g4[path]/lib/popmng.mobile.lib.php")){ //모바일 팝업관리자 지원되는 셋팅버전인지 확인
	include_once("$g4[path]/lib/popmng.mobile.lib.php");
}
}?>


<script>
function gotoTop(){
	jQuery('html, body').animate( {scrollTop:0} ,300);
}
</script>

<!-- 전화걸기 스크립트 -->
<script type="text/javascript">

var callFlag = true;
function callNumber(num){   
   if(callFlag){
	   $.post("<?=$g4[mpath]?>/_ajax_call_log.php", null, function(){
		callFlag = false;
		location.href="tel:"+num;
	   });
   }
   setTimeout(function(){callFlag=true;}, 1000 * 3);
}
</script>

<div id="snsArea"><!-- right_q 열였을때 뒷배경 -->
</div>

<div id="MenuArea" onclick="menuclose()">
</div>


<style type="text/css">
#MenuArea {position:fixed; width:100%; height:100%; left:0; top:0; background-color:#000000;filter:alpha(opacity=50);opacity:.7; z-index:9999; display:none;}
#MenuZone {position:absolute; width:480px;background:#fff; z-index:99999; display:none; left:-480px;}
#MenuZone #Menu .smenu {display:none;}
#MenuZone #Menu .smenu.on {display:block;}
</style>

<script type="text/javascript">
	function menu(){
		jQuery("#MenuZone").height(jQuery("#wrap").height());
		jQuery("#MenuArea").show();
		jQuery("#MenuZone").show();
		jQuery("#MenuZone").animate({left:"0"});
	}
	function menuclose(){
		jQuery("#MenuArea").hide();
		jQuery("#MenuZone").animate({left:"-450px"}, function(){jQuery("#MenuZone").hide();});
	}
</script>

<div id="wrap">

	<div id="MenuZone">
		<img src="/m/images/top/menu_off.png" style="position:absolute; right:-66px; top:42px;" onclick="menuclose()" alt="메뉴닫기">
		<div class="menu_top">
		<?if($is_member){?>
			<img src="/m/images/menu_top/logout.jpg" onclick="logout();" alt="로그아웃">
			<img src="/m/images/menu_top/modify.jpg" onclick="revision()" alt="수정하기">
		<?}else{?>
			<img src="/m/images/menu_top/login.jpg" onclick="login()" alt="로그인">
			<img src="/m/images/menu_top/join.jpg" onclick="register()" alt="회원가입">
		<?}?>
			<img src="/m/images/menu_top/mypage.jpg" onclick="mypage()" alt="마이페이지">
			<img src="/m/images/menu_top/delivery.jpg" onclick="order()" alt="배달">
		</div>
		<img src="/m/images/menu_top/kb.jpg" alt="손해보험">
			

		<ul id="Menu" >
			<?foreach($menu["pageNum"] as $pn=>$pnStr) {?>
				
				<li>
					<a href="" ><?=$pnStr?></a>
					<?if(count($menu["tot"][$pn]) > 0){?>
						<ul>
							<?foreach($menu["tot"][$pn] as $sn=>$snStr) {?>
								<li><a href="" ><?=$snStr?></a></li>
							<?}?>
						</ul>
					<?}?>
				</li>

			<?}?>
		</ul>

		<img src="/m/images/top/naver.jpg" alt="네이버 검색 이미지">

		<div class="menu_quick">
			<img src="/m/images/top/menuq_1.jpg" onclick="menum('menu01-1')" alt="건강원 소개">
			<img src="/m/images/top/menuq_2.jpg" onclick="menum('menu01-2')" alt="오시는 길">
			<img src="/m/images/top/menuq_3.jpg" onclick="menum('menu05-1')" alt="공지사항">
			<img src="/m/images/top/menuq_4.jpg" onclick="menum('menu05-2')" alt="문의하기">
		</div>

	</div>
	
	<header>
		<img src="/m/images/top/menu_on.png" class="menu" onclick="menu()" alt="메뉴오픈">
		<img src="/m/images/top/ci.png" class="ci" onclick="home()" alt="로고">
		<a href="/m/shop/cart.php">
			<div class="top_cart">
				<span><?=$cartcnt?></span>
			</div>
		</a>
		</form>
		
	</header>

	

	<div id="menu_cover_area">
		<?if(!defined("__INDEX")){?>

			<?
			$subcount;
			if($pageNum == "1"){
				$subcount = 2;
			}else if($pageNum == "2"){
				$subcount = 4;
			}else if($pageNum == "3"){
				$subcount = 1;
			}else if($pageNum == "4"){
				$subcount = 1;
			}else if($pageNum == "5"){
				$subcount = 2;
			}else if($pageNum == "100"){
				$subcount = 0;
			}
			?>
			<script type="text/javascript">
			$(function(){

				var a = new Array();					var b = new Array();
				a["a1_1"] = "인사말";						b["b1"] = "二代약초건강원";
				a["a1_2"] = "오시는 길";

				a["a2_1"] = "칡즙";							b["b2"] = "상품소개";
				a["a2_2"] = "배+도라지즙";
				a["a2_3"] = "양파즙";
				a["a2_4"] = "자색양파즙";

				a["a3_0"] = "전체상품";
				a["a3_1"] = "칡즙";							b["b3"] = "구매하기";
				a["a3_2"] = "배+도라지즙";
				a["a3_3"] = "양파즙";
				a["a3_4"] = "자색양파즙";

				a["a4_1"] = "산행이야기";					b["b4"] = "산행이야기";

				a["a5_1"] = "공지사항";						b["b5"] = "고객센터";
				a["a5_2"] = "문의하기";

				a["a100_1"] = "로그인";						b["b100"] = "二代약초건강원";
				a["a100_2"] = "정보수정";
				a["a100_3"] = "회원가입";
				a["a100_5"] = "장바구니";
				a["a100_6"] = "My Page";
				a["a100_7"] = "개인정보처리방침";
				a["a100_8"] = "이용약관";
				a["a100_9"] = "주문배송조회";
				a["a100_10"] = "주문상세내역";
				a["a100_11"] = "주문하기";
				a["a100_12"] = "주문 확인 및 결제";
				a["a100_13"] = "주문완료";
				a["a100_14"] = "주문내역";
				a["a100_15"] = "상품검색";
				a["a100_16"] = "이메일무단수집거부";
				a["a100_17"] = "결제완료";
				a["a100_18"] = "관심상품";

				var tit_a = a["a<?=$tot?>"];
				var tit_b = b["b<?=$pageNum?>"];

				$(".ru1, .bt1").html(tit_b); //대메뉴
				$(".st1, .st4, .ru2, .st2").html(tit_a); //소메뉴

				for (var t=1; t<="<?=$subcount?>";t++ ){
					var tablist = a["a<?=$pageNum?>_"+t];
					$("#tab_li_"+t+" span").html(tablist);
				}
				
				

			});
			</script>

			<section class="content">
				<div class="subvisual" style="background:url('/m/images/subvisual/s.jpg') no-repeat center top;">
					<?if($subcount > 1 || !$pageNum == 3){?>
					<div class="tab_div">
						<ul class="tab_ul">
							<?for($t=1; $t<=$subcount;$t++){?>
								<li id="tab_li_<?=$t?>" class="<?=$subNum == $t ? "on abc" : ""?>" onclick="menum('menu0<?=$pageNum?>-<?=$t?>');" ><span></span></li>
							<?}?>
						</ul>
					</div>
					<?}?>
				</div>
				
				<div class="title_div">
					<p class="st2"></p>
				</div>
				
				

				


			</section>
					<?if($bo_table){?>
				<div class="boardarea">
			<?}?>
		<?}?>