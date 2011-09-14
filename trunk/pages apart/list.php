<?php
// 总数, 第页显示数, 当前页码, 基础链接
function multi($num, $perpage, $curpage, $mpurl) {
global $_SCONFIG;
$page = 5;
$multipage = '';
// F:
$mpurl .= strpos($mpurl, '?')!==false ? '&' : '?';
$realpages = 1;
if($num > $perpage) {
  $offset = 2;
  $realpages = @ceil($num / $perpage);
  $pages = $_SCONFIG['maxpage'] && $_SCONFIG['maxpage'] < $realpages ? $_SCONFIG['maxpage'] : $realpages;
  if($page > $pages) {
   $from = 1;
   $to = $pages;
  } else {
   $from = $curpage - $offset;
   $to = $from + $page - 1;
   if($from < 1) {
    $to = $curpage + 1 - $from;
    $from = 1;
    if($to - $from < $page) {
     $to = $page;
    }
   } elseif($to > $pages) {
    $from = $pages - $page + 1;
    $to = $pages;
   }
  }
  $multipage = ($curpage - $offset > 1 && $pages > $page ? '<a href="'.$mpurl.'page=1" class="first">首页</a>' : '<a href="'.$mpurl.'page=1" class="first">首页</a>').
   ('<a href="'.$mpurl.'page='.($curpage - 1).'" class="prev">上一页</a>');
  for($i = $from; $i <= $to; $i++) {
   $multipage .= $i == $curpage ? '<strong>'.$i.'</strong>' :
    '<a href="'.$mpurl.'page='.$i.'">'.$i.'</a>';
  }
  $multipage .= ('<a href="'.$mpurl.'page='.($curpage + 1).'" class="next">下一页</a>').
   (0 && $to < $pages ? '<a href="'.$mpurl.'page='.$pages.'" class="last">末页</a>' : '<a href="'.$mpurl.'page='.$pages.'" class="last">末页</a>');
  $multipage = $multipage ? '<div class="pages">'.'<em> 共'.$num.'个 </em>'.$multipage.'</div>' : '<div class="pages">'.'<em> '.$num.' </em>'.$multipage.'</div>';
} else{ // 只有一页也显示分页
  $multipage = '<div class="pages"><em> 共'.$num.'个 </em><a href="#" class="first">首页</a><a href="#" class="prev">上一页</a><strong>1</strong><a href="#" class="next">下一页</a><a href="#" class="last">末页</a></div>';
}
$maxpage = $realpages;
return $multipage;
}

//调用方法
// 初始化
$perpage = 10;
$count  = 0;
$page = empty($_GET['page'])?0:intval($_GET['page']);
if($page<1) $page = 1;
// 基础链接
$theurl = "list.php?id=1";
// LIMIT 开始
$start = ($page-1)*$perpage;
// 数据总数
$count = $db->result($db->query("Select COUNT(*) FROM `list`"), 0);

// 查询 
$sql = "Select * from `list` LIMIT $start, $perpage";
$db->query($sql); 
//..........doing.....
// 输出分页
$pagehtml = multi($count, $perpage, $page, $theurl);

?>