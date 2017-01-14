<div style="max-width: 600px" class="form-group">
  <form method="POST">
    <h2>Edit Job</h2>
    <select name="client" class="form-control">
      <option disabled>Company</option>
<?php
foreach($clients as $c) {
  echo '<option value="'.$c['id'].'" ';
  if($job['client'] == $c['id']) {
    echo ' selected';
  }
  echo '>'.$c['name'].'</option>';
}
?>
    </select><br>
    <input name="category" class="form-control" placeholder="Category" required value="<?= $job['category'] ?>"><br>
    <input name="title" class="form-control" placeholder="Title" required value="<?= $job['category'] ?>"><br>
    <textarea name="content" class="form-control" rows="20"><?= $job['content'] ?></textarea><br>
    <input name="id" type="hidden" value="<?= $job['id'] ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
  </form>
</div>
