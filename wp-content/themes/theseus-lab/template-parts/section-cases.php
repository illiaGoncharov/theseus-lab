<?php
$cases = [
    [
        'index' => '01',
        'title' => theseus_field('case1_title', __('Мониторинг безопасности', 'theseus-lab')),
        'desc' => theseus_field('case1_desc', __('Автоматическое обнаружение инцидентов, несанкционированного доступа и нарушений протоколов в режиме реального времени.', 'theseus-lab')),
        'pipeline' => [__('Камеры', 'theseus-lab'), __('AI-модель', 'theseus-lab'), __('Детекция событий', 'theseus-lab'), __('Аналитика', 'theseus-lab')],
        'metric' => '−80%',
        'metric_label' => __('инцидентов', 'theseus-lab'),
        'image' => theseus_field('case1_image', ''),
        'link' => theseus_field('case1_link', ''),
    ],
    [
        'index' => '02',
        'title' => theseus_field('case2_title', __('Анализ производительности персонала', 'theseus-lab')),
        'desc' => theseus_field('case2_desc', __('Оценка эффективности работы, выявление узких мест в процессах и оптимизация рабочих операций на основе видеоданных.', 'theseus-lab')),
        'pipeline' => [__('Видеопоток', 'theseus-lab'), __('Обработка', 'theseus-lab'), __('Анализ', 'theseus-lab'), __('Отчёты', 'theseus-lab')],
        'metric' => '+40%',
        'metric_label' => __('эффективность', 'theseus-lab'),
        'image' => theseus_field('case2_image', ''),
        'link' => theseus_field('case2_link', ''),
    ],
    [
        'index' => '03',
        'title' => theseus_field('case3_title', __('Распознавание объектов и материалов', 'theseus-lab')),
        'desc' => theseus_field('case3_desc', __('Идентификация и классификация объектов, контроль качества продукции и автоматизация учёта материалов.', 'theseus-lab')),
        'pipeline' => [__('Сканирование', 'theseus-lab'), __('Детекция', 'theseus-lab'), __('Классификация', 'theseus-lab'), __('База данных', 'theseus-lab')],
        'metric' => '95%',
        'metric_label' => __('точность', 'theseus-lab'),
        'image' => theseus_field('case3_image', ''),
        'link' => theseus_field('case3_link', ''),
    ],
    [
        'index' => '04',
        'title' => theseus_field('case4_title', __('Мониторинг операционных процессов', 'theseus-lab')),
        'desc' => theseus_field('case4_desc', __('Контроль соблюдения технологических процессов, предотвращение сбоев и оптимизация производственных циклов.', 'theseus-lab')),
        'pipeline' => [__('Сенсоры', 'theseus-lab'), __('Процессинг', 'theseus-lab'), __('Алерты', 'theseus-lab'), __('Дашборд', 'theseus-lab')],
        'metric' => '3×',
        'metric_label' => __('быстрее реакция', 'theseus-lab'),
        'image' => theseus_field('case4_image', ''),
        'link' => theseus_field('case4_link', ''),
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
            <span class="section-label"><?php esc_html_e('Сценарии применения', 'theseus-lab'); ?></span>
            <h2 class="section-title">
                <?php theseus_field_e('cases_title', esc_html__('Как AI решает', 'theseus-lab')); ?><br><span class="text-muted-30"><?php theseus_field_e('cases_title_accent', esc_html__('реальные задачи бизнеса', 'theseus-lab')); ?></span>
            </h2>
        </div>

        <div class="cases-list">
            <?php foreach ($cases as $i => $c) : 
                $img_src = !empty($c['image']) ? $c['image'] : $case_placeholders[$i];
            ?>
            <div class="case-card reveal-item" style="transition-delay: <?php echo $i * 80; ?>ms" <?php if (!empty($c['link'])) echo 'data-link="' . esc_url($c['link']) . '"'; ?>>
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
                        <?php if (!empty($c['link'])) : ?>
                        <a href="<?php echo esc_url($c['link']); ?>" class="direction-link case-card-link">
                            <?php esc_html_e('Подробнее', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="case-card-image">
                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($c['title']); ?>" loading="lazy">
                        <div class="case-card-overlay"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="section-cta-row reveal-item">
            <a href="#contact" class="btn btn-primary" data-popup="contact">
                <?php esc_html_e('Рассчитать проект', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i>
            </a>
        </div>
    </div>
</section>
