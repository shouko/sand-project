<div style="max-width: 600px" class="form-group">
  <form method="POST">
    <h2>Resume</h2>
    <img src="assets/pic/<?= isset($_GET['user']) ? $_GET['user'] : $_SESSION['user'] ?>.jpg">
    <table style="width: 100%">
<?php
  $fields = [
    ['pos', 'Position Applied', 0],
    ['name', 'Name', 0],
    ['dob', 'Date of Birth', 0],
    ['edu', 'Education', 1],
    ['lang', 'Language Skills', 1],
    ['comp', 'Computer Skills', 1],
    ['appr', 'Appraisals', 1],
    ['work', 'Work Experience', 1]
  ];
  foreach($fields as $field) {
    echo '<tr><td width="20%">'.$field[1].'</td><td><br>';
    if(isset($_GET['user'])) {
      echo nl2br(htmlspecialchars($data[$field[0]])).'<br>';
    } else if($field[0] == 'name') {
      echo $_SESSION['name'].'<br>';
    } else if($field[2] == 0) {
      echo '<input name="'.$field[0].'" class="form-control" value="'.htmlspecialchars($data[$field[0]]).'" required>';
    } else {
      echo '<textarea name="'.$field[0].'" class="form-control" rows="10">'.htmlspecialchars($data[$field[0]]).'</textarea>';
    }
    echo '<br></td></tr>';
  }
?>
    </table>
<?php
if(!isset($_GET['user'])) {
  echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>';
}
?>
  </form>
</div>
