<?php
session_start();
require 'vendor/autoload.php';
require 'inc/rb.php';
require 'inc/lib.php';

R::setup();
$app = new \Slim\Slim(
  array('templates.path' => './views')
);

$app->hook('slim.before.dispatch', function () use ($app) {
  $active_menu = explode('/', $app->request()->getPathInfo())[1];
	if(!isset($_GET['fn'])){
    $nav_type = isset($_SESSION['type']) ? $_SESSION['type'] : 'public';
    $app->render('header.php', array('nav_type' => $nav_type, 'active_menu' => $active_menu));
  }
});

$app->hook('slim.after.dispatch', function () use ($app) {
  if(!isset($_GET['fn'])){
	   $app->render('footer.php');
   }
});

$app->get('/', function () {
  echo '      <div class="page-header">
          <h1>Sticky footer with fixed navbar</h1>
        </div>
        <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS. A fixed navbar has been added with <code>padding-top: 60px;</code> on the <code>body > .container</code>.</p>
        <p>Back to <a href="../sticky-footer">the default sticky footer</a> minus the navbar.</p>';
});

$app->get('/resume', function() {
  echo 'my';
});

$app->get('/init', function() {
echo 1;
});

$app->run();
