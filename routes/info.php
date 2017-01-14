<?php
$app->get('/info', function() use($app) {
  if(isset($_GET['id'])) {
    $info = R::findOne('info', ' id = ? ', [$_GET['id']]);
    if($info) {
      $app->render('info_detail.php', [
        'info' => $info,
        'liked' => (count(R::find('infolike', ' tid = ? AND user = ? AND active = 1', [$_GET['id'], $_SESSION['user']])) != 0),
        'likes' => count(R::find('infolike', ' tid = ? AND active = 1', [$_GET['id']])),
        'comments' => R::find('infocomment', 'tid = ?', [$_GET['id']])
      ]);
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

$app->get('/info_edit', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $info = R::load('info', $_GET['id']);
  $app->render('info_edit.php', ['info' => $info]);
});

$app->post('/info_edit', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['title', 'category', 'source', 'date', 'content'];
  $info = R::load('info', $_POST['id']);
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('javascript:history.back()');
      $app->halt(302);
    }
    $info[$para] = $_POST[$para];
  }
  R::store($info);
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Edit Information Success!'
  );
  $app->redirect('info');
  $app->halt(302);
});

$app->get('/info_delete', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  R::trash(R::load('info', $_GET['id']));
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Delete Info Success!'
  );  
  $app->redirect('info');
  $app->halt(302);
});
