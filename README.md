Notification System
============================

Для реализации системы уведомлений был разработан компонент `app\components\Notice`.
Пример использования представлен в модели `app\models\Article`. 

Для подключения системы уведомлений к модели, необходимо:

1. В модели реализовать интерфейс `app\components\notice\EventInterface`, который содержит метод `getNoticeParams()`.

2. Метод `getNoticeParams()` должен возвращать массив параметров, которые используются для подстановки в текст и заголовок уведомления.

    Пример:
    
    ```php
    public function getNoticeParams()
    {
        return [
            'articleName' => $this->title,
            'moreLink' => Html::a('Читать далее', ['/article/view', 'id' => $this->id]),
            'shortText' => mb_substr($this->text, 0, self::SHORT_TEXT_LENGTH),
        ];
    }
    ```

3. Добавить в модель константы доступных событий. Их названия должны начинаться на `EVENT_NOTICE_`.

    Пример:
    
    ```php
    const EVENT_NOTICE_CREATE_ARTICLE = 'createArticle';
    const EVENT_NOTICE_UPDATE_ARTICLE = 'updateArticle';
    ```

4. Добавить в модель триггеры на объявленные события.

Установка
============================

Выполнить команды в корне проекта:

```
composer install
php yii migrate/up
```

Добавить локальный файл конфигурации БД `app\config\db-local.php`.

Пример содержимого файла:

```php
return [
    'dsn' => 'mysql:host=localhost;dbname=rgk_test',
    'username' => 'root',
    'password' => 'root',
];
```


Затраченное время: ~13ч.

Резюме: https://moikrug.ru/singleton-8204
