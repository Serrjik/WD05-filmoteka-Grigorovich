# Фильмотека

Небольшой сайт фильмотека с описанием фильмов.

![Фильмотека](http://ipic.su/7yDT7i.png)

### Примененные технологии в проекте:

* HTML5
* CSS3
* PHP
* Git, GitBash

### Что внутри:

* Возможность для администратора добавлять, изменять и удалять карточки фильмов
* Возможность смотреть без авторизации список фильмов и подробную информацию по ним
* Работа с Cookies и сессией

### Для локального тестирования:

1. Установить OpenServer.

2. Клонировать на локальный ПК репозиторий командой:

`git clone https://github.com/Serrjik/WD05-filmoteka-Grigorovich.git`

3. Поместить проект в папку domains в папке OSPanel.

4. Перейти в ветку develop командой:

git checkout develop

5. В OpenServer в настройках указать версию PHP 7 и настроить путь к домену.

6. С помощью PhpMyAdmin или SypexDumper импортировать БД проекта из дампа в файле WD05-filmoteka-Grigorovich_2019-01-21_14-13-41.sql.gz. Данные для подключения к БД находятся в файле config.php.

7. Запустить проект. Должна открыться главная страница сайта с несколькимим карточками фильмов.
