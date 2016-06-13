<?php
$app->get('/init', function() {
  $user_key = ['user', 'pass', 'type', 'name'];
  $user = [
    ['can01', '12345', 'can', '張宛萍'],
    ['can02', '23456', 'can', '林涵易'],
    ['can03', '23456', 'can', '李海卉'],
    ['can04', '23456', 'can', '賴碧珊'],
    ['can05', '23456', 'can', '陳依夢'],
    ['con01', '12345', 'con', '黃映萱'],
    ['con02', '23456', 'con', '吳向波']
  ];
  foreach($user as $u) {
    if(!R::findOne('user', ' user = ? ', [$u[0]])) {
      $ub = R::dispense('user');
      foreach($user_key as $index => $key) {
        $ub[$key] = $u[$index];
      }
      R::store($ub);
    }
  }
  $relate = [
    ['can01', 'con01'],
    ['can02', 'con02'],
    ['can03', 'con01'],
    ['can04', 'con02'],
    ['can05', 'con01'],
  ];
  foreach($relate as $r) {
    if(!R::findOne('relate', ' can = ? AND con = ? ', [$r[0], $r[1]])) {
      $rb = R::dispense('relate');
      $rb->can = $r[0];
      $rb->con = $r[1];
      R::store($rb);
    }
  }
  $info_key = ['title', 'category', 'source', 'date', 'content'];
  $info = [
    ['世界最醜生物TOP5 反萌差更吸引人', '寵物中心', 'NOWnews', '2016/5/14 14:30', '國家地理頻道根據「醜陋動物保護協會（Ugly Animal Preservation Society）」的票選，製作全球最醜陋動物的前五名，儘管在世俗的標準下，牠們與其他動物不同，但卻有無法言語的「反萌差」感，讓目光無法離開牠們身上。']
  ];
  foreach($info as $i) {
    $ib = R::dispense('info');
    foreach($info_key as $index => $key) {
      $ib[$key] = $i[$index];
    }
    R::store($ib);
  }
  $client_key = ['name', 'category', 'content', 'date'];
  $client = [
    ['盈富', '電子業', '', '2010/02/02'],
    ['春如', '食品業', '好吃的鳳梨罐頭', '1981/01/01']
  ];
  foreach($client as $c) {
    $cb = R::dispense('client');
    foreach($client_key as $index => $key) {
      $cb[$key] = $c[$index];
    }
    R::store($cb);
  }
});
