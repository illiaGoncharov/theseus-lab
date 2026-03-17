<?php
$process_stages = [
    ['icon' => 'ri-search-eye-line', 'num' => '01', 'tag' => 'Discovery', 'title' => 'Анализ задачи', 'desc' => 'Изучаем бизнес-процессы, выявляем узкие места и формируем чёткие требования к AI-системе.', 'duration' => '1–2 нед.'],
    ['icon' => 'ri-draft-line', 'num' => '02', 'tag' => 'Design', 'title' => 'Проектирование', 'desc' => 'Разрабатываем архитектуру решения, выбираем стек технологий и согласуем прототип.', 'duration' => '1–3 нед.'],
    ['icon' => 'ri-code-s-slash-line', 'num' => '03', 'tag' => 'Build', 'title' => 'Разработка', 'desc' => 'Создаём и обучаем модели, пишем программное обеспечение и проводим тестирование.', 'duration' => '2–8 нед.'],
    ['icon' => 'ri-plug-2-line', 'num' => '04', 'tag' => 'Deploy', 'title' => 'Интеграция', 'desc' => 'Внедряем систему в вашу инфраструктуру, настраиваем процессы и обучаем команду.', 'duration' => '1–2 нед.'],
    ['icon' => 'ri-shield-check-line', 'num' => '05', 'tag' => 'Support', 'title' => 'Поддержка', 'desc' => 'Мониторим работу системы, оптимизируем производительность и развиваем функциональность.', 'duration' => 'Ongoing'],
];
?>
<section class="section process" id="process">
    <div class="container">
        <div class="process-header">
            <div>
                <span class="section-label">Процесс</span>
                <h2 class="section-title"><?php theseus_field_e('process_title', 'Этапы работы'); ?></h2>
            </div>
            <p class="process-desc"><?php theseus_field_e('process_desc', 'Прозрачный процесс от первого звонка до запуска и масштабирования вашего AI-решения'); ?></p>
        </div>

        <!-- Desktop: горизонтальные кружки с progress-line -->
        <div class="process-desktop">
            <div class="process-progress-wrap">
                <div class="process-progress-bg"></div>
                <div id="process-progress-fill" class="process-progress-fill"></div>
            </div>
            <div class="process-stages">
                <?php foreach ($process_stages as $i => $s) : ?>
                <div class="process-stage" data-stage="<?php echo $i; ?>">
                    <div class="process-stage-circle">
                        <i class="<?php echo esc_attr($s['icon']); ?>"></i>
                        <span class="process-stage-badge"><?php echo $i + 1; ?></span>
                    </div>
                    <span class="process-stage-tag"><?php echo esc_html($s['tag']); ?></span>
                    <h3><?php echo esc_html($s['title']); ?></h3>
                    <p class="process-stage-desc"><?php echo esc_html($s['desc']); ?></p>
                    <span class="process-stage-duration"><?php echo esc_html($s['duration']); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Mobile: вертикальные карточки -->
        <div class="process-mobile">
            <?php foreach ($process_stages as $i => $s) : ?>
            <div class="process-mobile-card">
                <span class="process-mobile-num"><?php echo esc_html($s['num']); ?></span>
                <div class="process-mobile-content">
                    <div class="process-mobile-meta">
                        <div class="process-mobile-icon"><i class="<?php echo esc_attr($s['icon']); ?>"></i></div>
                        <span class="process-stage-tag"><?php echo esc_html($s['tag']); ?></span>
                        <span class="process-stage-duration"><?php echo esc_html($s['duration']); ?></span>
                    </div>
                    <h3><?php echo esc_html($s['title']); ?></h3>
                    <p><?php echo esc_html($s['desc']); ?></p>
                </div>
                <?php if ($i < count($process_stages) - 1) : ?><div class="process-mobile-connector"></div><?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
