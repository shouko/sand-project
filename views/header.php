<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  $menu = array(
    './' => array('Home', 'public'),
    'resume' => array('Resume', 'can'),
    'consultant' => array('My Consultant', 'can'),
    'jobs' => array('Finding Jobs', 'can'),
    'candidate' => array('Candidates', 'con'),
    'opening' => array('Openings', 'con'),
    'client' => array('Clients', 'con'),
    'info' => array('Info', 'login')
  );
  if($active_menu == '') {
    $active_menu = './';
  }
  echo '<title>'.($active_menu == './' ? $menu[$active_menu][0].' - ' : '').'Sakirai</title>';
?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">

    <script src="assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sakirai</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
<?php
  foreach($menu as $key => $item) {
    if($item[1] == 'public' || $nav_type == $item[1] || ($nav_type != 'public' && $item[1] == 'login')) {
      echo '<li'.($active_menu == $key ? ' class="active"' : '').'><a href="'.$key.'">'.$item[0].'</a></li>';
    }
  }
?>          </ul>
          <ul class="nav navbar-nav navbar-right">
<?php
  if(isset($_SESSION['user'])) {
?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="logout">Logout</a></li>
              </ul>
            </li>
<?php
  }else{
?>
            <li><a href="login">Login</a></li>
<?php
  }
?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
<?php
  if(isset($_SESSION['flash'])){
    echo '<div class="bg-'.$_SESSION['flash']['type'].'" style="line-height: 2em; padding-left: 2em">'.$_SESSION['flash']['content'].'</div>';
    unset($_SESSION['flash']);
  }
?>
