<?php
global $scFW_globals, $CHfw_rdx_options;

$arrays_key = array();
foreach (range('A', 'Z') as $column) {
	$arrays_key[$column][] = '';
}

$args = $scFW_globals['archive-mp-event-arg'];
$i = 0;
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
$keyData = "";
$mydata3 = "";

$mydataServiceList = "";
$do_not_look_blank_ = $CHfw_rdx_options["DepartmanPageDo_not_look_blank_"];
if (!$do_not_look_blank_) {
	$paClass = "";
	$data = array_map('array_filter', $arrays_key);
	$data = array_filter($data);
} else {
	$paClass = "padd";
	$data = array_map('array_filter', $arrays_key);
}

$i = 0;
foreach ($data as $key => $rows) {
	$i++;
	$ival = ($i == 1 ? 'in active' : '');
	if (!empty($rows)) {
		$keyData .= '<li role="presentation" class="' . $ival . '"><a href="#menu' . $key . '" aria-controls="menu' . $key . '" role="tab" data-toggle="tab">' . $key . '</a></li>';
	} else{
		$keyData .= '<li role="presentation" class="' . $ival . '"><span class="gray ' . $paClass . '">' . $key . '</span></li>';
    }

	$mydata3 .= '<div role="tabpanel" id="menu' . $key . '" class=" tab-pane fade ' . $ival . '">';
	foreach ($rows as $key2 => $row) {
		$mydata3 .= '<a class="Keyname" href="' . $rows[$key2]["link"] . '"><span>' . $rows[$key2]["title"] . '</span></a>';
		$mydataServiceList .= '<li><a href="' . $rows[$key2]["link"] . '">' . $rows[$key2]["title"] . '</a></li>';
	}
	$mydata3 .= '</div> ';
}
?>
	<div class="col-md-3">
		<nav class="listdepartmans">
			<div class="nav-breadcrumbs-level">
				<h3> <?php _e('All Care Services', 'chfw-lang') ?></h3>
				<div id="search-mobile">
					<div role="search">
						<input type="text" id="myInput" onkeyup="JSquickSearch('myInput','myUL')" placeholder="Search for departmans.."
						       class="input-search">
						<span class="button-search"><i class="fa fa-search"></i></span>
					</div>
				</div>
				<ul id="myUL">
					<?php echo $mydataServiceList ?>
				</ul>
			</div>
		</nav>
	</div>
	<div class="col-md-9">
		<h3><?php _e('Medical and Surgical Services', 'chfw-lang') ?>        </h3>
		<ul id="myTabs" role="tablist" class="nav nav-tabs">
			<?php
			echo $keyData;
			?>
		</ul>
		<div class="tab-content" id="tab-contentDepartmans">
			<?php echo $mydata3 ?>
		</div>
	</div>