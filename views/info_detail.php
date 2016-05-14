<h2><?= $info['title'] ?></h2>
來源：<a href="info?source=<?= $info['source'] ?>"><?= $info['source'] ?></a> /
分類：<a href="info?category=<?= $info['category'] ?>"><?= $info['category'] ?></a> /
時間：<?= $info['date'] ?><br><br>
<?= nl2br($info['content']) ?>
