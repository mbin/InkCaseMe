<?php
#############################################################################
# 功能：图片浏览器
# 使用：
#     1.将根目录的app.txt内容写为jpg
#     2.在本目录里复制任意数量，任意大小的jpg图片
#     3.按一次后翻一张，长按为前翻
# 修改：
#     20170408 基于代码库减少代码量
#############################################################################

define("APP_BASE",dirname(__FILE__) . "/" );
include(APP_BASE."/../system/inkcase5.inc.php");

$page   = isset($argv[1]) ? $argv[1] : "n";
$Offset = 0;



$dh = opendir(APP_BASE);
$afn=[];
while($item = readdir($dh) ){
  if( $item{0} == "."){
    continue;
  }
  if( ! strstr(strtolower($item),"jpg" ) ){
    continue;
  }
  $afn [] = $item;
}
#按字节顺序对文件名排序
sort($afn);

$jpg = get_next_file( $afn );
showjpg( APP_BASE . $jpg );

function get_next_file(array $afn ){
  define("IDX_FILE", APP_BASE . "index" );
  if( ! file_exists( IDX_FILE ) ){
    file_put_contents( IDX_FILE , "-1");	
  }
  $fn = intval(file_get_contents(IDX_FILE)) ;
  if ($page == "n") {
    $fn++;
  } else {
    $fn--;
    if( $fn < 0 ){
      $fn=0;
    }
  }
  $fn %= sizeof($afn);
  file_put_contents( IDX_FILE , $fn );
  return $afn[$n];
}
$jpg = $afn[$fn];



