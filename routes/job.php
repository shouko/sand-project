<?php
$app->get('/job', function() use($app) {
  $client = R::find('client');
  $client_map = [];
  foreach($client as $c) {
    $client_map[$c['id']] = $c;
  }
  if(isset($_GET['id'])) {
    $job = R::findOne('job', ' id = ? ', [$_GET['id']]);
    if($job) {
      $app->render('job_detail.php', [
        'job' => $job,
        'client' => $client_map,
        'liked' => (count(R::find('joblike', ' tid = ? AND user = ? AND active = 1', [$_GET['id'], $_SESSION['user']])) != 0),
        'likes' => count(R::find('joblike', ' tid = ? AND active = 1', [$_GET['id']])),
        'comments' => R::find('jobcomment', 'tid = ?', [$_GET['id']])
      ]);
    }
  } else {
    $query = ' 1 ';
    $param = array();
    $pkeys = array('category', 'client');
    foreach($pkeys as $pkey) {
      if(isset($_GET[$pkey])) {
        $query .= " AND ".$pkey." LIKE ?";
        $param[] = "%".$_GET[$pkey]."%";
      }
    }
    $job_list = R::find('job', $query, $param);
    $app->render('job_list.php', array('data' => $job_list, 'client' => $client_map));
  }
});

$app->get('/job_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $clients = R::find('client');
  $app->render('job_add.php', ['clients' => $clients]);
});

$app->post('/job_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['client', 'category', 'title', 'content'];
  $job = R::dispense('job');
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('job_add');
      $app->halt(302);
    }
    $job[$para] = $_POST[$para];
  }
  $job['date'] = R::isoDateTime();
  R::store($job);
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Add Job Success!'
  );
  $app->redirect('job');
  $app->halt(302);
});

$app->get('/job_edit', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $app->render('job_edit.php', [
    'clients' => R::find('client'),
    'job' => R::load('job', $_GET['id'])
  ]);
});

$app->post('/job_edit', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['client', 'category', 'title', 'content'];
  $job = R::load('job', $_POST['id']);
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('job_add');
      $app->halt(302);
    }
    $job[$para] = $_POST[$para];
  }
  R::store($job);
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Edit Job Success!'
  );
  $app->redirect('job');
  $app->halt(302);
});
