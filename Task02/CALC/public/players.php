<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Zaglumonina\CalcG\Database;

$players = Database\getCalcPlayersWithGames();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" type="text/css" href="styles.php">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список игроков</title>
</head>
<a href="clear.php" onclick="return confirm('Вы уверены, что хотите очистить базу данных?');">Очистить базу данных</a>
<body>
    <h2>Список игроков и их игр</h2>
    <a href="index.php">На главную</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>Игрок</th>
            <th>Дата</th>
            <th>Выражение</th>
            <th>Ответ игрока</th>
            <th>Правильный ответ</th>
            <th>Результат</th>
        </tr>
        <?php foreach ($players as $player): ?>
            <tr>
                <td><?php echo htmlspecialchars($player['name']) ?></td>
                <td><?php echo $player['played_at'] ?></td>
                <td><?php echo $player['expression'] ?></td>
                <td><?php echo $player['player_answer'] ?></td>
                <td><?php echo $player['correct_answer'] ?></td>
                <td><?php echo $player['result'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
