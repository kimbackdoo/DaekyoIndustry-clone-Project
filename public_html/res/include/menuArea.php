<style>
.menuArea { width: 1200px; margin: 0 auto; text-align: center; }
#Menu { display: inline-block; }
#Menu > li { float: left; margin-left: 35px; position: relative; }
#Menu > li:first-child { margin-left: 0; }
#Menu > li > a { color: #000; font-size: 17px; line-height: 90px; }
#Menu > li:hover > a { color: #074dbf; border-bottom: 2px solid #074dbf; padding-bottom: 8px; }
#Menu > li:nth-child(3) > ul { width: 80%; left: 18px; }
#Menu > li:nth-child(6) > ul { width: 240%; left: -45px; }
#Menu > li:hover > #SoMenu { display: block; }
#Menu > li.on > a { color: #074dbf; }

#SoMenu { display: none; width: 150%; background: #fff; padding: 27px 0; position: absolute; top: 74px; left: -21px; box-shadow: 5px 10px 15px 0px rgba(0,0,0,0.3); z-index: 2; }
#SoMenu > li { position: relative; }
#SoMenu > li > a { color: #999; font-size: 17px; line-height: 45px; }
#SoMenu > li:hover > a,
#SoMenu > li.on > a { color: #000; }
#SoMenu > li:hover > #SoSoMenu { display: block; }

#SoSoMenu { display: none; width: 100%; position: absolute; top: -27px; left: 174px; background: #fff; border-left: 1px solid rgba(0,0,0,0.1); z-index: 3; }
#SoSoMenu > li > a { color: #999; font-size: 17px; line-height: 45px; }
#SoSoMenu > li:hover > a,
#SoSoMenu > li.on > a { color: #000; }
#Menu > li:nth-child(6) > #SoMenu > li > #SoSoMenu { left: 150px; }
</style>

<div class="menuArea">
	<ul id="Menu" >
		<?foreach($menu["pageNum"] as $pn=>$pnStr) {
			if($pn==100 || $pn==9 || $pn==99) continue;
		?>
			<li <?=$pageNum == $pn ? "class='on'" : ""?>>
				<?if($pn!=6 || $member['mb_id']) {?>
					<a href="#menulink" onclick="menulink('menu<?=sprintf('%02d', $pn)?>-1')"><?=$pnStr?></a>
				<?} else {?>
					<a href="#menulink" onclick="empOnlyChk()"><?=$pnStr?></a>
				<?}?>
				<ul id="SoMenu">
					<?foreach($menu["tot"][$pn] as $sn=>$snStr) {
						$nextCheck = (count($menu["tott"][$pn][$sn]) > 0) ? true : false;
					?>
						<li <?=$tot == $pn."_".$sn ? "class='on'" : ""?> style="<?=$nextCheck ? "background:url('/res/images/top/next.png') no-repeat center right 20px;" : ""?>">
							<?if($pn!=6 || $member['mb_id']) {?>
								<a href="#menulink" onclick="menulink('menu<?=sprintf("%02d", $pn)?>-<?=$sn?>')"><?=$snStr?></a>
							<?} else {?>
								<a href="#menulink" onclick="empOnlyChk()"><?=$snStr?></a>
							<?} if($nextCheck) {?>
								<ul id="SoSoMenu">
									<?foreach($menu["tott"][$pn][$sn] as $ssn=>$ssnStr) {?>
										<li <?=$tott == $pn."_".$sn."_".$ssn ? "class='on'" : ""?>>
											<?if($pn!=6 || $member['mb_id']) {?>
												<a href="#menulink" onclick="menulink('menu<?=sprintf("%02d", $pn)?>-<?=$sn?>-<?=$ssn?>')"><?=$ssnStr?></a>
											<?} else {?>
												<a href="#menulink" onclick="empOnlyChk()"><?=$ssnStr?></a>
											<?}?>
										</li>
									<?}?>
								</ul>
							<?}?>
						</li>
					<?}?>
				</ul>
			</li>
		<?}?>
	</ul>
</div>

<script>
	function empOnlyChk() {
		alert("직원 전용 마씸");
		location.href="/bbs/login.php";
	}
</script>