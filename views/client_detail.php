<h2><?= $client['name'] ?></h2>
<a class="btn-xs btn-warning btn" href="job?client=<?= $client['id'] ?>">List Job</a>
<?php
if($_SESSION['type'] == 'con') {
  echo ' <a class="btn-xs btn-warning btn" href="job_add">Add Job</a>';
}
?>
<br><br>
分類：<a href="client?category=<?= $client['category'] ?>"><?= $client['category'] ?></a> /
時間：<?= $client['date'] ?><br><br>
<?= nl2br($client['content']) ?>
