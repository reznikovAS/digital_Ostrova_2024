const axios = require('axios');
const cheerio = require('cheerio');
const express = require('express');
const cors = require('cors');
const app = express();
const port = 3002;

// Разрешаем все запросы
const corsOptions = {
    origin: '*',  // Разрешаем все источники
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type', 'Authorization']
};

app.use(cors(corsOptions));  // Используем CORS настройки
app.use(express.json());

// API endpoint для парсинга
app.get('/lift_scrap', async (req, res) => {
    try {
        const url = 'https://ski-gv.ru/hills/1/2/';  // URL страницы с подъемниками

        // Отправляем GET-запрос
        const { data } = await axios.get(url, {
            headers: {
                'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            }
        });

        const $ = cheerio.load(data);
        let results = [];

        // Парсинг информации о подъемниках
        $('.scheme-select .lift-option').each((i, el) => {
            const name = $(el).find('.lift-option__name').text().trim();
            const link = $(el).find('a').attr('href');
            
            // Тип подъемника
            const type = $(el).find('.icon_image_cabine').text().trim() || 'Не указано';
            
            // Время работы
            const time = $(el).find('.track-param').text().trim() || 'Не указано';
            
            // Длина трассы
            const length = $(el).find('.icon_image_track-length').text().replace(/[^0-9]/g, '').trim() || 'Не указано';
            
            // Вместимость
            const capacity = $(el).find('.icon_image_people').text().trim() || 'Не указано';
            
            // Статус подъемника
            const status = $(el).find('.lift-status').text().trim() || 'Не указано';

            // Логируем для отладки
            console.log(`Подъемник: ${name}, Тип: ${type}, Время: ${time}, Длина: ${length}, Вместимость: ${capacity}, Статус: ${status}`);

            results.push({
                name: name || 'Не указано',
                link: link ? `https://ski-gv.ru${link}` : 'Не указано', // Полный URL
                type: type || 'Не указано',
                time: time || 'Не указано',
                length: length || 'Не указано',
                capacity: capacity || 'Не указано',
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
