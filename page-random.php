<?php get_header(); ?>

<?php $random = isset($_GET['r']) && intval($_GET['r']) > 0 ? $_GET['r'] : '1'; 
$result = $wpdb->get_row($wpdb->prepare("SELECT * FROM talks WHERE id = %s", $random)); ?>
<main>

  <?php get_template_part('components/banner'); ?>

  <?php get_template_part('components/filters'); ?>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
        <?php set_query_var('latest', $result); get_template_part('components/card'); ?>
      </div>
    </div>
  </div>

</main>
<?php get_footer(); ?>