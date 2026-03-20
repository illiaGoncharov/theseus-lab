<?php
$fallback_solutions = [
    ['icon' => 'ri-camera-line',         'title' => 'Подключение к существующим камерам',    'description' => 'Система работает с любым CCTV или IP-оборудованием — не требует замены инфраструктуры.'],
    ['icon' => 'ri-brain-line',          'title' => 'Нейросетевое распознавание объектов',   'description' => 'Модели YOLO и Transformer архитектур детектируют объекты, людей, дефекты и события в реальном времени.'],
    ['icon' => 'ri-notification-4-line', 'title' => 'Мгновенные уведомления',                'description' => 'При обнаружении события система автоматически отправляет алерт в Telegram, email или корпоративную систему.'],
    ['icon' => 'ri-dashboard-3-line',    'title' => 'Единый дашборд аналитики',              'description' => 'Все метрики и события отображаются на одном экране с возможностью ретроспективного анализа и экспорта отчётов.'],
];

$fallback_image    = 'https://placehold.co/1040x840/111111/333333?text=CV+Solution';
$fallback_headline = 'Как мы решаем эти задачи';
$fallback_lead     = 'С помощью AI анализируем видеопотоки с камер в режиме реального времени и автоматически выявляем события, отклонения и риски.';

if (function_exists('get_field')) {
    $headline = get_field('exp_solution_headline') ?: $fallback_headline;
    $lead     = get_field('exp_solution_lead')     ?: $fallback_lead;

    $img_raw  = get_field('exp_solution_image');
    $img_url  = is_array($img_raw) ? esc_url($img_raw['url']) : $fallback_image;
    $img_alt  = is_array($img_raw) ? esc_attr($img_raw['alt']) : '';

    $solutions = [];
    for ($i = 1; $i <= 4; $i++) {
        $group = get_field("exp_solution_{$i}");
        if (!empty($group['title'])) {
            $solutions[] = $group;
        }
    }
    if (empty($solutions)) {
        $solutions = $fallback_solutions;
    }
} else {
    $headline  = $fallback_headline;
    $lead      = $fallback_lead;
    $img_url   = $fallback_image;
    $img_alt   = '';
    $solutions = $fallback_solutions;
}
?>
<section class="section exp-solution">
    <div class="container">
        <div class="exp-solution-header reveal-item">
            <span class="section-label">Решение</span>
            <h2 class="section-title"><?php echo esc_html($headline); ?></h2>
        </div>

        <div class="exp-solution-layout">
            <div class="exp-solution-list">
                <p class="exp-solution-lead reveal-item"><?php echo esc_html($lead); ?></p>

                <?php foreach ($solutions as $i => $s) : ?>
                <div class="exp-solution-item reveal-item" style="transition-delay: <?php echo $i * 80; ?>ms">
                    <div class="exp-solution-item-icon">
                        <i class="<?php echo esc_attr($s['icon']); ?>"></i>
                    </div>
                    <div>
                        <h3><?php echo esc_html($s['title']); ?></h3>
                        <p><?php echo esc_html($s['description']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="exp-solution-image reveal-item">
                <div class="exp-solution-image-wrap">
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" loading="lazy">
                    <div class="exp-solution-image-overlay"></div>
                </div>
            </div>
        </div>
    </div>
</section>
