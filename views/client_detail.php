<h2><?= $client['name'] ?></h2>
<a class="btn-xs btn-warning btn" href="job?client=<?= $client['id'] ?>">List Job</a>
<?php
if($_SESSION['type'] == 'con') {
  echo ' <a class="btn-xs btn-warning btn" href="job_add?client='.$client['id'].'">Add Job</a>';
}
?>
<br><br>
分類：<a href="client?category=<?= $client['category'] ?>"><?= $client['category'] ?></a> /
時間：<?= $client['date'] ?><br><br>
<?= nl2br($client['content']) ?>
<br><br>
<?= $likes ?> Likes / <?= count($comments) ?> Comments<br><br>
<a class="btn btn-small btn-primary" href="<?= $liked ? 'un' : '' ?>like?entity=client&id=<?= $client['id'] ?>"><?= $liked ? 'Unl' : 'L' ?>ike</a>
<a class="btn btn-small btn-primary" href="#comment">Comment</a>
<br>
<h3>留言</h3>
<?php
foreach($comments as $comment) {
    echo ($_SESSION['type'] == 'con' ? '<a class="btn btn-xs btn-danger" href="comment_delete?entity=client&cid='.$comment['id'].'&id='.$client['id'].'" onclick="if(!confirm(\'Are you sure?\')){return false}">Delete</a>' : '').' <b><a href="message?user='.$comment['user'].'" title="'.$comment['date'].'">'.$comment['user'].'</a></b>: '.$comment['content'].'<br>';
}
?>
<br>
<div style="max-width: 300px" class="form-group">
  <form method="POST" action="comment">
    <a name="comment"></a>
    <input name="content" class="form-control">
    <input name="entity" type="hidden" value="client">
    <input name="id" type="hidden" value="<?= $client['id'] ?>">
    <button class="btn btn-primary btn-block" type="submit">Comment</button>
  </form>
</div>

