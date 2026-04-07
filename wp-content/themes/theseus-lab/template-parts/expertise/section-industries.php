<?php
$fallback = [
    [
        'title'       => __('Промышленность', 'theseus-lab'),
        'description' => __('Интегрируем системы машинного зрения непосредственно в производственные линии для повышения выхода годной продукции и снижения брака.', 'theseus-lab'),
        'bullets'     => __("Автоматический контроль качества на линии без остановки производства\nДетекция дефектов поверхности с точностью 97%\nМониторинг выполнения технологических регламентов\nУчёт наличия и положения деталей в производственных ячейках", 'theseus-lab'),
        'image'       => null,
    ],
    [
        'title'       => __('Строительство', 'theseus-lab'),
        'description' => __('Круглосуточный видеомониторинг стройплощадки для контроля соблюдения техники безопасности и хода работ.', 'theseus-lab'),
        'bullets'     => __("Контроль ношения касок, жилетов и других СИЗ\nОбнаружение посторонних лиц в опасных зонах\nДокументирование прогресса строительства по камерам\nАвтоматический учёт въезда и выезда спецтехники", 'theseus-lab'),
        'image'       => null,
    ],
    [
        'title'       => __('Ритейл', 'theseus-lab'),
        'description' => __('Аналитика торговых залов, контроль полочного пространства и поведенческий анализ посетителей для роста конверсии.', 'theseus-lab'),
        'bullets'     => __("Тепловые карты движения и зон наибольшего внимания\nАвтоматический контроль наличия товаров на полке\nПодсчёт уникальных посетителей и времени в зале\nДетекция очередей и управление кассовыми потоками", 'theseus-lab'),
        'image'       => null,
    ],
    [
        'title'       => __('Транспорт и логистика', 'theseus-lab'),
        'description' => __('Автоматизация контроля на транспортных узлах: склады, терминалы, парковки, пограничные зоны.', 'theseus-lab'),
        'bullets'     => __("LPR — распознавание номеров с точностью 99%\nУправление воротами и шлагбаумами без оператора\nКонтроль целостности пломб и состояния груза\nМониторинг загрузки складских зон в реальном времени", 'theseus-lab'),
        'image'       => null,
    ],
];

$industries = [];
if (function_exists('get_field')) {
    for ($i = 1; $i <= 4; $i++) {
        $group = get_field("exp_industry_{$i}");
        if (!empty($group['title'])) {
            $industries[] = $group;
        }
    }
}
if (empty($industries)) {
    $industries = $fallback;
}

$placeholder = 'https://placehold.co/800x500/111111/333333?text=Industry';
?>
<section class="section exp-industries">
    <div class="container">
        <div class="exp-industries-header reveal-item">
            <span class="section-label"><?php esc_html_e('Отрасли', 'theseus-lab'); ?></span>
            <h2 class="section-title">
                <?php esc_html_e('Для каких отраслей', 'theseus-lab'); ?><br><span class="text-muted-30"><?php esc_html_e('подходит решение', 'theseus-lab'); ?></span>
            </h2>
        </div>

        <div class="exp-industries-panel reveal-item">
            <!-- Табы -->
            <div class="exp-industries-tabs">
                <?php foreach ($industries as $i => $ind) : ?>
                <button type="button"
                        class="exp-industries-tab<?php echo $i === 0 ? ' active' : ''; ?>"
                        data-tab="<?php echo $i; ?>">
                    <?php if ($i === 0) : ?><span class="exp-industries-tab-bar"></span><?php endif; ?>
                    <?php echo esc_html($ind['title']); ?>
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Контент вкладок -->
            <?php foreach ($industries as $i => $ind) :
                // Буллеты — текст с новой строки, превращаем в массив
                $bullets = array_filter(array_map('trim', explode("\n", $ind['bullets'] ?? '')));

                // Изображение из ACF (массив) или плейсхолдер
                $img_raw = $ind['image'] ?? null;
                $img_url = is_array($img_raw) ? esc_url($img_raw['url']) : $placeholder;
                $img_alt = is_array($img_raw) ? esc_attr($img_raw['alt']) : esc_attr($ind['title']);
            ?>
            <div class="exp-industries-content<?php echo $i === 0 ? ' active' : ''; ?>" data-tab-content="<?php echo $i; ?>">
                <div class="exp-industries-image">
                    <img src="<?php echo $img_url; ?>" alt="<?php echo $img_alt; ?>" loading="lazy">
                </div>
                <div class="exp-industries-info">
                    <h3><?php echo esc_html($ind['title']); ?></h3>
                    <p><?php echo esc_html($ind['description']); ?></p>
                    <?php if (!empty($bullets)) : ?>
                    <ul>
                        <?php foreach ($bullets as $bullet) : ?>
                        <li>
                            <i class="ri-checkbox-circle-fill"></i>
                            <?php echo esc_html($bullet); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(home_url('/cases/')); ?>" class="exp-industries-case-link">
                        <?php esc_html_e('Смотреть кейс', 'theseus-lab'); ?> <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
