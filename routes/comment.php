<?php
$app->post('/comment', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['entity', 'id', 'content'];
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('javascript:history.back()');
      $app->halt(302);
    }
  }
  $comment = R::dispense($_POST['entity'].'comment');
  $comment['tid'] = $_POST['id'];
  $comment['user'] = $_SESSION['user'];
  $comment['content'] = $_POST['content'];
  $comment['date'] = R::isoDateTime();
  R::store($comment);
  $app->redirect($_POST['entity'].'?id='.$_POST['id']);
  $app->halt(302);
});

$app->get('/comment_delete', function() use($app) {
  if(!isset($_SESSION['user']) && $_SESSION['user'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['entity', 'id', 'cid'];
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
  R::trash(R::load($_GET['entity'].'comment', $_GET['cid']));
  $app->redirect($_GET['entity'].'?id='.$_GET['id']);
  $app->halt(302);
});