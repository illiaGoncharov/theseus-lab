<?php
$fallback = [
    ['duration' => 'Постоянно',      'title' => 'Подключение к видеопотоку', 'description' => 'Сервис получает RTSP-поток с камер через сеть предприятия. Поддерживаются любые IP-камеры и видеосерверы.'],
    ['duration' => '< 80 мс / кадр', 'title' => 'Предобработка кадра',       'description' => 'Изображение нормализуется, ресайзится и передаётся в инференс-пайплайн на GPU-сервере или edge-устройстве.'],
    ['duration' => 'Real-time',      'title' => 'Детекция и трекинг',        'description' => 'Нейросеть обнаруживает объекты, назначает ID и отслеживает траектории между кадрами через DeepSORT / ByteTrack.'],
    ['duration' => '< 200 мс',       'title' => 'Бизнес-логика и алерты',    'description' => 'Правила срабатывают при пересечении зон, превышении порогов, появлении заданных классов объектов.'],
    ['duration' => 'Непрерывно',     'title' => 'Хранение и аналитика',      'description' => 'События сохраняются в базу данных. Дашборд обновляется в реальном времени, отчёты формируются автоматически.'],
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
            <span class="section-label">Принцип работы</span>
            <h2 class="section-title">
                Как работает<br><span class="text-muted-30">система</span>
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
