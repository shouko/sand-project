<?php
$app->get('/like', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['entity', 'id'];
  foreach($params as $para) {
    if(!isset($_GET[$para]) || $_GET[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('');
      $app->halt(302);
    }
  }
  $like = R::dispense($_GET['entity'].'like');
  $like['tid'] = $_GET['id'];
  $like['user'] = $_SESSION['user'];
  $like['date'] = R::isoDateTime();
  $like['active'] = 1;
  R::store($like);
  $app->redirect($_GET['entity'].'?id='.$_GET['id']);
  $app->halt(302);
});

$app->get('/unlike', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['entity', 'id'];
  foreach($params as $para) {
    if(!isset($_GET[$para]) || $_GET[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('');
      $app->halt(302);
    }
  }
  $likes = R::find($_GET['entity'].'like', ' tid = ? AND user = ? AND active = 1', [$_GET['id'], $_SESSION['user']]);
  foreach($likes as $like) {
    $like['active'] = 0;
    R::store($like);
  }
  $app->redirect($_GET['entity'].'?id='.$_GET['id']);
  $app->halt(302);
});