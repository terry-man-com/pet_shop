<?php
require_once __DIR__ . '/functions.php';
$dbh = connect_db();
$keyword = filter_input(INPUT_GET, "keyword");
$sql = 'SELECT * FROM animals WHERE description LIKE :keyword';
$stmt = $dbh->prepare($sql);
$keyword_param = "%" . $keyword . "%";
$stmt->bindParam(":keyword", $keyword_param, PDO::PARAM_STR);
$stmt->execute();
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ペットショップアプリ</title>
</head>
<body>
    <h2>本日のご紹介ペット！</h2>
    <p class="contents">キーワード：</p>
    <form method="get">
        <input type="text" name="keyword">
        <input type="submit" value="送信">
    </form>
        <ul>
            <?php foreach ($animals as $animal): ?>
                <li><?=h($animal['type']) . 'の' . h($animal['classification']) . 'ちゃん'?></li>
                <li><?=h($animal['description'])?></li>
                <li><?=h($animal['birthday']) . '生まれ'?></li>
                <li>出身地 <?=h($animal['birthplace'])?></li>
                <hr>
            <?php endforeach; ?>
        </ul>
</body>
</html>