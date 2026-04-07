<?php
/**
 * Theseus Lab — functions.php
 *
 * Подключение стилей, скриптов и базовая настройка темы.
 */

defined('ABSPATH') || exit;


/**
 * Поддержка базовых возможностей WordPress
 */
function theseus_setup(): void {
    load_theme_textdomain('theseus-lab', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ]);

    add_theme_support('custom-logo', [
        'height'      => 48,
        'width'       => 180,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Основное меню', 'theseus-lab'),
    ]);
}
add_action('after_setup_theme', 'theseus_setup');

/**
 * Подключение стилей и скриптов через wp_enqueue (а не через <link> напрямую)
 */
function theseus_enqueue_assets(): void {
    $css_ver = filemtime(get_stylesheet_directory() . '/style.css');
    $js_ver  = filemtime(get_stylesheet_directory() . '/assets/js/main.js');

    wp_enqueue_style(
        'theseus-fonts',
        'https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap',
        [],
        null
    );

    wp_enqueue_style(
        'remixicon',
        'https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css',
        [],
        null
    );

    wp_enqueue_style(
        'theseus-style',
        get_stylesheet_uri(),
        ['theseus-fonts', 'remixicon'],
        $css_ver
    );

    wp_enqueue_script(
        'theseus-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $js_ver,
        true
    );
}
add_action('wp_enqueue_scripts', 'theseus_enqueue_assets');

/**
 * Убираем лишние мета-теги WordPress из <head>
 */
