<h2>Jobs</h2>
<?php
if($_SESSION['type'] == 'con') {
  echo '<a class="btn-xs btn-warning btn" href="job_add">Add Job</a>';
  echo '<br><br>';
}
?>
<table class="table" style="max-width: 800px">
  <thead><tr><th>#</th><th>Company</th><th>Category</th><th>Title</th><th>Date</th><?= ($_SESSION['type'] == 'con') ? '<th>Actions</th>' : '' ?></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    if(!isset($client[$row['client']])) continue;
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><a href="job?client='.$row['client'].'">'.$client[$row['client']]['name'].'</a></td>';
    echo '<td><a href="job?category='.$row['category'].'">'.$row['category'].'</a></td>';
    echo '<td><a href="job?id='.$row['id'].'">'.$row['title'].'</a></td>';
    echo '<td>'.$row['date'].'</td>';
    if($_SESSION['type'] == 'con') echo '<td><a class="btn-xs btn-warning btn" href="job_edit?id='.$row['id'].'">Edit</a> <a class="btn-xs btn-warning btn" href="job_delete?id='.$row['id'].'" onclick="if(!confirm(\'Are you sure?\')){return false}">Delete</a></td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
