<h2>Information</h2>
<table class="table" style="max-width: 800px">
  <thead><tr><th>#</th><th>Title</th><th>Category</th><th>Source</th><th>Date</th></tr></thead>
  <tbody>
<?php
  foreach($data as $row) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td><a href="info?id='.$row['id'].'">'.$row['title'].'</a></td>';
    echo '<td><a href="info?category='.$row['category'].'">'.$row['category'].'</a></td>';
    echo '<td><a href="info?source='.$row['source'].'">'.$row['source'].'</a></td>';
    echo '<td>'.$row['date'].'</td>';
    echo '</tr>';
  }
?>
  </tbody>
</table>
