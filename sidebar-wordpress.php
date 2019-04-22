<?php
    // Category Post Count
    $cat = get_queried_object(); // Get Object

    $post_count = $cat->count; // Get Post Count
?>
<div class="sidebar-wordpress">
    <div class="widget">
        <h3 class="widget-title">
            <?php single_cat_title() ?> Statistics
        </h3>
        <div class="widget-content">
            <ul>
                <li>
                    <span>Comment Count</span>: <?php echo mocca_count_comment('wordpress'); ?>
                </li>
                <li>
                    <span>Post Count</span>:<?php  echo $post_count?></p>
                </li>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">
            Latest SASS Posts
        </h3>
        <div class="widget-content">
            <ul>
                <?php
                    $posts_arges = array(
                        'posts_per_page' => '3',
                        'cat'            => '5',
                    ); 
                    $query = new wp_Query($posts_arges); 
                    if($query->have_posts()){
                        while($query->have_posts()){
                            $query->the_post(); ?>
                            <li>
                                <a target="_blank" href="<?php echo the_permalink() ?>">
                                    <?php the_title() ?>
                                </a>
                            </li>
                        <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3 class="widget-title">
            Hot Posts
        </h3>
        <div class="widget-content">
            <ul>
                <?php
                    $hotpost_arges = array(
                        'posts_per_page' => '1',
                        'orderby'        => 'comment_count',
                    ); 
                    $hotquery = new wp_Query($hotpost_arges); 
                    if($hotquery->have_posts()){
                        while($hotquery->have_posts()){
                            $hotquery->the_post(); ?>
                            <li>
                                <a target="_blank" href="<?php echo the_permalink() ?>">
                                    <?php the_title() ?>
                                </a>
                                <hr>
                            <?php comments_popup_link('0 Comment', 'One Comment', '%comments', 'comment-url', 'Comment Off') ?>
                            </li>
                        <?php
                        }
                        wp_reset_postdata();
                    }
                ?>
            </ul>
        </div>
    </div>
</div>