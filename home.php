<?php get_header(); ?>

<?php $latests = $wpdb->get_results("SELECT * FROM ". $wpdb->prefix . "talks ORDER by date DESC, id DESC LIMIT 18"); ?>
<main>

  <?php get_template_part('components/banner'); ?>

  <?php get_template_part('components/filters'); ?>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <?php foreach ($latests as $latest): ?>
          <?php set_query_var('latest', $latest); get_template_part('components/card'); ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</main>
<?php get_footer(); ?>