<?php
// Фолбэк-данные — используются если ACF не установлен или поля не заполнены
$fallback_subtitle      = __('Машинное зрение', 'theseus-lab');
$fallback_title         = __('Машинное', 'theseus-lab');
$fallback_title_accent  = __('зрение', 'theseus-lab');
$fallback_description   = __('Внедряем системы компьютерного зрения, которые анализируют видеопотоки в реальном времени, автоматизируют контроль качества и обеспечивают безопасность объектов.', 'theseus-lab');

if (function_exists('get_field')) {
    $subtitle     = get_field('exp_subtitle')     ?: $fallback_subtitle;
    $title        = get_field('exp_title')        ?: $fallback_title;
    $title_accent = get_field('exp_title_accent') ?: $fallback_title_accent;
    $description  = get_field('exp_description')  ?: $fallback_description;
} else {
    $subtitle     = $fallback_subtitle;
    $title        = $fallback_title;
    $title_accent = $fallback_title_accent;
    $description  = $fallback_description;
}
?>
<section class="section exp-hero" id="expertise-hero">
    <canvas id="exp-hero-canvas" class="exp-hero-canvas" aria-hidden="true"></canvas>
    <div class="exp-hero-grid-lines" aria-hidden="true"></div>
    <div id="exp-hero-glow" class="exp-hero-glow" aria-hidden="true"></div>

    <div class="container exp-hero-content-wrap">
        <!-- Breadcrumb -->
        <nav class="exp-hero-breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Главная', 'theseus-lab'); ?></a>
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
            <span><?php esc_html_e('Услуги', 'theseus-lab'); ?></span>
            <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
            <span class="current"><?php echo esc_html($subtitle); ?></span>
        </nav>

        <div class="exp-hero-layout">
            <div class="exp-hero-main">
                <div class="section-label"><?php echo esc_html($subtitle); ?></div>

                <h1 class="exp-hero-title">
                    <?php echo esc_html($title); ?><br>
                    <span><?php echo esc_html($title_accent); ?></span>
                </h1>

                <p class="exp-hero-desc"><?php echo esc_html($description); ?></p>

                <div class="exp-hero-actions">
                    <a href="#contact" class="btn btn-primary" data-popup="contact"><?php esc_html_e('Обсудить проект', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i></a>
                    <a href="#how-it-works" class="btn btn-outline"><?php esc_html_e('Как это работает', 'theseus-lab'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="exp-hero-bottom-fade" aria-hidden="true"></div>
</section>
