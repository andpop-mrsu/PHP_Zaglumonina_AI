<?php

namespace Zaglumonina\CalcG\Database;

use PDO;

function getDBConnection()
{
    $dbPath = __DIR__ . '/../db/database.sqlite';
    $pdo = new PDO("sqlite:$dbPath");

    // Создаем таблицу players, если она не существует
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS players (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL
        );
    ");

    // Создаем таблицу calc_games, если она не существует
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS calc_games (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            player_id INTEGER NOT NULL,
            expression TEXT NOT NULL,
            correct_answer INTEGER NOT NULL,
            player_answer INTEGER NOT NULL,
            result TEXT NOT NULL,
            played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (player_id) REFERENCES players(id)
        );
    ");

    return $pdo;
}

function saveCalcGame($playerName, $expression, $correctAnswer, $playerAnswer, $result)
{
    $pdo = getDBConnection();

    // Проверяем, есть ли игрок
    $stmt = $pdo->prepare("SELECT id FROM players WHERE name = ?");
    $stmt->execute([$playerName]);
    $player = $stmt->fetch(PDO::FETCH_ASSOC);

    // Если игрока нет, добавляем
    if (!$player) {
        $stmt = $pdo->prepare("INSERT INTO players (name) VALUES (?)");
        $stmt->execute([$playerName]);
        $playerId = $pdo->lastInsertId();
    } else {
        $playerId = $player['id'];
    }

    // Записываем игру
    $stmt = $pdo->prepare("INSERT INTO calc_games (player_id, expression, correct_answer, player_answer, result) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$playerId, $expression, $correctAnswer, $playerAnswer, $result]);
}

function getCalcPlayersWithGames()
{
    $pdo = getDBConnection();
    $stmt = $pdo->query(
        "
        SELECT players.name,
               DATETIME(calc_games.played_at, '+3 hours') AS played_at,
               calc_games.expression, calc_games.correct_answer, calc_games.player_answer, calc_games.result
        FROM calc_games
        JOIN players ON calc_games.player_id = players.id
        ORDER BY calc_games.played_at DESC
    "
    );

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function clearCalcGamesDatabase()
{
    $pdo = getDBConnection();
    $pdo->exec("DELETE FROM calc_games;");
    $pdo->exec("DELETE FROM players;");
}
