<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подъемники Горного Воздуха</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.header {
    background-color: #28a745;
    color: white;
    text-align: center;
    padding: 20px;
    font-size: 36px;
    font-weight: bold;
}

.track-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

.track-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.track-card__title {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.track-card__status {
    font-size: 16px;
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.status-open {
    background-color: #28a745; /* Зеленый для открытых */
}

.status-closed {
    background-color: #dc3545; /* Красный для закрытых */
}

.status-icon {
    margin-right: 5px;
}

@media (max-width: 600px) {
    .track-card__title {
        font-size: 16px;
    }

    .track-card__status {
        font-size: 14px;
    }
}

</style>
<?php
// Получаем данные с API Node.js
$api_url = 'http://localhost:3002/lift_scrap'; // Убедитесь, что API URL верный
$response = file_get_contents($api_url);

if ($response !== false) {
    $lifts = json_decode($response, true); // Преобразуем JSON в массив
    if (is_array($lifts) && count($lifts) > 0) {
        echo "<div class='header'>Подъёмники</div>"; // Заголовок страницы
        
        echo "<div class='track-container'>";
        
        // Проходим по всем подъемникам и выводим их
        foreach ($lifts as $lift) {
            $name = $lift['name'] ?? 'Неизвестно';
            $status = $lift['status'] ?? 'Неизвестно';

            // Определяем класс и текст для статуса
            $status_class = $status === 'открыт' ? 'status-open' : 'status-closed';
            $status_text = $status === 'открыт' ? 'Открыт' : 'Закрыт';
            $status_icon = $status === 'открыт' ? '✅' : '❌';

            // Выводим HTML для каждого подъемника
            echo "<div class='track-card'>
                    <div class='track-card__title'>{$name}</div>
                    <div class='track-card__status {$status_class}'>
                        <span class='status-icon'>{$status_icon}</span> {$status_text}
                    </div>
                </div>";
        }

        echo "</div>";
    } else {
        echo "<p>Подъемники не найдены.</p>";
    }
} else {
    echo "<p>Не удалось получить данные с API.</p>";
}
?>
</html>

