<h2>Clients</h2>
<a class="btn-xs btn-warning btn" href="client_add">Add Client</a><br><br>

<table class="table" style="max-width: 500px">
  <thead><tr><th>#</th><th>Category</th><th>Name</th><th>Date</th><th>Actions</th></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><a href="client?category='.$row['category'].'">'.$row['category'].'</a></td>';
    echo '<td><a href="client?id='.$row['id'].'">'.$row['name'].'</a></td>';
    echo '<td>'.$row['date'].'</td>';
    echo '<td><a class="btn-xs btn-warning btn" href="client_edit?id='.$row['id'].'">Edit</a> <a class="btn-xs btn-warning btn" href="client_delete?id='.$row['id'].'" onclick="if(!confirm(\'Are you sure?\')){return false}">Delete</a></td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
