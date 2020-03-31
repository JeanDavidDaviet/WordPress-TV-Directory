<?php get_header(); ?>

<?php 

$args = array();
$join = '';
$search = '';

$event_slug = isset($_GET['event']) && $_GET['event'] != '' ? $_GET['event'] : null;
set_query_var('event_slug', $event_slug);
if(!is_null($event_slug)){
  $search .= " AND event_slug = %s ";
  array_push($args, $event_slug);
}

$language_slug = isset($_GET['language']) && $_GET['language'] != '' ? $_GET['language'] : null;
set_query_var('language_slug', $language_slug);
if(!is_null($language_slug)){
  $search .= " AND language_slug = %s ";
  array_push($args, $language_slug);
}

$producer_slug = isset($_GET['producer']) && $_GET['producer'] != '' ? $_GET['producer'] : null;
set_query_var('producer_slug', $producer_slug);
if(!is_null($producer_slug)){
  $search .= " AND producer_slug = %s ";
  array_push($args, $producer_slug);
}

$date_slug = isset($_GET['date']) && $_GET['date'] != '' ? $_GET['date'] : null;
set_query_var('date_slug', $date_slug);
if(!is_null($date_slug)){
  $search .= " AND date LIKE %s ";
  array_push($args, '%' . $date_slug . '%');
}

$speaker_slug = isset($_GET['speaker']) && $_GET['speaker'] != '' ? $_GET['speaker'] : null;
set_query_var('speaker_slug', $speaker_slug);
if(!is_null($speaker_slug)){
  $join .= " LEFT JOIN talks_speakers TS ON T.id = TS.id_talk LEFT JOIN speakers S ON TS.id_speaker = S.id ";
  $search .= " AND S.slug = %s ";
  array_push($args, $speaker_slug);
}

$tag_slug = isset($_GET['tag']) && $_GET['tag'] != '' ? $_GET['tag'] : null;
set_query_var('tag_slug', $tag_slug);
if(!is_null($tag_slug)){
  $join .= " LEFT JOIN talks_tags TS ON T.id = TS.id_talk LEFT JOIN tags TAG ON TS.id_tag = TAG.id ";
  $search .= " AND TAG.slug = %s ";
  array_push($args, $tag_slug);
}

$has_slides = isset($_GET['has_slides']) && $_GET['has_slides'] != '' && $_GET['has_slides'] === '1' ? true : false;
set_query_var('has_slides', $has_slides);
if($has_slides){
  $search .= " AND T.has_slides = 1 ";
}

$sql = "SELECT T.* FROM ". $wpdb->prefix . "talks T $join WHERE 1 = 1 $search ORDER by T.date, T.id DESC LIMIT 30";
$prepare = $wpdb->prepare($sql, $args);
$latests = $wpdb->get_results($prepare);

?>
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