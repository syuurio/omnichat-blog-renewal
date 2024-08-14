<?php

$post = get_field('solution');
if ($post) {
    echo do_blocks($post->post_content);
}

?>