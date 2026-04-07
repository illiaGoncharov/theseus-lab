<?php
/**
 * Template Name: Контакты
 *
 * Страница с формой обратной связи, контактной информацией и картой.
 * Карта берётся из ACF-поля contact_map_iframe (textarea с iframe-кодом).
 */
get_header();

$phone    = theseus_page_field('contact_phone', '+7 (812) 240-81-18');
$telegram = theseus_page_field('contact_telegram', 'https://t.me/theseuslab');
$whatsapp = theseus_page_field('contact_whatsapp', 'https://wa.me/78122408118');
$email    = theseus_page_field('contact_email', 'info@theseuslab.ru');
$schedule = theseus_page_field('contact_schedule', __('Пн–Пт: 10:00 – 18:00', 'theseus-lab'));
$address  = theseus_page_field('contact_address', __('Санкт-Петербург, ул. М. Говорова, 35, офис 4', 'theseus-lab'));
$map_iframe = theseus_page_field('contact_map_iframe', '');

$phone_clean = preg_replace('/\D/', '', $phone);

$form_status = isset($_GET['form']) ? sanitize_text_field($_GET['form']) : '';
?>

<!-- Page title -->
<section class="contact-title">
    <div class="container-wide">
        <p class="contact-title__label"><?php esc_html_e('Контакты', 'theseus-lab'); ?></p>
        <h1 class="contact-title__heading">
            <?php esc_html_e('Свяжитесь с', 'theseus-lab'); ?> <span class="text-accent"><?php esc_html_e('нами', 'theseus-lab'); ?></span>
        </h1>
    </div>
</section>

<!-- Contacts strip -->
<section class="contact-strip">
    <div class="container-wide">
        <div class="contact-strip__row">

            <div class="contact-strip__item">
                <div class="contact-strip__icon">
                    <i class="ri-phone-line"></i>
                </div>
                <a href="tel:+<?php echo esc_attr($phone_clean); ?>" class="contact-strip__link">
                    <?php echo esc_html($phone); ?>
                </a>
                <div class="contact-strip__messengers">
                    <?php if ($telegram) : ?>
                        <a href="<?php echo esc_url($telegram); ?>" target="_blank" rel="nofollow noopener noreferrer" class="contact-strip__messenger">
                            <i class="ri-telegram-line"></i>
                        </a>
                    <?php endif; ?>
                    <?php if ($whatsapp) : ?>
                        <a href="<?php echo esc_url($whatsapp); ?>" target="_blank" rel="nofollow noopener noreferrer" class="contact-strip__messenger">
                            <i class="ri-whatsapp-line"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <a href="mailto:<?php echo esc_attr($email); ?>" class="contact-strip__item contact-strip__item--link">
                <div class="contact-strip__icon">
                    <i class="ri-mail-line"></i>
                </div>
                <span><?php echo esc_html($email); ?></span>
            </a>

            <div class="contact-strip__item">
                <div class="contact-strip__icon">
                    <i class="ri-time-line"></i>
                </div>
                <span><?php echo esc_html($schedule); ?></span>
            </div>

            <div class="contact-strip__item">
                <div class="contact-strip__icon">
                    <i class="ri-map-pin-line"></i>
                </div>
                <span><?php echo esc_html($address); ?></span>
            </div>

        </div>
    </div>
</section>

<!-- Form + Map -->
<section class="contact-main">
    <div class="container-wide">
        <div class="contact-main__grid">

            <!-- Form -->
            <div class="contact-form-wrap">
                <div class="contact-form-card">
                    <div class="contact-form-card__header">
                        <h2 class="contact-form-card__title">
                            <?php esc_html_e('Готовы обсудить', 'theseus-lab'); ?><br>
                            <span class="text-muted-30"><?php esc_html_e('вашу задачу?', 'theseus-lab'); ?></span>
                        </h2>
                        <p class="contact-form-card__desc">
                            <?php esc_html_e('Расскажите о вашей задаче — мы проведём бесплатную консультацию и предложим оптимальное AI‑решение под ваш бизнес.', 'theseus-lab'); ?>
                        </p>
                    </div>

                    <form class="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action" value="theseus_contact">
                        <?php wp_nonce_field('theseus_contact_nonce', '_theseus_nonce'); ?>

                        <div class="contact-form__row">
                            <input type="text" name="name" required
                                   class="contact-form__input" placeholder="<?php echo esc_attr__('Ваше имя', 'theseus-lab'); ?>">
                            <input type="text" name="company" required
                                   class="contact-form__input" placeholder="<?php echo esc_attr__('Компания', 'theseus-lab'); ?>">
                        </div>
                        <div class="contact-form__row">
                            <input type="email" name="email" required
                                   class="contact-form__input" placeholder="<?php echo esc_attr__('Email', 'theseus-lab'); ?>">
                            <input type="tel" name="phone"
                                   class="contact-form__input" placeholder="<?php echo esc_attr__('Телефон', 'theseus-lab'); ?>">
                        </div>
                        <div class="contact-form__textarea-wrap">
                            <textarea name="message" required maxlength="500" rows="4"
                                      class="contact-form__textarea"
                                      placeholder="<?php echo esc_attr__('Опишите вашу задачу', 'theseus-lab'); ?>"
                                      id="contact-message-field"></textarea>
                            <span class="contact-form__counter" id="contact-char-counter">0/500</span>
                        </div>

                        <button type="submit" class="btn btn-accent btn--full">
                            <?php esc_html_e('Оставить заявку', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i>
                        </button>

                        <p class="contact-form__disclaimer">
                            <?php esc_html_e('Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности', 'theseus-lab'); ?>
                        </p>

                        <?php if ($form_status === 'ok') : ?>
                            <div class="contact-form__status contact-form__status--ok">
                                <?php esc_html_e('Спасибо! Заявка отправлена — мы свяжемся с вами в ближайшее время.', 'theseus-lab'); ?>
                            </div>
                        <?php elseif ($form_status === 'error') : ?>
                            <div class="contact-form__status contact-form__status--error">
                                <?php esc_html_e('Ошибка при отправке. Попробуйте позже.', 'theseus-lab'); ?>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Map -->
            <div class="contact-map-wrap">
                <div class="contact-map">
                    <?php if ($map_iframe) : ?>
                        <?php echo $map_iframe; ?>
                    <?php else : ?>
                        <div class="contact-map__placeholder">
                            <i class="ri-map-2-line"></i>
                            <p><?php esc_html_e('Карта появится после заполнения поля «Карта (iframe-код)» в WP-admin', 'theseus-lab'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
get_footer();
