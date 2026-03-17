<?php
$cases = [
    [
        'index' => '01',
        'title' => theseus_field('case1_title', 'Мониторинг безопасности'),
        'desc' => theseus_field('case1_desc', 'Автоматическое обнаружение инцидентов, несанкционированного доступа и нарушений протоколов в режиме реального времени.'),
        'pipeline' => ['Камеры', 'AI-модель', 'Детекция событий', 'Аналитика'],
        'metric' => '−80%',
        'metric_label' => 'инцидентов',
        'image' => theseus_field('case1_image', ''),
    ],
    [
        'index' => '02',
        'title' => theseus_field('case2_title', 'Анализ производительности персонала'),
        'desc' => theseus_field('case2_desc', 'Оценка эффективности работы, выявление узких мест в процессах и оптимизация рабочих операций на основе видеоданных.'),
        'pipeline' => ['Видеопоток', 'Обработка', 'Анализ', 'Отчёты'],
        'metric' => '+40%',
        'metric_label' => 'эффективность',
        'image' => theseus_field('case2_image', ''),
    ],
    [
        'index' => '03',
        'title' => theseus_field('case3_title', 'Распознавание объектов и материалов'),
        'desc' => theseus_field('case3_desc', 'Идентификация и классификация объектов, контроль качества продукции и автоматизация учёта материалов.'),
        'pipeline' => ['Сканирование', 'Детекция', 'Классификация', 'База данных'],
        'metric' => '95%',
        'metric_label' => 'точность',
        'image' => theseus_field('case3_image', ''),
    ],
    [
        'index' => '04',
        'title' => theseus_field('case4_title', 'Мониторинг операционных процессов'),
        'desc' => theseus_field('case4_desc', 'Контроль соблюдения технологических процессов, предотвращение сбоев и оптимизация производственных циклов.'),
        'pipeline' => ['Сенсоры', 'Процессинг', 'Алерты', 'Дашборд'],
        'metric' => '3×',
        'metric_label' => 'быстрее реакция',
        'image' => theseus_field('case4_image', ''),
    ],
];
$case_placeholders = [
    'https://placehold.co/900x560/111111/333333?text=Security',
    'https://placehold.co/900x560/111111/333333?text=Analytics',
    'https://placehold.co/900x560/111111/333333?text=Detection',
    'https://placehold.co/900x560/111111/333333?text=Monitoring',
];
?>
<section class="section use-cases" id="cases">
    <div class="container">
        <div class="reveal-item cases-header">
            <span class="section-label">Сценарии применения</span>
            <h2 class="section-title">
                <?php theseus_field_e('cases_title', 'Как AI решает'); ?><br><span class="text-muted-30"><?php theseus_field_e('cases_title_accent', 'реальные задачи бизнеса'); ?></span>
            </h2>
        </div>

        <div class="cases-list">
            <?php foreach ($cases as $i => $c) : 
                $img_src = !empty($c['image']) ? $c['image'] : $case_placeholders[$i];
            ?>
            <div class="case-card reveal-item" style="transition-delay: <?php echo $i * 80; ?>ms">
                <div class="case-card-inner">
                    <div class="case-card-content">
                        <div class="case-card-header">
                            <span class="case-card-num"><?php echo esc_html($c['index']); ?></span>
                            <div>
                                <h3><?php echo esc_html($c['title']); ?></h3>
                                <p><?php echo esc_html($c['desc']); ?></p>
                            </div>
                        </div>
                        <div class="case-pipeline">
                            <?php foreach ($c['pipeline'] as $pi => $step) : ?>
                            <span class="pipeline-step"><?php echo esc_html($step); ?></span>
                            <?php if ($pi < count($c['pipeline']) - 1) : ?>
                            <span class="pipeline-line"><span class="pipeline-line-hover"></span></span>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="case-metric">
                            <span class="metric"><?php echo esc_html($c['metric']); ?></span>
                            <span class="metric-label"><?php echo esc_html($c['metric_label']); ?></span>
                        </div>
                    </div>
                    <div class="case-card-image">
                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($c['title']); ?>" loading="lazy">
                        <div class="case-card-overlay"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
