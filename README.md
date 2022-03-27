Для запуску проекту(на OS X) потрібно виконати наступні дії:
1. Запустити **docker**
2. З корня проекту виконати команду **_make build_**
3. Створити базу test
4. Зайти в контейнер **fpm** - **_docker exec -it fpm bash_**
5. Запустити міграції в контейнері - **_php bin/console doctrine:migrations:migrate_**
6. Завантажити фікстури - **_php bin/console doctrine:fixtures:load_**

**Завдання 1(відправка SMS):**

<span style="color: red">!!!! Так як в тестовому завданні немає чітких вимог, в поточній реализації вважається, що можна редагувати текст повідомлення, але змінні в повідомленні**({name}, {password})** статичні**(не має можлівости додавати нові змінні без участі розробника)**</span>

Контролер завдання знаходіться тут source/src/Controller/AuthController.php

Запуск **http://localhost:8080/auth/remind**

**Завдання 2(новини):**

<span style="color: red">!!!! Якщо я правильно зрозумів, потрібно просто спроектувати БД, створити індекси, написати запити на SQL????? До чого тоді останній пункт завдання  - "Дать возможность создавать\редактировать\просматривать новости на всех языках для администратора\редактора"??????? Я цей пункт проігнорував бо писати SQL на insert і update тупо, а фігачити код я не хочу, бо це тестове вже явно виходить за рамки 15 хвилин про які ви розповідали на співбесіді.</span>

1. Структура БД - source/migrations/Version20220325213804.php
2. ER діаграма - post.png
3. Запити:

```
SELECT p.id, p.date_add, pt.title, pt.text
FROM post p
JOIN post_translation pt ON p.id = pt.post_id AND pt.language = 'UA'
WHERE p.enabled = true
ORDER BY p.date_add DESC
LIMIT 100 OFFSET 1000;

SELECT p.id, p.date_add, pt.title, pt.text
FROM post p
JOIN post_translation pt ON p.id = pt.post_id AND pt.language = 'PL'
WHERE p.id = 'e43b906c-f440-47ca-b576-2fb8e990f0b8';
```
