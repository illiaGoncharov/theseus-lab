<?php
/**
 * FAQ секция (страница услуги).
 *
 * Читает ACF-поля текущей страницы через get_field().
 * Поддерживает до 8 пар «вопрос — ответ»; пустые пропускаются.
 */

$fallback = [
    ['question' => __('Какие камеры подходят для машинного зрения?', 'theseus-lab'), 'answer' => __('Подходят любые IP-камеры с RTSP-потоком: от бюджетных Hikvision/Dahua до промышленных GigE Vision. Для задач контроля качества на конвейере рекомендуем камеры с разрешением от 2 Мп и частотой от 25 fps. Мы поможем подобрать оптимальное оборудование под вашу задачу.', 'theseus-lab')],
    ['question' => __('Сколько камер можно подключить к одной системе?', 'theseus-lab'), 'answer' => __('Архитектура масштабируется горизонтально. Один GPU-сервер обрабатывает 8–32 потока в зависимости от разрешения и сложности модели. Для крупных объектов разворачиваем кластер из нескольких серверов с единым дашбордом управления.', 'theseus-lab')],
    ['question' => __('Как обучается модель под нашу специфику?', 'theseus-lab'), 'answer' => __('Мы собираем датасет на вашем объекте (или используем ваши архивные записи), размечаем данные и дообучаем (fine-tune) базовую модель. Для большинства задач достаточно 500–2000 размеченных примеров. Итоговая точность проверяется на отложенной тестовой выборке.', 'theseus-lab')],
    ['question' => __('Что происходит, если модель ошибается?', 'theseus-lab'), 'answer' => __('Система логирует все события с уровнем уверенности. Ложные срабатывания и пропуски фиксируются и используются для дообучения модели. Мы настраиваем порог уверенности под ваш баланс между чувствительностью и специфичностью.', 'theseus-lab')],
    ['question' => __('Работает ли система при плохом освещении?', 'theseus-lab'), 'answer' => __('Да. Мы применяем предобработку изображений (нормализация яркости, шумоподавление) и при необходимости рекомендуем ИК-подсветку или тепловизионные камеры. Для ночных условий обучаем модели на данных с аналогичным освещением.', 'theseus-lab')],
    ['question' => __('Нужен ли постоянный интернет для работы?', 'theseus-lab'), 'answer' => __('Нет. Edge-версия системы работает полностью автономно на локальном сервере. Интернет нужен только для удалённого мониторинга дашборда и получения обновлений. Алерты могут отправляться через внутреннюю сеть предприятия.', 'theseus-lab')],
    ['question' => __('Как выглядит техническая поддержка после запуска?', 'theseus-lab'), 'answer' => __('Мы предоставляем SLA-поддержку: мониторинг работоспособности системы, плановые дообучения модели при изменении условий, обновления ПО и консультации команды. Доступны тарифы от базового (8×5) до расширенного (24×7).', 'theseus-lab')],
    ['question' => __('Можно ли начать с пилота на одной камере?', 'theseus-lab'), 'answer' => __('Да, это наш рекомендуемый подход. Пилот на 1–3 камерах позволяет проверить гипотезу, измерить реальный эффект и принять взвешенное решение о масштабировании — без больших первоначальных инвестиций.', 'theseus-lab')],
];

$faq_items = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 8; $i++) {
        $group = get_field("exp_faq_{$i}");
        if (!empty($group['question']) && !empty($group['answer'])) {
            $faq_items[] = $group;
        }
    }
}
if (empty($faq_items)) {
    $faq_items = $fallback;
}

$faq_title = '';
$faq_lead  = '';
if (function_exists('get_field')) {
    $faq_title = get_field('exp_faq_title');
    $faq_lead  = get_field('exp_faq_lead');
}
if (!$faq_title) {
    $faq_title = __('Вопросы о машинном зрении', 'theseus-lab');
}
if (!$faq_lead) {
    $faq_lead = __('Технические и практические вопросы о внедрении систем компьютерного зрения.', 'theseus-lab');
}
?>
<section class="section faq" id="faq">
    <div class="faq-grid-bg" aria-hidden="true"></div>

    <div class="container">
        <div class="faq-header reveal-item">
            <div class="faq-label-row">
                <span class="faq-label-line"></span>
                <span class="section-label"><?php esc_html_e('FAQ', 'theseus-lab'); ?></span>
                <span class="faq-label-line"></span>
            </div>
            <h2 class="section-title"><?php echo esc_html($faq_title); ?></h2>
            <?php if ($faq_lead) : ?>
            <p class="faq-lead"><?php echo esc_html($faq_lead); ?></p>
            <?php endif; ?>
        </div>

        <div class="faq-list">
            <?php foreach ($faq_items as $i => $item) : ?>
            <div class="faq-item reveal-item" style="transition-delay: <?php echo $i * 50; ?>ms">
                <button class="faq-question" type="button">
                    <span><?php echo esc_html($item['question']); ?></span>
                    <i class="ri-arrow-down-s-line"></i>
                </button>
                <div class="faq-answer">
                    <p><?php echo esc_html($item['answer']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
