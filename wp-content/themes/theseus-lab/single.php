<?php
/**
 * Шаблон одиночной записи блога.
 *
 * Hero с миниатюрой, контент через the_content(), sticky TOC,
 * блок «Читайте также» с записями из той же рубрики.
 */
get_header();

if (have_posts()) : the_post();

$categories = get_the_category();
$cat_name   = !empty($categories) ? $categories[0]->name : '';
$cat_link   = !empty($categories) ? get_category_link($categories[0]) : '';
$read_time  = '';
if (function_exists('get_field')) {
    $read_time = get_field('read_time') ?: '';
}

$related = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 2,
    'post__not_in'   => [get_the_ID()],
    'category__in'   => !empty($categories) ? [$categories[0]->term_id] : [],
    'post_status'    => 'publish',
]);
if ($related->found_posts < 2) {
    $related = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 2,
        'post__not_in'   => [get_the_ID()],
        'post_status'    => 'publish',
    ]);
}
?>

<!-- Hero -->
<section class="article-hero">
    <div class="article-hero__grid-bg"></div>

    <div class="article-hero__inner container-wide">
        <!-- Breadcrumb -->
        <div class="article-breadcrumb">
            <a href="<?php echo esc_url(home_url('/media/')); ?>"><?php esc_html_e('Медиа', 'theseus-lab'); ?></a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="article-breadcrumb__current"><?php echo esc_html($cat_name); ?></span>
        </div>

        <div class="article-hero__content">
            <?php if ($cat_name) : ?>
                <span class="article-hero__badge"><?php echo esc_html($cat_name); ?></span>
            <?php endif; ?>
            <h1 class="article-hero__title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="article-hero__desc"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
            <div class="article-hero__meta">
                <div class="article-hero__meta-item">
                    <i class="ri-calendar-line"></i>
                    <?php echo esc_html(get_the_date('d.m.Y')); ?>
                </div>
                <?php if ($read_time) : ?>
                    <div class="article-hero__meta-item">
                        <i class="ri-time-line"></i>
                        <?php echo esc_html($read_time); ?> <?php esc_html_e('чтения', 'theseus-lab'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Hero image -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="article-hero__image">
            <?php the_post_thumbnail('full', ['class' => 'article-hero__img']); ?>
            <div class="article-hero__image-overlay"></div>
        </div>
    <?php endif; ?>
</section>

<!-- Content -->
<section class="article-content">
    <div class="container-wide">
        <div class="article-layout">

            <!-- Main content -->
            <div class="article-body" id="article-body">
                <?php the_content(); ?>

                <!-- Footer -->
                <div class="article-footer">
                    <a href="<?php echo esc_url(home_url('/media/')); ?>" class="article-footer__back">
                        <i class="ri-arrow-left-line"></i>
                        <?php esc_html_e('Все статьи', 'theseus-lab'); ?>
                    </a>
                    <div class="article-footer__share">
                        <span><?php esc_html_e('Поделиться:', 'theseus-lab'); ?></span>
                        <button type="button" class="article-footer__copy-link" data-copy-url>
                            <i class="ri-links-line"></i>
                            <?php esc_html_e('Скопировать ссылку', 'theseus-lab'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sticky TOC -->
            <aside class="article-toc" id="article-toc">
                <p class="article-toc__label"><?php esc_html_e('Содержание', 'theseus-lab'); ?></p>
                <nav class="article-toc__nav" id="article-toc-nav">
                    <!-- JS заполнит из h2-заголовков -->
                </nav>

                <div class="article-toc__cta">
                    <p><?php esc_html_e('Нужна консультация по вашему AI-проекту?', 'theseus-lab'); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-accent btn--sm btn--full">
                        <?php esc_html_e('Написать нам', 'theseus-lab'); ?>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>

<!-- Related articles -->
<?php if ($related->have_posts()) : ?>
<section class="article-related">
    <div class="container-wide">
        <div class="section-label">
            <span class="section-label__line"></span>
            <span class="section-label__text"><?php esc_html_e('Читайте также', 'theseus-lab'); ?></span>
        </div>

        <div class="blog-grid blog-grid--related">
            <?php while ($related->have_posts()) : $related->the_post();
                $rel_cats = get_the_category();
                $rel_cat = !empty($rel_cats) ? $rel_cats[0]->name : '';
                $rel_read = function_exists('get_field') ? (get_field('read_time') ?: '') : '';
            ?>
                <a href="<?php the_permalink(); ?>" class="blog-card blog-card--related">
                    <div class="blog-card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'blog-card__img']); ?>
                        <?php endif; ?>
                        <div class="blog-card__image-overlay blog-card__image-overlay--surface"></div>
                        <?php if ($rel_cat) : ?>
                            <span class="blog-card__badge"><?php echo esc_html($rel_cat); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title blog-card__title--sm"><?php the_title(); ?></h3>
                        <p class="blog-card__excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <div class="blog-card__footer">
                            <div class="blog-card__meta">
                                <span><?php echo esc_html(get_the_date('d.m.Y')); ?></span>
                                <?php if ($rel_read) : ?>
                                    <span><?php echo esc_html($rel_read); ?> <?php esc_html_e('чтения', 'theseus-lab'); ?></span>
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
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php endif; ?>

<?php
get_footer();
