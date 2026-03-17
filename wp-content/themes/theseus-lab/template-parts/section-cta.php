<section class="section cta" id="contact">
    <div class="cta-grid-bg" aria-hidden="true"></div>
    <div class="cta-glow" aria-hidden="true"></div>

    <div class="container">
        <div class="cta-block reveal-item">
            <div class="cta-content">
                <span class="section-label">Начать проект</span>
                <h2 class="section-title">
                    <?php theseus_field_e('cta_title', 'Готовы обсудить'); ?><br><span class="text-muted-30"><?php theseus_field_e('cta_title_accent', 'вашу задачу?'); ?></span>
                </h2>
                <p class="cta-desc">
                    <?php theseus_field_e('cta_desc', 'Расскажите о вашей задаче — мы проведём бесплатную консультацию и предложим оптимальное AI-решение под ваш бизнес.'); ?>
                </p>
            </div>
            <div class="cta-form-wrap">
                <?php if (shortcode_exists('contact-form-7')) : ?>
                    <?php echo do_shortcode('[contact-form-7 id="contact-form" title="Заявка"]'); ?>
                <?php else : ?>
                <form class="cta-form" action="#" method="post">
                    <input type="text" name="your-name" placeholder="Ваше имя" required>
                    <input type="tel" name="your-phone" placeholder="Телефон" required>
                    <button type="submit" class="btn btn-primary">Оставить заявку <i class="ri-arrow-right-line"></i></button>
                </form>
                <?php endif; ?>
                <p class="cta-privacy">Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности</p>
            </div>
        </div>
    </div>
</section>
