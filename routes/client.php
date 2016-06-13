<?php
$app->get('/client', function() use($app) {
  if(isset($_GET['id'])) {
    $client = R::findOne('client', ' id = ? ', [$_GET['id']]);
    if($client) {
      $app->render('client_detail.php', array('client' => $client));
    }
  } else {
    $query = ' 1 ';
    $param = array();
    $pkeys = array('category');
    foreach($pkeys as $pkey) {
      if(isset($_GET[$pkey])) {
        $query .= " AND ".$pkey." LIKE ?";
        $param[] = "%".$_GET[$pkey]."%";
      }
    }
    $client_list = R::find('client', $query, $param);
    $app->render('client_list.php', array('data' => $client_list));
  }
});

$app->get('/client_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $app->render('client_add.php');
});

$app->post('/client_add', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./');
    $app->halt(302);
  }
  $params = ['name', 'category', 'content'];
  $client = R::dispense('client');
  foreach($params as $para) {
    if(!isset($_POST[$para]) || $_POST[$para] == '') {
      $_SESSION['flash'] = array(
        'type' => 'warning',
        'content' => 'Missing Parameters'
      );
      $app->redirect('client_add');
      $app->halt(302);
    }
    $client[$para] = $_POST[$para];
  }
  $client['date'] = R::isoDateTime();
  R::store($client);
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Add Client Success!'
  );
  $app->redirect('client');
  $app->halt(302);
});
