<section class="section cta" id="contact">
    <div class="cta-grid-bg" aria-hidden="true"></div>
    <div class="cta-glow" aria-hidden="true"></div>

    <div class="container">
        <div class="cta-block reveal-item">
            <div class="cta-content">
                <span class="section-label"><?php esc_html_e('Начать проект', 'theseus-lab'); ?></span>
                <h2 class="section-title">
                    <?php theseus_field_e('cta_title', esc_html__('Готовы обсудить', 'theseus-lab')); ?><br><span class="text-muted-30"><?php theseus_field_e('cta_title_accent', esc_html__('вашу задачу?', 'theseus-lab')); ?></span>
                </h2>
                <p class="cta-desc">
                    <?php theseus_field_e('cta_desc', esc_html__('Расскажите о вашей задаче — мы проведём бесплатную консультацию и предложим оптимальное AI-решение под ваш бизнес.', 'theseus-lab')); ?>
                </p>
            </div>
            <div class="cta-form-wrap">
                <?php if (shortcode_exists('contact-form-7')) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="contact-form" title="Заявка"]'); ?>
                <?php else : ?>
                <form class="cta-form" action="#" method="post">
                    <input type="text" name="your-name" placeholder="<?php echo esc_attr__('Ваше имя', 'theseus-lab'); ?>" required>
                    <input type="tel" name="your-phone" placeholder="<?php echo esc_attr__('Телефон', 'theseus-lab'); ?>" required>
                    <button type="submit" class="btn btn-primary"><?php esc_html_e('Оставить заявку', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i></button>
                </form>
                <?php endif; ?>
                <p class="cta-privacy"><?php esc_html_e('Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности', 'theseus-lab'); ?></p>
            </div>
        </div>
    </div>
</section>
