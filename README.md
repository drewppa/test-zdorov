Создание мини CRM системы:
===============================

Должно быть реализовано на Yii2 advanced

Backend часть
-------------------
```
    1. Авторизация в CRM системе

        1.1 Поля для входа на форме (Email, пароль)

    2. Модуль для отображения пользователей системы

        2.0 Отображение списка пользователей

        2.1 Возможность выставление прав пользователям, список (Администратор, менеджер)

        2.2 Поля пользователя (email, пароль, статус)

        2.3 Удаление и редактирование пользователей

        2.4 Смена статуса пользователям, Активный или неактивный

        2.5 Редактировать список может только пользователи с правами администратор

    3. Раздел отображение заявок

        3.1 Вывод списка заявок

        3.2 Поля у заявки (Имя клиента, Наименование заявки, наименование товар, телефон, время создания заявки, статус, комментарий, цена)

        3.3 Смена статуса заявки (Принята, отказана, брак)

    4. Раздел истории изменения заявок

        4.1 Каким пользователям были изменены поля у заявки (Имя клиента, Наименование заявки, наименование товара, телефон, время подачи заявки, статус, комментарий, цена)

    5. Добавить возможность выгрузки в CSV списка заявок, поля в CSV (Наименование заявки, товар, цена, телефон)
```

Frontend часть
-------------------
```
    1. Создать простую форму для отправки заявки

        1.1 Поля формы (Имя клиента, телефон, комментарий, товар)

        1.2 Список товаров (яблоки, апельсины, мандарины)
```
