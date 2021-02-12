<style>
.searchBtn { position: absolute; top: 28px; right: 101px; background: none; border: 0; outline: none; }

.searchZone { display: none; width: 366px; height: 52px; border-radius: 30px; padding: 0 26px; position: absolute; top: 19px; right: 86px; border: 1px solid #0069eb; box-sizing: border-box; }

.searchHash { font-size: 22px; font-weight: bold; line-height: 52px; vertical-align: top; color: #0069eb; }

.searchBox { margin-left: 16px; border: 0; outline: none; font-size: 15px; line-height: 48px; }
.searchBox::placeholder { color: #c4c4bd; }
.searchSubmit { vertical-align: middle; outline: none; margin-bottom: 3px; }
.searchClose { vertical-align: middle; cursor: pointer; margin-left: 16px; }
</style>

<button type="button" class="searchBtn"><img src="/res/images/top/searchBtn.png" alt="검색 버튼" /></button>

<div class="searchZone">
	<form method="get" action="/pages.php" >
		<input type="hidden" name="p" value="99_1_1_1" />
		<span class="searchHash">#</span>
		<input type="text" name="stx" autocomplete="off" placeholder="검색어를 입력하세요." class="searchBox" />
		<input type="image" src="/res/images/top/search_img.png" alt="submit 버튼" class="searchSubmit" />
		<img src="/res/images/top/search_close.png" alt="검색창 닫기" onclick="$('.searchZone').hide(); $('.searchBtn').show();" class="searchClose" />
	</form>
</div>

<script>
	$(".searchBtn").click(function() {
		$(".searchZone").show();
		$(this).hide();
	});
</script>