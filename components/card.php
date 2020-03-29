<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
    <a href="<?php echo $latest->url; ?>"><img src="<?php echo $latest->image; ?>" alt=""></a>
    <div class="card-title"><p><?php echo $latest->name; ?></p></div>
    <div class="card-body">
      <div class="card-text"><?php echo $latest->description; ?></div>
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted"><a href="<?php echo $latest->event_url; ?>"><?php echo $latest->event; ?></a></small>
      </div>
    </div>
  </div>
</div>