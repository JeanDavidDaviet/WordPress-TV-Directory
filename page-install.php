<?php

$last_url = $wpdb->get_var("SELECT url FROM ". $wpdb->prefix . "talks ORDER BY id DESC LIMIT 1");
$file = get_template_directory() . "/scrapper/new.csv";

$rows = file($file);
$last_row = array_pop($rows);
$last_line = str_getcsv($last_row, '|');

$row = 1;
if (($handle = fopen($file, "r")) !== FALSE && $last_line[2] !== $last_url) {
  while (($data = fgetcsv($handle, 15000, "|")) !== FALSE) {

  	if($row > 1
  	//	&& $row < 100
  	){

			$date = explode(' ', $data[3]);
			switch ($date[0]) {
				case 'January':
					$date[0] = '01';
					break;
				case 'February':
					$date[0] = '02';
					break;
				case 'March':
					$date[0] = '03';
					break;
				case 'April':
					$date[0] = '04';
					break;
				case 'May':
					$date[0] = '05';
					break;
				case 'June':
					$date[0] = '06';
					break;
				case 'July':
					$date[0] = '07';
					break;
				case 'August':
					$date[0] = '08';
					break;
				case 'September':
					$date[0] = '09';
					break;
				case 'October':
					$date[0] = '10';
					break;
				case 'November':
					$date[0] = '11';
					break;
				case 'December':
					$date[0] = '12';
					break;
			}
			$date[1] = str_replace(',', '', $date[1]);

			$date = $date[2] . '-' . $date[0] . '-' . $date[1];

			// $description = $data[5];
			$has_slides = preg_match('#Presentation Slides#', $data[4]);
			$description = explode('<div class="sd-block sd-rating">', $data[4]);
			$description = $description[0];


			$insert = array(
				'name' => $data[0],
				'slug' => sanitize_title($data[0]),
				'url' => $data[1],
				'image' => $data[2],
				'date' => $date,
				'description' => $description,
				'event' => $data[5],
				'event_slug' => sanitize_title($data[5]),
				'event_url' => $data[6],
				'speakers' => $data[7],
				'tags' => $data[8],
				'lang' => $data[9],
				'lang_slug' => sanitize_title($data[9]),
				'lang_url' => $data[10],
				'producer' => $data[11],
				'producer_slug' => sanitize_title($data[11]),
				'producer_url' => $data[12],
				'has_slides' => $has_slides
			);

			$insert_format = array(
				'name' => '%s',
				'slug' => '%s',
				'url' => '%s',
				'image' => '%s',
				'date' => '%s',
				'description' => '%s',
				'event' => '%s',
				'event_slug' => '%s',
				'event_url' => '%s',
				'speakers' => '%s',
				'tags' => '%s',
				'lang' => '%s',
				'lang_slug' => '%s',
				'lang_url' => '%s',
				'producer' => '%s',
				'producer_slug' => '%s',
				'producer_url' => '%s',
				'has_slides' => '%d'
			);

			$talk_id = null;

			if(trim($data[1]) != ""){
				$talk = $wpdb->get_var('SELECT url FROM '. $wpdb->prefix . 'talks WHERE url = "' . esc_sql($data[1]) . '"' );
				if(is_null($talk)){
					$insertion = $wpdb->insert('talks', $insert, $insert_format);
					if($insertion){
						$talk_id = $wpdb->insert_id;
					}
					echo $insert['name'].'<br/>';
				}else{
					echo 'Already exists : ' . $insert['name'] . '<br />';
				}
			}

			if($insertion){

				if(trim($data[9]) != ""){
					$lang = $wpdb->get_var('SELECT title FROM '. $wpdb->prefix . 'languages WHERE title = "' . esc_sql($data[9]) . '"' );
					if(is_null($lang)){
						$wpdb->insert('languages', array('title' => $data[9], 'slug' => sanitize_title($data[9]), 'url' => $data[10]), array('%s', '%s'));
					}
				}

				if(trim($data[5]) != ""){
					$event = $wpdb->get_var('SELECT title FROM '. $wpdb->prefix . 'events WHERE title = "' . esc_sql($data[5]) . '"' );
					if(is_null($event)){
						$wpdb->insert('events', array('title' => $data[5], 'slug' => sanitize_title($data[5]), 'url' => $data[6]), array('%s', '%s'));
					}
				}

				// $events = preg_split('#\s(?=\d{4}$)#', $data[5], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

		  // 	if(count($events) == 1){
				// 	$event = $wpdb->get_var('SELECT title FROM '. $wpdb->prefix . 'events WHERE title = "' . esc_sql($events[0]) . '"' );
				// 	if(is_null($event)){
				// 		$wpdb->insert('events', array('title' => $events[0], 'slug' => sanitize_title($events[0]), 'url' => $data[6]), array('%s', '%s'));
				// 	}
				// }else{
				// 	$event = $wpdb->get_var('SELECT title FROM '. $wpdb->prefix . 'events WHERE title = "' . esc_sql($events[0]) . '" AND year = ' . esc_sql($events[1]));
				// 	if(is_null($event)){
				// 		$wpdb->insert('events', array('title' => $events[0], 'slug' => sanitize_title($events[0]), 'url' => $data[6], 'year' => $events[1]), array('%s', '%s', '%s'));
				// 	}
				// }

				if(trim($data[11]) != ""){
					$producer = $wpdb->get_var('SELECT title FROM '. $wpdb->prefix . 'producers WHERE title = "' . esc_sql($data[11]) . '"' );
					if(is_null($producer)){
						$wpdb->insert('producers', array('title' => $data[11], 'slug' => sanitize_title($data[11]), 'url' => $data[12]), array('%s', '%s'));
					}
				}

				if(trim($data[7]) != ""){
					$speakers = json_decode($data[7]);
					foreach ($speakers as $speaker) {
						$speaker_id = $wpdb->get_var('SELECT id FROM '. $wpdb->prefix . 'speakers WHERE title = "' . esc_sql($speaker->speaker) . '"' );
						if(is_null($speaker_id)){
							$insertion_speaker = $wpdb->insert('speakers', array('title' => $speaker->speaker, 'slug' => sanitize_title($speaker->speaker), 'url' => $speaker->url), array('%s', '%s'));
							if($insertion_speaker && !is_null($talk_id)){
								$speaker_id = $wpdb->insert_id;
							}
						}
						$wpdb->insert('talks_speakers', array('id_talk' => $talk_id, 'id_speaker' => $speaker_id), array('%d', '%d'));
					}
				}

				if(trim($data[8]) != ""){
					$tags = json_decode($data[8]);
					foreach ($tags as $tag) {
						$tag_id = $wpdb->get_var('SELECT id FROM '. $wpdb->prefix . 'tags WHERE title = "' . esc_sql($tag->tag) . '"' );
						if(is_null($tag_id)){
							$insertion_tag = $wpdb->insert('tags', array('title' => $tag->tag, 'slug' => sanitize_title($tag->tag), 'url' => $tag->url), array('%s', '%s'));
							if($insertion_tag && !is_null($talk_id)){
								$tag_id = $wpdb->insert_id;
							}
						}
						$wpdb->insert('talks_tags', array('id_talk' => $talk_id, 'id_tag' => $tag_id), array('%d', '%d'));
					}
				}

			}


  	}


    $row++;
  }
  fclose($handle);
}

update_option('talk_count', $wpdb->get_var('SELECT COUNT(*) FROM talks'), false);

die;
