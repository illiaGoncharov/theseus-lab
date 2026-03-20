<?php
$fallback = [
    ['icon' => 'ri-shield-check-line', 'title' => 'Контроль доступа и безопасность',    'description' => 'Автоматическое обнаружение несанкционированных лиц, пересечения запрещённых зон и появления посторонних предметов.',   'tags' => 'Периметр, Зоны доступа, Алерты'],
    ['icon' => 'ri-focus-3-line',      'title' => 'Контроль качества продукции',         'description' => 'Детекция дефектов, царапин, деформаций и несоответствий стандарту прямо на конвейере с точностью до 97%.',               'tags' => 'Инспекция, Дефекты, Конвейер'],
    ['icon' => 'ri-user-follow-line',  'title' => 'Мониторинг сотрудников',              'description' => 'Контроль использования СИЗ, присутствия на рабочем месте, отслеживание нарушений охраны труда.',                        'tags' => 'СИЗ, Охрана труда, Присутствие'],
    ['icon' => 'ri-route-line',        'title' => 'Анализ движения и трафика',           'description' => 'Подсчёт посетителей, тепловые карты трафика, загрузка зон — данные для оптимизации пространства.',                      'tags' => 'Heatmap, Счётчик, Зонирование'],
    ['icon' => 'ri-truck-line',        'title' => 'Контроль транспорта и логистики',     'description' => 'Автоматическое распознавание номеров, контроль правил въезда и выезда, мониторинг загрузки/разгрузки.',                   'tags' => 'LPR, Логистика, Въезд/выезд'],
    ['icon' => 'ri-settings-3-line',   'title' => 'Мониторинг оборудования',             'description' => 'Детекция нештатных состояний, перегревов, утечек, вибраций на основе визуального анализа.',                             'tags' => 'Предиктив, Состояние, Аварии'],
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
            <span class="section-label">Применение</span>
            <h2 class="section-title">
                Сценарии<br><span class="text-muted-30">применения</span>
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
