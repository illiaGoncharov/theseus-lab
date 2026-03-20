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
    $theme_version = wp_get_theme()->get('Version');

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

    // Основные стили темы
    wp_enqueue_style(
        'theseus-style',
        get_stylesheet_uri(),
        ['theseus-fonts', 'remixicon'],
        $theme_version
    );

    // JS темы
    wp_enqueue_script(
        'theseus-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $theme_version,
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
 * Фолбэк-обработчик формы заявки (работает без CF7)
 *
 * Принимает POST через admin-post.php, валидирует nonce,
 * очищает данные и отправляет на email администратора.
 */
function theseus_handle_contact_form(): void {
    if (
        !isset($_POST['_theseus_nonce']) ||
        !wp_verify_nonce($_POST['_theseus_nonce'], 'theseus_contact_nonce')
    ) {
        wp_safe_redirect(home_url('/?form=error'));
        exit;
    }

    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $phone   = sanitize_text_field($_POST['phone'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (empty($name) || empty($email)) {
        wp_safe_redirect(home_url('/?form=error'));
        exit;
    }

    $to      = get_option('admin_email');
    $subject = 'Заявка с сайта ' . get_bloginfo('name');
    $body    = "Имя: {$name}\nEmail: {$email}\nТелефон: {$phone}\n\nСообщение:\n{$message}";
    $headers = ['Content-Type: text/plain; charset=UTF-8', "Reply-To: {$name} <{$email}>"];

    $sent = wp_mail($to, $subject, $body, $headers);

    wp_safe_redirect(home_url('/?form=' . ($sent ? 'ok' : 'error')));
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
