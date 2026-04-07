<?php
$fallback = [
    ['icon' => 'ri-eye-off-line',      'title' => __('Слепые зоны в контроле качества', 'theseus-lab'),       'description' => __('Ручной осмотр покрывает не более 15% продукции — дефекты проходят незамеченными и добираются до конечного потребителя.', 'theseus-lab')],
    ['icon' => 'ri-time-line',         'title' => __('Высокие трудозатраты', 'theseus-lab'),                  'description' => __('Операторы тратят до 40% рабочего времени на монотонный визуальный контроль, что ведёт к усталости и росту ошибок.', 'theseus-lab')],
    ['icon' => 'ri-alert-line',        'title' => __('Медленная реакция на инциденты', 'theseus-lab'),         'description' => __('Без автоматического мониторинга критические события — вторжение, поломка, нарушение зон — обнаруживаются с опозданием.', 'theseus-lab')],
    ['icon' => 'ri-bar-chart-2-line',  'title' => __('Отсутствие аналитики потоков', 'theseus-lab'),           'description' => __('Нет данных о движении людей, загрузке оборудования, плотности трафика — невозможно принимать взвешенные операционные решения.', 'theseus-lab')],
    ['icon' => 'ri-file-damage-line',  'title' => __('Документирование инцидентов вручную', 'theseus-lab'),    'description' => __('Бумажные журналы и ручные отчёты не позволяют быстро найти нужные записи и подтвердить факты при спорных ситуациях.', 'theseus-lab')],
    ['icon' => 'ri-team-line',         'title' => __('Нехватка специалистов', 'theseus-lab'),                  'description' => __('Дефицит квалифицированных инспекторов и охранников ограничивает масштабирование операций и повышает операционный риск.', 'theseus-lab')],
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
            <span class="section-label"><?php esc_html_e('Контекст', 'theseus-lab'); ?></span>
            <h2 class="section-title">
                <?php esc_html_e('С какими проблемами', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('сталкиваются предприятия', 'theseus-lab'); ?></span>
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
