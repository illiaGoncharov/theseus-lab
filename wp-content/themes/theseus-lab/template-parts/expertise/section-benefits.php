<?php
$fallback = [
    ['icon' => 'ri-arrow-up-line',             'metric' => '+38%', 'metric_label' => __('рост производительности', 'theseus-lab'), 'title' => __('Эффективность производства', 'theseus-lab'), 'description' => __('Автоматизация визуального контроля высвобождает сотрудников для задач с большей добавленной стоимостью.', 'theseus-lab')],
    ['icon' => 'ri-bug-line',                  'metric' => '−72%', 'metric_label' => __('снижение брака', 'theseus-lab'),          'title' => __('Качество продукции', 'theseus-lab'),          'description' => __('Нейросеть обнаруживает дефекты, незаметные человеческому глазу, до попадания продукта на следующий этап.', 'theseus-lab')],
    ['icon' => 'ri-shield-line',               'metric' => '−61%', 'metric_label' => __('инцидентов по ОТ', 'theseus-lab'),       'title' => __('Безопасность персонала', 'theseus-lab'),      'description' => __('Мгновенная реакция на нарушения снижает травматизм и потери от простоев, связанных с несчастными случаями.', 'theseus-lab')],
    ['icon' => 'ri-money-dollar-circle-line',  'metric' => '6–18', 'metric_label' => __('месяцев окупаемость', 'theseus-lab'),    'title' => __('ROI внедрения', 'theseus-lab'),               'description' => __('Экономия на ручном контроле и потерях от брака обеспечивает возврат инвестиций в течение одного-двух сезонов.', 'theseus-lab')],
];

$benefits = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 4; $i++) {
        $group = get_field("exp_benefit_{$i}");
        if (!empty($group['title'])) {
            $benefits[] = $group;
        }
    }
}
if (empty($benefits)) {
    $benefits = $fallback;
}
?>
<section class="section exp-benefits">
    <div class="container">
        <div class="exp-benefits-header reveal-item">
            <div>
                <span class="section-label"><?php esc_html_e('Эффект', 'theseus-lab'); ?></span>
                <h2 class="section-title">
                    <?php esc_html_e('Преимущества', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('для бизнеса', 'theseus-lab'); ?></span>
                </h2>
            </div>
            <p class="exp-benefits-desc"><?php esc_html_e('Измеримые результаты, подтверждённые реальными проектами', 'theseus-lab'); ?></p>
        </div>

        <div class="exp-benefits-grid">
            <?php foreach ($benefits as $i => $b) : ?>
            <div class="exp-benefit-card reveal-item" style="transition-delay: <?php echo $i * 80; ?>ms">
                <div class="exp-benefit-icon">
                    <i class="<?php echo esc_attr($b['icon']); ?>"></i>
                </div>
                <div class="exp-benefit-metric">
                    <span class="exp-benefit-metric-value"><?php echo esc_html($b['metric']); ?></span>
                    <span class="exp-benefit-metric-label"><?php echo esc_html($b['metric_label']); ?></span>
                </div>
                <h3><?php echo esc_html($b['title']); ?></h3>
                <p><?php echo esc_html($b['description']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
