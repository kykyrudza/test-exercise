# Laravel Тестовое задание

## Установка
   
1. **Установить зависимости:**
   ```bash
   composer install && npm install
   ```  

2. **Скопировать `.env` и настроить:**
   ```bash
   cp .env.example .env  
   php artisan key:generate
   ```  

3. **Запустить миграции и сидеры:**
   ```bash
   php artisan migrate --seed
   ```  

4. **Запустить сервер:**
   ```bash
   php artisan serve
   ```  
   ```bash
   npm run dev
   ``` 

## Тесты

Для запуска тестов:
```bash
php artisan test
```  


---  
[Подробнее здесь](https://gptonline.ai/ru/)  
