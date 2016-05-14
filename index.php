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

$app->get('/', function(){
  echo '      <div class="page-header">
          <h1>Sticky footer with fixed navbar</h1>
        </div>
        <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
        <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>';
});

$app->get('/login', function() use($app) {
  $app->render('login.php');
});

$app->post('/login', function() use($app) {
  if(isset($_POST['user']) && isset($_POST['pass'])) {
    $user = R::findOne( 'user', ' user = ? ', [ $_POST['user'] ]);
    if($user && $user['pass'] == $_POST['pass']) {
      $_SESSION['flash'] = array(
        'type' => 'success',
        'content' => 'Login Success!'
      );
      foreach($user as $key => $val) {
        $_SESSION[$key] = $val;
      }
      $app->redirect('./');
    } else {
      $_SESSION['flash'] = array(
        'type' => 'danger',
        'content' => 'Login Failed'
      );
      $app->redirect('login');
    }
  }
});

$app->get('/logout', function() use($app) {
  $_SESSION = array();
  $_SESSION['flash'] = array(
    'type' => 'success',
    'content' => 'Logout Success'
  );
  $app->redirect('./');
});

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

include 'routes/info.php';
include 'routes/init.php';

$app->run();
