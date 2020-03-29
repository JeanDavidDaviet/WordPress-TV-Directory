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
              <p class="text-muted">Hi, my name is Jean-David. I'm a web developer specialized in WordPress. I like to watch WordPress.tv talks coming from the WordPress events all around the world and learn everything about the WordPress environment. But I'm not a big fan of the WordPress.tv user experience, so I tried to do a better version of it. None of the content is mine, it is all property of the WordPress.tv website.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Contact</h4>
              <ul class="list-unstyled">
                <li><a href="https://twitter.com/JeanDavidDaviet" class="text-white">Follow on Twitter</a></li>
                <li><a href="mailto:contact@jeandaviddaviet.fr" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <strong>WordPress Talks Online</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>
