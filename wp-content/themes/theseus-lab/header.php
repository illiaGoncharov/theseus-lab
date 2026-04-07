<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$header_phone = theseus_field('header_phone', '+7 (812) 240-00-18');
$header_tg = theseus_field('header_telegram', 'https://t.me/theseuslab');
?>
<header class="site-header">
    <nav class="nav">
        <div class="nav-left">
            <?php if (has_custom_logo()) : ?>
                <?php
                $logo = get_custom_logo();
                echo $logo ? str_replace('class="custom-logo-link"', 'class="custom-logo-link nav-logo"', $logo) : '';
                ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
                    <i class="ri-brain-line nav-logo-icon" aria-hidden="true"></i>
                    <span class="nav-logo-text"><?php bloginfo('name'); ?></span>
                </a>
            <?php endif; ?>
        </div>

        <div class="nav-center">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-links',
                    'container'      => false,
                ]);
            } else {
                ?>
                <ul class="nav-links">
                    <li><a href="<?php echo esc_url(home_url('/computer-vision/')); ?>"><?php esc_html_e('Услуги', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cases/')); ?>"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/media/')); ?>"><?php esc_html_e('Медиа', 'theseus-lab'); ?></a></li>
                </ul>
                <?php
            }
            ?>
        </div>

        <div class="nav-right">
            <div class="nav-contact">
                <?php if ($header_phone) : ?>
                    <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $header_phone)); ?>" class="nav-phone">
                        <?php echo esc_html($header_phone); ?>
                    </a>
                <?php endif; ?>
                <?php if ($header_tg) : ?>
                    <a href="<?php echo esc_url($header_tg); ?>" class="nav-tg" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
                        <i class="ri-telegram-line"></i>
                    </a>
                <?php endif; ?>
            </div>
            <?php if (function_exists('pll_the_languages')) : ?>
                <div class="lang-switcher">
                    <?php pll_the_languages(['show_flags' => 0, 'show_names' => 1, 'display_names_as' => 'slug', 'hide_current' => 1]); ?>
                </div>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-cta"><?php theseus_field_e('header_cta_text', esc_html__('Рассчитать проект', 'theseus-lab')); ?></a>
        </div>

        <button class="nav-burger" aria-label="<?php esc_attr_e('Меню', 'theseus-lab'); ?>" aria-expanded="false">
            <i class="ri-menu-3-line nav-burger-icon"></i>
            <i class="ri-close-line nav-burger-close" aria-hidden="true"></i>
        </button>

        <div class="nav-mobile-menu">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-links',
                    'container'      => false,
                ]);
            } else {
                ?>
                <ul class="nav-links">
                    <li><a href="<?php echo esc_url(home_url('/computer-vision/')); ?>"><?php esc_html_e('Услуги', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cases/')); ?>"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/media/')); ?>"><?php esc_html_e('Медиа', 'theseus-lab'); ?></a></li>
                </ul>
                <?php
            }
            ?>
            <?php if (function_exists('pll_the_languages')) : ?>
                <div class="lang-switcher lang-switcher--mobile">
                    <?php pll_the_languages(['show_flags' => 0, 'show_names' => 1, 'display_names_as' => 'slug', 'hide_current' => 1]); ?>
                </div>
            <?php endif; ?>
            <?php if ($header_phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $header_phone)); ?>" class="nav-phone nav-phone-mobile">
                    <?php echo esc_html($header_phone); ?>
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-cta nav-cta-mobile"><?php theseus_field_e('header_cta_text', esc_html__('Рассчитать проект', 'theseus-lab')); ?></a>
        </div>
    </nav>
</header>

<main>
