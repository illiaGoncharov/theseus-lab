<?php
$techs = [
    ['name' => 'Python', 'icon' => 'ri-code-s-slash-line', 'category' => 'Core'],
    ['name' => 'PyTorch', 'icon' => 'ri-fire-line', 'category' => 'ML'],
    ['name' => 'TensorFlow', 'icon' => 'ri-brain-line', 'category' => 'ML'],
    ['name' => 'OpenCV', 'icon' => 'ri-eye-line', 'category' => 'Vision'],
    ['name' => 'YOLO', 'icon' => 'ri-focus-3-line', 'category' => 'Vision'],
    ['name' => 'Yandex Speech', 'icon' => 'ri-mic-line', 'category' => 'Speech'],
    ['name' => 'Django', 'icon' => 'ri-layout-line', 'category' => 'Backend'],
    ['name' => 'Docker', 'icon' => 'ri-ship-line', 'category' => 'Infra'],
    ['name' => 'PostgreSQL', 'icon' => 'ri-database-line', 'category' => 'Data'],
    ['name' => 'Redis', 'icon' => 'ri-database-2-line', 'category' => 'Data'],
    ['name' => 'FastAPI', 'icon' => 'ri-rocket-line', 'category' => 'API'],
    ['name' => 'React', 'icon' => 'ri-reactjs-line', 'category' => 'UI'],
];
?>
<section class="section tech" id="tech">
    <div class="container">
        <div class="tech-header reveal-item">
            <div>
                <span class="section-label">Технологии</span>
                <h2 class="section-title">
                    <?php theseus_field_e('tech_title', 'Стек, на котором'); ?><br><span class="text-muted-30"><?php theseus_field_e('tech_title_accent', 'строятся системы'); ?></span>
                </h2>
            </div>
            <p class="tech-desc"><?php theseus_field_e('tech_desc', 'Используем проверенные инструменты и открытые стандарты для создания надёжных AI-решений'); ?></p>
        </div>

        <div class="tech-grid reveal-item">
            <?php foreach ($techs as $t) : ?>
            <div class="tech-badge">
                <div class="tech-badge-icon"><i class="<?php echo esc_attr($t['icon']); ?>"></i></div>
                <span class="tech-name"><?php echo esc_html($t['name']); ?></span>
                <span class="tech-cat"><?php echo esc_html($t['category']); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
