# CALC Game

**CALC Game** — это консольная игра, которая показывается случайное арифметическое выражение с операциями +, -, *, содержащее четыре операнда (например 35+16*2-4), которое нужно вычислить и записать ответ. После этого программа должна вывести соответствующее сообщение и правильный ответ.

## Установка и запуск

### Локальная установка
1. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/Zaglumonina/CALC_Game.git
   cd Game_name
   
2. Установите зависимости через Composer:
   ```bash
   composer install
   ```
3. Запустите встроенный PHP-сервер:
   ```bash
   php -S localhost:3000 -t public
   ```
4. Откройте в браузере:
   ```
   http://localhost:3000/
   ```

### Установка через Packagist
1. Убедитесь, что Composer установлен глобально.
2. Установите игру:
    ```bash
    composer global require erefef/php_tenyakshev_ma
3. Запустите игру из командной строки:
    ```bash
    calcg
    

## Используемые технологии
- **PHP** — основной язык разработки.
- **Composer** — управление зависимостями и автозагрузка классов.
- **SQLite** — база данных для хранения информации об игроках и сыгранных партиях.
- **wp-cli/php-cli-tools** — библиотека для удобного взаимодействия с консолью.
- **HTML/CSS (styles.php)** — стилизация веб-интерфейса.


## Дополнительные возможности
- Просмотр всех игроков и их игр: `http://localhost:3000/players.php`
- Очистка базы данных: `http://localhost:3000/clear.php`

## Ссылки
- Packagist: [CALC Game](https://packagist.org/packages/zaglumosha/php_zaglumonina_ai)
- [Репозиторий на GitHub](https://github.com/Zaglumosha/Calcul_Game)
- Автор: zaglumonina
- Лицензия: MIT

