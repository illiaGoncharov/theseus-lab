<?php
/**
 * Template Name: Страница кейсов
 *
 * Листинг CPT «case» с фильтром по таксономии case_industry.
 * Аналогичная логика блогу: клиентская фильтрация через data-атрибуты.
 */
get_header();

$cases = new WP_Query([
    'post_type'      => 'case',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$industries = get_terms([
    'taxonomy'   => 'case_industry',
    'hide_empty' => true,
]);
if (is_wp_error($industries)) {
    $industries = [];
}
?>

<!-- Hero -->
<section class="blog-hero">
    <div class="blog-hero__grid-bg"></div>
    <div class="blog-hero__glow blog-hero__glow--left"></div>
    <div class="blog-hero__fade"></div>
    <div class="blog-hero__inner container-wide">
        <div class="section-label">
            <span class="section-label__line"></span>
            <span class="section-label__text"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></span>
        </div>
        <h1 class="blog-hero__title">
            <?php esc_html_e('Реальные внедрения', 'theseus-lab'); ?><br>
            <span class="text-muted-25"><?php esc_html_e('с измеримым результатом', 'theseus-lab'); ?></span>
        </h1>
        <p class="blog-hero__desc">
            <?php esc_html_e('Проекты в производстве, логистике, ритейле и строительстве — задачи, решения и конкретные цифры.', 'theseus-lab'); ?>
        </p>
    </div>
</section>

<!-- Cases -->
<section class="blog-listing" id="cases-listing">
    <div class="container-wide">

        <!-- Rubricator -->
        <div class="blog-rubricator reveal-item" id="cases-rubricator">
            <button type="button" class="blog-rubricator__btn is-active" data-filter="all"><?php esc_html_e('Все', 'theseus-lab'); ?></button>
            <?php foreach ($industries as $ind) : ?>
                <button type="button" class="blog-rubricator__btn" data-filter="<?php echo esc_attr($ind->slug); ?>">
                    <?php echo esc_html($ind->name); ?>
                </button>
            <?php endforeach; ?>
            <span class="blog-rubricator__count" id="cases-count">
                <?php echo esc_html($cases->found_posts); ?>
                <?php
                $n = $cases->found_posts;
                $mod10 = $n % 10;
                $mod100 = $n % 100;
                if ($mod10 === 1 && $mod100 !== 11) {
                    echo esc_html__('кейс', 'theseus-lab');
                } elseif ($mod10 >= 2 && $mod10 <= 4 && ($mod100 < 12 || $mod100 > 14)) {
                    echo esc_html__('кейса', 'theseus-lab');
                } else {
                    echo esc_html__('кейсов', 'theseus-lab');
                }
                ?>
            </span>
        </div>

        <!-- Grid -->
        <?php if ($cases->have_posts()) : ?>
            <div class="blog-grid" id="cases-grid">
                <?php
                $index = 0;
                while ($cases->have_posts()) : $cases->the_post();
                    $terms = get_the_terms(get_the_ID(), 'case_industry');
                    $ind_slugs = $terms ? array_map(fn($t) => $t->slug, $terms) : [];
                    $ind_name = $terms ? $terms[0]->name : '';
                    $result = '';
                    $result_label = '';
                    if (function_exists('get_field')) {
                        $result = get_field('case_result') ?: '';
                        $result_label = get_field('case_result_label') ?: '';
                    }
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                ?>
                    <a href="<?php the_permalink(); ?>"
                       class="blog-card blog-card--case reveal-item"
                       data-category="<?php echo esc_attr(implode(' ', $ind_slugs)); ?>"
                       style="transition-delay: <?php echo ($index % 4) * 80; ?>ms">
                        <div class="blog-card__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'blog-card__img']); ?>
                            <?php endif; ?>
                            <div class="blog-card__image-overlay"></div>
                            <?php if ($ind_name) : ?>
                                <span class="blog-card__badge"><?php echo esc_html($ind_name); ?></span>
                            <?php endif; ?>
                            <span class="blog-card__num"><?php echo esc_html($num); ?></span>
                            <?php if ($result) : ?>
                                <div class="blog-card__result">
                                    <span class="blog-card__result-value"><?php echo esc_html($result); ?></span>
                                    <span class="blog-card__result-label"><?php echo esc_html($result_label); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="blog-card__body">
                            <h2 class="blog-card__title"><?php the_title(); ?></h2>
                            <p class="blog-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <div class="blog-card__footer">
                                <span class="blog-card__date"><?php echo esc_html(get_the_date('d.m.Y')); ?></span>
                                <div class="blog-card__link">
                                    <?php esc_html_e('Подробнее', 'theseus-lab'); ?>
                                    <i class="ri-arrow-right-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="blog-card__hover-line"></div>
                    </a>
                <?php
                    $index++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <div class="blog-show-more" id="cases-show-more" style="display:none">
                <button type="button" class="btn-outline" id="cases-load-more">
                    <?php esc_html_e('Показать больше', 'theseus-lab'); ?>
                    <i class="ri-arrow-down-line"></i>
                </button>
            </div>

        <?php else : ?>
            <div class="blog-empty">
                <i class="ri-folder-chart-line"></i>
                <p><?php esc_html_e('Кейсов пока нет', 'theseus-lab'); ?></p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA strip -->
<section class="cta-strip">
    <div class="cta-strip__grid-bg"></div>
    <div class="cta-strip__inner container-wide">
        <div>
            <div class="section-label">
                <span class="section-label__line"></span>
                <span class="section-label__text"><?php esc_html_e('Ваш проект', 'theseus-lab'); ?></span>
            </div>
            <h2 class="cta-strip__title">
                <?php esc_html_e('Похожая задача', 'theseus-lab'); ?><br>
                <span class="text-muted-30"><?php esc_html_e('в вашем бизнесе?', 'theseus-lab'); ?></span>
            </h2>
        </div>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-accent">
            <?php esc_html_e('Обсудить проект', 'theseus-lab'); ?>
            <i class="ri-arrow-right-line"></i>
        </a>
    </div>
</section>

<?php
get_footer();
