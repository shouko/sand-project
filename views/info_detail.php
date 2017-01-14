<h2><?= $info['title'] ?></h2>
來源：<a href="info?source=<?= $info['source'] ?>"><?= $info['source'] ?></a> /
分類：<a href="info?category=<?= $info['category'] ?>"><?= $info['category'] ?></a> /
時間：<?= $info['date'] ?><br><br>
<?= nl2br($info['content']) ?>
<br><br>
<?= $likes ?> Likes / <?= count($comments) ?> Comments<br><br>
<a class="btn btn-small btn-primary" href="<?= $liked ? 'un' : '' ?>like?entity=info&id=<?= $info['id'] ?>"><?= $liked ? 'Unl' : 'L' ?>ike</a>
<a class="btn btn-small btn-primary" href="#comment">Comment</a>
<br>
<h3>留言</h3>
<?php
foreach($comments as $comment) {
    echo ($_SESSION['type'] == 'con' ? '<a class="btn btn-xs btn-danger" href="comment_delete?entity=info&cid='.$comment['id'].'&id='.$info['id'].'" onclick="if(!confirm(\'Are you sure?\')){return false}">Delete</a>' : '').' <b><a href="message?user='.$comment['user'].'" title="'.$comment['date'].'">'.$comment['user'].'</a></b>: '.$comment['content'].'<br>';
}
?>
<br>
<div style="max-width: 300px" class="form-group">
  <form method="POST" action="comment">
    <a name="comment"></a>
    <input name="content" class="form-control">
    <input name="entity" type="hidden" value="info">
    <input name="id" type="hidden" value="<?= $info['id'] ?>">
    <button class="btn btn-primary btn-block" type="submit">Comment</button>
  </form>
</div>
