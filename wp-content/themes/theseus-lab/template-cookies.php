<?php
/**
 * Template Name: Политика cookies
 *
 * Информационная страница о файлах cookie.
 * Назначается через WP-admin → Страницы → «Политика cookies» → Атрибуты → Шаблон.
 */
get_header();
?>

<!-- Hero -->
<section class="article-hero">
    <div class="article-hero__grid-bg"></div>
    <div class="article-hero__inner container-wide">
        <div class="article-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Главная', 'theseus-lab'); ?></a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="article-breadcrumb__current"><?php esc_html_e('Политика cookies', 'theseus-lab'); ?></span>
        </div>
        <div class="article-hero__content">
            <h1 class="article-hero__title"><?php esc_html_e('Политика использования', 'theseus-lab'); ?><br><?php esc_html_e('файлов', 'theseus-lab'); ?> <span class="text-accent">cookie</span></h1>
            <p class="article-hero__desc">
                <?php esc_html_e('Мы заботимся о вашей конфиденциальности и прозрачно объясняем, какие данные собираем и зачем.', 'theseus-lab'); ?>
            </p>
            <div class="article-hero__meta">
                <div class="article-hero__meta-item">
                    <i class="ri-calendar-line"></i>
                    <?php /* translators: %s: дата обновления */ printf(esc_html__('Обновлено: %s', 'theseus-lab'), date('d.m.Y')); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="article-content">
    <div class="container-wide">
        <div class="article-layout">
            <div class="article-body" id="article-body">

                <h2><?php esc_html_e('Что такое cookie', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Файлы cookie — это небольшие текстовые файлы, которые сохраняются на вашем устройстве (компьютере, смартфоне, планшете) при посещении веб-сайта. Они помогают сайту «запоминать» ваши настройки и действия, чтобы вам не приходилось вводить их заново при каждом визите.', 'theseus-lab'); ?>
                </p>
                <p>
                    <?php esc_html_e('Cookie не содержат вирусов, не имеют доступа к файлам на вашем устройстве и не могут идентифицировать вас лично без дополнительной информации.', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Какие cookie мы используем', 'theseus-lab'); ?></h2>

                <h3><?php esc_html_e('Строго необходимые', 'theseus-lab'); ?></h3>
                <p>
                    <?php esc_html_e('Эти файлы нужны для корректной работы сайта. Без них невозможно отображение страниц, работа форм обратной связи и защита от межсайтовых атак (CSRF). Их нельзя отключить.', 'theseus-lab'); ?>
                </p>
                <ul>
                    <li><strong>theseus_cookies_accepted</strong> — <?php esc_html_e('сохраняет ваше согласие с политикой cookie (localStorage, бессрочно до удаления).', 'theseus-lab'); ?></li>
                    <li><strong>wordpress_sec_*</strong> — <?php esc_html_e('сессия авторизации для администраторов сайта.', 'theseus-lab'); ?></li>
                    <li><strong>wp_nonce</strong> — <?php esc_html_e('токен защиты форм от CSRF-атак.', 'theseus-lab'); ?></li>
                </ul>

                <h3><?php esc_html_e('Аналитические', 'theseus-lab'); ?></h3>
                <p>
                    <?php esc_html_e('Помогают нам понять, как посетители взаимодействуют с сайтом: какие страницы просматривают, откуда приходят, сколько времени проводят. Данные собираются в обезличенном виде.', 'theseus-lab'); ?>
                </p>
                <ul>
                    <li><strong>_ym_uid / _ym_d</strong> — <?php esc_html_e('Яндекс.Метрика: уникальный идентификатор посетителя (срок хранения — 1 год).', 'theseus-lab'); ?></li>
                    <li><strong>_ym_isad</strong> — <?php esc_html_e('Яндекс.Метрика: определение наличия блокировщика рекламы.', 'theseus-lab'); ?></li>
                </ul>

                <h3><?php esc_html_e('Функциональные', 'theseus-lab'); ?></h3>
                <p>
                    <?php esc_html_e('Запоминают ваши предпочтения — например, выбранный язык, регион или состояние интерфейса. Не передаются третьим сторонам.', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Как управлять cookie', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Вы можете в любой момент удалить или заблокировать cookie через настройки вашего браузера. Обратите внимание: отключение cookie может повлиять на функциональность сайта.', 'theseus-lab'); ?>
                </p>
                <ul>
                    <li><strong>Google Chrome:</strong> <?php esc_html_e('Настройки → Конфиденциальность и безопасность → Файлы cookie', 'theseus-lab'); ?></li>
                    <li><strong>Firefox:</strong> <?php esc_html_e('Настройки → Приватность и защита → Cookie и данные сайтов', 'theseus-lab'); ?></li>
                    <li><strong>Safari:</strong> <?php esc_html_e('Настройки → Конфиденциальность → Управление данными веб-сайтов', 'theseus-lab'); ?></li>
                    <li><strong>Edge:</strong> <?php esc_html_e('Настройки → Конфиденциальность → Файлы cookie и разрешения сайтов', 'theseus-lab'); ?></li>
                </ul>
                <p>
                    <?php esc_html_e('Чтобы сбросить согласие с cookie на нашем сайте, удалите ключ theseus_cookies_accepted в разделе Local Storage вашего браузера (DevTools → Application → Local Storage).', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Срок хранения', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Сессионные cookie удаляются автоматически при закрытии браузера. Постоянные cookie хранятся от 30 дней до 1 года в зависимости от назначения. Данные аналитики хранятся в обезличенном виде не более 26 месяцев.', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Передача данных третьим лицам', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Мы не продаём и не передаём персональные данные третьим лицам в коммерческих целях. Аналитические сервисы (Яндекс.Метрика) получают доступ только к обезличенной статистике посещений в соответствии с их собственной политикой конфиденциальности.', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Изменения в политике', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Мы оставляем за собой право обновлять данную политику. Актуальная версия всегда доступна на этой странице. Рекомендуем периодически проверять её на наличие изменений.', 'theseus-lab'); ?>
                </p>

                <h2><?php esc_html_e('Контакты', 'theseus-lab'); ?></h2>
                <p>
                    <?php esc_html_e('Если у вас есть вопросы о нашей политике использования cookie, свяжитесь с нами:', 'theseus-lab'); ?>
                </p>
                <ul>
                    <li><strong><?php esc_html_e('Email:', 'theseus-lab'); ?></strong> <?php echo esc_html(theseus_field('footer_email', 'info@theseuslab.ru')); ?></li>
                    <li><strong><?php esc_html_e('Страница контактов:', 'theseus-lab'); ?></strong> <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: var(--color-primary);">theseuslab.ru/contact</a></li>
                </ul>

                <!-- Footer -->
                <div class="article-footer">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="article-footer__back">
                        <i class="ri-arrow-left-line"></i>
                        <?php esc_html_e('На главную', 'theseus-lab'); ?>
                    </a>
                </div>
            </div>

            <!-- TOC -->
            <aside class="article-toc" id="article-toc">
                <p class="article-toc__label"><?php esc_html_e('Содержание', 'theseus-lab'); ?></p>
                <nav class="article-toc__nav" id="article-toc-nav"></nav>

                <div class="article-toc__cta">
                    <p><?php esc_html_e('Есть вопросы? Мы на связи.', 'theseus-lab'); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-accent btn--sm btn--full">
                        <?php esc_html_e('Написать нам', 'theseus-lab'); ?>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php
get_footer();
