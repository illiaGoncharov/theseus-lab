<?php
$portfolio_cases = [
    ['industry' => 'Производство', 'title' => theseus_field('port1_title', 'Автоматизация контроля качества'), 'desc' => theseus_field('port1_desc', 'Ручной контроль занимал много времени и приводил к пропуску дефектов'), 'result' => '95%', 'result_label' => 'точность обнаружения дефектов', 'image' => theseus_field('port1_image', '')],
    ['industry' => 'Логистика', 'title' => theseus_field('port2_title', 'Мониторинг безопасности склада'), 'desc' => theseus_field('port2_desc', 'Невозможность отслеживать все зоны и своевременно реагировать на инциденты'), 'result' => '80%', 'result_label' => 'сокращение инцидентов', 'image' => theseus_field('port2_image', '')],
    ['industry' => 'Ритейл', 'title' => theseus_field('port3_title', 'Анализ поведения покупателей'), 'desc' => theseus_field('port3_desc', 'Отсутствие данных о движении покупателей и эффективности выкладки'), 'result' => '35%', 'result_label' => 'рост конверсии', 'image' => theseus_field('port3_image', '')],
    ['industry' => 'Строительство', 'title' => theseus_field('port4_title', 'Контроль техники безопасности'), 'desc' => theseus_field('port4_desc', 'Сложность контроля использования СИЗ на большой стройплощадке'), 'result' => '90%', 'result_label' => 'соблюдение требований', 'image' => theseus_field('port4_image', '')],
];
$port_placeholders = [
    'https://placehold.co/800x520/111111/333333?text=QA',
    'https://placehold.co/800x520/111111/333333?text=Warehouse',
    'https://placehold.co/800x520/111111/333333?text=Retail',
    'https://placehold.co/800x520/111111/333333?text=Safety',
];
?>
<section class="section portfolio" id="portfolio">
    <div class="container">
        <div class="portfolio-header reveal-item">
            <div>
                <span class="section-label">Кейсы</span>
                <h2 class="section-title">
                    <?php theseus_field_e('portfolio_title', 'Реальные внедрения'); ?><br><span class="text-muted-30"><?php theseus_field_e('portfolio_title_accent', 'с измеримым результатом'); ?></span>
                </h2>
            </div>
            <a href="#contact" class="btn btn-outline" data-popup="contact">Обсудить ваш проект <i class="ri-arrow-right-line"></i></a>
        </div>

        <div class="portfolio-grid">
            <?php foreach ($portfolio_cases as $i => $c) : 
                $img_src = !empty($c['image']) ? $c['image'] : $port_placeholders[$i];
            ?>
            <a href="#contact" class="portfolio-card reveal-item" data-popup="contact" style="transition-delay: <?php echo $i * 80; ?>ms">
                <div class="portfolio-card-image">
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($c['title']); ?>" loading="lazy">
                    <div class="portfolio-card-overlay"></div>
                    <span class="portfolio-card-tag"><?php echo esc_html($c['industry']); ?></span>
                </div>
                <div class="portfolio-card-content">
                    <h3><?php echo esc_html($c['title']); ?></h3>
                    <p><?php echo esc_html($c['desc']); ?></p>
                    <div class="portfolio-metric">
                        <span class="metric"><?php echo esc_html($c['result']); ?></span>
                        <span class="metric-label"><?php echo esc_html($c['result_label']); ?></span>
                    </div>
                </div>
                <div class="portfolio-accent-line"></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
