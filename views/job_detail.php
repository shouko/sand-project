<h2><?= $job['title'] ?></h2>
類型：<a href="job?category=<?= $job['category'] ?>"><?= $job['category'] ?></a> /
公司：<a href="client?id=<?= $job['client'] ?>"><?= $client[$job['client']]['name'] ?></a> /
時間：<?= $job['date'] ?><br><br>
<?= nl2br($job['content']) ?>
<br><br>
<?= $likes ?> Likes / <?= count($comments) ?> Comments<br><br>
<a class="btn btn-small btn-primary" href="<?= $liked ? 'un' : '' ?>like?entity=job&id=<?= $job['id'] ?>"><?= $liked ? 'Unl' : 'L' ?>ike</a>
<a class="btn btn-small btn-primary" href="#comment">Comment</a>
<br>
<h3>留言</h3>
<?php
foreach($comments as $comment) {
    echo ($_SESSION['type'] == 'con' ? '<a class="btn btn-xs btn-danger" href="comment_delete?entity=job&cid='.$comment['id'].'&id='.$job['id'].'" onclick="if(!confirm(\'Are you sure?\')){return false}">Delete</a>' : '').' <b><a href="message?user='.$comment['user'].'" title="'.$comment['date'].'">'.$comment['user'].'</a></b>: '.$comment['content'].'<br>';
}
?>
<br>
<div style="max-width: 300px" class="form-group">
  <form method="POST" action="comment">
    <a name="comment"></a>
    <input name="content" class="form-control">
    <input name="entity" type="hidden" value="job">
    <input name="id" type="hidden" value="<?= $job['id'] ?>">
    <button class="btn btn-primary btn-block" type="submit">Comment</button>
  </form>
</div>
