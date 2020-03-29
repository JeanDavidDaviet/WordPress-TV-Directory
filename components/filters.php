<section class="filters jumbotron collapse" id="collapseExample">
  <form class="container" action="<?php echo home_url(); ?>" method="get">
    <input type="hidden" name="s" value="">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="event">Event</label>
          <select class="form-control" id="event" name="event">
            <option value>Filter by event</option>
            <?php foreach ($events as $event): ?>
              <option value="<?php echo $event->slug; ?>" <?php echo !is_null($event_slug) && $event_slug == $event->slug ? 'selected' : ''; ?>><?php echo $event->title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="tag">Tag</label>
          <select class="form-control" id="tag" name="tag">
            <option value>Filter by tag</option>
            <?php foreach ($tags as $tag): ?>
              <option value="<?php echo $tag->slug; ?>" <?php echo !is_null($tag_slug) && $tag_slug == $tag->slug ? 'selected' : ''; ?>><?php echo $tag->title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="speaker">Speaker</label>
          <select class="form-control" id="speaker" name="speaker">
            <option value>Filter by speaker</option>
            <?php foreach ($speakers as $speaker): ?>
              <option value="<?php echo $speaker->slug; ?>" <?php echo !is_null($speaker_slug) && $speaker_slug == $speaker->slug ? 'selected' : ''; ?>><?php echo $speaker->title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="language">Language</label>
          <select class="form-control" id="language" name="language">
            <option value>Filter by language</option>
            <?php foreach ($languages as $language): ?>
              <option value="<?php echo $language->slug; ?>" <?php echo !is_null($language_slug) && $language_slug == $language->slug ? 'selected' : ''; ?>><?php echo $language->title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div class="row">
      <div class="col-6">
        <a href="#">More filters</a>
      </div>
    </div>
        <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="date">Date</label>
          <select class="form-control" id="date" name="date">
            <option value>Filter by date</option>
            <?php for($minDate = intval(date('Y')); $minDate >= 2007; $minDate--): ?>
              <option value="<?php echo $minDate; ?>" <?php echo !is_null($date_slug) && $date_slug == $minDate ? 'selected' : ''; ?>><?php echo $minDate; ?></option>
            <?php endfor; ?>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <p>Are slides included ?</p>
          <input id="has_slides" class="form-control" type="checkbox" value="1" name="has_slides" <?php echo $has_slides ? 'checked' : ''; ?>><label for="has_slides">Slides included</label>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="producer">Producer</label>
          <select class="form-control" id="producer" name="producer">
            <option value>Filter by producer</option>
            <?php foreach ($producers as $producer): ?>
              <option value="<?php echo $producer->slug; ?>" <?php echo !is_null($producer_slug) && $producer_slug == $producer->slug ? 'selected' : ''; ?>><?php echo $producer->title; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</section>
