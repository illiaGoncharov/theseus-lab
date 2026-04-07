<?php
/**
 * Template Name: Страница услуги
 *
 * Этот комментарий — сигнал для WordPress.
 * Он делает шаблон доступным в выпадающем списке «Шаблон»
 * при редактировании любой страницы в WP Admin.
 *
 * Чтобы использовать: создай страницу → выбери «Страница услуги»
 * в блоке «Атрибуты страницы» → заполни ACF-вкладки.
 */
get_header();
?>

<?php get_template_part('template-parts/expertise/section', 'hero'); ?>
<?php get_template_part('template-parts/expertise/section', 'problems'); ?>
<?php get_template_part('template-parts/expertise/section', 'solution'); ?>
<?php get_template_part('template-parts/expertise/section', 'how-it-works'); ?>
<?php get_template_part('template-parts/expertise/section', 'scenarios'); ?>
<?php get_template_part('template-parts/expertise/section', 'industries'); ?>
<?php get_template_part('template-parts/expertise/section', 'benefits'); ?>
<?php get_template_part('template-parts/expertise/section', 'implementation'); ?>
<?php get_template_part('template-parts/section', 'tech'); ?>
<?php get_template_part('template-parts/expertise/section', 'faq'); ?>
<?php get_template_part('template-parts/section', 'cta'); ?>

<?php
get_footer();
