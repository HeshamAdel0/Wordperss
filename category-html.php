<?php get_header(); ?>

<div class="container">
    <h1 class="text-center category-title"><?php single_cat_title()?></h1>
    <p class="text-center category-description"><?php  echo category_description()?></p>
    <div class="row">
        <div class="col-9 home-page">
            <?php 
                if (have_posts()) {
                    while (have_posts()) {
                        the_post(); ?>
                        <div class="main-post">
                            <div class="row">
                                <div class="col-6">
                                    <?php the_post_thumbnail('', ['class' => 'img-thumbnail']); ?>
                                </div> 
                                <div class="col-6">
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                        </a>
                                    </h3>
                                    <span class="post-author">
                                        <i class="fa fa-user"></i>
                                            <?php the_author_posts_link() ?>, 
                                    </span>
                                    <span class="post-date">
                                        <i class="fa fa-calendar"></i>
                                            <?php the_time('F j, Y') ?> 
                                    </span>
                                    <span class="post-comments">
                                        <i class="fa fa-comment"></i>
                                            <?php comments_popup_link('0 Comment', 'One Comment', '%comments', 'comment-url', 'Comment Off') ?>
                                    </span>
                                    <div class="post-content">
                                        <?php the_excerpt()?> 
                                    </div>
                                </div>
                            </div> 
                        </div> 
                        <?php
                    } // End While
                } // End If
                echo '<div class="clearfix"></div>';
            ?>
        </div> 
        <div class="col-3">
            <div class="sidebar-wordpress ">
                <?php
                    if(is_active_sidebar('mocca-sidebar2')) {
                        dynamic_sidebar('mocca-sidebar2');
                    }
                ?>
            </div>
        </div>   
        <div class="pagination-numbers">
                <?php echo mocca_Pagination_number() ?>
        </div>  
    </div>
</div>
<?php get_footer(); ?>