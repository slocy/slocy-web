<?php if ( post_password_required() )return false;?>
<ul class="commentlist"><li><?php wp_list_comments(); ?></li></ul>
<div class="navigation"><?php paginate_comments_links(); ?></div>
<?php comment_form(); ?>