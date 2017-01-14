<div id="icon-tools" class="icon32"><br /></div>
<h2><?php _e( 'WoBIL Product Checker', 'wobil-checker' ); ?></h2>
<?php 
//$products = wp_get_products( $_POST['check_category'] );

$args     = array( 'post_type' => 'product', 'meta_key' => 'finn-url', 'posts_per_page' => 10000 );
$products = get_posts( $args ); 
//echo "<pre>";var_dump($products);echo "</pre>";


if ($products){?>
<h3>Following products were found as imported matching your selection (<?php echo $_POST['check_category']?>):</h3>
<form enctype="multipart/form-data" method="post" action="<?php echo get_admin_url().'tools.php?page=wobil-checker&action=preview'; ?>">
<button id="check_products" class="button-primary" type="submit"><?php _e( 'Check if active on Finn', 'wobil-checker' ); ?></button>
<p>When products aren't available on Finn, they are marked with red background. Click check box to mark them for deletion.</p><br />
<button id="delete_products" class="button-primary" type="submit"><?php _e( 'Delete checked products!', 'wobil-checker' ); ?></button><br /><br />
<div class="updated" style="display:none">
	<p>Selected products have been deleted.</p>
</div><br />
<img src="<?php echo plugin_dir_url( __FILE__ ); ?>ajax-loader1.gif" id="ajax_loading" style="display:none" />
<table id="import_data_preview" class="wp-list-table widefat fixed pages" cellspacing="0">
	<thead>
		<tr>
			<td>Select</td>
			<td>ID</td>
			<td>Brand | Model</td>
			<td>Price</td>
			<td>Title</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product){?>
	<tr id="tr_<?php echo $product->ID?>">
		<td><input type="checkbox" class="product_check" name="product_<?php echo $product->ID?>" id="product_<?php echo $product->ID?>"></td>
		<td><?php echo $product->ID?></td>
		<td>
			<?php 
			$terms = woocommerce_get_product_terms($product->ID, "pa_merke") ;
			echo $terms[0]->name;
			
			$terms = woocommerce_get_product_terms($product->ID, "pa_modell") ;
			
			if ($terms){
				echo ' - ';
				foreach ($terms as $term){
					//var_dump($term);
					echo $term->name;
				}
			}
			?>
		</td>
		
		<td>
			<?php 
			$price = get_post_meta( $product->ID, '_regular_price');
			echo woocommerce_price( $price[0] );
			?>
		</td>
		<td>
			<?php echo $product->post_title; ?>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>
</form>
<?php } else {?>
<h3>No items were found matching your selection</h3>
<?php }?>
<br /><button type="button" class="button-primary" onclick="history.back(-1)">Go Back</button>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#check_products').click(function(){
		doAjaxCheck(1, 0);
		return false;
	});

	function doAjaxCheck(limit, offset) {
		$('.updated').html('');
		$('.updated').hide();
		$('#ajax_loading').show();
        var data = {
            "action": "wobil-checker-ajax",
            "limit": limit,
            "offset": offset,
			//"items": <?php echo json_encode($items)?>,
			"products": <?php echo json_encode($products)?>
        };

        $.post(ajaxurl, data, ajaxCheckCallback);
    }

	function ajaxCheckCallback(response_text) {
		var response = jQuery.parseJSON(response_text);
		console.log(response);
		if (response.exist == false){
			$('#product_' + response.product_id).attr('checked', true);
			$('#product_' + response.product_id).children('td, th').css('background-color','red');
		}
		
		if(parseInt(response.remaining_count) > 0) {
			doAjaxCheck(response.limit, response.new_offset);
		} else {
			$("#check_status").addClass("complete");
		}
		
		$('.updated').fadeOut();
		$('#ajax_loading').hide();
		return false;
		//show the progress
		
	}

	$('#delete_products').click(function(){
		$('#ajax_loading').show();
		doAjaxDelete();
		return false;
	});

	function doAjaxDelete(){
		$('.updated').fadeOut();
		ids = [];
		$('.product_check').each(function(){
			if ($(this).attr('checked')){
				var id = $(this).attr('id');
				id = id.split('_');
				id=id[1];
				ids.push(id);
			}
		});

        var data = {
			"action": "wobil-checker-ajax-delete",
			"ids": ids
		};
		$.post(ajaxurl, data, ajaxDeleteCallback);
	}

	function ajaxDeleteCallback(response_text) {
		var response = jQuery.parseJSON(response_text);
		$('.updated').html('<p>Selected products have been deleted.</p>');
		$('.updated').fadeIn();
		$.each(response, function(i,d){
			$('#tr_' + d).fadeOut();
		});
		$('#ajax_loading').hide();
	}
});
</script>