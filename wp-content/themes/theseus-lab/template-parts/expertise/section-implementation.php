<?php
$fallback = [
    ['num' => '01', 'title' => 'Аудит и ТЗ',       'duration' => '1–2 нед.', 'tasks' => "Обследование объекта и инфраструктуры\nСбор требований к детекции\nСогласование метрик успеха"],
    ['num' => '02', 'title' => 'Сбор данных',       'duration' => '2–4 нед.', 'tasks' => "Съёмка на объекте или подготовка датасета\nРазметка и аугментация данных\nОценка базового качества модели"],
    ['num' => '03', 'title' => 'Обучение модели',   'duration' => '2–6 нед.', 'tasks' => "Fine-tuning или обучение с нуля\nВалидация на тестовой выборке\nОптимизация под целевое железо"],
    ['num' => '04', 'title' => 'Пилот и запуск',    'duration' => '2–4 нед.', 'tasks' => "Развёртывание на объекте\nИнтеграция с CCTV и системами уведомлений\nСдача, документация, поддержка"],
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
                <span class="section-label">Процесс</span>
                <h2 class="section-title">
                    Этапы<br><span class="text-muted-30">внедрения</span>
                </h2>
            </div>
            <p class="exp-impl-desc">Прозрачный процесс — от первой встречи до запуска в продакшн</p>
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
