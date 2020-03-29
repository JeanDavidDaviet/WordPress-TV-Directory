<?php


// remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');

function wp_remove_vers( $src ) {
    global $wp_version;
     parse_str(parse_url($src, PHP_URL_QUERY), $query);
     if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
          $src = remove_query_arg('ver', $src);
     }
     return $src;
}
add_filter( 'script_loader_src', 'wp_remove_vers' );
add_filter( 'style_loader_src', 'wp_remove_vers' );


add_action('init', 'html5wp_pagination');
function html5wp_pagination($paged = null, $max_num_pages = null){
    if(is_null($paged)){
        $paged = get_query_var('paged');
    }
    if(is_null($max_num_pages)){
        global $wp_query;
        $max_num_pages = $wp_query->max_num_pages;
    }
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $max_num_pages
    ));
}

function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function jce_remove_attachment_comments( $open, $post_id ) {
  $post = get_post( $post_id );
    if ( 'attachment' == $post->post_type ) {
      return false;
    }
    return $open;
  }
add_filter( 'comments_open', 'jce_remove_attachment_comments', 10 , 2 );