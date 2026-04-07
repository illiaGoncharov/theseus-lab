<?php
/**
 * Шаблон одиночного кейса (CPT case).
 *
 * Hero с результатом, контент, sticky TOC, галерея с lightbox,
 * блок «Смотрите также» с кейсами из той же отрасли.
 */
get_header();

if (have_posts()) : the_post();

$terms       = get_the_terms(get_the_ID(), 'case_industry');
$industry    = $terms ? $terms[0]->name : '';
$result      = '';
$result_label = '';
$gallery     = [];
if (function_exists('get_field')) {
    $result       = get_field('case_result') ?: '';
    $result_label = get_field('case_result_label') ?: '';
    $gallery      = get_field('case_gallery') ?: [];
}

$related = new WP_Query([
    'post_type'      => 'case',
    'posts_per_page' => 2,
    'post__not_in'   => [get_the_ID()],
    'post_status'    => 'publish',
    'tax_query'      => $terms ? [[
        'taxonomy' => 'case_industry',
        'field'    => 'term_id',
        'terms'    => $terms[0]->term_id,
    ]] : [],
]);
if ($related->found_posts < 2) {
    $related = new WP_Query([
        'post_type'      => 'case',
        'posts_per_page' => 2,
        'post__not_in'   => [get_the_ID()],
        'post_status'    => 'publish',
    ]);
}
?>

<!-- Lightbox (скрыт по умолчанию, управляется через JS) -->
<div class="lightbox" id="lightbox" style="display:none">
    <button type="button" class="lightbox__close" id="lightbox-close">
        <i class="ri-close-line"></i>
    </button>
    <div class="lightbox__counter" id="lightbox-counter"></div>
    <button type="button" class="lightbox__prev" id="lightbox-prev">
        <i class="ri-arrow-left-line"></i>
    </button>
    <button type="button" class="lightbox__next" id="lightbox-next">
        <i class="ri-arrow-right-line"></i>
    </button>
    <div class="lightbox__body" id="lightbox-body">
        <div class="lightbox__img-wrap">
            <img src="" alt="" class="lightbox__img" id="lightbox-img">
        </div>
        <p class="lightbox__caption" id="lightbox-caption"></p>
        <div class="lightbox__dots" id="lightbox-dots"></div>
    </div>
</div>

<!-- Hero -->
<section class="article-hero">
    <div class="article-hero__grid-bg"></div>
    <div class="article-hero__inner container-wide">
        <div class="article-breadcrumb">
            <a href="<?php echo esc_url(home_url('/cases/')); ?>"><?php esc_html_e('Кейсы', 'theseus-lab'); ?></a>
            <i class="ri-arrow-right-s-line"></i>
            <span class="article-breadcrumb__current"><?php echo esc_html($industry); ?></span>
        </div>

        <div class="article-hero__content">
            <?php if ($industry) : ?>
                <span class="article-hero__badge"><?php echo esc_html($industry); ?></span>
            <?php endif; ?>
            <h1 class="article-hero__title"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="article-hero__desc"><?php echo esc_html(get_the_excerpt()); ?></p>
            <?php endif; ?>
            <?php if ($result) : ?>
                <div class="article-hero__result">
                    <span class="article-hero__result-value"><?php echo esc_html($result); ?></span>
                    <span class="article-hero__result-label"><?php echo esc_html($result_label); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

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

            <div class="article-body" id="article-body">
                <?php the_content(); ?>

                <div class="article-footer">
                    <a href="<?php echo esc_url(home_url('/cases/')); ?>" class="article-footer__back">
                        <i class="ri-arrow-left-line"></i>
                        <?php esc_html_e('Все кейсы', 'theseus-lab'); ?>
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

            <!-- Sticky TOC + result sidebar -->
            <aside class="article-toc" id="article-toc">
                <p class="article-toc__label"><?php esc_html_e('Содержание', 'theseus-lab'); ?></p>
                <nav class="article-toc__nav" id="article-toc-nav"></nav>

                <?php if ($result) : ?>
                    <div class="article-toc__result-card">
                        <p class="article-toc__result-card-label"><?php esc_html_e('Ключевой результат', 'theseus-lab'); ?></p>
                        <div class="article-toc__result-value">
                            <span class="text-accent-lg"><?php echo esc_html($result); ?></span>
                            <span class="article-toc__result-sublabel"><?php echo esc_html($result_label); ?></span>
                        </div>
                        <p class="article-toc__result-meta"><?php echo esc_html($industry); ?> · <?php echo esc_html(get_the_date('d.m.Y')); ?></p>
                    </div>
                <?php endif; ?>

                <div class="article-toc__cta">
                    <p><?php esc_html_e('Похожая задача в вашем бизнесе?', 'theseus-lab'); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-accent btn--sm btn--full">
                        <?php esc_html_e('Обсудить проект', 'theseus-lab'); ?>
                        <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </aside>

        </div>
    </div>
