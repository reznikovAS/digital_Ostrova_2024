

<?php
session_start();

// Инициализация массива ски-пассов, если он ещё не существует
if (!isset($_SESSION['ski_passes'])) {
    $_SESSION['ski_passes'] = [];
}

// Обработка добавления ски-пасса
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ski_pass'])) {
    $skiPass = htmlspecialchars($_POST['ski_pass']);

    // Проверка на дублирование номера ски-пасса
    if (!in_array($skiPass, $_SESSION['ski_passes'])) {
        $_SESSION['ski_passes'][] = $skiPass;
    }
}

// Получение всех сохранённых ски-пассов
$savedSkiPasses = $_SESSION['ski_passes'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Горный воздух</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 400px;
            /* margin: 20px auto; */
            background-color: #fff;
            border-radius: 0px 0px 0px 0px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            padding: 16px;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .form {
            padding: 16px;
            margin: 5px;
            background-color: #e3e3e3;
        }
        .form_hils {
            padding: 16px;
            background-color: #ffffff;;
        }
        .form_hils input[type="text"] {
            width: 90%;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form_hils button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form_hils button:hover {
            background-color: #0056b3;
        }





        .form input[type="text"] {
            width: 90%;
            padding: 12px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form button:hover {
            background-color: #0056b3;
        }

        .info {
            font-size: 14px;
            color: #555;
            margin-bottom: 12px;
        }

        .tariffs {
            padding: 16px;
        }

        .tariff {
            margin-bottom: 12px;
        }

        .tariff-title {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .tariff-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 4px;
        }

        .tariff-price {
            font-weight: bold;
            font-size: 16px;
        }

        .weather-header {
            display: flex;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #ddd;
            background-color: #f4f4f4;
        }

        .weather-card__icon {
            width: 48px;
            height: 48px;
            margin-right: 16px;
        }

        .weather-data {
            font-size: 14px;
        }

        .weather-condition {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .weather-card__temp {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }

        .weather-card__params {
            list-style: none;
            padding: 16px;
            margin: 0;
            border-top: 1px solid #ddd;
        }

        .weather-card__param {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            /* padding: 8px 0; */
        }
        .ski-pass {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #007bff;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .ski-pass img {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="header">Горный воздух</div>
    <div class="form">
        <?php if (count($savedSkiPasses) > 0): ?>
            <?php foreach ($savedSkiPasses as $pass): ?>
                <div class="ski-pass">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/mountain.png" alt="Иконка">
                    <span><?= $pass ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>У вас пока нет добавленных карт ски-пасс.</p>
        <?php endif; ?>
        </div>

        <div class="form">
            <div class="info">Можно использовать карту МИР как ски-пасс</div>
            <form method="POST">
                <input type="text" name="ski_pass" placeholder="Номер ски-пасса" required>
                <button type="submit">Добавить</button>
            </form>
        </div>
          <!-- Кнопка перехода на страницу со статусами подъёмников -->
          <div class="container">
        <div class="header">Статусы трасс и подьемников</div>
        
        
        <!-- <div style="text-align: center;font-size: 20px;font-weight: bold;margin-top: 5px;">Гора Большевик</div> -->
        
        <!-- Кнопки для перехода на страницы -->
        <div style="text-align: center;margin: 8px;">
            <a href="/hils.php">
                <button style="padding: 12px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Трассы</button>
            </a>
            <a href="/lift.php" style="margin-left: 10px;">
                <button style="padding: 12px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Подъёмники</button>
            </a>
        </div>

        
        
        
        <!-- <div style="text-align: center;font-size: 20px;font-weight: bold;margin-top: 5px;">Гора Большевик</div> -->
        
        <!-- Кнопки для перехода на страницы -->
        <!-- <div style="text-align: center;margin: 8px;"> -->
            <!-- <a href="/hils.php"> -->
                <!-- <button style="padding: 12px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Трассы</button> -->
            <!-- </a> -->
            <!-- <a href="/lift.php" style="margin-left: 10px;"> -->
                <!-- <button style="padding: 12px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Подъёмники</button> -->
            <!-- </a> -->
        <!-- </div> -->


        </div>

        
    </div>
        <div class="tariffs">
            <div class="tariff">
                <div class="tariff-title">Разовый подъём</div>
                <div class="tariff-description">От нижней до средней / от средней до верхней / КД "Юг"</div>
                <div class="tariff-price">170</div>
            </div>
            <div class="tariff">
                <div class="tariff-title">Разовый подъём</div>
                <div class="tariff-description">От нижней до верхней</div>
                <div class="tariff-price">340</div>
            </div>
            <div class="tariff">
                <div class="tariff-title">Разовый подъём</div>
                <div class="tariff-description">КД "Красная-север"</div>
                <div class="tariff-price">330</div>
            </div>
            <div class="tariff">
                <div class="tariff-title">Особый</div>
                <div class="tariff-price">120</div>
            </div>
        </div>
    </div>

    <div class="container">
    <ul class="weather-car__params params">
    <li class="weather-car__param param"><p>Погода</p></li>
    </ul>
        <div class="weather-header weather-header_type_full weather__current-part">
            <img src="" class="weather-card__icon icon" alt="Погода">
            <div class="weather-data">
                <span class="weather-condition">-</span>
                <p class="weather-card__temp temp">-</p>
               
            </div>
        </div>
        <ul class="weather-card__params params">
            <li class="weather-card__param param"><p>Восход</p><p>-</p></li>
            <li class="weather-card__param param"><p>Заход</p><p>-</p></li>
            <li class="weather-card__param param"><p>Влажность</p><p>-</p></li>
            <li class="weather-card__param param"><p>Давление</p><p>-</p></li>
        </ul>
    </div>

    <?php
    // Данные для API
    $access_key = '660e5b19-4abd-432b-9c95-504cee6ce30e';
    $lat = '46.95424'; // Горный
    $lon = '142.79274';

    $opts = array(
        'http' => array(
            'method' => 'GET',
            'header' => 'X-Yandex-Weather-Key: ' . $access_key
        )
    );

    $context = stream_context_create($opts);

    // Получение данных о погоде
    $response = file_get_contents("https://api.weather.yandex.ru/v2/forecast?lat=$lat&lon=$lon", false, $context);
    $weatherData = json_decode($response, true);

    // Извлечение данных
    // $condition = $weatherData['fact']['condition'] ?? 'нет данных';
    $temp = $weatherData['fact']['temp'] ?? 'нет данных';
    $wind_speed = $weatherData['fact']['wind_speed'] ?? 'нет данных';
    $humidity = $weatherData['fact']['humidity'] ?? 'нет данных';
    $pressure_mm = $weatherData['fact']['pressure_mm'] ?? 'нет данных';
    $sunrise = $weatherData['forecasts'][0]['sunrise'] ?? 'нет данных';
    $sunset = $weatherData['forecasts'][0]['sunset'] ?? 'нет данных';
    $icon = $weatherData['fact']['icon'] ?? 'skc_d';

    
    ?>
<?php
// $client->setHeader('User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
// $crawler = $client->request('GET', 'https://ski-gv.ru/hills/1/2/');

// $statusCode = $client->getResponse()->getStatusCode();

// if ($statusCode == 200) {
//     echo "Страница загружена успешно.\n";
// } else {
//     echo "Ошибка при загрузке страницы. Код: $statusCode\n";
// }

// require 'vendor/autoload.php';

// use Goutte\Client;

// // Создайте клиент
// $client = new Client();

// // Загружаем страницу
// $crawler = $client->request('GET', 'https://ski-gv.ru/hills/1/2/');

// // Извлекаем нужные данные
// $crawler->filter('a.some-class')->each(function ($node) {
//     echo $node->text() . ' - ' . $node->attr('href') . "\n";
// });
?>

    <script>
        const weatherData = {
            condition: "<?php echo ucfirst($condition); ?>",
            temp: "<?php echo $temp; ?>",
            windSpeed: "<?php echo $wind_speed; ?>",
            humidity: "<?php echo $humidity; ?>",
            pressure: "<?php echo $pressure_mm; ?>",
            sunrise: "<?php echo $sunrise; ?>",
            sunset: "<?php echo $sunset; ?>",
            icon: "https://yastatic.net/weather/i/icons/funky/dark/<?php echo $icon; ?>.svg"
        };

        document.querySelector('.weather-condition').innerText = weatherData.condition;
        document.querySelector('.weather-card__temp').innerText = `${weatherData.temp}°`;
        document.querySelector('.weather-data').innerHTML += `<p>Ветер ${weatherData.windSpeed} м/с</p>`;
        document.querySelector('.weather-card__icon').src = weatherData.icon;

        const params = document.querySelectorAll('.weather-card__param p');
        params[1].innerText = weatherData.sunrise;
        params[3].innerText = weatherData.sunset;
        params[5].innerText = `${weatherData.humidity}%`;
        params[7].innerText = `${weatherData.pressure} мм`;
    </script>

</body>
</html>




<script type="module">
    import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js"
    Chatbot.init({
        chatflowid: "7ffb12b2-61ef-4711-acbc-94d0ad1e0b1b",
        apiHost: "http://45.15.162.148:3000",
        chatflowConfig: {
            /* Chatflow Config */
        },
        observersConfig: {
            /* Observers Config */
        },
        theme: {
            button: {
                backgroundColor: '#3B81F6',
                right: 20,
                bottom: 20,
                size: 48,
                dragAndDrop: true,
                iconColor: 'white',
                customIconSrc: 'https://raw.githubusercontent.com/walkxcode/dashboard-icons/main/svg/google-messages.svg',
                autoWindowOpen: {
                    autoOpen: true,
                    openDelay: 2,
                    autoOpenOnMobile: false
                }
            },
            tooltip: {
                showTooltip: true,
                tooltipMessage: 'Привет, я помогу 👋!',
                tooltipBackgroundColor: 'black',
                tooltipTextColor: 'white',
                tooltipFontSize: 16
            },
            customCSS: ``,
            chatWindow: {
                showTitle: true,
                showAgentMessages: true,
                title: 'ИИ чат-бот',
                titleAvatarSrc: 'https://raw.githubusercontent.com/walkxcode/dashboard-icons/main/svg/google-messages.svg',
                welcomeMessage: 'Привет! Я твой ИИ помощник по курорту "Горный воздух". Я могу подсказать актуальные контакты, объяснить условия льготных тарифов и использования карты сахалинца, а так же подсказать их цены, рассказать о режиме работы трасс и подъемников, на каких трассах кататься новичку, ответить на часто задаваемые вопросы и не только. Чем могу помочь прямо сейчас?😊"',
                errorMessage: 'Упссс что-то пошло не так ',
                backgroundColor: '#ffffff',
                backgroundImage: 'enter image path or link',
                height: 700,
                width: 400,
                fontSize: 16,
                starterPrompts: [
                    "Номера экстренных служб",
                    "Карта Сахалинца",
                    "Разовый проход по ски-пассу",
                ],
                starterPromptFontSize: 15,
                clearChatOnReload: false,
                sourceDocsTitle: 'Источники:',
                renderHTML: true,
                botMessage: {
                    backgroundColor: '#f7f8ff',
                    textColor: '#303235',
                    showAvatar: true,
                    avatarSrc: 'https://ski-gv.ru/resources/images/logo-color.png'
                },
                userMessage: {
                    backgroundColor: '#3B81F6',
                    textColor: '#ffffff',
                    showAvatar: true,
                    avatarSrc: 'https://raw.githubusercontent.com/zahidkhawaja/langchain-chat-nextjs/main/public/usericon.png'
                },
                textInput: {
                    placeholder: 'Введите вопрос',
                    backgroundColor: '#ffffff',
                    textColor: '#303235',
                    sendButtonColor: '#3B81F6',
                    maxChars: 80,
                    maxCharsWarningMessage: 'Превышен лимит',
                    autoFocus: true,
                    sendMessageSound: true,
                    sendSoundLocation: 'send_message.mp3',
                    receiveMessageSound: true,
                    receiveSoundLocation: 'receive_message.mp3'
                },
                feedback: {
                    color: '#303235'
                },
                dateTimeToggle: {
                    date: true,
                    time: true
                },
                footer: {
                    textColor: '#303235',
                    text: 'Dev by',
                    company: '@ziabls',
                    companyLink: ''
                }
            }
        }
    })
</script>
