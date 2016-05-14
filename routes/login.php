<?php
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
