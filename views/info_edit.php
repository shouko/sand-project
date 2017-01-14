<div style="max-width: 600px" class="form-group">
  <form method="POST">
    <h2>Edit Information</h2>
    <input name="title" class="form-control" placeholder="Title" required autofocus value="<?= $info['title'] ?>"><br>
    <input name="category" class="form-control" placeholder="Category" required value="<?= $info['category'] ?>"><br>
    <input name="source" class="form-control" placeholder="Source" required value="<?= $info['source'] ?>"><br>
    <input name="date" class="form-control" placeholder="Date" required value="<?= $info['date'] ?>"><br>
    <textarea name="content" class="form-control" rows="20"><?= $info['content'] ?></textarea><br>
    <input name="id" type="hidden" value="<?= $info['id'] ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
  </form>
</div>
