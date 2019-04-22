<?php
    if(comments_open()) { // Chick IF Comment Are Open ?>
    	<h3 class="comments-count"><?php comments_number('0 Comment', '1 Comment', '%comments') ?></h3> 
    	<?php
        echo '<ul class="list-unstyled comments-list">';
            $comments_arg = array(
                'max_depth'             =>3,          // Comment Level
                'type'                  =>'comment',  // Comment Type
                'avatar_size'           =>100,        // Avatar Size Pexl
                'reverse_top_level'     => true       // Last Comment To Top List Comment
            );
            wp_list_comments($comments_arg); // List All Comments
        echo '</ul>';
        echo '<hr>';
        $commentform_arg= array(
            'fields' => array(
                'author'   => '<div class="form-group"><label>Yor Name</label><input type="text" class="form-control" placeholder="First Name" required></div>',
                'email'    => '<div class="form-group"><label>Yor E-Mail</label><input type="text" class="form-control" placeholder="Enter E-mail" required></div>',
                'url'      => '<div class="form-group"><label>Yor Website</label><input type="text" class="form-control" placeholder="Website"></div>',
            ),
            'comment_field'           => '<textarea class="form-control" placeholder="Required example textarea" required></textarea>',
            'comment_notes_before'    => 'Comments', // Disable Email Message
            'title_reply'             => 'Add Your Comment',
            'title_reply_to'          => 'Add a Reply To [%s]',
        );
        comment_form($commentform_arg);
    } else {
        echo 'sorry Comments Disabled';
    }
?>