<?php
/*
 * program and services list
 * @return array
 */
function CHfw_StaffProgramAndServices_($id)
{
	$var = get_post_meta($id, 'CHfw_DrAndDep_program_and_services', true);

	$vars = explode(',', $var);

	return CHfw_get_the_title_Custom($vars);
}

/*@uses  StaffProgramAndServices () top func*/
function CHfw_get_the_title_Custom($post = 0, $returnType = 'string')
{

	$arrays_key = array();
	$i = 0;
	$args = array(
		'post_type' => 'mp-event',
		'post__in' => $post,
		'hide_empty' => 0,
		'posts_per_page' => -1,
		"post_status" => "publish",
	);
	$arrays_keyString = "";
	$wp_query_ = new WP_Query($args);

	if ($wp_query_->have_posts()) {
		while ($wp_query_->have_posts()) {
			$i++;
			$wp_query_->the_post();
			unset($previousday);
			if ($returnType == 'string') {
				$arrays_keyString .= get_the_title() . ',';
			}
			$arrays_key[$i]["title"] = get_the_title();
		}
	}
	unset($wp_query_);
	if ($returnType == 'array') {
		return $arrays_key;
	} else {
		return substr($arrays_keyString, 0, -1);;
	}
}

/*
 *Departman ALL list
 * @return string
 */
function CHfw_AllCareServiceList()
{

    $root_categories = get_categories(
        array(
            'parent' => 0,
            'taxonomy' => 'mp-event_category',
            'post_type' => 'mp-event',
        )
    );
    $newResult = array();
    foreach ($root_categories as $key => $value) {
        $newResult[] = $value->slug;
    }


	$i = 0;
	$mydataServiceList = "";
	$args = array('post_type' => 'mp-event',
		'parent' => 0,
		'hide_empty' => 0,
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'tax_query' =>
			array(
				'relation' => 'OR',
				0 =>
					array(
						'taxonomy' => 'mp-event_category',
						'field' => 'slug',
                        'terms' => $newResult,
						'include_children' => false,
					),
			));
	$wp_query_ = new WP_Query($args);
	if ($wp_query_->have_posts()) {
		while ($wp_query_->have_posts()) {
			$i++;
			$wp_query_->the_post();
			$format_typeCH = get_post_format();
			unset($previousday);

			$OneLetter = mb_substr(get_the_title(), 0, 1);
			$arrays_key[$OneLetter][$i]["title"] = get_the_title();
			$arrays_key[$OneLetter][$i]["link"] = get_the_permalink();
		}
	}


	$data = array_map('array_filter', $arrays_key);
	foreach ($data as $key => $rows) {
		$i++;
		foreach ($rows as $key2 => $row) {
			$mydataServiceList .= '<li><a href="' . $rows[$key2]["link"] . '">' . $rows[$key2]["title"] . '</a></li>';
		}
	}
	return $mydataServiceList;
}

/*
 * custom expert new
 * */
function CHfw_custom_excerpt_length2($length)
{
	return 20;
}

add_filter('excerpt_length', 'CHfw_custom_excerpt_length2', 999);