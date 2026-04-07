<?php
$fallback = [
    ['icon' => 'ri-shield-check-line', 'title' => __('Контроль доступа и безопасность', 'theseus-lab'),    'description' => __('Автоматическое обнаружение несанкционированных лиц, пересечения запрещённых зон и появления посторонних предметов.', 'theseus-lab'),   'tags' => __('Периметр, Зоны доступа, Алерты', 'theseus-lab')],
    ['icon' => 'ri-focus-3-line',      'title' => __('Контроль качества продукции', 'theseus-lab'),         'description' => __('Детекция дефектов, царапин, деформаций и несоответствий стандарту прямо на конвейере с точностью до 97%.', 'theseus-lab'),               'tags' => __('Инспекция, Дефекты, Конвейер', 'theseus-lab')],
    ['icon' => 'ri-user-follow-line',  'title' => __('Мониторинг сотрудников', 'theseus-lab'),              'description' => __('Контроль использования СИЗ, присутствия на рабочем месте, отслеживание нарушений охраны труда.', 'theseus-lab'),                        'tags' => __('СИЗ, Охрана труда, Присутствие', 'theseus-lab')],
    ['icon' => 'ri-route-line',        'title' => __('Анализ движения и трафика', 'theseus-lab'),           'description' => __('Подсчёт посетителей, тепловые карты трафика, загрузка зон — данные для оптимизации пространства.', 'theseus-lab'),                      'tags' => __('Heatmap, Счётчик, Зонирование', 'theseus-lab')],
    ['icon' => 'ri-truck-line',        'title' => __('Контроль транспорта и логистики', 'theseus-lab'),     'description' => __('Автоматическое распознавание номеров, контроль правил въезда и выезда, мониторинг загрузки/разгрузки.', 'theseus-lab'),                   'tags' => __('LPR, Логистика, Въезд/выезд', 'theseus-lab')],
    ['icon' => 'ri-settings-3-line',   'title' => __('Мониторинг оборудования', 'theseus-lab'),             'description' => __('Детекция нештатных состояний, перегревов, утечек, вибраций на основе визуального анализа.', 'theseus-lab'),                             'tags' => __('Предиктив, Состояние, Аварии', 'theseus-lab')],
];

$scenarios = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 6; $i++) {
        $group = get_field("exp_scenario_{$i}");
        if (!empty($group['title'])) {
            $scenarios[] = $group;
        }
    }
}
if (empty($scenarios)) {
    $scenarios = $fallback;
}
?>
<section class="section exp-scenarios">
    <div class="container">
        <div class="exp-scenarios-header reveal-item">
            <span class="section-label"><?php esc_html_e('Применение', 'theseus-lab'); ?></span>
            <h2 class="section-title">
                <?php esc_html_e('Сценарии', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('применения', 'theseus-lab'); ?></span>
            </h2>
        </div>

        <div class="exp-scenarios-grid">
            <?php foreach ($scenarios as $i => $s) :
                // Теги — строка через запятую, превращаем в массив
                $tags = array_filter(array_map('trim', explode(',', $s['tags'] ?? '')));
            ?>
            <div class="exp-scenario-card reveal-item" style="transition-delay: <?php echo $i * 70; ?>ms">
                <div class="exp-scenario-icon">
                    <i class="<?php echo esc_attr($s['icon']); ?>"></i>
                </div>
                <h3><?php echo esc_html($s['title']); ?></h3>
                <p><?php echo esc_html($s['description']); ?></p>
                <?php if (!empty($tags)) : ?>
                <div class="exp-scenario-tags">
                    <?php foreach ($tags as $tag) : ?>
                    <span class="exp-scenario-tag"><?php echo esc_html($tag); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
