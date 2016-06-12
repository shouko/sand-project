<h2>Candidates</h2>
<table class="table" style="max-width: 500px">
  <thead><tr><th>#</th><th>Photo</th><th>Name</th><th>Username</th><th>Action</th></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><img style="border-radius: 100%; width: 100px" src="assets/pic/'.$row['user'].'.jpg"></td>';
    echo '<td><a href="resume?user='.$row['user'].'">'.$row['name'].'</a></td>';
    echo '<td>'.$row['user'].'</td>';
    echo '<td><a class="btn-xs btn-warning btn" href="note?user='.$row['user'].'">Notes</a> <a class="btn-xs btn-warning btn" href="message?user='.$row['user'].'">Message</a></td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
