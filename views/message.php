<h2>Messages</h2>
<?php
if(isset($_GET['user'])) {
  echo '<a class="btn-xs btn-warning btn" href="message">Show All Messages</a>';
  if($_SESSION['type'] == 'con') {
    echo ' <a class="btn-xs btn-warning btn" href="resume?user='.$_GET['user'].'">See '.$users[$_GET['user']]['name'].'\'s Resume</a>';
  }
  echo ' <a class="btn-xs btn-warning btn" onclick="document.location.reload()">Refresh</a>';
  echo '<br><br>';
}
?>
<table class="table" style="max-width: 600px">
  <thead><tr><th width="5%">#</th><th width="20%">From &gt; To</th><th>Content</th><th width="20%">Date</th></tr></thead>
  <tbody>
<?php
  foreach($data as $key => $row) {
    echo '<tr>';
    echo '<td>'.$key.'</td>';
    echo '<td nowrap>';
    if($row['from'] == $_SESSION['user']) {
      echo '我 &gt; <a href="message?user='.$row['to'].'">'.$users[$row['to']]['name'].'</a>';
    } else {
      echo '<a href="message?user='.$row['from'].'">'.$users[$row['from']]['name'].'</a> &gt; 我';
    }
    echo '</td>';
    echo '<td>'.htmlspecialchars(nl2br($row['content'])).'</td>';
    echo '<td nowrap>'.$row['date'].'</td>';
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
      <h3>Reply</h3>
      <input name="to" type="hidden" value="<?= $_GET['user'] ?>">
      <textarea name="content" class="form-control" rows="5"></textarea><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
    </form>
  </div>
<?php
}
?>
