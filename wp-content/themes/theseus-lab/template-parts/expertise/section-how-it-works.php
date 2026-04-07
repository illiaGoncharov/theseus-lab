<?php
$fallback = [
    ['duration' => __('Постоянно', 'theseus-lab'),      'title' => __('Подключение к видеопотоку', 'theseus-lab'), 'description' => __('Сервис получает RTSP-поток с камер через сеть предприятия. Поддерживаются любые IP-камеры и видеосерверы.', 'theseus-lab')],
    ['duration' => __('< 80 мс / кадр', 'theseus-lab'), 'title' => __('Предобработка кадра', 'theseus-lab'),       'description' => __('Изображение нормализуется, ресайзится и передаётся в инференс-пайплайн на GPU-сервере или edge-устройстве.', 'theseus-lab')],
    ['duration' => __('Real-time', 'theseus-lab'),       'title' => __('Детекция и трекинг', 'theseus-lab'),        'description' => __('Нейросеть обнаруживает объекты, назначает ID и отслеживает траектории между кадрами через DeepSORT / ByteTrack.', 'theseus-lab')],
    ['duration' => __('< 200 мс', 'theseus-lab'),       'title' => __('Бизнес-логика и алерты', 'theseus-lab'),    'description' => __('Правила срабатывают при пересечении зон, превышении порогов, появлении заданных классов объектов.', 'theseus-lab')],
    ['duration' => __('Непрерывно', 'theseus-lab'),      'title' => __('Хранение и аналитика', 'theseus-lab'),     'description' => __('События сохраняются в базу данных. Дашборд обновляется в реальном времени, отчёты формируются автоматически.', 'theseus-lab')],
];

$steps = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 5; $i++) {
        $group = get_field("exp_step_{$i}");
        if (!empty($group['title'])) {
            $steps[] = $group;
        }
    }
}
if (empty($steps)) {
    $steps = $fallback;
}
?>
<section class="section exp-how-it-works" id="how-it-works">
    <div class="container">
        <div class="exp-hiw-header reveal-item">
            <span class="section-label"><?php esc_html_e('Принцип работы', 'theseus-lab'); ?></span>
            <h2 class="section-title">
                <?php esc_html_e('Как работает', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('система', 'theseus-lab'); ?></span>
            </h2>
        </div>

        <div class="exp-hiw-grid reveal-item">
            <?php foreach ($steps as $i => $step) : ?>
            <div class="exp-hiw-step">
                <div class="exp-hiw-step-num">
                    <span><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                    <div class="exp-hiw-step-line"></div>
                </div>
                <span class="exp-hiw-step-duration"><?php echo esc_html($step['duration']); ?></span>
                <h3><?php echo esc_html($step['title']); ?></h3>
                <p><?php echo esc_html($step['description']); ?></p>
                <div class="exp-hiw-step-accent"></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
