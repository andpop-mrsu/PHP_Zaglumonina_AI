<?php

namespace Zaglumonina\CalcG\Controller;

use Zaglumonina\CalcG\View;
use Zaglumonina\CalcG\Database;

function startCalcGame($playerName)
{
    // Определяем, запущена ли игра в консоли или через сервер
    if (php_sapi_name() === 'cli') {
        echo "Привет, $playerName! Давай решим пример.\n";
        $expression = generateExpression();
        $correctAnswer = eval("return $expression;");
        echo "Пример: $expression = ?\n";
        
        echo "Введите ваш ответ: ";
        $playerAnswer = trim(fgets(STDIN));

        if ($playerAnswer == $correctAnswer) {
            echo "Верно!\n";
        } else {
            echo "Неверно! Правильный ответ: $correctAnswer\n";
        }
        return;
    }

    // *** Для серверной версии ***
    $expression = generateExpression();
    $correctAnswer = eval("return $expression;");

    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <link rel="stylesheet" type="text/css" href="styles.php">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Игра "Калькулятор"</title>
    </head>
    <body>
        <h2>Привет, <?php echo htmlspecialchars($playerName) ?>! Вычисли выражение:</h2>
        <p><?php echo $expression ?></p>
        <form method="post" action="result.php">
            <input type="hidden" name="playerName" value="<?php echo htmlspecialchars($playerName) ?>">
            <input type="hidden" name="expression" value="<?php echo htmlspecialchars($expression) ?>">
            <input type="hidden" name="correctAnswer" value="<?php echo $correctAnswer ?>">
            <label>Введите ваш ответ:</label>
            <input type="number" name="playerAnswer" required>
            <button type="submit">Проверить</button>
        </form>
    </body>
    </html>
    <?php
}

// Генерируем случайное математическое выражение
function generateExpression()
{
    $numbers = range(1, 9);
    shuffle($numbers);
    return "{$numbers[0]}+{$numbers[1]}-{$numbers[2]}*{$numbers[3]}";
}
