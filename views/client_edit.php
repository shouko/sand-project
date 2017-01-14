<div style="max-width: 600px" class="form-group">
  <form method="POST">
    <h2>Edit Client</h2>
    <input name="category" class="form-control" placeholder="Category" required autofocus value="<?= $client['category'] ?>"><br>
    <input name="name" class="form-control" placeholder="Name" required value="<?= $client['name'] ?>"><br>
    <textarea name="content" class="form-control" rows="20"><?= $client['content'] ?></textarea><br>
    <input name="id" type="hidden" value="<?= $client['id'] ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
  </form>
</div>
