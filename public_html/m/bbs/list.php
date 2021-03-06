<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 공지사항의 갯수를 구함[2008-02-03]
$bo_notics_cnt = count(split("\n", trim($board[bo_notice])));
// 만약 내용이 없으면 카운트는 0으로 한다...[2008-04-29]
if(trim($board[bo_notice]) == "") $bo_notics_cnt = 0;

// 분류 사용 여부
$is_category = false;
if ($board[bo_use_category])
{
    $is_category = true;
    $category_location = "./board.php?bo_table=$bo_table&sca=";
    $category_option = get_category_option($bo_table); // SELECT OPTION 태그로 넘겨받음
}

$sop = strtolower($sop);
if ($sop != "and" && $sop != "or")
    $sop = "and";

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx)
{
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from $write_table ";
    $row = sql_fetch($sql);
    $min_spt = $row[min_wr_num];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between '".$spt."' and '".($spt + $config[cf_search_part])."') ";

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    $sql = " select distinct wr_parent from $write_table where $sql_search ";
    $result = sql_query($sql);
    $total_count = mysql_num_rows($result);
}
else
{
    $sql_search = "";

    $total_count = $board[bo_count_write];
}

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
//분류선택시 전체페이지에서 공지사항의 갯수만큼 빼줌.[2008-02-03]
if($min_spt)
 {
 $total_page  = ceil($total_count / $board[bo_page_rows]);
 }else{
 $total_page  = ceil(($total_count - $bo_notics_cnt) / $board[bo_page_rows]);
 }
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($member[mb_id] && ($is_admin == "super" || $group[gr_admin] == $member[mb_id] || $is_admin == "board"))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = "bo_table=$bo_table&sop=$sop";

if ($board[bo_gallery_cols])
    $td_width = (int)(100 / $board[bo_gallery_cols]);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst)
{
    $sod = "";
    if ($board[bo_sort_field]) {
        $sst = $board[bo_sort_field];
		if($sst == "wr_datetime desc" || $sst == "wr_datetime asc") {	
			$sstTmp = explode(" ", $sst);
			$sst = $sstTmp[0];
			$sod = $sstTmp[1];
		}
	}
    else
        $sst  = "wr_num, wr_reply";
}
else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if ($sst)
    $sql_order = " order by $sst $sod ";
$list = array();
$i = 0;

if (!$sca && !$stx)
{
    $arr_notice = explode("\n", trim($board[bo_notice]));
    for ($k=0; $k<count($arr_notice); $k++)
    {
        if (trim($arr_notice[$k])=='') continue;

        $row = sql_fetch(" select * from $write_table where wr_id = '$arr_notice[$k]' ");

        if (!$row[wr_id]) continue;

        $list[$i] = get_mlist($row, $board, $board_skin_mpath, $board[bo_subject_len]);
        $list[$i][is_notice] = true;
		$notice_order .= " and wr_id != '$arr_notice[$k]'";//추가[2008-02-03]
        $i++;
    }
}
if ($sca || $stx)
{
	if ($sod != ""){
		$sql = " select distinct a.wr_parent, (select {$sst} FROM $write_table WHERE wr_num=a.wr_num AND wr_reply = '' AND wr_is_comment=0) p_{$sst} from $write_table a where $sql_search ORDER BY p_{$sst} {$sod},wr_num, wr_reply limit $from_record, $board[bo_page_rows] ";
	} else {
		$sql = " select distinct wr_parent from $write_table where $sql_search $sql_order limit $from_record, $board[bo_page_rows] ";
	}
}
else
{
	if ($sod != ""){
		$sql = " select a.*, (select {$sst} FROM $write_table WHERE wr_num=a.wr_num AND wr_reply = '' AND wr_is_comment=0) p_{$sst} from $write_table a where wr_is_comment = 0 $notice_order ORDER BY p_{$sst} {$sod}, wr_num, wr_reply limit $from_record, $board[bo_page_rows] ";//$notice_order 추가[2008-02-03]
	} else {
	    $sql = " select * from $write_table where wr_is_comment = 0 $notice_order $sql_order limit $from_record, $board[bo_page_rows] ";//$notice_order 추가[2008-02-03]
	}
}
$result = sql_query($sql);



// 년도 2자리
$today2 = $g4[time_ymd];
$k = 0;

while ($row = sql_fetch_array($result))
{
    // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
    if ($sca || $stx)
        $row = sql_fetch(" select * from $write_table where wr_id = '$row[wr_parent]' ");

    $list[$i] = get_mlist($row, $board, $board_skin_mpath, $board[bo_subject_len]);
    if (strstr($sfl, "subject"))
        $list[$i][subject] = search_font($stx, $list[$i][subject]);
    $list[$i][is_notice] = false;
    //$list[$i][num] = number_format($total_count - ($page - 1) * $board[bo_page_rows] - $k);
    $list[$i][num] = $total_count - ($page - 1) * $board[bo_page_rows] - $k;
	//공지사항이 있을경우 총 게시물에서 수량을 빼서 번호를 맞춤. 분류선택시 번호조절 [2008-02-07] ' - $bo_notics_cnt' 추가 및 수정
	if($board[bo_notice])
	{
   if ($min_spt)
    {
    $list[$i][num] = $total_count - ($page - 1) * $board[bo_page_rows] - $k;
    }else{
     $list[$i][num] = $total_count - ($page - 1) * $board[bo_page_rows] - $k - $bo_notics_cnt;
    }
   }else{
    $list[$i][num] = $total_count - ($page - 1) * $board[bo_page_rows] - $k;
   }
    $i++;
    $k++;
}

$write_pages = get_paging2($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=");

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx)
{
    $list_href = "./board.php?bo_table=$bo_table";

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config[cf_search_part];
    if (isset($min_spt) && $prev_spt >= $min_spt)
        $prev_part_href = "./board.php?bo_table=$bo_table".$qstr."&spt=$prev_spt&page=1";

    $next_spt = $spt + $config[cf_search_part];
    if ($next_spt < 0)
        $next_part_href = "./board.php?bo_table=$bo_table".$qstr."&spt=$next_spt&page=1";
}

$write_href = "";
if ($member[mb_level] >= $board[bo_write_level])
    $write_href = "./write.php?bo_table=$bo_table";

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = "<nobr style='display:block; overflow:hidden;'>";
    $nobr_end   = "</nobr>";
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = "";
if ($board[bo_use_rss_view])
    $rss_href = "./rss.php?bo_table=$bo_table";

$stx = get_text(stripslashes($stx));
include_once("$board_skin_mpath/list.skin.php");
?>
