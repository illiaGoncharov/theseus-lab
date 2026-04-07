<?php
$fallback = [
    ['num' => '01', 'title' => __('Аудит и ТЗ', 'theseus-lab'),       'duration' => __('1–2 нед.', 'theseus-lab'), 'tasks' => __("Обследование объекта и инфраструктуры\nСбор требований к детекции\nСогласование метрик успеха", 'theseus-lab')],
    ['num' => '02', 'title' => __('Сбор данных', 'theseus-lab'),       'duration' => __('2–4 нед.', 'theseus-lab'), 'tasks' => __("Съёмка на объекте или подготовка датасета\nРазметка и аугментация данных\nОценка базового качества модели", 'theseus-lab')],
    ['num' => '03', 'title' => __('Обучение модели', 'theseus-lab'),   'duration' => __('2–6 нед.', 'theseus-lab'), 'tasks' => __("Fine-tuning или обучение с нуля\nВалидация на тестовой выборке\nОптимизация под целевое железо", 'theseus-lab')],
    ['num' => '04', 'title' => __('Пилот и запуск', 'theseus-lab'),    'duration' => __('2–4 нед.', 'theseus-lab'), 'tasks' => __("Развёртывание на объекте\nИнтеграция с CCTV и системами уведомлений\nСдача, документация, поддержка", 'theseus-lab')],
];

$stages = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 4; $i++) {
        $group = get_field("exp_stage_{$i}");
        if (!empty($group['title'])) {
            $stages[] = $group;
        }
    }
}
if (empty($stages)) {
    $stages = $fallback;
}
?>
<section class="section exp-implementation">
    <div class="container">
        <div class="exp-impl-header reveal-item">
            <div>
                <span class="section-label"><?php esc_html_e('Процесс', 'theseus-lab'); ?></span>
                <h2 class="section-title">
                    <?php esc_html_e('Этапы', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('внедрения', 'theseus-lab'); ?></span>
                </h2>
            </div>
            <p class="exp-impl-desc"><?php esc_html_e('Прозрачный процесс — от первой встречи до запуска в продакшн', 'theseus-lab'); ?></p>
        </div>

        <div class="exp-impl-grid">
            <?php foreach ($stages as $i => $stage) :
                // Задачи — строка с новой строки, превращаем в массив
                $tasks = array_filter(array_map('trim', explode("\n", $stage['tasks'] ?? '')));
            ?>
            <div class="exp-impl-card reveal-item" style="transition-delay: <?php echo $i * 100; ?>ms">
                <div class="exp-impl-card-top">
                    <span class="exp-impl-card-num"><?php echo esc_html($stage['num']); ?></span>
                    <span class="exp-impl-card-duration"><?php echo esc_html($stage['duration']); ?></span>
                </div>
                <h3><?php echo esc_html($stage['title']); ?></h3>
                <?php if (!empty($tasks)) : ?>
                <ul>
                    <?php foreach ($tasks as $task) : ?>
                    <li>
                        <span class="exp-impl-dot"></span>
                        <?php echo esc_html($task); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <div class="exp-impl-card-accent"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
