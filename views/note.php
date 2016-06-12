<h2>Notes</h2>
<?php
if(isset($_GET['user'])) {
  echo '<a class="btn-xs btn-warning btn" href="note">Show All Notes</a> <a class="btn-xs btn-warning btn" href="resume?user='.$_GET['user'].'">See '.$users[$_GET['user']]['name'].'\'s Resume</a><br><br>';
}
?>
<table class="table" style="max-width: 600px">
  <thead><tr><th>#</th><th>Name</th><th>Content</th><th>Date</th><th>Action</th></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td nowrap><a href="note?user='.$row['can'].'">'.$users[$row['can']]['name'].'</a></td>';
    echo '<td>'.$row['content'].'</td>';
    echo '<td nowrap>'.$row['date'].'</td>';
    echo '<td><a class="btn-xs btn-danger btn" onclick="if(confirm(\'你確定要刪除嗎\')){document.location.href=\'note_delete?id='.$row['id'].'\'}">Delete</a></td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
<br><br>
<?php
if(isset($_GET['user'])) {
?><div style="max-width: 600px" class="form-group">
    <form method="POST">
      <h3>Add Note</h3>
      <input name="can" type="hidden" value="<?= $_GET['user'] ?>">
      <textarea name="content" class="form-control" rows="10"></textarea><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
    </form>
  </div>
<?php
}
?>
