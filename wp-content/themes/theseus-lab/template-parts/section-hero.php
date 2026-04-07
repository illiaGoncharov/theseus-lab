<section class="section hero" id="hero">
    <!-- Canvas: точечная сетка с реакцией на курсор -->
    <canvas id="hero-canvas" class="hero-canvas" aria-hidden="true"></canvas>

    <!-- Grid-линии (CSS background) -->
    <div class="hero-grid-lines" aria-hidden="true"></div>

    <!-- Glow — следует за курсором, позиция через JS -->
    <div id="hero-glow" class="hero-glow" aria-hidden="true"></div>

    <div class="container hero-content-wrap">
        <div class="hero-content">
            <h1>
                <?php esc_html_e('Разработка', 'theseus-lab'); ?><br><span><?php esc_html_e('AI решений', 'theseus-lab'); ?></span>
            </h1>
            <p class="hero-desc">
                <?php theseus_field_e('hero_desc', esc_html__('Создаём интеллектуальные системы для анализа визуальных данных, мониторинга операций и автоматизации принятия решений.', 'theseus-lab')); ?>
            </p>
            <div class="hero-actions">
                <a href="#contact" class="btn btn-primary" data-popup="contact"><?php esc_html_e('Оставить заявку', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i></a>
                <a href="#portfolio" class="btn btn-outline"><?php esc_html_e('Посмотреть кейсы', 'theseus-lab'); ?></a>
            </div>
        </div>
    </div>

    <!-- Bottom fade -->
    <div class="hero-bottom-fade" aria-hidden="true"></div>
</section>