function theseus_cleanup_head(): void {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('after_setup_theme', 'theseus_cleanup_head');

/**
 * ACF-поля привязаны к главной странице (front_page).
 * Options Page больше не нужна — поля редактируются прямо
 * при редактировании страницы «Главная» в WP-админке.
 */

/**
 * ACF JSON — загрузка групп полей из темы
 *
 * Позволяет хранить конфигурацию ACF-полей в git (как JSON),
 * а не только в базе данных.
 */
function theseus_acf_json_load_point(array $paths): array {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'theseus_acf_json_load_point');

function theseus_acf_json_save_point(string $path): string {
    return get_template_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'theseus_acf_json_save_point');

/**
 * Кастомный тип записи «Кейс» (case).
 *
 * Каждый кейс — это реализованный проект с результатом, галереей и отраслью.
 * CPT нужен потому что у кейсов свои ACF-поля (результат, галерея),
 * которые не подходят под стандартные записи.
 */
function theseus_register_case_cpt(): void {
    register_post_type('case', [
        'labels' => [
            'name'               => __('Кейсы', 'theseus-lab'),
            'singular_name'      => __('Кейс', 'theseus-lab'),
            'add_new'            => __('Добавить кейс', 'theseus-lab'),
            'add_new_item'       => __('Добавить новый кейс', 'theseus-lab'),
            'edit_item'          => __('Редактировать кейс', 'theseus-lab'),
            'new_item'           => __('Новый кейс', 'theseus-lab'),
            'view_item'          => __('Просмотреть кейс', 'theseus-lab'),
            'search_items'       => __('Найти кейс', 'theseus-lab'),
            'not_found'          => __('Кейсов не найдено', 'theseus-lab'),
            'not_found_in_trash' => __('В корзине кейсов нет', 'theseus-lab'),
            'menu_name'          => __('Кейсы', 'theseus-lab'),
        ],
        'public'       => true,
        'has_archive'  => false,
        'rewrite'      => ['slug' => 'cases', 'with_front' => false],
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('case_industry', 'case', [
        'labels' => [
            'name'          => __('Отрасли', 'theseus-lab'),
            'singular_name' => __('Отрасль', 'theseus-lab'),
            'add_new_item'  => __('Добавить отрасль', 'theseus-lab'),
            'search_items'  => __('Найти отрасль', 'theseus-lab'),
            'all_items'     => __('Все отрасли', 'theseus-lab'),
            'edit_item'     => __('Редактировать отрасль', 'theseus-lab'),
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'industry', 'with_front' => false],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'theseus_register_case_cpt');

/**
 * Фолбэк-обработчик формы заявки (работает без CF7)
 *
 * Принимает POST через admin-post.php, валидирует nonce,
 * очищает данные и отправляет на email администратора.
 * Поддерживает redirect на страницу-источник (?form=ok / ?form=error).
 */
function theseus_handle_contact_form(): void {
    if (
        !isset($_POST['_theseus_nonce']) ||
        !wp_verify_nonce($_POST['_theseus_nonce'], 'theseus_contact_nonce')
    ) {
        $redirect = !empty($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : home_url('/');
        wp_safe_redirect(add_query_arg('form', 'error', $redirect));
        exit;
    }

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $company = sanitize_text_field($_POST['company'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    $redirect = !empty($_POST['_wp_http_referer']) ? $_POST['_wp_http_referer'] : home_url('/');

    if (empty($name) || empty($email)) {
        wp_safe_redirect(add_query_arg('form', 'error', $redirect));
        exit;
    }

    $to      = get_option('admin_email');
    $subject = __('Заявка с сайта', 'theseus-lab') . ' ' . get_bloginfo('name');
    $body    = __('Имя', 'theseus-lab') . ": {$name}\n" . __('Компания', 'theseus-lab') . ": {$company}\nEmail: {$email}\n" . __('Телефон', 'theseus-lab') . ": {$phone}\n\n" . __('Сообщение', 'theseus-lab') . ":\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>"];

    $sent = wp_mail($to, $subject, $body, $headers);

    wp_safe_redirect(add_query_arg('form', $sent ? 'ok' : 'error', $redirect));
    exit;
}
add_action('admin_post_theseus_contact', 'theseus_handle_contact_form');
add_action('admin_post_nopriv_theseus_contact', 'theseus_handle_contact_form');

/**
 * Хелпер: получить ACF-поле главной страницы с фолбэком.
 *
 * Читает данные из поста, установленного как «Главная страница»
 * (Настройки → Чтение). Если ACF не установлен или поле пустое —
 * возвращает $default, что позволяет теме работать без плагина.
 */
function theseus_field(string $field_name, string $default = ''): string {
    if (function_exists('get_field')) {
        $front_page_id = (int) get_option('page_on_front');
        $post_id       = $front_page_id > 0 ? $front_page_id : 'option';
        $value         = get_field($field_name, $post_id);
        if ($value) {
            return is_string($value) ? esc_html($value) : $default;
        }
    }
    return $default;
}

/**
 * Хелпер: вывести ACF-поле с фолбэком (echo)
 */
function theseus_field_e(string $field_name, string $default = ''): void {
    echo theseus_field($field_name, $default);
}

/**
 * Хелпер: получить ACF-поле текущей страницы (не главной).
 *
 * В отличие от theseus_field(), который читает с front_page,
 * эта функция читает поле с текущего поста/страницы.
 */
function theseus_page_field(string $field_name, $default = '') {
    if (function_exists('get_field')) {
        $value = get_field($field_name);
        if ($value) {
            return $value;
        }
    }
    return $default;
}

/**
 * Отключаем редактор Gutenberg для страниц (page).
 *
 * Тема использует PHP-шаблоны, контент вводить через блоки нет смысла.
 * Для постов (post) редактор остаётся включённым — там он может пригодиться.
 */
function theseus_disable_gutenberg(bool $use, string $post_type): bool {
    if ($post_type === 'page') {
        return false;
    }
    return $use;
}
add_filter('use_block_editor_for_post_type', 'theseus_disable_gutenberg', 10, 2);

/**
 * Регистрация строк темы для Polylang String Translations.
 *
 * Polylang не умеет автоматически находить вызовы __() в шаблонах —
 * нужно явно «зарегистрировать» строки, которые мы хотим переводить
 * через интерфейс Languages → String Translations.
 * Работает только если Polylang установлен (function_exists).
 */
function theseus_register_polylang_strings(): void {
    if (!function_exists('pll_register_string')) {
        return;
    }

    $strings = [
        'Услуги',
        'Кейсы',
        'Медиа',
        'Рассчитать проект',
        'Оставить заявку',
        'Посмотреть кейсы',
        'Подробнее',
        'Читать',
        'Показать больше',
        'Все права защищены.',
        'Политика cookies',
        'Пользовательское соглашение',
        'Решения',
        'Компания',
        'Контакты',
        'Принять',
        'На главную',
        'Все статьи',
        'Все кейсы',
        'Поделиться:',
        'Скопировать ссылку',
        'Содержание',
        'Написать нам',
        'Обсудить проект',
        'FAQ',
        'Часто задаваемые вопросы',
        'Ваше имя',
        'Email',
        'Телефон',
        'Отправить',
    ];

    foreach ($strings as $s) {
        pll_register_string('theseus-lab', $s, 'Theseus Lab Theme');
    }
}
add_action('init', 'theseus_register_polylang_strings');
