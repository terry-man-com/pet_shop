<?php
require_once __DIR__ . '/functions.php';
$dbh = connect_db();
$sql = 'SELECT * FROM animals';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>ペットショップアプリ</title>
</head>
<body>
    <h2>本日のご紹介ペット！</h2>
    <ul style="list-style-type: none;">
        <?php foreach ($animals as $animal): ?>
            <li><?=h($animal['type']) . 'の' . h($animal['classification']) . 'ちゃん'?></li>
            <li><?=h($animal['description'])?></li>
            <li><?=h($animal['birthday']) . '生まれ'?></li>
            <li style="border-bottom: 2px solid #000000;">出身地 <?=h($animal['birthplace'])?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>