<?php
$directions = [
    [
        'num' => '01',
        'icon' => 'ri-eye-2-line',
        'title' => theseus_field('dir1_title', __('Машинное зрение', 'theseus-lab')),
        'desc' => theseus_field('dir1_desc', __('Системы распознавания объектов, анализа видеопотоков и мониторинга в реальном времени. Автоматизация контроля качества и безопасности на производстве.', 'theseus-lab')),
        'tags' => [__('Детекция объектов', 'theseus-lab'), __('Видеоаналитика', 'theseus-lab'), __('Контроль качества', 'theseus-lab')],
        'image' => theseus_field('dir1_image', ''),
        'link' => theseus_field('dir1_link', ''),
    ],
    [
        'num' => '02',
        'icon' => 'ri-mic-2-line',
        'title' => theseus_field('dir2_title', __('Речевые технологии', 'theseus-lab')),
        'desc' => theseus_field('dir2_desc', __('Распознавание и синтез речи, анализ тональности, голосовые интерфейсы и автоматизация коммуникаций для бизнеса.', 'theseus-lab')),
        'tags' => ['ASR / TTS', 'NLP', __('Голосовые боты', 'theseus-lab')],
        'image' => theseus_field('dir2_image', ''),
        'link' => theseus_field('dir2_link', ''),
    ],
    [
        'num' => '03',
        'icon' => 'ri-flow-chart',
        'title' => theseus_field('dir3_title', __('Автоматизация процессов', 'theseus-lab')),
        'desc' => theseus_field('dir3_desc', __('Интеллектуальные системы для оптимизации рабочих процессов, прогнозирования и принятия решений на основе данных.', 'theseus-lab')),
        'tags' => ['RPA', __('Предиктивная аналитика', 'theseus-lab'), 'Decision AI'],
        'image' => theseus_field('dir3_image', ''),
        'link' => theseus_field('dir3_link', ''),
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
                <span class="section-label"><?php esc_html_e('Что мы делаем', 'theseus-lab'); ?></span>
                <h2 class="section-title">
                    <?php theseus_field_e('directions_title', esc_html__('Три направления', 'theseus-lab')); ?><br><span class="text-muted-30"><?php theseus_field_e('directions_title_accent', esc_html__('нашей экспертизы', 'theseus-lab')); ?></span>
                </h2>
            </div>
            <p class="section-desc directions-desc">
                <?php theseus_field_e('directions_desc', esc_html__('Разрабатываем AI-системы под конкретные бизнес-задачи — от прототипа до промышленного внедрения', 'theseus-lab')); ?>
            </p>
        </div>

        <div class="directions-grid">
            <?php foreach ($directions as $i => $d) : 
                $img_src = !empty($d['image']) ? $d['image'] : $dir_placeholders[$i];
            ?>
            <a href="<?php echo !empty($d['link']) ? esc_url($d['link']) : '#contact'; ?>" class="direction-card reveal-item" <?php if (empty($d['link'])) echo 'data-popup="contact"'; ?> style="transition-delay: <?php echo $i * 120; ?>ms">
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
                    <span class="direction-link"><?php esc_html_e('Подробнее', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i></span>
                </div>
                <div class="direction-accent-line"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
