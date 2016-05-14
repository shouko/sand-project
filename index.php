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
      print_r($user);
      $_SESSION['user'] = $user['user'];
      $_SESSION['type'] = $user['type'];
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

$app->get('/info', function() {
  echo 'info';
});

$app->get('/init', function() {
  $user = array(
    array('can01', '12345', 'can'),
    array('can02', '23456', 'can'),
    array('con01', '12345', 'con'),
    array('con02', '23456', 'con')
  );
  foreach($user as $u) {
    if(!R::findOne( 'user', ' user = ? ', [$u[0]])) {
      $ub = R::dispense('user');
      $ub->user = $u[0];
      $ub->pass = $u[1];
      $ub->type = $u[2];
      R::store($ub);
    }
  }
});

$app->run();
