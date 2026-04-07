<?php
$portfolio_cases = [
    ['industry' => __('Производство', 'theseus-lab'), 'title' => theseus_field('port1_title', __('Автоматизация контроля качества', 'theseus-lab')), 'desc' => theseus_field('port1_desc', __('Ручной контроль занимал много времени и приводил к пропуску дефектов', 'theseus-lab')), 'result' => '95%', 'result_label' => __('точность обнаружения дефектов', 'theseus-lab'), 'image' => theseus_field('port1_image', '')],
    ['industry' => __('Логистика', 'theseus-lab'), 'title' => theseus_field('port2_title', __('Мониторинг безопасности склада', 'theseus-lab')), 'desc' => theseus_field('port2_desc', __('Невозможность отслеживать все зоны и своевременно реагировать на инциденты', 'theseus-lab')), 'result' => '80%', 'result_label' => __('сокращение инцидентов', 'theseus-lab'), 'image' => theseus_field('port2_image', '')],
    ['industry' => __('Ритейл', 'theseus-lab'), 'title' => theseus_field('port3_title', __('Анализ поведения покупателей', 'theseus-lab')), 'desc' => theseus_field('port3_desc', __('Отсутствие данных о движении покупателей и эффективности выкладки', 'theseus-lab')), 'result' => '35%', 'result_label' => __('рост конверсии', 'theseus-lab'), 'image' => theseus_field('port3_image', '')],
    ['industry' => __('Строительство', 'theseus-lab'), 'title' => theseus_field('port4_title', __('Контроль техники безопасности', 'theseus-lab')), 'desc' => theseus_field('port4_desc', __('Сложность контроля использования СИЗ на большой стройплощадке', 'theseus-lab')), 'result' => '90%', 'result_label' => __('соблюдение требований', 'theseus-lab'), 'image' => theseus_field('port4_image', '')],
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
                <span class="section-label"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></span>
                <h2 class="section-title">
                    <?php theseus_field_e('portfolio_title', esc_html__('Реальные внедрения', 'theseus-lab')); ?><br><span class="text-muted-30"><?php theseus_field_e('portfolio_title_accent', esc_html__('с измеримым результатом', 'theseus-lab')); ?></span>
                </h2>
            </div>
            <a href="#contact" class="btn btn-outline" data-popup="contact"><?php esc_html_e('Обсудить ваш проект', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i></a>
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
