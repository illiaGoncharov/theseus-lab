<?php
/**
 * FAQ секция (главная страница).
 *
 * Читает ACF-группы с front_page через get_field().
 * theseus_field() не подходит — она возвращает только строки,
 * а FAQ-поля — это группы с sub_fields question/answer.
 * Поддерживает до 8 пар «вопрос — ответ»; пустые пропускаются.
 */

$faq_items = [];
if (function_exists('get_field')) {
    $front_page_id = (int) get_option('page_on_front');
    $post_id = $front_page_id > 0 ? $front_page_id : 'option';
    for ($i = 1; $i <= 8; $i++) {
        $group = get_field("faq_{$i}", $post_id);
        if (!empty($group['question']) && !empty($group['answer'])) {
            $faq_items[] = $group;
        }
    }
}

$fallback = [
    ['question' => __('Что такое компьютерное зрение и как оно работает?', 'theseus-lab'), 'answer' => __('Компьютерное зрение — это направление AI, которое позволяет машинам «видеть» и интерпретировать изображения и видео. Наши системы получают видеопоток с камер, обрабатывают каждый кадр нейросетью и в реальном времени выявляют объекты, события и отклонения — без участия человека.', 'theseus-lab')],
    ['question' => __('Нужно ли менять существующие камеры?', 'theseus-lab'), 'answer' => __('Нет. Наши решения интегрируются с любым CCTV или IP-оборудованием через стандартный RTSP-протокол. Вы сохраняете текущую инфраструктуру и просто подключаете к ней AI-аналитику.', 'theseus-lab')],
    ['question' => __('Как быстро можно запустить систему?', 'theseus-lab'), 'answer' => __('Типовой пилотный проект занимает 6–10 недель: аудит и ТЗ (1–2 нед.), сбор и разметка данных (2–4 нед.), обучение модели и развёртывание (2–4 нед.). Сроки зависят от сложности задачи и объёма данных.', 'theseus-lab')],
    ['question' => __('Какова точность детекции?', 'theseus-lab'), 'answer' => __('На типовых задачах (контроль качества, СИЗ, LPR) точность составляет 93–97%. Финальные метрики фиксируются в ТЗ и проверяются на тестовой выборке перед сдачей проекта.', 'theseus-lab')],
    ['question' => __('Где обрабатываются данные — в облаке или на объекте?', 'theseus-lab'), 'answer' => __('Мы поддерживаем оба варианта. Edge-развёртывание (на сервере или GPU-устройстве прямо на объекте) обеспечивает минимальную задержку и работу без интернета. Облачный вариант удобен для распределённых объектов и централизованной аналитики.', 'theseus-lab')],
    ['question' => __('Как обеспечивается безопасность видеоданных?', 'theseus-lab'), 'answer' => __('Видеопоток обрабатывается локально или в изолированном облачном контуре. Мы не храним сырое видео дольше, чем требует регламент заказчика. Все данные передаются по зашифрованным каналам, доступ разграничен по ролям.', 'theseus-lab')],
    ['question' => __('Можно ли интегрировать систему с нашей ERP или MES?', 'theseus-lab'), 'answer' => __('Да. Мы предоставляем REST API и webhook-уведомления, которые легко подключаются к SAP, 1С, любым MES/SCADA-системам. Также поддерживается экспорт событий в базы данных и BI-инструменты.', 'theseus-lab')],
    ['question' => __('Каков срок окупаемости?', 'theseus-lab'), 'answer' => __('По нашим проектам ROI достигается за 6–18 месяцев. Основная экономия — сокращение ручного контроля, снижение брака и потерь от инцидентов. Точный расчёт делаем бесплатно на этапе консультации.', 'theseus-lab')],
];

if (empty($faq_items)) {
    $faq_items = $fallback;
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
            <h2 class="section-title">
                <?php theseus_field_e('faq_title', esc_html__('Часто задаваемые', 'theseus-lab')); ?><br><span class="text-muted-30"><?php theseus_field_e('faq_title_accent', esc_html__('вопросы', 'theseus-lab')); ?></span>
            </h2>
            <?php
            $faq_lead = theseus_field('faq_lead', esc_html__('Отвечаем на самые популярные вопросы о внедрении AI-систем компьютерного зрения.', 'theseus-lab'));
            if ($faq_lead) : ?>
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
