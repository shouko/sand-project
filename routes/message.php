<?php
$app->get('/message', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $another = '%';
  if(isset($_GET['user'])) {
    $another = $_GET['user'];
  }
  $messages = R::find('message', ' (`from` LIKE ? AND `to` LIKE ?) OR (`from` LIKE ? AND `to` LIKE ?) ', [$_SESSION['user'], $another, $another, $_SESSION['user']]);
  $users = R::find('user');
  $users_map = [];
  foreach($users as $user) {
    $users_map[$user['user']] = $user;
  }
  $app->render('message.php', array('data' => $messages, 'users' => $users_map));
});

$app->post('/message', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $message = R::dispense('message');
  $message['from'] = $_SESSION['user'];
  $message['to'] = $_POST['to'];
  $message['content'] = $_POST['content'];
  $message['date'] = R::isoDateTime();
  R::store($message);
  $app->redirect('./message?user='.$_POST['to']);
  $app->halt('302');
});
