<?php get_header(); ?>
<div class="container">
    <div class="row author-page">
        <h1 class="profile-header text-center"><?php the_author_meta('nickname') // Print Nickname ?></h1>
        <div class="col-3">
            <?php 
                // User Avatar
                $avatar_arg = array(
                    'class' => 'img-thumbnail'
                );
                // get_avatar(ID or Email, Size, Default, alternate taxt, img Arguments)
                echo get_avatar(get_the_author_meta('ID'), 210, '', 'IMG', $avatar_arg) 
            ?>
        </div>
        <div class="col-9">
            <div class="author-main-info">
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
    </div>
</div>
<hr class="comment-separator">
<div class="container">
    <div class="row">
        <?php 
            $author_posts_per_page = 5;
            $author_posts_arg = array(
                'author' => get_the_author_meta('ID'),
                'posts_per_page' => $author_posts_per_page,

            );
            $author_posts = new WP_Query($author_posts_arg);

            if ($author_posts->have_posts()) {
                $count_latst_post = count_user_posts(get_the_author_meta('ID')); ?>
                <h3>
                    <?php
                        // Chick If Number Posts >= Counter Post
                        if ($count_latst_post >= $author_posts_per_page) {
                            echo 'Latest' . $author_posts_per_page . 'Posts';
                        } else {
                            echo 'The Latest Post';
                        }

                    ?>  
                </h3>
                <?php
                while ($author_posts->have_posts()) {
                    $author_posts->the_post(); ?>
                    <div class="author-page">
                        <div class="author-posts">
                            <div class="col-3">
                                <?php the_post_thumbnail('', ['class' => 'img-thumbnail']); ?>
                            </div>
                            <div class="col-9">
                                <div class="home-page">
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink() ?>">
                                        <?php the_title() ?>
                                        </a>
                                    </h3>
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
                    </div>
                    <div class="clearfix"></div>
                    <?php
                } // End While
            } // End If
            wp_reset_postdata(); // reset loop query

            $comment_per_page = 4;

            $comment_argu = array(
                'user_id'           => get_the_author_meta('ID'),
                'status'            =>'approve',
                'number'            => $comment_per_page,
                'post_status'       =>'publish',
                'post_type'         =>'post',
            );
            $comments = get_comments($comment_argu);
            // $comment->comment_post_ID

            if ($comments) {
                foreach($comments as $comment) { ?>
                    <div class="author-page">
                        <div class="author-posts">
                            <div class="col-12">
                                <div class="home-page">
                                    <h3 class="post-title">
                                        <a href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                                        <?php echo get_the_title ($comment->comment_post_ID) ?>
                                        </a>
                                    </h3>
                                    <span class="post-date">
                                        <i class="fa fa-calendar"></i>
                                            <?php  echo $comment->comment_date ?> 
                                    </span>
                                    <div class="post-content">
                                        <?php echo $comment->comment_content ?> 
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }

            } else {
                echo 'No Have Any Comment';
            }
        ?>
    </div>
</div>      
<?php get_footer(); ?>