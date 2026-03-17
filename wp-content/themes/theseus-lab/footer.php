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
                    <?php theseus_field_e('footer_text', 'Разработка интеллектуальных систем для анализа данных и автоматизации бизнес-процессов'); ?>
                </p>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title">Решения</h4>
                <ul class="footer-links">
                    <li><a href="#directions">Компьютерное зрение</a></li>
                    <li><a href="#directions">Системы безопасности</a></li>
                    <li><a href="#cases">Анализ персонала</a></li>
                    <li><a href="#cases">Распознавание объектов</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title">Компания</h4>
                <ul class="footer-links">
                    <li><a href="#portfolio">Кейсы</a></li>
                    <li><a href="#contact">Контакты</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="footer-col-title">Контакты</h4>
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
            <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Все права защищены.</p>
            <div class="footer-bottom-links">
                <a href="<?php echo esc_url(home_url('/cookies/')); ?>">Политика cookies</a>
                <a href="<?php echo esc_url(home_url('/terms/')); ?>">Пользовательское соглашение</a>
            </div>
        </div>
    </div>
</footer>

<!-- Попап формы заявки -->
<div class="popup-overlay" id="popup-contact">
    <div class="popup-content">
        <button class="popup-close" aria-label="Закрыть">&times;</button>
        <h3 class="mb-3">Оставить заявку</h3>
        <p class="text-muted mb-4">Расскажите о вашей задаче — мы проведём бесплатную консультацию.</p>
        <?php if (shortcode_exists('contact-form-7')) : ?>
            <?php echo do_shortcode('[contact-form-7 id="contact-form" title="Заявка"]'); ?>
        <?php else : ?>
            <?php
            $form_msg = '';
            if (isset($_GET['form'])) {
                $form_msg = $_GET['form'] === 'ok'
                    ? '<div class="form-message form-success">Спасибо! Мы свяжемся с вами в ближайшее время.</div>'
                    : '<div class="form-message form-error">Ошибка отправки. Попробуйте ещё раз.</div>';
            }
            ?>
            <?php echo $form_msg; ?>
            <form class="theseus-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="theseus_contact">
                <?php wp_nonce_field('theseus_contact_nonce', '_theseus_nonce'); ?>
                <label for="contact-name">Имя</label>
                <input type="text" id="contact-name" name="name" placeholder="Ваше имя" required>
                <label for="contact-email">Email</label>
                <input type="email" id="contact-email" name="email" placeholder="email@example.com" required>
                <label for="contact-phone">Телефон</label>
                <input type="tel" id="contact-phone" name="phone" placeholder="+7 (___) ___-__-__">
                <label for="contact-message">Сообщение</label>
                <textarea id="contact-message" name="message" rows="4" placeholder="Расскажите о вашей задаче"></textarea>
                <button type="submit" class="btn btn-primary" style="width:100%">Отправить</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
