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
                    <li><a href="#directions">Услуги</a></li>
                    <li><a href="#portfolio">Кейсы</a></li>
                    <li><a href="#cases">Сценарии</a></li>
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
            <a href="#contact" class="nav-cta" data-popup="contact"><?php theseus_field_e('header_cta_text', 'Рассчитать проект'); ?></a>
        </div>

        <button class="nav-burger" aria-label="Меню" aria-expanded="false">
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
                    <li><a href="#directions">Услуги</a></li>
                    <li><a href="#portfolio">Кейсы</a></li>
                    <li><a href="#cases">Сценарии</a></li>
                </ul>
                <?php
            }
            ?>
            <?php if ($header_phone) : ?>
                <a href="tel:<?php echo esc_attr(preg_replace('/\D/', '', $header_phone)); ?>" class="nav-phone nav-phone-mobile">
                    <?php echo esc_html($header_phone); ?>
                </a>
            <?php endif; ?>
            <a href="#contact" class="nav-cta nav-cta-mobile" data-popup="contact"><?php theseus_field_e('header_cta_text', 'Рассчитать проект'); ?></a>
        </div>
    </nav>
</header>

<main>
