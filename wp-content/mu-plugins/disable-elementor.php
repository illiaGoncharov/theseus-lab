<?php
/**
 * Must-Use Plugin: Disable Elementor
 *
 * MU-плагины грузятся первыми — раньше обычных плагинов и темы.
 * Фильтр удаляет Elementor из списка активных плагинов до его инициализации.
 */

defined('ABSPATH') || exit;

add_filter('option_active_plugins', function (array $plugins): array {
    return array_values(array_diff($plugins, [
        'elementor/elementor.php',
        'elementor-pro/elementor-pro.php',
    ]));
});
