<?php 
$events = $wpdb->get_results("SELECT * FROM events ORDER by title"); set_query_var('events', $events);
$tags = $wpdb->get_results("SELECT * FROM tags ORDER by title"); set_query_var('tags', $tags);
$speakers = $wpdb->get_results("SELECT * FROM speakers ORDER by title"); set_query_var('speakers', $speakers);
$languages = $wpdb->get_results("SELECT * FROM languages ORDER by title"); set_query_var('languages', $languages);
$producers = $wpdb->get_results("SELECT * FROM producers ORDER by title"); set_query_var('producers', $producers);
?>
<!doctype html>
<html class="no-js no-touch" lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php $title = wp_title('|', true, 'right'); echo ($title != "" ? ' ' : '') . get_bloginfo('name'); ?></title>
  <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/src/img/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/src/img/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/src/img/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/src/img/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/src/img/favicon/safari-pinned-tab.svg" color="#5bbad5"> -->
  <!-- <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff"> -->
  <?php wp_head(); ?>
</head>
<body>
  <div class="wrapper">
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">About</h4>
              <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            <strong>WordPress TV Directory</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
