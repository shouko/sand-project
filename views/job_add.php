<div style="max-width: 600px" class="form-group">
  <form method="POST">
    <h2>Add Job</h2>
    <select name="client" class="form-control">
      <option disabled<?= isset($_GET['client']) ? '' : ' selected' ?>>Company</option>
<?php
foreach($clients as $c) {
  echo '<option value="'.$c['id'].'" ';
  if(isset($_GET['client']) && $_GET['client'] == $c['id']) {
    echo ' selected';
  }
  echo '>'.$c['name'].'</option>';
}
?>
    </select><br>
    <input name="category" class="form-control" placeholder="Category" required><br>
    <input name="title" class="form-control" placeholder="Title" required><br>
    <textarea name="content" class="form-control" rows="20"></textarea><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
  </form>
</div>
