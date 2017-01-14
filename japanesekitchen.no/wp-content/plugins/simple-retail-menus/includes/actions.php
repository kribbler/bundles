<?php 

//Database Query Actions

switch ($_POST['dbtouch']) {
		case "Cancel":
			$loc = "";
		break;	
		
		//Delete a Menu
		case "Delete This Menu":
			$targetmenu = $_POST['targetmenu'];
			$wpdb->query( $wpdb->prepare("DELETE FROM $jsrm_item_table WHERE menu = $targetmenu") );
			$wpdb->query( $wpdb->prepare("DELETE FROM $jsrm_menu_table WHERE id = $targetmenu") );	
			$loc = "";
		break;
		
		// Add a new menu
		case "Add Menu": 
			$loc = "&mode=newmenu&error=namefield";	
			$name = preg_replace('/\s\s+/', ' ', $_POST['name']);
			if (isset($name) && $name != "" && $name !=" "){
			 	$num_menus = $wpdb->query( $wpdb->prepare("SELECT * FROM $jsrm_menu_table") );
			 	$label = ($_POST['label']) ? $_POST['label'] : $name;
				$description = $_POST['desc'];
				$wpdb->insert( $jsrm_menu_table , array( 'name' => $name, 'label' => $label, 'description' => $description, ) );
				$targetmenu = $wpdb->insert_id;
				$loc = "&mode=edit&targetmenu=".$targetmenu;
				$md = "edit";
			}
		break;
		
		// Sort Menu List
		case "menuorder":
			$loc = "";
			
			foreach($_POST['id'] as $j){
				$morder = $_POST['morder'][$j];
				$wpdb->update( $jsrm_menu_table , array( 'menuorder' => $morder ),array( 'id' => $j ), array( '%s' ) );
			}
		break;

		
		// Update an existing menu
		case "Update Menu": 
			$loc = "&mode=edit&targetmenu=".$_POST['targetmenu']."&error=namefield";	
			$name = preg_replace('/\s\s+/', ' ', $_POST['name']);
			if (isset($name) && $name != "" && $name !=" "){
				$label = ($_POST['label']) ? $_POST['label'] : $name;
				$description = $_POST['desc'];
				$id = $_POST['targetmenu'];
				$itemheader = $_POST['itemheader'];
				$valueheader = $_POST['valueheader'];
				
				for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
						$p = "valueheader".$v;
						${$p} = $_POST[$p];
					}
				
				$updates = array(
					'name' => $name,
					'label' => $label,
					'description' => $description,
					'itemheader' => $itemheader,
					'valueheader' => $valueheader,
				);
				
				for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
						$q = "valueheader".$v;
						$updates[$q] = $$q;
					}
					
				$wpdb->update( $jsrm_menu_table, $updates, array( 'id' => $id ) );
				$loc = "&mode=edit&targetmenu=".$_POST['targetmenu'];
				$md = "edit";
			}				
		break;
		
		// Add a new item to a menu
		case "Add": 
			$targetmenu = $_POST['targetmenu'];
			$num_rows = $wpdb->query("SELECT * FROM $jsrm_item_table WHERE menu = $targetmenu");
			$neworder = $num_rows+1;	
			if ($_POST['item']){
				$image = $_POST['image'];
				$linked = (isset($_POST['linked']) && $_POST['linked'] == 'checked' ) ? 1 : 0;
				$linkurl = $_POST['linkurl'];
				$item = $_POST['item'];
				$description = $_POST['desc'];
				$value = $_POST['value'];
				
				for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
					$p = "value".$v;
					${$p} = $_POST[$p];
				}	
				$insertions = array(
					'itemorder' => $neworder,
					'menu' => $targetmenu,
					'image' => $image,
					'linked' => $linked,
					'linkurl' => $linkurl,
					'item' => $item,
					'description' => $description,
					'value' => $value,
				);
				for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
					$q = "value".$v;
					$insertions[$q] = $$q;
				}
				$wpdb->insert( $jsrm_item_table , $insertions );	
			}
			
			$loc = "&mode=edit&targetmenu=".$targetmenu;
			$md = "edit";
		break;
		
		// Update existing menu items
		case "Update Items": 
			foreach($_POST['id'] as $j){
				if (isset($_POST['strike'][$j]) && $_POST['strike'][$j] == 'checked' ){
					$wpdb->query( $wpdb->prepare("DELETE FROM $jsrm_item_table WHERE id = $j") );
				}
				else{
					$order = (isset($_POST['order'][$j])) ? $_POST['order'][$j] : "";
					$image = (isset($_POST['image'][$j])) ? $_POST['image'][$j] : "";
					$linked = (isset($_POST['linked'][$j]) && $_POST['linked'][$j] == 'checked' ) ? 1 : 0;
					$linkurl = (isset($_POST['linkurl'][$j])) ? $_POST['linkurl'][$j] : "";
					$itemhidden = (isset($_POST['itemhidden'][$j]) && $_POST['itemhidden'][$j] == 'checked' ) ? 1 : 0;
					$item = (isset($_POST['item'][$j])) ? $_POST['item'][$j] : "";
					$desc = (isset($_POST['desc'][$j])) ? $_POST['desc'][$j] : "";
					$value = (isset($_POST['value'][$j])) ? $_POST['value'][$j] : "";
					
					for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
						$p = "value".$v;
						${$p} = (isset($_POST[$p][$j])) ? $_POST[$p][$j] : "";
					}	
					
					$updates = array(
						'itemorder' => $order,
						'image' => $image,
						'linked' => $linked,
						'linkurl' => $linkurl,
						'itemhidden' => $itemhidden,
						'item' => $item,
						'description' => $desc,
						'value' => $value,
					);
					for ($v=2;$v<=JSRM_VALUE_COLS;$v++){
						$q = "value".$v;
						$updates[$q] = $$q;
					}
					
					$wpdb->update( $jsrm_item_table , $updates, array( 'id' => $j ) 
					);
				}
			}
			//Sort items by order, then rewrite the orderw ith no gaps left from deleted items
			$targetmenu = $_POST['targetmenu'];
			$rows = "SELECT * FROM $jsrm_item_table WHERE menu = $targetmenu ORDER by itemorder ASC";
			$result = $wpdb->get_results($rows);
			$n = 1;
			foreach ($result as $r){
				$id = $r->id;
				$wpdb->update( $jsrm_item_table , array( 'itemorder' => $n ), array( 'id' => $id ) );
				++$n;
			}
			$loc = "&mode=edit&targetmenu=".$targetmenu;
		break;
		}
	
	// return to Admin page
	header('Location:'.JSRM_SELF.$loc);
	
	exit;
?>