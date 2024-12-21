<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Горный воздух</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
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
$api_url = 'http://localhost:3001/scrape'; 
$response = file_get_contents($api_url);


if ($response !== false) {
    $tracks = json_decode($response, true); // Преобразуем JSON в массив
    if (is_array($tracks) && count($tracks) > 0) {
        echo "<div class='track-container'>";
        
        
        foreach ($tracks as $track) {
           
            $name = $track['name'] ?? 'Неизвестно';
            $status = $track['status'] ?? 'Неизвестно';

           
            $status_class = $status === 'открыта' ? 'status-open' : 'status-closed';
            $status_text = $status === 'открыта' ? 'Открыта' : 'Закрыта';
            $status_icon = $status === 'открыта' ? '✅' : '❌';

            echo "<div class='track-card'>
                    <div class='track-card__title'>{$name}</div>
                    <div class='track-card__status {$status_class}'>
                        <span class='status-icon'>{$status_icon}</span> {$status_text}
                    </div>
                </div>";
        }

        echo "</div>";
    } else {
        echo "<p>Трассы не найдены.</p>";
    }
} else {
    echo "<p>Не удалось получить данные с API.</p>";
}
?>

