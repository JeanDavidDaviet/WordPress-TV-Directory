<div class="col-md-4">
  <div class="card mb-4 shadow-sm">
    <a href="<?php echo $latest->url; ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo $latest->image; ?>" alt=""></a>
    <div class="card-title"><a href="<?php echo $latest->url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $latest->name; ?></a></div>
    <div class="card-body">
      <a href="#" data-toggle="collapse" data-target="#talk<?php echo $latest->id; ?>" aria-expanded="false" aria-controls="collapseExample">Show description</button>
      <div class="card-text collapse" id="talk<?php echo $latest->id; ?>"><?php echo $latest->description; ?></div>
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted"><a href="<?php echo $latest->event_url; ?>" target="_blank" rel="noopener noreferrer"><?php echo $latest->event; ?></a></small>
      </div>
    </div>
  </div>
</div>
