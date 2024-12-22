const axios = require('axios');
const cheerio = require('cheerio');
const express = require('express');
const cors = require('cors');
const app = express();
const port = 3001;

// Разрешаем все запросы
const corsOptions = {
    origin: '*',  // Разрешаем все источники
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type', 'Authorization']
};

app.use(cors(corsOptions));  // Используем CORS настройки
app.use(express.json());

// API endpoint для парсинга
app.get('/scrape', async (req, res) => {
    try {
        const url = 'https://ski-gv.ru/hills/';

        // Отправляем GET-запрос
        const { data } = await axios.get(url, {
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            }
        });

        const $ = cheerio.load(data);
        let results = [];

        // Парсинг блоков с трассами
        $('.scheme-select .track-option').each((i, el) => {
            const name = $(el).find('.track-option__name').text().trim();
            console.log("HTML для трассы:", $(el).html());  // Печатаем весь HTML
            const length = $(el).find('.track-param.icon_image_track-length').text().replace(/[^0-9]/g, '').trim(); // Извлекаем только цифры
            const time = $(el).find('.track-param.icon_image_clock').text().trim();
            const height = $(el).find('.track-param.icon_image_track-height').text().replace(/[^0-9]/g, '').trim(); // Извлекаем только цифры
            const status = $(el).find('.track-status').text().trim();
        
            console.log(`Трасса: ${name}, Длина: ${length}, Время: ${time}, Высота: ${height}, Статус: ${status}`);
        
            results.push({
                name: name || 'Не указано',
                length: length || 'Не указано',
                time: time || 'Не указано',
                height: height || 'Не указано',
                status: status || 'Не указано'
            });
        });
        

        // Отправляем данные в формате JSON
        res.json(results);
    } catch (error) {
        console.error('Ошибка при парсинге:', error.message);
        res.status(500).send('Ошибка парсинга');
    }
});

app.listen(port, () => {
    console.log(`Сервер работает на http://localhost:${port}`);
});
