</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="footer-brand-logo">
                    <i class="ri-brain-line"></i>
                    <span class="footer-brand-name"><?php bloginfo('name'); ?></span>
                </div>
                <p class="footer-brand-desc">
                    <?php theseus_field_e('footer_text', esc_html__('Разработка интеллектуальных систем для анализа данных и автоматизации бизнес-процессов', 'theseus-lab')); ?>
                </p>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Решения', 'theseus-lab'); ?></h4>
                <ul class="footer-links">
                    <li><a href="#directions"><?php esc_html_e('Компьютерное зрение', 'theseus-lab'); ?></a></li>
                    <li><a href="#directions"><?php esc_html_e('Системы безопасности', 'theseus-lab'); ?></a></li>
                    <li><a href="#cases"><?php esc_html_e('Анализ персонала', 'theseus-lab'); ?></a></li>
                    <li><a href="#cases"><?php esc_html_e('Распознавание объектов', 'theseus-lab'); ?></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Компания', 'theseus-lab'); ?></h4>
                <ul class="footer-links">
                    <li><a href="<?php echo esc_url(home_url('/cases/')); ?>"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/media/')); ?>"><?php esc_html_e('Блог', 'theseus-lab'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Контакты', 'theseus-lab'); ?></a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title"><?php esc_html_e('Контакты', 'theseus-lab'); ?></h4>
                <ul class="footer-contacts">
                    <?php if ($email = theseus_field('footer_email', 'info@theseuslab.ru')) : ?>
                    <li><i class="ri-mail-line"></i> <?php echo esc_html($email); ?></li>
                    <?php endif; ?>
                    <?php if ($phone = theseus_field('header_phone', '+7 (812) 240-00-18')) : ?>
                    <li><i class="ri-phone-line"></i> <?php echo esc_html($phone); ?></li>
                    <?php endif; ?>
                </ul>
                <div class="footer-social">
                    <?php if ($tg = theseus_field('header_telegram', 'https://t.me/theseuslab')) : ?>
                    <a href="<?php echo esc_url($tg); ?>" class="footer-social-link" target="_blank" rel="noopener" aria-label="Telegram"><i class="ri-telegram-line"></i></a>
                    <?php endif; ?>
                    <a href="#" class="footer-social-link" aria-label="YouTube"><i class="ri-youtube-line"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('Все права защищены.', 'theseus-lab'); ?></p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(home_url('/cookies/')); ?>"><?php esc_html_e('Политика cookies', 'theseus-lab'); ?></a>
                <a href="<?php echo esc_url(home_url('/terms/')); ?>"><?php esc_html_e('Пользовательское соглашение', 'theseus-lab'); ?></a>
            </div>
        </div>
    </div>
</footer>

<!-- Попап формы заявки -->
<div class="popup-overlay" id="popup-contact">
    <div class="popup-content">
        <button class="popup-close" aria-label="<?php esc_attr_e('Закрыть', 'theseus-lab'); ?>">&times;</button>
        <h3 class="mb-3"><?php esc_html_e('Оставить заявку', 'theseus-lab'); ?></h3>
        <p class="text-muted mb-4"><?php esc_html_e('Расскажите о вашей задаче — мы проведём бесплатную консультацию.', 'theseus-lab'); ?></p>
        <?php if (shortcode_exists('contact-form-7')) : ?>
            <?php echo do_shortcode('[contact-form-7 id="contact-form" title="Заявка"]'); ?>
        <?php else : ?>
            <?php
            $form_msg = '';
            if (isset($_GET['form'])) {
                $form_msg = $_GET['form'] === 'ok'
                    ? '<div class="form-message form-success">' . esc_html__('Спасибо! Мы свяжемся с вами в ближайшее время.', 'theseus-lab') . '</div>'
                    : '<div class="form-message form-error">' . esc_html__('Ошибка отправки. Попробуйте ещё раз.', 'theseus-lab') . '</div>';
            }
            ?>
            <?php echo $form_msg; ?>
            <form class="theseus-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="theseus_contact">
                <?php wp_nonce_field('theseus_contact_nonce', '_theseus_nonce'); ?>
                <label for="contact-name"><?php esc_html_e('Имя', 'theseus-lab'); ?></label>
                <input type="text" id="contact-name" name="name" placeholder="<?php esc_attr_e('Ваше имя', 'theseus-lab'); ?>" required>
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" name="email" placeholder="email@example.com" required>
                <label for="contact-phone"><?php esc_html_e('Телефон', 'theseus-lab'); ?></label>
                <input type="tel" id="contact-phone" name="phone" placeholder="+7 (___) ___-__-__">
                <label for="contact-message"><?php esc_html_e('Сообщение', 'theseus-lab'); ?></label>
                <textarea id="contact-message" name="message" rows="4" placeholder="<?php esc_attr_e('Расскажите о вашей задаче', 'theseus-lab'); ?>"></textarea>
                <button type="submit" class="btn btn-primary" style="width:100%"><?php esc_html_e('Отправить', 'theseus-lab'); ?></button>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Cookie-баннер -->
<div class="cookie-banner" id="cookie-banner">
    <div class="cookie-banner__inner">
        <p class="cookie-banner__text">
            <?php esc_html_e('Мы используем файлы cookie для улучшения работы сайта.', 'theseus-lab'); ?>
            <a href="<?php echo esc_url(home_url('/cookies/')); ?>" class="cookie-banner__link"><?php esc_html_e('Подробнее', 'theseus-lab'); ?></a>
        </p>
        <button class="cookie-banner__accept" id="cookie-accept" type="button"><?php esc_html_e('Принять', 'theseus-lab'); ?></button>
    </div>
</div>

<!-- Кнопка «Наверх» -->
<button class="scroll-top" id="scroll-top" type="button" aria-label="<?php esc_attr_e('Наверх', 'theseus-lab'); ?>">
    <i class="ri-arrow-up-line"></i>
</button>

<?php wp_footer(); ?>
</body>
</html>
