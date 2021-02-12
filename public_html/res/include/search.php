<style>
.search_test { width: 1200px; margin: 0 auto; padding: 20px 0 80px 0; }
.search_test > p { text-align: center; font-size: 60px; font-weight: bold; }

.search_table { width: 100%; border-collapse: collapse; text-align: center; }
.search_table > thead > tr > th { background: #f8f8f8; }
.search_table th,
.search_table td { height: 50px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; }
.search_table td > a { color: #000; }
.search_table tr:hover { background: #f8f8f8; }
</style>

<?
	$bo_sql = "SELECT * FROM g4_board";
	$bo_result = sql_query($bo_sql);
	$cnt = 0;
?>

<div class="search_test">
	<?
		if($stx=="")
			echo "<p>''에 대한 검색결과가 없습니다.</p>"; 
		
		else {
	?>
		<table class="search_table">
			<thead>
				<tr>
					<th style="width:45px;">번호</th>
					<th style="width:150px;">게시판</th>
					<th style="width:350px;">제목</th>
					<th style="width:150px;">작성자</th>
					<th style="width:100px;">작성일</th>
					<th style="width:45px;">조회</th>
				</tr>
			</thead>
			<tbody>
				<?
					while($bo_arr = sql_fetch_array($bo_result)) {
						$wr_sql = "SELECT * FROM g4_write_{$bo_arr[bo_table]} WHERE (wr_subject like '%{$stx}%' or wr_content like '%{$stx}%')";
						$wr_result = sql_query($wr_sql);
						
						$tmp_arr = array();
						while($wr_arr = sql_fetch_array($wr_result))
							array_push($tmp_arr, $wr_arr);

						if(count($tmp_arr) > 0) {
							for($i=0; $i<count($tmp_arr); $i++) {
								echo "<tr>";
								echo "<td>".(++$cnt)."</td>";
								echo "<td>".$bo_arr["bo_subject"]."</td>";
								echo "<td><a href=\"/bbs/board.php?bo_table=".$bo_arr["bo_table"]."&wr_id=".$tmp_arr[$i]["wr_id"]."\" >".$tmp_arr[$i]["wr_subject"]."</a></td>";
								echo "<td>".$tmp_arr[$i]["wr_name"]."</td>";
								echo "<td>".date("Y.m.d",strtotime($tmp_arr[$i]["wr_datetime"]))."</td>";
								echo "<td>".$tmp_arr[$i]["wr_hit"]."</td>";
								echo "</tr>";
							}
						}
					}
				?>
			</tbody>
		</table>
	<?}?>
</div>