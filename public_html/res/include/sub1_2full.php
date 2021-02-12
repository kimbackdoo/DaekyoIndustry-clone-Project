<style>
.sub1_2-div { width: 100%; height: 100%; text-align: center; }

.sub1_2-tab { width: 1200px; height: 72px; margin: 0 auto; background: #f5f5f5; }
.sub1_2-tab > li { width: 300px; height: 100%; box-sizing: border-box; float: left;  border-right: 1px solid #ccc; font-size: 20px; line-height: 72px; cursor: pointer; }
.sub1_2-tab > li:last-child { border: 0; }
.sub1_2-tab > li.on { color: #fff; background: #074dbf; }
</style>

<div class="sub1_2-div">
	<ul class="sub1_2-tab">
		<li class="on">2020's</li>
		<li>2010's</li>
		<li>2000's</li>
		<li>1990's</li>
	</ul>

	<?
		for($i=1; $i<=4; $i++) {
			echo "<img src='/res/images/sub1_2/".$i.".jpg' alt='콘텐츠' style='display:inline-block;' class='sub1_2-".$i."'/>";
		}
	?>
</div>

<script>
	$(".sub1_2-tab > li").click(function() {
		var idx = $(this).index()+1;
		$(".sub1_2-tab > li").removeClass("on");
		$(this).addClass("on");
		$(".sub1_2-div > img").hide();
		$(".sub1_2-"+idx).show();
	});
</script>