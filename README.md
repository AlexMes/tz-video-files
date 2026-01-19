## API

### Плоучить токен. 
POST /api/login?email=alex@ukr.net&password=111
### Список доступніх файлов 
GET /api/file/list
### Получить файл
GET /api/file?id=2 (id - из списка доступных файлов)

## БД
Sqlite, migrate не нужжен.
### users
Есть три пользователя: alex@ukr.net, jon@ukr.net, michael@ukr.net у всех пароль 111.

alex - доступно 2 файла, jon - 1, michael - 0.

### files
Таблица файлов. Два поля name = название, path = путь в хранилище.

### user_files
Опредиляет какие файлы доступны пользрвателю.

### Установка
composer install

npm install









