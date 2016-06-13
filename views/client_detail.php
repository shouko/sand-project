<h2><?= $client['name'] ?></h2>
分類：<a href="client?category=<?= $client['category'] ?>"><?= $client['category'] ?></a> /
時間：<?= $client['date'] ?><br><br>
<?= nl2br($client['content']) ?>
