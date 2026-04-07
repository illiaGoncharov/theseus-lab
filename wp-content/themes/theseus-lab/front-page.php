<?php
/**
 * Шаблон главной страницы — лендинг Theseus Lab
 *
 * WordPress использует front-page.php когда в настройках
 * «Чтение» выбрана статическая главная страница.
 * Работает и без этой настройки — как фолбэк.
 */
get_header();
?>

<?php get_template_part('template-parts/section', 'hero'); ?>
<?php get_template_part('template-parts/section', 'directions'); ?>
<?php get_template_part('template-parts/section', 'cases'); ?>
<?php get_template_part('template-parts/section', 'process'); ?>
<?php get_template_part('template-parts/section', 'tech'); ?>
<?php get_template_part('template-parts/section', 'architecture'); ?>
<?php get_template_part('template-parts/section', 'portfolio'); ?>
<?php get_template_part('template-parts/section', 'faq'); ?>
<?php get_template_part('template-parts/section', 'cta'); ?>

<?php
get_footer();
