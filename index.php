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
include 'routes/resume.php';
include 'routes/note.php';
include 'routes/message.php';

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
    echo '<br><br><a class=" btn-warning btn" href="message?user='.$con['user'].'">Message</a>';
  }
});

$app->get('/candidate', function() use($app) {
  if(!isset($_SESSION['user'])) {
    $app->redirect('./login');
    $app->halt('302');
  }
  $can = R::find('user', ' user IN ( SELECT can FROM relate WHERE con = ? )', [$_SESSION['user']]);
  $app->render('candidate_list.php', array('data' => $can));
});

include 'routes/job.php';
include 'routes/client.php';
include 'routes/info.php';
include 'routes/init.php';

$app->run();
