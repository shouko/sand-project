<?php
$app->get('/note', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./login');
    $app->halt('302');
  }
  $can = '%';
  if(isset($_GET['user'])) {
    $can = $_GET['user'];
  }
  $notes = R::find('note', ' can LIKE ? AND con = ? AND deleted = 0', [$can, $_SESSION['user']]);
  $users = R::find('user');
  $users_map = [];
  foreach($users as $user) {
    $users_map[$user['user']] = $user;
  }
  $app->render('note.php', array('data' => $notes, 'users' => $users_map));
});

$app->post('/note', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./login');
    $app->halt('302');
  }
  $note = R::dispense('note');
  $note['can'] = $_POST['can'];
  $note['con'] = $_SESSION['user'];
  $note['content'] = $_POST['content'];
  $note['deleted'] = 0;
  $note['date'] = R::isoDateTime();
  R::store($note);
  $app->redirect('./note?user='.$_GET['user']);
  $app->halt('302');
});

$app->get('/note_delete', function() use($app) {
  if(!isset($_SESSION['user']) || $_SESSION['type'] != 'con') {
    $app->redirect('./login');
    $app->halt('302');
  }
  $note = R::findOne('note', ' id = ? ', [$_GET['id']]);
  if($note) {
    $note['deleted'] = 1;
    R::store($note);
  }
  $app->redirect('./note?user='.$note['can']);
  $app->halt('302');
});
