<?php
/**
 * Shortcode Title: Pricing table
 * Shortcode: pricing_table
 * Usage: [pricing_table animation="bounceInUp"][pricing_table_column]...[/pricing_table_column][/pricing_table]
 */
add_shortcode('pricing_table', 'ts_pricing_table_func');

function ts_pricing_table_func( $atts, $content = null ) {

	global $pricing_table_columns;
    $pricing_table_columns = array(); // clear the array

	do_shortcode($content); // execute the '[pricing_table_columns]' shortcode first to get columns

	extract(shortcode_atts(array(
		'animation' => ''
	), $atts));

	$columns = '';

	if (!is_array($pricing_table_columns) || count($pricing_table_columns) == 0) {
		return '';
	}

	$columns_count = count($pricing_table_columns);
	$add_to_class = '';
	if ($columns_count < 4) {
		$add_to_class = '-two';
	}

	foreach ($pricing_table_columns as $column) {

		$features = '';
		if (is_array($column)) {
			foreach ($column['rows'] as $row) {

				$features .= '<li>'.$row['text'].'</li>';
			}
		}

		$button = '';
		if (!empty($column['buttontext'])) {
			$button = '<div class="ordernow"><a href="'.$column['url'].'" class="colorchan">'.$column['buttontext'].'</a></div>';
		}

		$columns .= '
			<div class="pricing-tables'.($column['featured'] == 'yes' ? '-helight' : '').$add_to_class.' '.ts_get_animation_class($animation).'" data-animation="'.$animation.'">
            	<div class="title">'.$column['title'].'</div>
                <div class="price">'.$column['price'].'<i>'.$column['period'].'</i></div>
                <div class="cont-list">
                	<ul>
                    	'.$features.'
                    </ul>
                </div>
                '.$button.'
            </div><!-- end section -->';

	}
    $pricing_table_columns = array();

	return '
		<div class="pricing-tables-main">
            '.$columns.'
        </div><!-- end pricing tables with 4 columns -->';
}

/**
 * Shortcode Title: Pricing Table Column - can be used only with pricing_table shortcode
 * Shortcode: pricing_table_columns
 * Usage: [pricing_table_column featured="no" title="Medium plan" price="25" period="per month" buttontext="Signup" url="..."][/pricing_table_column]
 */
add_shortcode('pricing_table_column', 'ts_pricing_table_column_func');
function ts_pricing_table_column_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'featured' => 'no',
	    'title' => '',
	    'price' => '',
	    'period' => '',
	    'discount' => '',
	    'buttontext' => '',
	    'url' => ''
    ), $atts));
    global $pricing_table_columns, $pricing_table_items;
	$pricing_table_items = array();
	do_shortcode($content);

    $pricing_table_columns[] = array(
		'featured' => $featured,
	    'title' => $title,
	    'price' => $price,
	    'period' => $period,
	    'discount' => $discount,
		'buttontext' => $buttontext,
	    'url' => $url,
		'rows' => $pricing_table_items
	);

	$pricing_table_items = array();
}

/**
 * Shortcode Title: Pricing Table Item - can be used only with pricing_table_column shortcode
 * Shortcode: pricing_table_columns
 * Usage: [pricing_table_item text="Your text"]
 */
add_shortcode('pricing_table_item', 'ts_pricing_table_item_func');
function ts_pricing_table_item_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'text' => ''
    ), $atts));
    global $pricing_table_items;
    $pricing_table_items[] = array(
		'text' => $text
	);
}