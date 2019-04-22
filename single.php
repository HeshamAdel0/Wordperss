<?php get_header(); 
    include(get_template_directory() . '/includes/breadcrumb.php');
?>

<div class="container">
    <?php 
        if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <div class="post-page">
                    <div class="main-post">
                        <?php edit_post_link('Edit <i class="fa fa-pen"></i>') ?>
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
                        <div class="row">
                            <div class="col-6">
                                <?php the_post_thumbnail('', ['class' => 'img-thumbnail']); ?>
                            </div>
                            <div class="col-6">
                                <div class="post-content">
                                    <?php the_content()?> 
                                </div>
                            </div>
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
                <?php
            } // End While
        } // End If
        echo '<div class="clearfix"></div>'; // fix Float Clear
        
            // Get Post ID => get_queried_object_id()
            // Category ID => wp_get_post_categories(post ID)

            $random_posts_arg = array(
                'posts_per_page'        => 3,
                'orderby'               => 'rand',
                'Category__in'          => wp_get_post_categories(get_queried_object_id()),
                'post__not_in'          => array(get_queried_object_id())

            );
            $random_posts = new WP_Query($random_posts_arg);

            if ($random_posts->have_posts()) {
                while ($random_posts->have_posts()) {
                    $random_posts->the_post(); ?>
                    <div class="author-page">
                        <div class="author-posts">
                            <div class="home-page">
                                <h3 class="post-title">
                                    <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                    </a>
                                </h3> 
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                } // End While
            } 
        ?>
        <div class="row">
            <div class="col-2">
                <div class="author-posts">
                    <?php 
                        // User Avatar
                        $avatar_arg = array(
                            'class' => 'img-thumbnail'
                        );
                        // get_avatar(ID or Email, Size, Default, alternate taxt, img Arguments)
                        echo get_avatar(get_the_author_meta('ID'), 125, '', 'IMG', $avatar_arg) 
                    ?>
                </div>
            </div>    
            <div class="col-10 author-page"> 
                <div class="author-main-info">
                    <h4 class="author-names">
                        <?php the_author_meta('first_name') // Print First name ?>
                        <?php the_author_meta('last_name') // Print Last name ?>
                        (<span><?php the_author_meta('nickname') // Print Nickname ?></span>)
                    </h4>
                    <?php
                        if(get_the_author_meta('description')) { // Chick If Have Description Or No ?>
                            <p>
                                <?php the_author_meta('description') // Print Description If Have ?>
                            </p>
                            <?php
                        } else {
                            echo '<div class="alert alert-danger" role="alert">No Have Description</div>';
                        }
                    ?>
                </div>
            </div>    
        </div><!-- End Row -->

        <hr class="comment-separator">
        <p class="author-stats">
            User Post Count: <span class="posts-count"><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>,
            User Profile Link: <?php the_author_posts_link()?>
        </p>

        <?php

        echo '<hr class="comment-separator">';

        echo '<div class="post-page">';
            echo '<div class="post-pagination">';
                if(get_previous_post_link()) {
                    previous_post_link('%link', '<i class="fa fa-chevron-left"></i> %title');
                } else {
                    echo '<span>This is Last Page</span>';
                }
                if(get_next_post_link()) {
                    next_post_link('%link', '%title <i class="fa fa-chevron-right"></i>');
                } else {
                    echo '<span>No Next Page</span>';
                }
            echo '</div>';
        echo '</div>';
        echo '<hr class="comment-separator">';
        comments_template();
    ?>
</div>
<?php get_footer(); ?>