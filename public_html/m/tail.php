<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$call = sql_fetch("SELECT COUNT(*) cnt FROM g4_call_log");
?>

<?if($bo_table){?>
	</div>
<?}?>


<img src="/m/images/main_info.jpg" alt="전화번호, 계좌번호">

<style>
#snsArea { position:fixed; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.7); display:none; z-index:400; }

#right_q { width:66px; height:150px; position:fixed; right:20px; bottom:30px; z-index:999; }
.rq_1 { position:absolute; right:7px; top:0px; z-index:999; display:none; }
.rq_2 { position:absolute; right:7px; top:0px; z-index:999; display:none; }

.rq_btn { position:absolute; top:0px; right:0; z-index:999; }
.rq_gotop { position:absolute; bottom:0px; right:0; z-index:999; }
.rq_chat { position:absolute; bottom:87px; left:20px; z-index:999; }
</style>

<div id="right_q">
	
	<img src="/m/images/bot_quick/open_2.png" class="rq_1" onclick="callNumber('010-3698-1325')" />

	<img src="/m/images/bot_quick/open_1.png" class="rq_2" onclick="menum('menu01-2')"/>

	<img src="/m/images/bot_quick/plus.png" class="rq_btn" />

	<img src="/m/images/bot_quick/top.png" class="rq_gotop" onclick="gotoTop()" />
	
	

	<script type="text/javascript">
	var is_rq_open = false;

	$(function(){
		$(".rq_btn").click(function(){
			if(is_rq_open){
				$(".rq_1").stop().animate({"top":"0px"}, 400, function(){
					$(this).hide();
				});
				$(".rq_2").stop().animate({"top":"0px"}, 400, function(){
					$(this).hide();
				});
				$(".rq_3").stop().animate({"top":"0px"}, 400, function(){
					$(this).hide();
				});
				$(".rq_btn").attr("src", "/m/images/bot_quick/plus.png");

				
				$("#snsArea").fadeOut(400);

				is_rq_open = false;
			}else{
				$("#snsArea").show();
				
				$(".rq_1").show().stop().animate({"top":"-142px"}, 400);
				$(".rq_2").show().stop().animate({"top":"-71px"}, 400);

				$(".rq_btn").attr("src", "/m/images/bot_quick/close.png");

				is_rq_open = true;
			}
		});
	});	
	</script>

</div>

<img src="/m/images/bot_quick/chat.png" class="rq_chat" onclick="<?=$talk_link?>" />

<script type="text/javascript">

    $(function(){
		 check_chat();

        $(window).scroll(function () {
            check_chat();
        });
        $(window).resize(function(){
            check_chat();
        });
    });

    function check_chat(){
        var scrollTop = $(document).scrollTop();

        var scrollHeight = $("body").prop("scrollHeight");
        var footerHeight = $("footer.copy").height();

        if(scrollHeight - footerHeight < scrollTop + $(window).height()) {
            $("#right_q, .rq_chat").css({"position":"absolute", "bottom":(footerHeight-259)+"px"});
        }else{
            $("#right_q, .rq_chat").css({"position":"fixed", "bottom":"30px"});
        }
    }

</script>

<footer class="copy">
	<img src="<?=$g4[mpath]?>/images/copy.jpg" usemap="#copy" />
	<map name="copy" id="copy">
		<area shape="rect" coords="260,255,380,285" href="javascript:<?=$member["mb_id"] ? "adm" : "login"?>();" alt="관리자">
	</map>
</footer>
<?preg_match("/오늘:(.*),어제:(.*),최대:(.*),전체:(.*)/", $config['cf_visit'], $visit);settype($visit[0], "integer");settype($visit[1], "integer");settype($visit[2], "integer");settype($visit[3], "integer");?>
<div style="position:relative;width:640px;height:40px;font-size:18px;background:#222222;color:#dadada;text-align:center;z-index:20;margin-top:-2px; margin-bottom:100px;">
	<div style="margin:6px 0 0;display:inline-block;">
		<span>Today</span>
		<span style="font-weight:bold;margin-left:8px;"><?=$visit[1]?></span>
	</div>
	<div style="margin:6px 0 0 30px;display:inline-block;">
		<span>Total</span>
		<span style="font-weight:bold;margin-left:8px;"><?=$visit[4]?></span>
	</div>
</div>


</div><!-- #menu_cover_area -->

</div><!-- #wrap -->



<?if($config["cf_kakao_key"]){?>
<script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
<script>
// 사용할 앱의 Javascript 키를 설정해 주세요.
Kakao.init('<?=$config["cf_kakao_key"]?>');
</script>
<?}?>


<!--
<script>
// 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
Kakao.Link.createTalkLinkButton({
  container: '#kakao-link-btn',
  label: '안녕하세요. <?=$config[cf_title]?>입니다.',
  image: {
    src: 'http://<?=$_SERVER[SERVER_NAME]?>/m/images/kakao_img.jpg',
    width: '300',
    height: '150'
  },
  webButton: {
	text: '<?=$config[cf_title]?>',
	url: 'http://antispam.1937.co.kr/kakaolink.php?link_url=http://<?=$_SERVER[SERVER_NAME]?>/m/' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
  }
});
</script> -->

<?
include_once($g4[mpath]."/tail.sub.php");
?>
