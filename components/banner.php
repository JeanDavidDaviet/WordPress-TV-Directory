<?php $talk_count = get_option('talk_count'); ?>
<section class="jumbotron text-center">
  <div class="container">
    <h1 class="jumbotron-heading">WordPress TV Directory</h1>
    <p class="lead text-muted">WordPress TV has a lot of great content, but not the best way to discover it.</p>
    <p class="lead text-muted"><?php echo $talk_count; ?> videos and couting.</p>
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Advanced search</button>
      <?php /* ?><a href="<?php echo add_query_arg('r', rand(0, $talk_count), home_url('random')); ?>" class="btn btn-secondary my-2">Random video</a><?php */ ?>
    </p>
  </div>
</section>
