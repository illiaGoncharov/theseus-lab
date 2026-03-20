<?php
$fallback = [
    ['icon' => 'ri-arrow-up-line',             'metric' => '+38%', 'metric_label' => 'рост производительности', 'title' => 'Эффективность производства', 'description' => 'Автоматизация визуального контроля высвобождает сотрудников для задач с большей добавленной стоимостью.'],
    ['icon' => 'ri-bug-line',                  'metric' => '−72%', 'metric_label' => 'снижение брака',          'title' => 'Качество продукции',          'description' => 'Нейросеть обнаруживает дефекты, незаметные человеческому глазу, до попадания продукта на следующий этап.'],
    ['icon' => 'ri-shield-line',               'metric' => '−61%', 'metric_label' => 'инцидентов по ОТ',       'title' => 'Безопасность персонала',      'description' => 'Мгновенная реакция на нарушения снижает травматизм и потери от простоев, связанных с несчастными случаями.'],
    ['icon' => 'ri-money-dollar-circle-line',  'metric' => '6–18', 'metric_label' => 'месяцев окупаемость',    'title' => 'ROI внедрения',               'description' => 'Экономия на ручном контроле и потерях от брака обеспечивает возврат инвестиций в течение одного-двух сезонов.'],
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
                <span class="section-label">Эффект</span>
                <h2 class="section-title">
                    Преимущества<br><span class="text-muted-30">для бизнеса</span>
                </h2>
            </div>
            <p class="exp-benefits-desc">Измеримые результаты, подтверждённые реальными проектами</p>
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
