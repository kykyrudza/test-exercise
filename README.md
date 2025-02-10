# Laravel Тестовое задание

## Установка

1. **Клонировать репозиторий:**
   ```bash
   git clone <URL> && cd <название_проекта>
   ```  

2. **Установить зависимости:**
   ```bash
   composer install && npm install
   ```  

3. **Скопировать `.env` и настроить:**
   ```bash
   cp .env.example .env  
   php artisan key:generate
   ```  

4. **Запустить миграции и сидеры:**
   ```bash
   php artisan migrate --seed
   ```  

5. **Запустить сервер:**
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