</section>

<!-- Gallery -->
<?php if (!empty($gallery)) : ?>
<section class="case-gallery">
    <div class="container-wide">
        <div class="case-gallery__header">
            <div class="section-label">
                <span class="section-label__line"></span>
                <span class="section-label__text"><?php esc_html_e('Галерея проекта', 'theseus-lab'); ?></span>
            </div>
            <span class="case-gallery__count"><?php echo count($gallery); ?> <?php esc_html_e('фото', 'theseus-lab'); ?></span>
        </div>

        <div class="case-gallery__grid" id="case-gallery-grid">
            <?php foreach ($gallery as $i => $img) : ?>
                <div class="case-gallery__item <?php echo $i === 0 ? 'case-gallery__item--wide' : ''; ?>"
                     data-gallery-index="<?php echo $i; ?>"
                     data-gallery-url="<?php echo esc_url($img['url']); ?>"
                     data-gallery-caption="<?php echo esc_attr($img['caption'] ?? ''); ?>">
                    <img src="<?php echo esc_url($img['sizes']['medium_large'] ?? $img['url']); ?>"
                         alt="<?php echo esc_attr($img['alt'] ?? ''); ?>"
                         class="case-gallery__img">
                    <div class="case-gallery__overlay">
                        <div class="case-gallery__zoom">
                            <i class="ri-zoom-in-line"></i>
                        </div>
                    </div>
                    <?php if (!empty($img['caption'])) : ?>
                        <div class="case-gallery__caption">
                            <p><?php echo esc_html($img['caption']); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Related cases -->
<?php if ($related->have_posts()) : ?>
<section class="article-related">
    <div class="container-wide">
        <div class="section-label">
            <span class="section-label__line"></span>
            <span class="section-label__text"><?php esc_html_e('Смотрите также', 'theseus-lab'); ?></span>
        </div>

        <div class="blog-grid blog-grid--related">
            <?php while ($related->have_posts()) : $related->the_post();
                $rel_terms = get_the_terms(get_the_ID(), 'case_industry');
                $rel_ind = $rel_terms ? $rel_terms[0]->name : '';
                $rel_result = function_exists('get_field') ? (get_field('case_result') ?: '') : '';
                $rel_result_label = function_exists('get_field') ? (get_field('case_result_label') ?: '') : '';
            ?>
                <a href="<?php the_permalink(); ?>" class="blog-card blog-card--case blog-card--related">
                    <div class="blog-card__image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', ['class' => 'blog-card__img']); ?>
                        <?php endif; ?>
                        <div class="blog-card__image-overlay blog-card__image-overlay--surface"></div>
                        <?php if ($rel_ind) : ?>
                            <span class="blog-card__badge"><?php echo esc_html($rel_ind); ?></span>
                        <?php endif; ?>
                        <?php if ($rel_result) : ?>
                            <div class="blog-card__result">
                                <span class="blog-card__result-value"><?php echo esc_html($rel_result); ?></span>
                                <span class="blog-card__result-label"><?php echo esc_html($rel_result_label); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="blog-card__body">
                        <h3 class="blog-card__title blog-card__title--sm"><?php the_title(); ?></h3>
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
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php endif; ?>

<?php
get_footer();
