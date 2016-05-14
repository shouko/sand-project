<?php
$app->get('/info', function() use($app) {
  if(isset($_GET['id'])) {
    $info = R::findOne('info', ' id = ? ', [$_GET['id']]);
    if($info) {
      $app->render('info_detail.php', array('info' => $info));
    }
  } else {
    $query = ' 1 ';
    $param = array();
    $pkeys = array('category', 'source');
    foreach($pkeys as $pkey) {
      if(isset($_GET[$pkey])) {
        $query .= " AND ".$pkey." LIKE ?";
        $param[] = "%".$_GET[$pkey]."%";
      }
    }
    $info_list = R::find('info', $query, $param);
    $app->render('info_list.php', array('data' => $info_list));
  }
});

$app->get('/info_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $app->render('info_add.php');
});

$app->post('/info_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['title', 'category', 'source', 'date', 'content'];
  $info = R::dispense('info');
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('info_add');
      $app->halt(302);
    }
    $info[$para] = $_POST[$para];
  }
  R::store($info);
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Add Information Success!'
  );
  $app->redirect('info');
  $app->halt(302);
});
