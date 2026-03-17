<?php
$directions = [
    [
        'num' => '01',
        'icon' => 'ri-eye-2-line',
        'title' => theseus_field('dir1_title', 'Машинное зрение'),
        'desc' => theseus_field('dir1_desc', 'Системы распознавания объектов, анализа видеопотоков и мониторинга в реальном времени. Автоматизация контроля качества и безопасности на производстве.'),
        'tags' => ['Детекция объектов', 'Видеоаналитика', 'Контроль качества'],
        'image' => theseus_field('dir1_image', ''),
    ],
    [
        'num' => '02',
        'icon' => 'ri-mic-2-line',
        'title' => theseus_field('dir2_title', 'Речевые технологии'),
        'desc' => theseus_field('dir2_desc', 'Распознавание и синтез речи, анализ тональности, голосовые интерфейсы и автоматизация коммуникаций для бизнеса.'),
        'tags' => ['ASR / TTS', 'NLP', 'Голосовые боты'],
        'image' => theseus_field('dir2_image', ''),
    ],
    [
        'num' => '03',
        'icon' => 'ri-flow-chart',
        'title' => theseus_field('dir3_title', 'Автоматизация процессов'),
        'desc' => theseus_field('dir3_desc', 'Интеллектуальные системы для оптимизации рабочих процессов, прогнозирования и принятия решений на основе данных.'),
        'tags' => ['RPA', 'Предиктивная аналитика', 'Decision AI'],
        'image' => theseus_field('dir3_image', ''),
    ],
];
$dir_placeholders = [
    'https://placehold.co/600x400/111111/333333?text=CV',
    'https://placehold.co/600x400/111111/333333?text=Speech',
    'https://placehold.co/600x400/111111/333333?text=Automation',
];
?>
<section class="section directions" id="directions">
    <div class="container">
        <div class="directions-header reveal-item">
            <div>
                <span class="section-label">Что мы делаем</span>
                <h2 class="section-title">
                    <?php theseus_field_e('directions_title', 'Три направления'); ?><br><span class="text-muted-30"><?php theseus_field_e('directions_title_accent', 'нашей экспертизы'); ?></span>
                </h2>
            </div>
            <p class="section-desc directions-desc">
                <?php theseus_field_e('directions_desc', 'Разрабатываем AI-системы под конкретные бизнес-задачи — от прототипа до промышленного внедрения'); ?>
            </p>
        </div>

        <div class="directions-grid">
            <?php foreach ($directions as $i => $d) : 
                $img_src = !empty($d['image']) ? $d['image'] : $dir_placeholders[$i];
            ?>
            <a href="#contact" class="direction-card reveal-item" data-popup="contact" style="transition-delay: <?php echo $i * 120; ?>ms">
                <div class="direction-card-image">
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($d['title']); ?>" loading="lazy">
                    <div class="direction-card-overlay"></div>
                    <div class="direction-card-icon"><i class="<?php echo esc_attr($d['icon']); ?>"></i></div>
                    <span class="direction-card-num"><?php echo esc_html($d['num']); ?></span>
                </div>
                <div class="direction-card-body">
                    <h3><?php echo esc_html($d['title']); ?></h3>
                    <p class="text-muted"><?php echo esc_html($d['desc']); ?></p>
                    <div class="direction-tags">
                        <?php foreach ($d['tags'] as $tag) : ?>
                        <span class="direction-tag"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <span class="direction-link">Подробнее <i class="ri-arrow-right-line"></i></span>
                </div>
                <div class="direction-accent-line"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
