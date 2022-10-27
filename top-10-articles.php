<?php
header('Content-type: application/json');
$cachetime = 21600; // 6 hours

/* Add $token_auth variable to credentials.php */
include('config.php');
include('inc/top-cache.php');

$json = file_get_contents( $matomo_url . '/index.php?date=last30&filter_limit=50&flat=1&force_api_session=1&format=JSON&idSite=1&method=Actions.getPageUrls&module=API&period=range&segment=&token_auth=' . $token_auth );
$results = json_decode($json);

/* for each result, add the label value to the array */
$slugs = array();
foreach ($results as $result) {
	/* Get only articles */
	if (strpos($result->label, '/article/') === 0 && strpos($result->label, ' - Others') === false) {
		/* Extract slug */
		$slug = explode('/', $result->label);
		$slug = $slug[2];

		/* Add only slug to array */
		$slugs[] = $slug;
	}

	/* Add only first 10 results */
	if ( count($slugs) == 10 ) {
		break;
	}
}

$output = array();
$output["fetch_date"] = date('c');
$output["results"] = $slugs;

print json_encode($output);

include('inc/bottom-cache.php');