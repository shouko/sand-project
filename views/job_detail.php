<h2><?= $job['title'] ?></h2>
類型：<a href="job?category=<?= $job['category'] ?>"><?= $job['category'] ?></a> /
公司：<a href="client?id=<?= $job['client'] ?>"><?= $client[$job['client']]['name'] ?></a> /
時間：<?= $job['date'] ?><br><br>
<?= nl2br($job['content']) ?>
