# Theseus Lab — Рабочий процесс

> Этот документ — живой. Обновляй его когда меняются процессы, появляются новые договорённости или ты разобрался с чем-то важным.

---

## Что это за проект

**Theseus Lab** — сайт на WordPress, размещён на хостинге Beget.
Локальная разработка — через Docker. Деплой — через FTP.

- Прод: http://theseuslab.ru
- WP Admin (прод): http://theseuslab.ru/wp-admin
- Локальный WP: http://localhost:8088
- Локальный phpMyAdmin: http://localhost:8082

---

## Быстрый старт — первый раз на новой машине

### 1. Установи зависимости
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) — обязательно
- [FileZilla](https://filezilla-project.org/) — для работы с FTP (или любой FTP-клиент)
- [git](https://git-scm.com/) — должен быть установлен

### 2. Скачай wp-content с сервера (FTP)

Подключись к FTP:
```
Сервер:   jointeam.beget.tech
Логин:    jointeam_lab
Пароль:   (см. в защищённом хранилище)
Порт:     21
```

Скачай папку `/jointeam_lab/theseuslab.ru/wp-content/` и положи её в корень этого проекта (рядом с `docker-compose.yml`).

> Зачем: ядро WordPress мы берём из Docker-образа (так всегда одна версия у всех).
> Кастомный код (тема, плагины) живёт в `wp-content` — только его и качаем.

### 3. Скачай дамп базы данных

На хостинге Beget → раздел «Базы данных» → экспорт в `.sql` файл.
Сохрани как `db-backup/theseus-lab.sql` (эта папка в `.gitignore`).

### 4. Настрой переменные окружения

```bash
cp .env.example .env
```

Заполни `.env` своими паролями. Значения для подключения к БД — можешь придумать любые (это локальная БД, не прод).

### 5. Запусти Docker

```bash
docker compose up -d
```

Первый запуск займёт 1–2 минуты — скачивается образ WordPress.
После — открой http://localhost:8080, должен появиться экран установки WP (или сайт если БД импортирована).

### 6. Импортируй базу данных

1. Открой http://localhost:8081 (phpMyAdmin)
2. Выбери базу `theseus_lab`
3. Вкладка «Импорт» → загрузи `db-backup/theseus-lab.sql`

### 7. Обнови siteurl в БД

После импорта дампа с прод-сервера, адрес сайта в БД будет `http://theseuslab.ru`.
Нужно поменять на локальный:

```sql
UPDATE wp_options SET option_value = 'http://localhost:8080' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'http://localhost:8080' WHERE option_name = 'home';
```

Выполни через phpMyAdmin (вкладка «SQL»).

> Зачем: WordPress хранит адрес сайта в базе данных. Без этого шага редиректы и ссылки будут вести на прод.

---

## Ежедневная работа

### Запуск

```bash
docker compose up -d
```

### Остановка

```bash
docker compose down
```

### Просмотр логов (если что-то сломалось)

```bash
docker compose logs wordpress
docker compose logs db
```

---

## Как работает Git в этом проекте

Git инициализирован **только в `wp-content/`** — здесь живёт весь кастомный код.

```
wp-content/          ← git репозиторий
├── themes/
│   └── theseus-lab/ ← основная работа
├── plugins/         ← кастомные плагины (если появятся)
└── uploads/         ← НЕ в git (медиафайлы)
```

**Ядро WordPress** (`wp-admin/`, `wp-includes/`, и т.д.) — в git не попадает, оно берётся из Docker-образа.

### Формат коммитов

Используем [Conventional Commits](https://www.conventionalcommits.org/):

```bash
git commit -m "feat(theme): добавить секцию с услугами"
git commit -m "fix(header): исправить высоту nav на мобильных"
git commit -m "chore: обновить .gitignore"
```

Подробнее — в `.cursor/rules/git-commits.mdc`.

---

## Деплой на прод

Пока деплой — ручной через FTP.

1. Определи какие файлы изменились: `git diff --name-only HEAD~1`
2. Загрузи изменённые файлы через FileZilla в `/jointeam_lab/theseuslab.ru/wp-content/`
3. Проверь сайт на http://theseuslab.ru

> В будущем: можно автоматизировать через GitHub Actions + rsync/lftp. Запиши как задачу если захочешь.

---

## Структура темы

```
wp-content/themes/theseus-lab/
├── style.css          ← обязательный файл темы (содержит метаданные)
├── functions.php      ← подключение скриптов, регистрация функций
├── index.php          ← главный шаблон
├── header.php         ← шапка
├── footer.php         ← подвал
├── page.php           ← шаблон страниц
├── single.php         ← шаблон записей
└── template-parts/    ← переиспользуемые части шаблонов
```

---

## Полезные команды

```bash
# Зайти внутрь контейнера WordPress (например для WP-CLI)
docker exec -it theseus_wp bash

# Очистить всё и начать заново (ОСТОРОЖНО — удалит данные БД)
docker compose down -v

# Посмотреть запущенные контейнеры
docker ps
```

---

## Как создать попап с формой заявки

В теме уже есть готовый попап (`footer.php`). Вот как он устроен:

### Архитектура попапа

```
footer.php      ← HTML попапа (оверлей + контент)
main.js         ← открытие/закрытие (data-popup="contact")
style.css       ← стили .popup-overlay, .popup-content
```

### Как работает

1. Любая кнопка/ссылка с атрибутом `data-popup="contact"` открывает попап
2. Закрытие — по клику на крестик, фон или Escape
3. При открытии блокируется скролл страницы

### Как добавить новый попап

1. В `footer.php` добавь новый `<div class="popup-overlay" id="popup-{name}">`
2. На кнопке добавь `data-popup="{name}"`
3. В `main.js` продублируй логику (или вынеси в универсальную функцию)

### Как подключить Contact Form 7

1. В WP-admin → Плагины → Добавить → ищи **Contact Form 7** → Установить → Активировать
2. Перейди в WP-admin → Contact → Добавить форму
3. Настрой форму:

```
<label>Имя</label>
[text* your-name placeholder "Ваше имя"]

<label>Email</label>
[email* your-email placeholder "email@example.com"]

<label>Телефон</label>
[tel your-phone placeholder "+7 (___) ___-__-__"]

<label>Сообщение</label>
[textarea your-message placeholder "Расскажите о вашей задаче"]

[submit "Отправить"]
```

4. Скопируй шорткод формы (выглядит как `[contact-form-7 id="123" title="Заявка"]`)
5. В `footer.php` замени строку с `do_shortcode(...)` на свой шорткод

### Настройка отправки писем (CF7 → email)

В WP-admin → Contact → выбери форму → вкладка «Письмо»:
- **Кому:** твой email
- **От:** `[your-name] <[your-email]>`
- **Тема:** Заявка с сайта Theseus Lab
- **Тело:** Имя: [your-name], Email: [your-email], Телефон: [your-phone], Сообщение: [your-message]

> На Beget может потребоваться настройка SMTP — если письма не уходят, ставь плагин **WP Mail SMTP** и прописывай SMTP-данные хостинга.

---

## ACF — редактирование текстов сайта

### Что это

ACF (Advanced Custom Fields) позволяет менять тексты всех секций через WP-admin, не трогая код. Все тексты лендинга подключены через ACF с фолбэками — если ACF не установлен, отображаются дефолтные тексты из шаблонов.

### Установка

1. WP-admin → Плагины → Добавить → **Advanced Custom Fields** → Установить → Активировать
2. После активации в меню появится пункт «Настройки сайта»
3. ACF автоматически подтянет конфигурацию полей из `acf-json/` в теме

### Структура полей (вкладки)

| Вкладка | Что редактируется |
|---|---|
| Hero | Заголовок и описание главного экрана |
| Направления | Тексты 3 карточек направлений |
| Сценарии | Тексты 4 кейсов применения |
| Процесс | Заголовок и описание этапов |
| Технологии | Заголовок и описание стека |
| Кейсы | Портфолио с результатами |
| CTA | Финальный блок с призывом к действию |
| Подвал | Текст в футере |

### Как это работает в коде

```php
// theseus_field_e('hero_title', 'Дефолтный текст')
// 1. Если ACF установлен и поле заполнено → берём из ACF
// 2. Если ACF нет или поле пустое → показываем дефолт
```

---

## Деплой на Beget (сервер)

### Данные доступа

```
FTP сервер:  jointeam.beget.tech
Логин:       jointeam_lab
Пароль:      (см. защищённое хранилище)
```

WP-admin (прод):
```
URL:    http://theseuslab.ru/wp-admin
Логин:  admin
Пароль: (см. защищённое хранилище)
```

### Ручной деплой темы

1. Посмотри что изменилось: `git diff --name-only HEAD~1` (в `wp-content/`)
2. Через FileZilla загрузи файлы в `/jointeam_lab/theseuslab.ru/wp-content/themes/theseus-lab/`
3. Проверь на http://theseuslab.ru

### Первый деплой — чеклист

- [ ] Загрузить тему через FTP
- [ ] В WP-admin → Внешний вид → Темы → Активировать «Theseus Lab»
- [ ] Установить плагин ACF (Advanced Custom Fields)
- [ ] Установить плагин Contact Form 7
- [ ] Создать форму в CF7, обновить шорткод в `footer.php`
- [ ] Заполнить тексты в «Настройки сайта» (ACF)
- [ ] Проверить отправку формы
- [ ] Настроить SMTP если письма не уходят

### Beget — особенности

- PHP-версия: убедись что стоит 8.0+ (Beget → Настройки сайта → PHP)
- SSL: включи бесплатный Let's Encrypt в панели Beget
- Кэш: Beget имеет свой кэш — после деплоя может потребоваться очистка

---

## Заметки и договорённости

> Сюда добавляй всё что важно запомнить: решения, обходы багов, договорённости с собой.

- [ ] Настроить автодеплой через GitHub Actions
- [ ] Добавить WP-CLI в docker-compose для удобного управления WP из терминала
- [ ] Подключить Figma MCP для точной работы с макетом
- [ ] Настроить SMTP на Beget для отправки писем

---

*Последнее обновление: март 2026*
