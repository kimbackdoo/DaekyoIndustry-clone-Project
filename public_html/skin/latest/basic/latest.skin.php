<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>

<style>
.notice { position: relative; width: 590px; height: 234px; float: left; margin-left: 20px; background: #fff; cursor: pointer; color: #000; box-sizing: border-box; border: 1px solid #cfcdce; padding: 66px 0 0 46px; }

.notice > div { overflow:hidden; text-overflow:ellipsis; white-space:normal; word-wrap:break-word; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; word-break:break-all; text-align: left; font-size: 18px; font-weight: 300; }

.notice > .notice_title { font-size: 20px; font-weight: 400; }
.notice > .notice_content { color:#222; height: 60px; margin-top: 10px; }

.notice:hover > span:nth-child(2n+1) { width: 100%; }
.notice:hover > span:nth-child(2n) { height: 100%; }
</style>

<?for($i=0; $i<2; $i++) {?>
	<div class="notice" onclick="location.href='<?=$list[$i][href]?>'" <?=$i==0 ? "style='margin-left: 0px;'" : ""?>>
		<? outLine() ?>

		<div class="notice_title">
			<?=cut_str($list[$i][wr_subject], 58, '..');?>
		</div>

		<div class="notice_content">
			<?=strip_tags(cut_str($list[$i][wr_content], 300, '..'));?>
		</div>

		<div class="notice_date">
			<?=date("Y.m.d",strtotime($list[$i][wr_datetime]));?>
		</div>

		<? if (count($list) == 0) { ?><font color=#6A6A6A>게시물이 없습니다. <? } ?>
	</div>
<?}?>