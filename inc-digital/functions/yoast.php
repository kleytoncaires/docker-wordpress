<?php


// -----------
// MOVE YOAST TO THE BOTTOM IN ADMIN
// -----------
function yoasttobottom()
{
	return 'low';
}
add_filter('wpseo_metabox_prio', 'yoasttobottom');
