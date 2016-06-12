<?php
$app->get('/resume', function() use($app) {
  $can = $_SESSION['user'];
  if(isset($_GET['user'])) {
    $can = $_GET['user'];
  }
  $resume = R::findOne('resume', ' can = ? ', [$can]);
  $app->render('resume.php', array('data' => $resume));
});

$app->post('/resume', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $fields = ['pos', 'dob', 'edu', 'lang', 'comp', 'appr', 'work'];
  $resume = R::findOne('resume', ' can = ? ', [$_SESSION['user']]);
  if(!$resume) {
    $resume = R::dispense('resume');
    $resume['can'] = $_SESSION['user'];
    $resume['name'] = $_SESSION['name'];
  }
  foreach($fields as $field) {
    $resume[$field] = $_POST[$field];
  }
  R::store($resume);
  $app->redirect('./resume');
  $app->halt('302');
});
