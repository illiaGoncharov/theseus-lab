<?php
/**
 * Template Name: Страница медиа
 *
 * Листинг записей блога с фильтром по рубрикам и пагинацией «Показать больше».
 * Фильтрация работает на JS (клиентская) — все карточки рендерятся в HTML
 * с data-атрибутами, JS показывает/скрывает нужные.
 */
get_header();

$articles = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$categories = get_categories(['hide_empty' => true]);
?>

<!-- Hero -->
<section class="blog-hero">
    <div class="blog-hero__grid-bg"></div>
    <div class="blog-hero__glow"></div>
    <div class="blog-hero__fade"></div>
    <div class="blog-hero__inner container-wide">
        <div class="section-label">
            <span class="section-label__line"></span>
            <span class="section-label__text"><?php esc_html_e('Медиа', 'theseus-lab'); ?></span>
        </div>
        <h1 class="blog-hero__title">
            <?php esc_html_e('Статьи об', 'theseus-lab'); ?><br>
            <span class="text-muted-25"><?php esc_html_e('AI технологиях', 'theseus-lab'); ?></span>
        </h1>
        <p class="blog-hero__desc">
            <?php esc_html_e('Разбираем архитектуры, делимся кейсами и рассказываем о трендах в компьютерном зрении и AI-автоматизации.', 'theseus-lab'); ?>
        </p>
    </div>
</section>

<!-- Articles -->
<section class="blog-listing" id="blog-listing">
    <div class="container-wide">

        <!-- Rubricator -->
        <div class="blog-rubricator reveal-item" id="blog-rubricator">
            <button type="button" class="blog-rubricator__btn is-active" data-filter="all"><?php esc_html_e('Все', 'theseus-lab'); ?></button>
            <?php foreach ($categories as $cat) : ?>
                <button type="button" class="blog-rubricator__btn" data-filter="<?php echo esc_attr($cat->slug); ?>">
                    <?php echo esc_html($cat->name); ?>
                </button>
            <?php endforeach; ?>
            <span class="blog-rubricator__count" id="blog-count">
                <?php echo esc_html($articles->found_posts); ?>
                <?php
                $n = $articles->found_posts;
                $mod10 = $n % 10;
                $mod100 = $n % 100;
                if ($mod10 === 1 && $mod100 !== 11) {
                    echo esc_html__('статья', 'theseus-lab');
                } elseif ($mod10 >= 2 && $mod10 <= 4 && ($mod100 < 12 || $mod100 > 14)) {
                    echo esc_html__('статьи', 'theseus-lab');
                } else {
                    echo esc_html__('статей', 'theseus-lab');
                }
                ?>
            </span>
        </div>

        <!-- Grid -->
        <?php if ($articles->have_posts()) : ?>
            <div class="blog-grid" id="blog-grid">
                <?php
                $index = 0;
                while ($articles->have_posts()) : $articles->the_post();
                    $post_categories = get_the_category();
                    $cat_slugs = array_map(fn($c) => $c->slug, $post_categories);
                    $cat_names = array_map(fn($c) => $c->name, $post_categories);
                    $cat_display = !empty($cat_names) ? $cat_names[0] : '';
                    $read_time = '';
                    if (function_exists('get_field')) {
                        $read_time = get_field('read_time') ?: '';
                    }
                    $num = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                ?>
                    <a href="<?php the_permalink(); ?>"
                       class="blog-card reveal-item"
                       data-category="<?php echo esc_attr(implode(' ', $cat_slugs)); ?>"
                       style="transition-delay: <?php echo ($index % 4) * 80; ?>ms">
                        <div class="blog-card__image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'blog-card__img']); ?>
                            <?php endif; ?>
                            <div class="blog-card__image-overlay"></div>
                            <?php if ($cat_display) : ?>
                                <span class="blog-card__badge"><?php echo esc_html($cat_display); ?></span>
                            <?php endif; ?>
                            <span class="blog-card__num"><?php echo esc_html($num); ?></span>
                        </div>
                        <div class="blog-card__body">
                            <h2 class="blog-card__title"><?php the_title(); ?></h2>
                            <p class="blog-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <div class="blog-card__footer">
                                <div class="blog-card__meta">
                                    <span><?php echo esc_html(get_the_date('d.m.Y')); ?></span>
                                    <?php if ($read_time) : ?>
                                        <span><?php echo esc_html($read_time); ?> <?php esc_html_e('чтения', 'theseus-lab'); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="blog-card__link">
                                    <?php esc_html_e('Читать', 'theseus-lab'); ?>
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

            <div class="blog-show-more" id="blog-show-more" style="display:none">
                <button type="button" class="btn-outline" id="blog-load-more">
                    <?php esc_html_e('Показать больше', 'theseus-lab'); ?>
                    <i class="ri-arrow-down-line"></i>
                </button>
            </div>

        <?php else : ?>
            <div class="blog-empty">
                <i class="ri-article-line"></i>
                <p><?php esc_html_e('Статей пока нет', 'theseus-lab'); ?></p>
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
                <span class="section-label__text"><?php esc_html_e('AI-решения', 'theseus-lab'); ?></span>
            </div>
            <h2 class="cta-strip__title">
                <?php esc_html_e('Нужна консультация', 'theseus-lab'); ?><br>
                <span class="text-muted-30"><?php esc_html_e('по вашему проекту?', 'theseus-lab'); ?></span>
            </h2>
        </div>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-accent">
            <?php esc_html_e('Оставить заявку', 'theseus-lab'); ?>
            <i class="ri-arrow-right-line"></i>
        </a>
    </div>
</section>

<?php
get_footer();
