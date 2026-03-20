<?php
$fallback = [
    ['icon' => 'ri-eye-off-line',      'title' => 'Слепые зоны в контроле качества',       'description' => 'Ручной осмотр покрывает не более 15% продукции — дефекты проходят незамеченными и добираются до конечного потребителя.'],
    ['icon' => 'ri-time-line',         'title' => 'Высокие трудозатраты',                  'description' => 'Операторы тратят до 40% рабочего времени на монотонный визуальный контроль, что ведёт к усталости и росту ошибок.'],
    ['icon' => 'ri-alert-line',        'title' => 'Медленная реакция на инциденты',         'description' => 'Без автоматического мониторинга критические события — вторжение, поломка, нарушение зон — обнаруживаются с опозданием.'],
    ['icon' => 'ri-bar-chart-2-line',  'title' => 'Отсутствие аналитики потоков',           'description' => 'Нет данных о движении людей, загрузке оборудования, плотности трафика — невозможно принимать взвешенные операционные решения.'],
    ['icon' => 'ri-file-damage-line',  'title' => 'Документирование инцидентов вручную',    'description' => 'Бумажные журналы и ручные отчёты не позволяют быстро найти нужные записи и подтвердить факты при спорных ситуациях.'],
    ['icon' => 'ri-team-line',         'title' => 'Нехватка специалистов',                  'description' => 'Дефицит квалифицированных инспекторов и охранников ограничивает масштабирование операций и повышает операционный риск.'],
];

$problems = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 6; $i++) {
        $group = get_field("exp_problem_{$i}");
        if (!empty($group['title'])) {
            $problems[] = $group;
        }
    }
}
if (empty($problems)) {
    $problems = $fallback;
}
?>
<section class="section exp-problems">
    <div class="container">
        <div class="exp-problems-header reveal-item">
            <span class="section-label">Контекст</span>
            <h2 class="section-title">
                С какими проблемами<br><span class="text-muted-30">сталкиваются предприятия</span>
            </h2>
        </div>

        <div class="exp-problems-grid">
            <?php foreach ($problems as $i => $p) : ?>
            <div class="exp-problem-card reveal-item" style="transition-delay: <?php echo $i * 80; ?>ms">
                <div class="exp-problem-icon">
                    <i class="<?php echo esc_attr($p['icon']); ?>"></i>
                </div>
                <h3><?php echo esc_html($p['title']); ?></h3>
                <p><?php echo esc_html($p['description']); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
