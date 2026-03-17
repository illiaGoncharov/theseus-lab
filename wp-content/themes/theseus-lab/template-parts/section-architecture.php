<?php
$architecture_layers = [
    ['num' => '01', 'icon' => 'ri-database-2-line', 'title' => 'Источники данных', 'desc' => 'Камеры, сенсоры, внешние API и потоковые данные', 'tags' => ['Камеры', 'Сенсоры', 'API', 'Стримы']],
    ['num' => '02', 'icon' => 'ri-brain-line', 'title' => 'Модели компьютерного зрения', 'desc' => 'Предобученные и кастомные нейросети для детекции и классификации', 'tags' => ['YOLO', 'ResNet', 'Custom CNN', 'Transformer']],
    ['num' => '03', 'icon' => 'ri-cpu-line', 'title' => 'Слой обработки', 'desc' => 'Предобработка, извлечение признаков и инференс в реальном времени', 'tags' => ['Preprocessing', 'Feature Extraction', 'Inference']],
    ['num' => '04', 'icon' => 'ri-git-branch-line', 'title' => 'Бизнес-логика', 'desc' => 'Правила, принятие решений и система оповещений', 'tags' => ['Rules Engine', 'Decision Making', 'Alerts']],
    ['num' => '05', 'icon' => 'ri-dashboard-line', 'title' => 'Аналитический дашборд', 'desc' => 'Визуализация данных, отчёты и мониторинг в реальном времени', 'tags' => ['Визуализация', 'Отчёты', 'Мониторинг']],
];
?>
<section class="section architecture" id="architecture">
    <div class="container">
        <div class="architecture-header reveal-item">
            <div>
                <span class="section-label">Архитектура</span>
                <h2 class="section-title">
                    Как устроена<br><span class="text-muted-30">AI-система</span>
                </h2>
            </div>
            <p class="architecture-desc">
                Каждый слой системы решает конкретную задачу — от сбора данных до принятия решений
            </p>
        </div>

        <div class="architecture-layers reveal-item">
            <?php foreach ($architecture_layers as $i => $layer) : ?>
            <div class="architecture-layer">
                <div class="architecture-card">
                    <div class="architecture-card-header">
                        <span class="architecture-num"><?php echo esc_html($layer['num']); ?></span>
                        <div class="architecture-icon"><i class="<?php echo esc_attr($layer['icon']); ?>"></i></div>
                    </div>
                    <h3><?php echo esc_html($layer['title']); ?></h3>
                    <p><?php echo esc_html($layer['desc']); ?></p>
                    <div class="architecture-tags">
                        <?php foreach ($layer['tags'] as $tag) : ?>
                        <span class="architecture-tag"><?php echo esc_html($tag); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if ($i < count($architecture_layers) - 1) : ?>
                <div class="architecture-arrow"><i class="ri-arrow-right-s-line"></i></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="architecture-mobile">
            <?php foreach ($architecture_layers as $i => $layer) : ?>
            <div class="architecture-mobile-item">
                <div class="architecture-card">
                    <div class="architecture-mobile-row">
                        <div class="architecture-icon"><i class="<?php echo esc_attr($layer['icon']); ?>"></i></div>
                        <div>
                            <span class="architecture-num"><?php echo esc_html($layer['num']); ?></span>
                            <h3><?php echo esc_html($layer['title']); ?></h3>
                        </div>
                    </div>
                    <p><?php echo esc_html($layer['desc']); ?></p>
                </div>
                <?php if ($i < count($architecture_layers) - 1) : ?>
                <div class="architecture-arrow-down"><i class="ri-arrow-down-s-line"></i></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
