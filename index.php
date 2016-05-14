<?php
session_start();
require 'vendor/autoload.php';
require 'inc/rb.php';
require 'inc/lib.php';

R::setup('sqlite:/tmp/sakirai.db');
$app = new \Slim\Slim(
  array('templates.path' => './views')
);

$app->hook('slim.before.dispatch', function() use($app) {
  $active_menu = explode('/', $app->request()->getPathInfo())[1];
	if(!isset($_GET['fn'])){
    $nav_type = isset($_SESSION['type']) ? $_SESSION['type'] : 'public';
    $app->render('header.php', array('nav_type' => $nav_type, 'active_menu' => $active_menu));
  }
});

$app->hook('slim.after.dispatch', function() use($app) {
  if(!isset($_GET['fn'])){
	   $app->render('footer.php');
   }
});

$app->get('/', function() use($app) {
  $app->render('index.php');
});

include 'routes/login.php';

$app->get('/resume', function() {
  echo 'my';
});

$app->get('/consultant', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $rel = R::findOne('relate', ' can = ? ', [$_SESSION['user']]);
  if(!$rel) {
    echo 'You Have No Consultant';
  } else {
    $con = R::findOne('user', ' user = ? ', [$rel['con']]);
    echo '<h2>My Consultant</h2>';
    echo '<img style="border-radius: 100%" src="assets/pic/'.$con['user'].'.jpg">';
    echo '<br><br>Name: '.$con['name'];
  }
});

$app->get('/candidate', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $rel = R::find('relate', ' con = ? ', [$_SESSION['user']]);
  echo '<h2>Candidates</h2>';
  if(!$rel) {
    echo 'You Have No Candidate';
  } else {
    foreach($rel as $r) {
      $can = R::findOne('user', ' user = ? ', [$r['can']]);
      echo '<img style="border-radius: 100%" src="assets/pic/'.$can['user'].'.jpg">';
      echo '<br><br>Name: '.$can['name'].'<br><br>';
    }
  }
});

$app->get('/opening', function() {
  echo 'Opening';
});

$app->get('/client', function() {
  echo 'Clients';
});

include 'routes/info.php';
include 'routes/init.php';

$app->run();
