<?php
  require_once "simple_html_dom.php";

  // html取得
  $html = file_get_html('https://disneyreal.asumirai.info/realtime/disneyland-wait-today-ls.html');

  // アトラクション名取得
  $names = array();
  foreach($html->find('.th span') as $node) {
    $value = $node->plaintext;
    array_push($names, $value);
  }

  // 平均待ち時間取得
  $times = array();
  $colCount = 0;
  $skipCount = 0;
  // foreach($html->find('.ave .time, .ave [class^="w"], .ave .closure, .ave .na') as $node){
  foreach($html->find('.ave') as $aveNode){
    foreach($aveNode->children as $node){
      $value = $node->plaintext;
      if ($value == 'PP 終了') {
        $skipCount = $colCount - 1;
      } else if ($skipCount > 0) {
        $skipCount = $skipCount - 1;
      } else if ($value == '平均') {
        $colCount = 0;
        array_push($times, $value);
      } else {
        $colCount = $colCount + 1;
        array_push($times, $value);
      }
    }  
  }  

  // JSON配列にアトラクション名(name), 平均時間(time)を設定
  $arrays = array();
  for ($i = 0; $i < count($names); $i++) {
    array_push($arrays, ['name'=>$names[$i], 'time'=>$times[$i]]);
  }

  // JSON出力
  header("Content-type: application/json; charset=UTF-8; Access-Control-Allow-Origin: *");
  echo json_encode($arrays);
?>
