<?php
/**
 * Shortcode Title: Table
 * Shortcode: table
 * Usage:
[table]
  [table_row][table_cell]A1[/table_cell][table_cell]A2[/table_cell][table_cell]A3[/table_cell][/table_row]
  [table_row][table_cell]B1[/table_cell][table_cell]B2[/table_cell][table_cell]B3[/table_cell][/table_row]
  [table_row][table_cell]C1[/table_cell][table_cell]C2[/table_cell][table_cell]C3[/table_cell][/table_row]
  [table_row][table_cell]D1[/table_cell][table_cell]D2[/table_cell][table_cell]D3[/table_cell][/table_row]
[/table]
*/

add_shortcode('table', 'ts_table_func');

function ts_table_func( $atts, $content = null ) {

	extract(shortcode_atts(array(
		'animation' => '',
	    'style' => 'default'
    ), $atts));

	global $shortcode_table;
    $shortcode_table = array();
    do_shortcode($content);

	$html = '<div class="table-style '.ts_get_animation_class($animation).'" data-animation="'.$animation.'"><table class="table-list">';
	$i = 0;
	foreach ($shortcode_table as $row) {
		$html .= '<tr>';

		if (is_array($row['content'])) {
			foreach ($row['content'] as $cell) {
				if ($i == 0) {
					$html .= '<th>'.$cell['content'].'</th>';
				} else {
					$html .= '<td>'.$cell['content'].'</td>';
				}
			}
		}
		$html .= '</tr><!-- .sc-row -->';
		$i++;
	}
	$html .= '</table></div><!-- .sc-table -->';
    $shortcode_table = array();

	return $html;
}

/**
 * Shortcode Title: Table Row - can be used only with table shortcode
 * Shortcode: table_row
 * Usage: [table_row] [table_cell][/table_cell] [/table_row]
 */
add_shortcode('table_row', 'ts_table_row_func');
function ts_table_row_func( $atts, $content = null ) {

	global $shortcode_table_cell;

//	extract(shortcode_atts(array(
//	    'title' => '',
//	    'icon' => 'no',
//	    'iconsize' => '',
//	    'iconupload' => ''
//    ), $atts));
    global $shortcode_table;

	$shortcode_table_cell = array();

	do_shortcode($content);

    $shortcode_table[] = array(
		'content' => $shortcode_table_cell
	);
    return '';
}

/**
 * Shortcode Title: Table Row - can be used only with table shortcode
 * Shortcode: table_row
 * Usage: [table_row] [table_cell][/table_cell] [/table_row]
 */
add_shortcode('table_cell', 'ts_table_cell_func');
function ts_table_cell_func( $atts, $content = null ) {

	global $shortcode_table_cell;

	$shortcode_table_cell[] = array(
		'content' => trim(do_shortcode($content))
	);
    return '';
}