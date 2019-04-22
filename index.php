<?php get_header(); ?>

<div class="container">
    <div class="row">
        <?php 
            if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <div class="col-6">
                        <div class="home-page">
                            <div class="main-post">
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
                                <?php the_post_thumbnail('', ['class' => 'img-thumbnail']); ?>
                                <div class="post-content">
                                    <?php the_excerpt()?> 
                                </div>
                                <hr>
                                <p class="post-categories">
                                    <i class="fa fa-tags"></i> 
                                    <?php the_category(', ') ?>
                                </p>
                                <p class="post-tags">
                                    <i class="fa fa-tags"></i> 
                                    <?php 
                                        if(has_tag()) {
                                            the_tags();
                                        } else {
                                            echo 'Tags, No Have Tags';
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                } // End While
            } // End If
            echo '<div class="clearfix"></div>';
            /*
            echo '<div class="home-page">';
                echo '<div class="post-pagination">';
                    if(get_previous_posts_link()) {
                        previous_posts_link('<i class="fa fa-chevron-left"></i> prev');
                    } else {
                        echo '<span>This is Last Page</span>';
                    }
                    if(get_next_posts_link()) {
                        next_posts_link('next <i class="fa fa-chevron-right"></i>');
                    } else {
                        echo '<span>No Next Page</span>';
                    }
                echo '</div>';
            echo '</div>';
            */  
        ?>
        <div class="pagination-numbers">
                <?php echo mocca_Pagination_number() ?>
        </div>  
    </div>
</div>
<?php get_footer(); ?>