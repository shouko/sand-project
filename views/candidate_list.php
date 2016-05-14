<h2>Information</h2>
<table class="table" style="max-width: 400px">
  <thead><tr><th>#</th><th>Photo</th><th>Name</th><th>Username</th></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><img style="border-radius: 100%; width: 100px" src="assets/pic/'.$row['user'].'.jpg"></td>';
    echo '<td>'.$row['name'].'</td>';
    echo '<td>'.$row['user'].'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
