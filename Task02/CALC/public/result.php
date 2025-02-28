<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Zaglumonina\CalcG\Database;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $playerName = trim($_POST["playerName"]);
    $expression = trim($_POST["expression"]);
    $correctAnswer = (int) $_POST["correctAnswer"];
    $playerAnswer = (int) $_POST["playerAnswer"];

    $result = ($playerAnswer === $correctAnswer) ? "Верно!" : "Неверно. Правильный ответ: $correctAnswer";

    // Сохраняем в БД
    Database\saveCalcGame($playerName, $expression, $correctAnswer, $playerAnswer, $result);
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <link rel="stylesheet" type="text/css" href="styles.php">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Результат</title>
    </head>
    <body>
        <h2>Результат</h2>
        <p><?php echo $result ?></p>
        <a href="index.php">Играть снова</a>
    </body>
    </html>
    <?php
}
