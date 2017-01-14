<?php

class adminThemeOptions {

    public function contact() {



        if (isset($_GET['save_contact']))
            $this->contact_save();
        ?>

        <form action="themes.php?page=theme_options&sub_page=contact_form&save_contact" method="post">

            <div class="content-top"><input type="submit" value="Save all changes" /><div class="clear"></div></div>

            <div class="content-inner">

                <h3>Contact form</h3>

                <p>Add fields to your contact form and then call the contact field via shortcodes.</p>

        <?php if (!$this->contact_select()) : ?>

                    <div class="form_fields">

                        <div class="input" style="display: none">

                            <label for="label_1">Label</label>

                            <input type="text" name="label_1" />

                        </div>

                        <div class="input">

                            <label for="input_type_1">Input type</label>

                            <select name="input_type_1">

            <?php
            $options = array('text' => 'Text', 'textarea' => 'Textarea');

            //, 'checkbox' => 'Checkbox'

            foreach ($options as $key => $value) :
                ?>

                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option> 

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="input" id="required">

                            <label for="is_required_1">Required</label> 

                            <input type="checkbox" name="is_required_1" value="0" />

                        </div>

                        <div class="clear"></div>

                        <div class="input">

                            <label for="placeholder_1">Placeholder</label>

                            <input type="text" name="placeholder_1" />

                        </div>

                        <div class="input">

                            <label for="validation_1">Validation</label>

                            <select name="validation_1">

            <?php
            $options = array('none' => 'None', 'email' => 'Email', 'number' => 'Number', 'phone' => 'phone', 'text_only' => 'Text only');

            foreach ($options as $key => $value) :
                ?>

                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option> 

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>    

        <?php else : ?>

                    <div class="form_fields_wrapper">

            <?php $i = 0;
            foreach ($this->contact_select() as $data) : $i++; ?>

                            <div class="form_fields" id="form_fields_<?php echo $i; ?>">

                                <div class="input"  style="display: none">

                                    <label for="label_<?php echo $i; ?>">Label</label>

                                    <input type="text" name="label_<?php echo $i; ?>" value="<?php echo $data->label; ?>"/>

                                </div>

                                <div class="input">

                                    <label class="left_label" for="input_type_<?php echo $i; ?>">Input type</label>

                                    <select class="small_input" name="input_type_<?php echo $i; ?>">

                <?php
                $options = array('text' => 'Text', 'textarea' => 'Textarea');

                //, 'checkbox' => 'Checkbox'

                foreach ($options as $key => $value) :

                    if ($data->form_type == $key) {

                        $selected = 'selected="selected"';
                    } else {

                        $selected = '';
                    }
                    ?>

                                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option> 

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="input">

                                        <?php
                                        if ($data->required == 'on')
                                            $checked = 'checked';

                                        else
                                            $checked = '';
                                        ?>

                                    <label class="left_label" for="is_required_<?php echo $i; ?>">Required</label> 

                                    <input class="small_input" type="checkbox" name="is_required_<?php echo $i; ?>" <?php echo $checked; ?>/>

                                </div>

                                <div class="input" id="required">

                                    <label for="placeholder_<?php echo $i; ?>">Placeholder</label>

                                    <input type="text" name="placeholder_<?php echo $i; ?>" value="<?php echo $data->placeholder; ?>" />

                                </div>

                                <div class="input">

                                    <label class="left_label" for="validation_<?php echo $i; ?>">Validation</label>

                                    <select class="small_input" name="validation_<?php echo $i; ?>">

                <?php
                $options = array('none' => 'None', 'email' => 'Email', 'phone' => 'Phone number');

                //, 'text_only' => 'Text only', 'number' => 'Number'

                foreach ($options as $key => $value) :

                    if ($data->validation == $key) {

                        $selected = 'selected="selected"';
                    } else {

                        $selected = '';
                    }
                    ?>

                                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option> 

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="remove-add"><input type="button" class="remove" value="-"><input class="add" type="button" value="+"></div>

                            </div>

                                    <?php endforeach; ?>

                    </div>

        <?php endif; ?>

                <input type="submit" value="Save all changes" />

            </div>

        </form>

        <?php
    }

    public function info() {

        if (isset($_GET['save_info']))
            $this->info_save();



        $info_data = $this->info_account_select();

        if (empty($info_data)) {

            $info_data[0]->responsive = '';
            
            $info_data[0]->responsive_demand = '';

            $info_data[0]->boxed = '';
            
            $info_data[0]->pattern = '';
            
            $info_data[0]->custom_pattern = '';

            $info_data[0]->email = '';

            $info_data[0]->google_analytics = '';

            $info_data[0]->facebook = '';

            $info_data[0]->twitter = '';

            $info_data[0]->linkedin = '';

            $info_data[0]->vimeo = '';

            $info_data[0]->youtube = '';

            $info_data[0]->flickr = '';

            $info_data[0]->copyright = '';
            
            $info_data[0]->copyright_on = '';
            
            $info_data[0]->top_menu = '';
            
            $info_data[0]->top_menu_label = '';
            
            $info_data[0]->top_menu_input = '';
            
            $info_data[0]->google = '';
        }

        $media_data = $this->info_media_select();

        if (empty($media_data)) {

            $media_data[0]->url = '';

            $media_data[1]->url = '';
        }

        $pages_data = $this->info_pages_select();

        if (empty($pages_data))
            $portfolio_data = '';

        else {
            foreach($pages_data as $data) {
                if($data->type=='blog')
                  $blog_data = explode(';', $data->details);  
                if($data->type=='portfolio')
                  $portfolio_data = explode(';', $data->details); 
                if($data->type=='error')
                  $error_data = explode(';', $data->details); 
            } 
        }
        ?>

        <form action="themes.php?page=theme_options&sub_page=options&save_info" method="post">

            <div class="content-top"><input type="submit" value="Save all changes" /><div class="clear"></div></div>

            <div class="content-inner">

                <h3>Page layout:</h3>

                <p>Here you can change all the settings about responsive layout and will your site be boxed (when checked you will have more options).</p>

                <div class="info">

                    <div class="input">

        <?php
        if ($info_data[0]->responsive == '-1')
            $checked = '';

        elseif ($info_data[0]->responsive == '')
            $checked = '';

        else
            $checked = 'checked';
        ?>

                        <label for="responsive">Responsive</label>

                        <input class="small_input" style="margin-left: 74px" type="checkbox" name="responsive" <?php echo $checked; ?> />

                    </div>
                    
                    <div class="input">

        <?php
        if ($info_data[0]->responsive_demand == '-1')
            $checked = '';

        elseif ($info_data[0]->responsive_demand == '')
            $checked = '';

        else
            $checked = 'checked';
        ?>

                        <label for="responsive_demand">Responsive on demand</label>

                        <input class="small_input" style="margin-left: 74px" type="checkbox" name="responsive_demand" <?php echo $checked; ?> />

                    </div>
                    
                    <div class="input">

        <?php
        if ($info_data[0]->boxed == '-1')
            $checked = '';

        elseif ($info_data[0]->boxed == '')
            $checked = '';

        else
            $checked = 'checked';
        ?>

                        <label for="boxed">Boxed</label>

                        <input id="is-boxed" class="small_input" style="margin-left: 74px" type="checkbox" name="boxed" <?php echo $checked; ?> />

                    </div>
                    <div <?php if ( $checked == "" ) { echo 'style="display:none"'; } ?> class="input" id="pattern-select-wrapper">
                        <label for="pattern">Pattern</label>
                        <div class="admin-patern-radio">
                            <?php for($i=0; $i<10; $i++) : 
                                if($info_data[0]->pattern == $i)
                                    $checked = 'checked';
                                else
                                    $checked = '';
                                ?>
                            <input type="radio" name="pattern" value="<?php echo $i; ?>" <?php echo $checked; ?>/>
                            <?php endfor; ?>
                        </div>
                        <div class="admin-patern-select">
                            <?php for($i=0; $i<10; $i++) : ?>
                                <?php if($info_data[0]->pattern == $i): ?>
                                    <img id="selected-pattern" src="<?php echo get_template_directory_uri(); ?>/images/patterns/patern<?php echo $i; ?>.png" />
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/patterns/patern<?php echo $i; ?>.png" />
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div><div style="clear: both"></div>
                    </div>

                    <div class="input"  <?php if($info_data[0]->pattern != 0 || $info_data[0]->boxed=='-1' || $info_data[0]->boxed == ''){ echo 'style="display: none"'; } ?> id="custom-patern-wrapper">
                        <label for="custom_pattern">Custom background image/pattern</label>
                        <input id="custom_pattern" type="text" size="36" name="custom_pattern" value="<?php echo $info_data[0]->custom_pattern; ?>" />
                        <input id="_btn" class="upload_image_button" type="button" value="Upload" />
                    </div>
                    
                    <div class="input" <?php if($info_data[0]->pattern != 0 || $info_data[0]->boxed=='-1' || $info_data[0]->boxed == ''){ echo 'style="display: none"'; } ?> id="patern-type-wrapper">
                        <label for="pattern">Custom background type</label>
                        <div class="patern-type">
                            <?php 
                            $types = array('stretched', 'tilled');
                            foreach ($types as $type) : 
                                if($info_data[0]->type == $type)
                                    $checked = 'checked';
                                else
                                    $checked = '';
                                ?>
                            <input style="display: inline" type="radio" id="back-type-<?php echo $type; ?>" name="type" value="<?php echo $type; ?>" <?php echo $checked; ?>/><label style="font-weight: normal;display: inline; margin: 0; cursor: pointer" for="back-type-<?php echo $type; ?>"><?php echo $type; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="input">

                        <label for="breadcrumbs">Show breadcrumbs</label>
                        <input style="margin-left: 74px;" type="checkbox" name="breadcrumbs" <?php if ( get_option('breadcrumbs', '') && get_option('breadcrumbs', '') == "on" ) { echo "checked"; } ?> />

                    </div>

                    <div class="input">

                        <label for="rtl">Right-To-Left (RTL)</label>
                        <input style="margin-left: 74px;" type="checkbox" name="rtl" <?php if ( get_option('rtl', '') && get_option('rtl', '') == "on" ) { echo "checked"; } ?> />

                    </div>

                    <div class="input">

                        <label for="cart">Hide cart in header</label>
                        <input style="margin-left: 74px;" type="checkbox" name="cart" <?php if ( get_option('cart', '') && get_option('cart', '') == "on" ) { echo "checked"; } ?> />

                    </div>

                    <hr />
                    <h3>First page slider options:</h3>

                    <div class="input">

                        <label for="slider">Shortcode</label>

                        <input type="text" name="slider" value="<?php echo get_option('slider', '') ?>" />

                    </div>
                    <hr />

                    <h3>Shop page:</h3>

                    <div class="input">

                        <label for="shop_hover">Show view full image on product hover</label>
                        <input style="margin-left: 74px;" type="checkbox" name="shop_hover" <?php if ( get_option('shop_hover', '') && get_option('shop_hover', '') == "on" ) { echo "checked"; } ?> />

                    </div>

                    <div class="input">

                        <label for="shop_num">Number of products per page</label>
                        <input style="margin-left: 74px;" type="text" name="shop_num" value="<?php echo get_option('shop_num', ''); ?>" />

                    </div>

                    <div class="input">

                        <label for="cat_layout_chk">Category uses same layout as shop</label>
                        <input id="chk_cat_sidebars" style="margin-left: 74px;" type="checkbox" name="cat_layout_chk" <?php if ( get_option('cat_layout_chk', '') && get_option('cat_layout_chk', '') == "on" ) { echo "checked"; } ?> />

                    </div>

                    <div class="input cat_sidebars" <?php if ( get_option('cat_layout_chk', '') && get_option('cat_layout_chk', '') == "on" ) { } else { echo 'style="display: none"'; } ?>>
                    <?php 

                        global $wp_registered_sidebars;

                        $cat_layout_left = get_option('cat_layout_left', '');
                        $cat_layout_right = get_option('cat_layout_right', '');

                        for($i=0;$i<1;$i++){ ?>

                            <label for="cat_layout_left">Left sidebar:</label> 
                            <select name="cat_layout_left">
                                <option value="0"<?php if($cat_layout_left == ''){ echo " selected";} ?>>None</option>
                            <?php
                            $sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
                            if(is_array($sidebars) && !empty($sidebars)){
                                foreach($sidebars as $sidebar){
                                    if($cat_layout_left == $sidebar['name']){
                                        echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
                                    }else{
                                        echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
                                    }
                                }
                            }
                            ?>
                            </select>

                            <label for="cat_layout_right">Right sidebar:</label> 
                            <select name="cat_layout_right">
                                <option value="0"<?php if($cat_layout_right == ''){ echo " selected";} ?>>None</option>
                            <?php
                            
                            $sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
                            if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
                                foreach($sidebar_replacements as $sidebar){
                                    if($cat_layout_right == $sidebar['name']){
                                        echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
                                    }else{
                                        echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
                                    }
                                }
                            }
                            ?>
                            </select> 
                            
                            
                        <?php } ?>

                    </div>

                    <div class="input">

                        <label for="shop_dec_len">Description length</label>
                        <input style="margin-left: 74px;" type="text" name="shop_dec_len" value="<?php echo get_option('shop_dec_len', '180'); ?>" />

                    </div>

                    <hr>

                    <h3>Single product page:</h3>

                    <p>Only one sidebar can be selected at a time.</p>

                    <div>
                    <?php 

                        global $wp_registered_sidebars;

                        $single_product_left = get_option('single_product_left', '');
                        $single_product_right = get_option('single_product_right', '');

                        for($i=0;$i<1;$i++){ ?>

                            <label for="single_product_left">Left sidebar:</label> 
                            <select name="single_product_left">
                                <option value="0"<?php if($single_product_left == ''){ echo " selected";} ?>>None</option>
                            <?php
                            $sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
                            if(is_array($sidebars) && !empty($sidebars)){
                                foreach($sidebars as $sidebar){
                                    if($single_product_left == $sidebar['name']){
                                        echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
                                    }else{
                                        echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
                                    }
                                }
                            }
                            ?>
                            </select>

                            <label for="single_product_right">Right sidebar:</label> 
                            <select name="single_product_right">
                                <option value="0"<?php if($single_product_right == ''){ echo " selected";} ?>>None</option>
                            <?php
                            
                            $sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
                            if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
                                foreach($sidebar_replacements as $sidebar){
                                    if($single_product_right == $sidebar['name']){
                                        echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
                                    }else{
                                        echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
                                    }
                                }
                            }
                            ?>
                            </select> 
                            
                            
                        <?php } ?>

                    </div>

                    <hr />
                    <h3>Social accounts:</h3>

                    <p>Here you can set up all of your social accounts, which will appear in the footer of the page. You do not need to include all of them.</p>
                    <div class="input">

                        <label for="email">Email</label>

                        <input type="text" name="email" value="<?php echo $info_data[0]->email; ?>" />

                    </div>

                    <div class="input">

                        <label for="google_analytics">Google analytics</label>

                        <input type="text" name="google_analytics" value="<?php echo $info_data[0]->google_analytics; ?>" />

                    </div>

                    <div class="input">

                        <label for="facebook">Facebook</label>

                        <input type="text" name="facebook" value="<?php echo $info_data[0]->facebook; ?>" />

                    </div>

                    <div class="input">

                        <label for="google">Google</label>

                        <input type="text" name="google" value="<?php echo $info_data[0]->google; ?>" />

                    </div>

                    <div class="input">

                        <label for="twitter">Twitter</label>

                        <input type="text" name="twitter" value="<?php echo $info_data[0]->twitter; ?>" />

                    </div>

                    <div class="input">

                        <label for="linkedin">LinkedIn</label>

                        <input type="text" name="linkedin" value="<?php echo $info_data[0]->linkedin; ?>" />

                    </div>

                    <div class="input">

                        <label for="vimeo">Vimeo</label>

                        <input type="text" name="vimeo" value="<?php echo $info_data[0]->vimeo; ?>" />

                    </div>

                    <div class="input">

                        <label for="youtube">Youtube</label>

                        <input type="text" name="youtube" value="<?php echo $info_data[0]->youtube; ?>" />

                    </div>

                    <div class="input">

                        <label for="flickr">Flickr</label>

                        <input type="text" name="flickr" value="<?php echo $info_data[0]->flickr; ?>" />

                    </div>

                    <hr />

                    <h3>Favicon and logo:</h3>

                    <div class="input">

                        <label for="favicon">Favicon</label>

                        <div class="preview"><img src="<?php echo $media_data[0]->url; ?>"></div>

                        <input id="favicon" type="text" size="36" name="favicon" value="<?php echo $media_data[0]->url; ?>" />

                        <input id="_btn" class="upload_image_button" type="button" value="Upload" />

                        <p>Enter an URL or upload an image for the favicon.</p>

                    </div>

                    <div class="input">

                        <label for="logo">Logo</label>

                        <div class="preview"><img src="<?php echo $media_data[1]->url; ?>"></div>

                        <input id="logo" type="text" size="36" name="logo" value="<?php echo $media_data[1]->url; ?>" />

                        <input id="_btn" class="upload_image_button" type="button" value="Upload" />

                        <p>Enter an URL or upload an image for the logo.</p>

                    </div>



                    <hr />

                    <h3>Page setup:</h3>

                    <div class="input">

                        <label for="error_page">404 error page</label>

                        <select name="error_page">

                            <option value="0">*** Select ***</option>

        <?php
        $pages = get_pages();

        foreach ($pages as $item) : 

            if ($error_data[0] == $item->ID) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 

        <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="input">

                        <label for="front_page">Front page</label>

                        <select name="front_page">

                            <option value="0">*** Select ***</option>

        <?php
        $pages = get_pages();

        foreach ($pages as $item) :

            if (get_option('page_on_front') == $item->ID) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 

        <?php endforeach; ?>

                        </select>

                    </div>
                    <br /><br />
                    <div class="input">

                        <label for="blog_page">Blog page</label>

                        <select name="blog_page">

                            <option value="0">*** Select ***</option>

                            <?php
                            foreach ($pages as $item) :

                                if ($blog_data[0] == $item->ID) {

                                    $selected = 'selected="selected"';
                                } else {

                                    $selected = '';
                                }
                                ?>

                                <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="input"> 

                        <label for="blog_type">Blog layout</label>

        <?php $pag_type = array('Sidebar layout', 'Full view', '1 column', '2 column', '3 column', '4 column'); ?>

                        <select name="blog_type">

        <?php
        foreach ($pag_type as $item) :

            if ($blog_data[1] == $item) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="input" style="display: none"> 

                        <label for="single_blog_type">Single blog page layout</label>

        <?php $pag_type = array('Sidebar layout', 'Full view', '2 column', '3 column', '4 column'); ?>

                        <select name="single_blog_type">

        <?php
        foreach ($pag_type as $item) :

            if ($blog_data[2] == $item) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>

                            <?php endforeach; ?>

                        </select>

                    </div> 
                    <br /><br />
                    <div class="input">

                        <label for="portfolio_page">Portfolio page</label>

                        <select name="portfolio_page">

                            <option value="0">*** Select ***</option>

        <?php
        foreach ($pages as $item) :

            if ($portfolio_data[0] == $item->ID) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="input"> 

                        <label for="pagination_type">Number of columns</label>

                            <?php $pag_type = array('2 column', '3 column', '4 column'); ?>

                        <select name="pagination_type">

        <?php
        foreach ($pag_type as $item) :

            if ($portfolio_data[1] == $item) {

                $selected = 'selected="selected"';
            } else {

                $selected = '';
            }
            ?>

                                <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>

                            <?php endforeach; ?>

                        </select>

                    </div>
                            <?php 
                            if ( isset($portfolio_data[3]) && $portfolio_data[3] == 'on')
                                $checked = 'checked';
                            else
                                $checked = '';
                            ?>
                    <div class="input"> 
                        <label for="filter_pag">Filter</label>
                        <input style="margin-left: 74px;" type="checkbox" name="filter_pag" <?php echo $checked; ?> />
                    </div>

                    <div class="input"> <?php if (!isset($portfolio_data[2])) $portfolio_data[2] = ''; ?>

                        <label for="limit_items">Limit items</label>

                        <input type="text" name="limit_items" value="<?php echo $portfolio_data[2]; ?>"/>

                    </div>


                    <div class="input">
                    <label for="faq_page">Faq page</label>

                    <select name="faq_page">

                        <option value="0">*** Select ***</option>

                            <?php
                            foreach ($pages as $item) :

                                if (get_option("faq_page") == $item->ID) {

                                    $selected = 'selected="selected"';
                                } else {

                                    $selected = '';
                                }
                                ?>

                                <option value="<?php echo $item->ID; ?>" <?php echo $selected; ?>><?php echo $item->post_title; ?></option> 

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <hr />
                    <h3>Copyright footer:</h3>
                    <div class="input">

                        <label for="copyright">Copyright</label>

                        <input type="text" name="copyright" value="<?php echo $info_data[0]->copyright; ?>" />

                    </div>
                    
                    <div class="input">

                        <label for="copyright_on">Copyright footer</label>
                        <?php $options = array('on', 'off'); ?>
                        <select name="copyright_on">
                            <?php foreach ($options as $item) :

                                if ($info_data[0]->copyright_on == $item) {

                                    $selected = 'selected="selected"';
                                } else {

                                    $selected = '';
                                }
                                ?>

                                <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>

                            <?php endforeach; ?>
                        </select>

                    </div>

                    <hr />

                    <h3>Top menu setup:</h3>

                    <div class="input">

                        <label for="top_menu">Top menu</label>
                        <?php $options = array('on', 'off', 'always open'); ?>
                        <select name="top_menu">
                            <?php foreach ($options as $item) :

                                if ($info_data[0]->top_menu == $item) {

                                    $selected = 'selected="selected"';
                                } else {

                                    $selected = '';
                                }
                                ?>

                                <option value="<?php echo $item; ?>" <?php echo $selected; ?>><?php echo $item; ?></option>

                            <?php endforeach; ?>
                        </select>

                    </div>

                    <div class="input">

                        <label for="top_menu_label">Top menu label</label>

                        <input type="text" name="top_menu_label" value="<?php echo $info_data[0]->top_menu_label; ?>" />

                    </div>
                    
                    <div class="input">

                        <label for="top_menu_input">Top menu input text</label>

                        <input type="text" name="top_menu_input" value="<?php echo $info_data[0]->top_menu_input; ?>" />

                    </div>
                    
                </div>

                <input type="submit" value="Save all changes" />

            </div>

        </form>

        <?php
        wp_enqueue_script('media-upload');

        wp_enqueue_script('thickbox');

        wp_register_script('my-upload', get_template_directory_uri() . '/slider.js', array('jquery', 'media-upload', 'thickbox'));

        wp_enqueue_script('my-upload');

        wp_enqueue_style('thickbox');
    }

    public function style() {
        
        $fonts = array(
                            "Abel" => "Abel",
                            "Abril Fatface" => "Abril Fatface",
                            "Aclonica" => "Aclonica",
                            "Acme" => "Acme",
                            "Actor" => "Actor",
                            "Adamina" => "Adamina",
                            "Advent Pro" => "Advent Pro",
                            "Aguafina Script" => "Aguafina Script",
                            "Aladin" => "Aladin",
                            "Aldrich" => "Aldrich",
                            "Alegreya" => "Alegreya",
                            "Alegreya SC" => "Alegreya SC",
                            "Alex Brush" => "Alex Brush",
                            "Alfa Slab One" => "Alfa Slab One",
                            "Alice" => "Alice",
                            "Alike" => "Alike",
                            "Alike Angular" => "Alike Angular",
                            "Allan" => "Allan",
                            "Allerta" => "Allerta",
                            "Allerta Stencil" => "Allerta Stencil",
                            "Allura" => "Allura",
                            "Almendra" => "Almendra",
                            "Almendra SC" => "Almendra SC",
                            "Amaranth" => "Amaranth",
                            "Amatic SC" => "Amatic SC",
                            "Amethysta" => "Amethysta",
                            "Andada" => "Andada",
                            "Andika" => "Andika",
                            "Angkor" => "Angkor",
                            "Annie Use Your Telescope" => "Annie Use Your Telescope",
                            "Anonymous Pro" => "Anonymous Pro",
                            "Antic" => "Antic",
                            "Antic Didone" => "Antic Didone",
                            "Antic Slab" => "Antic Slab",
                            "Anton" => "Anton",
                            "Arapey" => "Arapey",
                            "Arbutus" => "Arbutus",
                            "Architects Daughter" => "Architects Daughter",
                            "Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
                            "Arimo" => "Arimo",
                            "Arizonia" => "Arizonia",
                            "Armata" => "Armata",
                            "Artifika" => "Artifika",
                            "Arvo" => "Arvo",
                            "Asap" => "Asap",
                            "Asset" => "Asset",
                            "Astloch" => "Astloch",
                            "Asul" => "Asul",
                            "Atomic Age" => "Atomic Age",
                            "Aubrey" => "Aubrey",
                            "Audiowide" => "Audiowide",
                            "Average" => "Average",
                            "Averia Gruesa Libre" => "Averia Gruesa Libre",
                            "Averia Libre" => "Averia Libre",
                            "Averia Sans Libre" => "Averia Sans Libre",
                            "Averia Serif Libre" => "Averia Serif Libre",
                            "Bad Script" => "Bad Script",
                            "Balthazar" => "Balthazar",
                            "Bangers" => "Bangers",
                            "Basic" => "Basic",
                            "Battambang" => "Battambang",
                            "Baumans" => "Baumans",
                            "Bayon" => "Bayon",
                            "Belgrano" => "Belgrano",
                            "Belleza" => "Belleza",
                            "Bentham" => "Bentham",
                            "Berkshire Swash" => "Berkshire Swash",
                            "Bevan" => "Bevan",
                            "Bigshot One" => "Bigshot One",
                            "Bilbo" => "Bilbo",
                            "Bilbo Swash Caps" => "Bilbo Swash Caps",
                            "Bitter" => "Bitter",
                            "Black Ops One" => "Black Ops One",
                            "Bokor" => "Bokor",
                            "Bonbon" => "Bonbon",
                            "Boogaloo" => "Boogaloo",
                            "Bowlby One" => "Bowlby One",
                            "Bowlby One SC" => "Bowlby One SC",
                            "Brawler" => "Brawler",
                            "Bree Serif" => "Bree Serif",
                            "Bubblegum Sans" => "Bubblegum Sans",
                            "Buda" => "Buda",
                            "Buenard" => "Buenard",
                            "Butcherman" => "Butcherman",
                            "Butterfly Kids" => "Butterfly Kids",
                            "Cabin" => "Cabin",
                            "Cabin Condensed" => "Cabin Condensed",
                            "Cabin Sketch" => "Cabin Sketch",
                            "Caesar Dressing" => "Caesar Dressing",
                            "Cagliostro" => "Cagliostro",
                            "Calligraffitti" => "Calligraffitti",
                            "Cambo" => "Cambo",
                            "Candal" => "Candal",
                            "Cantarell" => "Cantarell",
                            "Cantata One" => "Cantata One",
                            "Cardo" => "Cardo",
                            "Carme" => "Carme",
                            "Carter One" => "Carter One",
                            "Caudex" => "Caudex",
                            "Cedarville Cursive" => "Cedarville Cursive",
                            "Ceviche One" => "Ceviche One",
                            "Changa One" => "Changa One",
                            "Chango" => "Chango",
                            "Chau Philomene One" => "Chau Philomene One",
                            "Chelsea Market" => "Chelsea Market",
                            "Chenla" => "Chenla",
                            "Cherry Cream Soda" => "Cherry Cream Soda",
                            "Chewy" => "Chewy",
                            "Chicle" => "Chicle",
                            "Chivo" => "Chivo",
                            "Coda" => "Coda",
                            "Coda Caption" => "Coda Caption",
                            "Codystar" => "Codystar",
                            "Comfortaa" => "Comfortaa",
                            "Coming Soon" => "Coming Soon",
                            "Concert One" => "Concert One",
                            "Condiment" => "Condiment",
                            "Content" => "Content",
                            "Contrail One" => "Contrail One",
                            "Convergence" => "Convergence",
                            "Cookie" => "Cookie",
                            "Copse" => "Copse",
                            "Corben" => "Corben",
                            "Cousine" => "Cousine",
                            "Coustard" => "Coustard",
                            "Covered By Your Grace" => "Covered By Your Grace",
                            "Crafty Girls" => "Crafty Girls",
                            "Creepster" => "Creepster",
                            "Crete Round" => "Crete Round",
                            "Crimson Text" => "Crimson Text",
                            "Crushed" => "Crushed",
                            "Cuprum" => "Cuprum",
                            "Cutive" => "Cutive",
                            "Damion" => "Damion",
                            "Dancing Script" => "Dancing Script",
                            "Dangrek" => "Dangrek",
                            "Dawning of a New Day" => "Dawning of a New Day",
                            "Days One" => "Days One",
                            "Delius" => "Delius",
                            "Delius Swash Caps" => "Delius Swash Caps",
                            "Delius Unicase" => "Delius Unicase",
                            "Della Respira" => "Della Respira",
                            "Devonshire" => "Devonshire",
                            "Didact Gothic" => "Didact Gothic",
                            "Diplomata" => "Diplomata",
                            "Diplomata SC" => "Diplomata SC",
                            "Doppio One" => "Doppio One",
                            "Dorsa" => "Dorsa",
                            "Dosis" => "Dosis",
                            "Dr Sugiyama" => "Dr Sugiyama",
                            "Droid Sans" => "Droid Sans",
                            "Droid Sans Mono" => "Droid Sans Mono",
                            "Droid Serif" => "Droid Serif",
                            "Duru Sans" => "Duru Sans",
                            "Dynalight" => "Dynalight",
                            "EB Garamond" => "EB Garamond",
                            "Eater" => "Eater",
                            "Economica" => "Economica",
                            "Electrolize" => "Electrolize",
                            "Emblema One" => "Emblema One",
                            "Emilys Candy" => "Emilys Candy",
                            "Engagement" => "Engagement",
                            "Enriqueta" => "Enriqueta",
                            "Erica One" => "Erica One",
                            "Esteban" => "Esteban",
                            "Euphoria Script" => "Euphoria Script",
                            "Ewert" => "Ewert",
                            "Exo" => "Exo",
                            "Expletus Sans" => "Expletus Sans",
                            "Fanwood Text" => "Fanwood Text",
                            "Fascinate" => "Fascinate",
                            "Fascinate Inline" => "Fascinate Inline",
                            "Federant" => "Federant",
                            "Federo" => "Federo",
                            "Felipa" => "Felipa",
                            "Fjord One" => "Fjord One",
                            "Flamenco" => "Flamenco",
                            "Flavors" => "Flavors",
                            "Fondamento" => "Fondamento",
                            "Fontdiner Swanky" => "Fontdiner Swanky",
                            "Forum" => "Forum",
                            "Francois One" => "Francois One",
                            "Fredericka the Great" => "Fredericka the Great",
                            "Fredoka One" => "Fredoka One",
                            "Freehand" => "Freehand",
                            "Fresca" => "Fresca",
                            "Frijole" => "Frijole",
                            "Fugaz One" => "Fugaz One",
                            "GFS Didot" => "GFS Didot",
                            "GFS Neohellenic" => "GFS Neohellenic",
                            "Galdeano" => "Galdeano",
                            "Gentium Basic" => "Gentium Basic",
                            "Gentium Book Basic" => "Gentium Book Basic",
                            "Geo" => "Geo",
                            "Geostar" => "Geostar",
                            "Geostar Fill" => "Geostar Fill",
                            "Germania One" => "Germania One",
                            "Give You Glory" => "Give You Glory",
                            "Glass Antiqua" => "Glass Antiqua",
                            "Glegoo" => "Glegoo",
                            "Gloria Hallelujah" => "Gloria Hallelujah",
                            "Goblin One" => "Goblin One",
                            "Gochi Hand" => "Gochi Hand",
                            "Gorditas" => "Gorditas",
                            "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
                            "Graduate" => "Graduate",
                            "Gravitas One" => "Gravitas One",
                            "Great Vibes" => "Great Vibes",
                            "Gruppo" => "Gruppo",
                            "Gudea" => "Gudea",
                            "Habibi" => "Habibi",
                            "Hammersmith One" => "Hammersmith One",
                            "Handlee" => "Handlee",
                            "Hanuman" => "Hanuman",
                            "Happy Monkey" => "Happy Monkey",
                            "Henny Penny" => "Henny Penny",
                            "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
                            "Holtwood One SC" => "Holtwood One SC",
                            "Homemade Apple" => "Homemade Apple",
                            "Homenaje" => "Homenaje",
                            "IM Fell DW Pica" => "IM Fell DW Pica",
                            "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
                            "IM Fell Double Pica" => "IM Fell Double Pica",
                            "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
                            "IM Fell English" => "IM Fell English",
                            "IM Fell English SC" => "IM Fell English SC",
                            "IM Fell French Canon" => "IM Fell French Canon",
                            "IM Fell French Canon SC" => "IM Fell French Canon SC",
                            "IM Fell Great Primer" => "IM Fell Great Primer",
                            "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
                            "Iceberg" => "Iceberg",
                            "Iceland" => "Iceland",
                            "Imprima" => "Imprima",
                            "Inconsolata" => "Inconsolata",
                            "Inder" => "Inder",
                            "Indie Flower" => "Indie Flower",
                            "Inika" => "Inika",
                            "Irish Grover" => "Irish Grover",
                            "Istok Web" => "Istok Web",
                            "Italiana" => "Italiana",
                            "Italianno" => "Italianno",
                            "Jim Nightshade" => "Jim Nightshade",
                            "Jockey One" => "Jockey One",
                            "Jolly Lodger" => "Jolly Lodger",
                            "Josefin Sans" => "Josefin Sans",
                            "Josefin Slab" => "Josefin Slab",
                            "Judson" => "Judson",
                            "Julee" => "Julee",
                            "Junge" => "Junge",
                            "Jura" => "Jura",
                            "Just Another Hand" => "Just Another Hand",
                            "Just Me Again Down Here" => "Just Me Again Down Here",
                            "Kameron" => "Kameron",
                            "Karla" => "Karla",
                            "Kaushan Script" => "Kaushan Script",
                            "Kelly Slab" => "Kelly Slab",
                            "Kenia" => "Kenia",
                            "Khmer" => "Khmer",
                            "Knewave" => "Knewave",
                            "Kotta One" => "Kotta One",
                            "Koulen" => "Koulen",
                            "Kranky" => "Kranky",
                            "Kreon" => "Kreon",
                            "Kristi" => "Kristi",
                            "Krona One" => "Krona One",
                            "La Belle Aurore" => "La Belle Aurore",
                            "Lancelot" => "Lancelot",
                            "Lato" => "Lato",
                            "League Script" => "League Script",
                            "Leckerli One" => "Leckerli One",
                            "Ledger" => "Ledger",
                            "Lekton" => "Lekton",
                            "Lemon" => "Lemon",
                            "Lilita One" => "Lilita One",
                            "Limelight" => "Limelight",
                            "Linden Hill" => "Linden Hill",
                            "Lobster" => "Lobster",
                            "Lobster Two" => "Lobster Two",
                            "Londrina Outline" => "Londrina Outline",
                            "Londrina Shadow" => "Londrina Shadow",
                            "Londrina Sketch" => "Londrina Sketch",
                            "Londrina Solid" => "Londrina Solid",
                            "Lora" => "Lora",
                            "Love Ya Like A Sister" => "Love Ya Like A Sister",
                            "Loved by the King" => "Loved by the King",
                            "Lovers Quarrel" => "Lovers Quarrel",
                            "Luckiest Guy" => "Luckiest Guy",
                            "Lusitana" => "Lusitana",
                            "Lustria" => "Lustria",
                            "Macondo" => "Macondo",
                            "Macondo Swash Caps" => "Macondo Swash Caps",
                            "Magra" => "Magra",
                            "Maiden Orange" => "Maiden Orange",
                            "Mako" => "Mako",
                            "Marck Script" => "Marck Script",
                            "Marko One" => "Marko One",
                            "Marmelad" => "Marmelad",
                            "Marvel" => "Marvel",
                            "Mate" => "Mate",
                            "Mate SC" => "Mate SC",
                            "Maven Pro" => "Maven Pro",
                            "Meddon" => "Meddon",
                            "MedievalSharp" => "MedievalSharp",
                            "Medula One" => "Medula One",
                            "Megrim" => "Megrim",
                            "Merienda One" => "Merienda One",
                            "Merriweather" => "Merriweather",
                            "Metal" => "Metal",
                            "Metamorphous" => "Metamorphous",
                            "Metrophobic" => "Metrophobic",
                            "Michroma" => "Michroma",
                            "Miltonian" => "Miltonian",
                            "Miltonian Tattoo" => "Miltonian Tattoo",
                            "Miniver" => "Miniver",
                            "Miss Fajardose" => "Miss Fajardose",
                            "Modern Antiqua" => "Modern Antiqua",
                            "Molengo" => "Molengo",
                            "Monofett" => "Monofett",
                            "Monoton" => "Monoton",
                            "Monsieur La Doulaise" => "Monsieur La Doulaise",
                            "Montaga" => "Montaga",
                            "Montez" => "Montez",
                            "Montserrat" => "Montserrat",
                            "Moul" => "Moul",
                            "Moulpali" => "Moulpali",
                            "Mountains of Christmas" => "Mountains of Christmas",
                            "Mr Bedfort" => "Mr Bedfort",
                            "Mr Dafoe" => "Mr Dafoe",
                            "Mr De Haviland" => "Mr De Haviland",
                            "Mrs Saint Delafield" => "Mrs Saint Delafield",
                            "Mrs Sheppards" => "Mrs Sheppards",
                            "Muli" => "Muli",
                            "Mystery Quest" => "Mystery Quest",
                            "Neucha" => "Neucha",
                            "Neuton" => "Neuton",
                            "News Cycle" => "News Cycle",
                            "Niconne" => "Niconne",
                            "Nixie One" => "Nixie One",
                            "Nobile" => "Nobile",
                            "Nokora" => "Nokora",
                            "Norican" => "Norican",
                            "Nosifer" => "Nosifer",
                            "Nothing You Could Do" => "Nothing You Could Do",
                            "Noticia Text" => "Noticia Text",
                            "Nova Cut" => "Nova Cut",
                            "Nova Flat" => "Nova Flat",
                            "Nova Mono" => "Nova Mono",
                            "Nova Oval" => "Nova Oval",
                            "Nova Round" => "Nova Round",
                            "Nova Script" => "Nova Script",
                            "Nova Slim" => "Nova Slim",
                            "Nova Square" => "Nova Square",
                            "Numans" => "Numans",
                            "Nunito" => "Nunito",
                            "Odor Mean Chey" => "Odor Mean Chey",
                            "Old Standard TT" => "Old Standard TT",
                            "Oldenburg" => "Oldenburg",
                            "Oleo Script" => "Oleo Script",
                            "Open Sans" => "Open Sans",
                            "Open Sans Condensed" => "Open Sans Condensed",
                            "Orbitron" => "Orbitron",
                            "Original Surfer" => "Original Surfer",
                            "Oswald" => "Oswald",
                            "Over the Rainbow" => "Over the Rainbow",
                            "Overlock" => "Overlock",
                            "Overlock SC" => "Overlock SC",
                            "Ovo" => "Ovo",
                            "Oxygen" => "Oxygen",
                            "PT Mono" => "PT Mono",
                            "PT Sans" => "PT Sans",
                            "PT Sans Caption" => "PT Sans Caption",
                            "PT Sans Narrow" => "PT Sans Narrow",
                            "PT Serif" => "PT Serif",
                            "PT Serif Caption" => "PT Serif Caption",
                            "Pacifico" => "Pacifico",
                            "Parisienne" => "Parisienne",
                            "Passero One" => "Passero One",
                            "Passion One" => "Passion One",
                            "Patrick Hand" => "Patrick Hand",
                            "Patua One" => "Patua One",
                            "Paytone One" => "Paytone One",
                            "Permanent Marker" => "Permanent Marker",
                            "Petrona" => "Petrona",
                            "Philosopher" => "Philosopher",
                            "Piedra" => "Piedra",
                            "Pinyon Script" => "Pinyon Script",
                            "Plaster" => "Plaster",
                            "Play" => "Play",
                            "Playball" => "Playball",
                            "Playfair Display" => "Playfair Display",
                            "Podkova" => "Podkova",
                            "Poiret One" => "Poiret One",
                            "Poller One" => "Poller One",
                            "Poly" => "Poly",
                            "Pompiere" => "Pompiere",
                            "Pontano Sans" => "Pontano Sans",
                            "Port Lligat Sans" => "Port Lligat Sans",
                            "Port Lligat Slab" => "Port Lligat Slab",
                            "Prata" => "Prata",
                            "Preahvihear" => "Preahvihear",
                            "Press Start 2P" => "Press Start 2P",
                            "Princess Sofia" => "Princess Sofia",
                            "Prociono" => "Prociono",
                            "Prosto One" => "Prosto One",
                            "Puritan" => "Puritan",
                            "Quantico" => "Quantico",
                            "Quattrocento" => "Quattrocento",
                            "Quattrocento Sans" => "Quattrocento Sans",
                            "Questrial" => "Questrial",
                            "Quicksand" => "Quicksand",
                            "Qwigley" => "Qwigley",
                            "Radley" => "Radley",
                            "Raleway" => "Raleway",
                            "Rammetto One" => "Rammetto One",
                            "Rancho" => "Rancho",
                            "Rationale" => "Rationale",
                            "Redressed" => "Redressed",
                            "Reenie Beanie" => "Reenie Beanie",
                            "Revalia" => "Revalia",
                            "Ribeye" => "Ribeye",
                            "Ribeye Marrow" => "Ribeye Marrow",
                            "Righteous" => "Righteous",
                            "Rochester" => "Rochester",
                            "Rock Salt" => "Rock Salt",
                            "Rokkitt" => "Rokkitt",
                            "Ropa Sans" => "Ropa Sans",
                            "Rosario" => "Rosario",
                            "Rosarivo" => "Rosarivo",
                            "Rouge Script" => "Rouge Script",
                            "Ruda" => "Ruda",
                            "Ruge Boogie" => "Ruge Boogie",
                            "Ruluko" => "Ruluko",
                            "Ruslan Display" => "Ruslan Display",
                            "Russo One" => "Russo One",
                            "Ruthie" => "Ruthie",
                            "Sail" => "Sail",
                            "Salsa" => "Salsa",
                            "Sancreek" => "Sancreek",
                            "Sansita One" => "Sansita One",
                            "Sarina" => "Sarina",
                            "Satisfy" => "Satisfy",
                            "Schoolbell" => "Schoolbell",
                            "Seaweed Script" => "Seaweed Script",
                            "Sevillana" => "Sevillana",
                            "Shadows Into Light" => "Shadows Into Light",
                            "Shadows Into Light Two" => "Shadows Into Light Two",
                            "Shanti" => "Shanti",
                            "Share" => "Share",
                            "Shojumaru" => "Shojumaru",
                            "Short Stack" => "Short Stack",
                            "Siemreap" => "Siemreap",
                            "Sigmar One" => "Sigmar One",
                            "Signika" => "Signika",
                            "Signika Negative" => "Signika Negative",
                            "Simonetta" => "Simonetta",
                            "Sirin Stencil" => "Sirin Stencil",
                            "Six Caps" => "Six Caps",
                            "Slackey" => "Slackey",
                            "Smokum" => "Smokum",
                            "Smythe" => "Smythe",
                            "Sniglet" => "Sniglet",
                            "Snippet" => "Snippet",
                            "Sofia" => "Sofia",
                            "Sonsie One" => "Sonsie One",
                            "Sorts Mill Goudy" => "Sorts Mill Goudy",
                            "Special Elite" => "Special Elite",
                            "Spicy Rice" => "Spicy Rice",
                            "Spinnaker" => "Spinnaker",
                            "Spirax" => "Spirax",
                            "Squada One" => "Squada One",
                            "Stardos Stencil" => "Stardos Stencil",
                            "Stint Ultra Condensed" => "Stint Ultra Condensed",
                            "Stint Ultra Expanded" => "Stint Ultra Expanded",
                            "Stoke" => "Stoke",
                            "Sue Ellen Francisco" => "Sue Ellen Francisco",
                            "Sunshiney" => "Sunshiney",
                            "Supermercado One" => "Supermercado One",
                            "Suwannaphum" => "Suwannaphum",
                            "Swanky and Moo Moo" => "Swanky and Moo Moo",
                            "Syncopate" => "Syncopate",
                            "Tangerine" => "Tangerine",
                            "Taprom" => "Taprom",
                            "Telex" => "Telex",
                            "Tenor Sans" => "Tenor Sans",
                            "The Girl Next Door" => "The Girl Next Door",
                            "Tienne" => "Tienne",
                            "Tinos" => "Tinos",
                            "Titan One" => "Titan One",
                            "Trade Winds" => "Trade Winds",
                            "Trocchi" => "Trocchi",
                            "Trochut" => "Trochut",
                            "Trykker" => "Trykker",
                            "Tulpen One" => "Tulpen One",
                            "Ubuntu" => "Ubuntu",
                            "Ubuntu Condensed" => "Ubuntu Condensed",
                            "Ubuntu Mono" => "Ubuntu Mono",
                            "Ultra" => "Ultra",
                            "Uncial Antiqua" => "Uncial Antiqua",
                            "UnifrakturCook" => "UnifrakturCook",
                            "UnifrakturMaguntia" => "UnifrakturMaguntia",
                            "Unkempt" => "Unkempt",
                            "Unlock" => "Unlock",
                            "Unna" => "Unna",
                            "VT323" => "VT323",
                            "Varela" => "Varela",
                            "Varela Round" => "Varela Round",
                            "Vast Shadow" => "Vast Shadow",
                            "Vibur" => "Vibur",
                            "Vidaloka" => "Vidaloka",
                            "Viga" => "Viga",
                            "Voces" => "Voces",
                            "Volkhov" => "Volkhov",
                            "Vollkorn" => "Vollkorn",
                            "Voltaire" => "Voltaire",
                            "Waiting for the Sunrise" => "Waiting for the Sunrise",
                            "Wallpoet" => "Wallpoet",
                            "Walter Turncoat" => "Walter Turncoat",
                            "Wellfleet" => "Wellfleet",
                            "Wire One" => "Wire One",
                            "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
                            "Yellowtail" => "Yellowtail",
                            "Yeseva One" => "Yeseva One",
                            "Yesteryear" => "Yesteryear",
                            "Zeyada" => "Zeyada",
                        );
        
        if (isset($_GET['save_style']))
            $this->style_save();

        ?><div class="content">

            <form action="themes.php?page=theme_options&save_style" method="post">

                <div class="content-top"><input type="submit" value="Save all changes" /><div class="clear"></div></div>
                
                
                <div class="content-inner">
                    
                    <h3>Font family</h3>
                    
                    <div class="input">
                        <label for="font_type_1">Font type 1</label>
                        <select name="font_type_1" id="font_type_1">
                            <?php foreach($fonts as $font) : 
                                if($font==get_option('font_type_1', 'Arial, Helvetica, sans-serif'))
                                    $selected = 'selected="selected"';
                                else
                                    $selected = '';
                                ?>
                                <option value="<?php echo $font; ?>" <?php echo $selected; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input">
                        <label for="font_type_2">Font type 2</label>
                        <select name="font_type_2" id="font_type_2">
                            <?php foreach($fonts as $font) : 
                                if($font==get_option('font_type_2', 'Open Sans'))
                                    $selected = 'selected="selected"';
                                else
                                    $selected = '';
                                ?>
                                <option value="<?php echo $font; ?>" <?php echo $selected; ?>><?php echo $font; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
 
                    <br /><hr /><br />

                    <h3>Heading sizes</h3>

                    <div class="input">
                        <label for="heading1">Heading 1</label>
                        <input style="width: 40px; text-align: center" type="text" name="heading1" value="<?php echo get_option('heading1', '30'); ?>" id="heading1" />&nbsp; px
                    </div>
  
                    <div class="input">
                        <label for="heading2">Heading 2</label>
                        <input style="width: 40px; text-align: center" type="text" name="heading2" value="<?php echo get_option('heading2', '24'); ?>" id="heading2" />&nbsp; px
                    </div>

                    <div class="input">
                        <label for="heading3">Heading 3</label>
                        <input style="width: 40px; text-align: center" type="text" name="heading3" value="<?php echo get_option('heading3', '20'); ?>" id="heading3" />&nbsp; px
                    </div>

                    <div class="input">
                        <label for="heading4">Heading 4</label>
                        <input style="width: 40px; text-align: center" type="text" name="heading4" value="<?php echo get_option('heading4', '14'); ?>" id="heading4" />&nbsp; px
                    </div>

                    <div class="input">
                        <label for="heading5">Heading 5</label>
                        <input style="width: 40px; text-align: center" type="text" name="heading5" value="<?php echo get_option('heading5', '12'); ?>" id="heading5" />&nbsp; px
                    </div>

                    <br /><hr /><br />
                    
                    <h3>Predefined color Scheme</h3>
                    <p>Selecting one of this schemes will import the predefined colors below, which you can then edit as you like.</p>
                    <br /><br />
                    <select name="predefined_colors" id="predefined_colors">
                        <option></option>
                        <option value="cool-blue">Cool blue</option>
                        <option value="orange">Orange</option>
                        <option value="green">Green</option>
                        <option value="whine-red">Whine red</option>
                        <option value="greyish">Greyish</option>
                        <option value="soft-purple">Soft purple</option>
                        <option value="cream">Cream</option>
                        <option value="sky-blue">Sky blue</option>
                        <option value="easy-pink">Easy pink</option>
                        <option value="gentle-green">Gentle green</option>
                    </select>
                    <br /><br /><br /><hr />
                    <h3>Main theme colors</h3>
                    
                    <div class="input">
                        <label for="text_color">Text color</label>
                        <input data-value="<?php echo get_option('text_color', '#727272'); ?>" readonly style="background: <?php echo get_option('text_color', '#727272'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="text_color" value="<?php echo get_option('text_color', '#727272'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="hover_color">Link hover color</label>
                        <input data-value="<?php echo get_option('hover_color', '#92bf00'); ?>" readonly style="background: <?php echo get_option('hover_color', '#92bf00'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="hover_color" value="<?php echo get_option('hover_color', '#92bf00'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="headings_color">Headings color</label>
                        <input data-value="<?php echo get_option('headings_color', '#719400'); ?>" readonly style="background: <?php echo get_option('headings_color', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="headings_color" value="<?php echo get_option('headings_color', '#719400'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="primary_color">Primary color</label>
                        <input data-value="<?php echo get_option('primary_color', '#719400'); ?>" readonly style="background: <?php echo get_option('primary_color', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="primary_color" value="<?php echo get_option('primary_color', '#719400'); ?>" id="text_color" />
                    </div>

                    <br /><hr /><br />
                    <h3>Footer colors</h3>


                    <div class="input">
                        <label for="primary_color">Footer/Top menu text primary color</label>
                        <input data-value="<?php echo get_option('footer_top_primary_color', '#dee8bc'); ?>" readonly style="background: <?php echo get_option('footer_top_primary_color', '#dee8bc'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="footer_top_primary_color" value="<?php echo get_option('footer_top_primary_color', '#dee8bc'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="primary_color">Footer/Top menu text secondary color</label>
                        <input data-value="<?php echo get_option('footer_top_second_color', '#fff'); ?>" readonly style="background: <?php echo get_option('footer_top_second_color', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="footer_top_second_color" value="<?php echo get_option('footer_top_second_color', '#fff'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="primary_color">Copyright footer background color</label>
                        <input data-value="<?php echo get_option('copyright_back_color', '#628000'); ?>" readonly style="background: <?php echo get_option('copyright_back_color', '#628000'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="copyright_back_color" value="<?php echo get_option('copyright_back_color', '#628000'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="primary_color">Copyright footer text color</label>
                        <input data-value="<?php echo get_option('copyright_text_color', '#accf3a'); ?>" readonly style="background: <?php echo get_option('copyright_text_color', '#accf3a'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="copyright_text_color" value="<?php echo get_option('copyright_text_color', '#accf3a'); ?>" id="text_color" />
                    </div>
                    <br /><hr /><br />
                    <h3>Main navigation colors</h3>
                    <div class="input">
                        <label for="menu_text_color">Text color</label>
                        <input data-value="<?php echo get_option('menu_text_color', '#292929'); ?>" readonly style="background: <?php echo get_option('menu_text_color', '#292929'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_text_color" value="<?php echo get_option('menu_text_color', '#292929'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="menu_text_color_hover">Text color hover</label>
                        <input data-value="<?php echo get_option('menu_text_color_hover', '#89b300'); ?>" readonly style="background: <?php echo get_option('menu_text_color_hover', '#89b300'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_text_color_hover" value="<?php echo get_option('menu_text_color_hover', '#89b300'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="menu_text_color_hover">Selected text color</label>
                        <input data-value="<?php echo get_option('menu_text_color_selected', '#719400'); ?>" readonly style="background: <?php echo get_option('menu_text_color_selected', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="menu_text_color_selected" value="<?php echo get_option('menu_text_color_selected', '#719400'); ?>" id="text_color" />
                    </div>

                    <br /><hr /><br />
                    <h3>Portfolio/Blog colors</h3>

                    <div class="input">
                        <label for="portfolio_primary">Portfolio/Blog information primary background</label>
                        <input data-value="<?php echo get_option('portfolio_primary', '#719400'); ?>" readonly style="background: <?php echo get_option('portfolio_primary', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="portfolio_primary" value="<?php echo get_option('portfolio_primary', '#719400'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="portfolio_secondary">Portfolio/Blog information secondary background</label>
                        <input data-value="<?php echo get_option('portfolio_secondary', '#5a7500'); ?>" readonly style="background: <?php echo get_option('portfolio_secondary', '#5a7500'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="portfolio_secondary" value="<?php echo get_option('portfolio_secondary', '#5a7500'); ?>" id="text_color" />
                    </div> 
                    
                    <br /><hr /><br />
                    <h3>Button styles</h3>
                    
                    <div class="input">
                        <label for="style_1_text">Button style 1, text color</label>
                        <input data-value="<?php echo get_option('style_1_text', '#fff'); ?>" readonly style="background: <?php echo get_option('style_1_text', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_1_text" value="<?php echo get_option('style_1_text', '#fff'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="style_1_top">Button style 1, top gradient</label>
                        <input data-value="<?php echo get_option('style_1_top', '#89b300'); ?>" readonly style="background: <?php echo get_option('style_1_top', '#89b300'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_1_top" value="<?php echo get_option('style_1_top', '#89b300'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="style_1_bottom">Button style 1, bottom gradient</label>
                        <input data-value="<?php echo get_option('style_1_bottom', '#719400'); ?>" readonly style="background: <?php echo get_option('style_1_bottom', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_1_bottom" value="<?php echo get_option('style_1_bottom', '#719400'); ?>" id="text_color" />
                    </div>    
                    
                    <br /><br />
                    
                    <div class="input">
                        <label for="style_2_text">Button style 2, text color</label>
                        <input data-value="<?php echo get_option('style_2_text', '#fff'); ?>" readonly style="background: <?php echo get_option('style_2_text', '#fff'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_2_text" value="<?php echo get_option('style_2_text', '#fff'); ?>" id="text_color" />
                    </div>                    
                    <div class="input">
                        <label for="style_2_top">Button style 2, top gradient</label>
                        <input data-value="<?php echo get_option('style_2_top', '#454545'); ?>" readonly style="background: <?php echo get_option('style_2_top', '#454545'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_2_top" value="<?php echo get_option('style_2_top', '#454545'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="style_2_bottom">Button style 2, bottom gradient</label>
                        <input data-value="<?php echo get_option('style_2_bottom', '#252525'); ?>" readonly style="background: <?php echo get_option('style_2_bottom', '#252525'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_2_bottom" value="<?php echo get_option('style_2_bottom', '#252525'); ?>" id="text_color" />
                    </div>  
                    
                    <br /><br />
                    
                    <div class="input">
                        <label for="style_3_text">Button style 3, text color</label>
                        <input data-value="<?php echo get_option('style_3_text', '#696969'); ?>" readonly style="background: <?php echo get_option('style_3_text', '#696969'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_3_text" value="<?php echo get_option('style_3_text', '#696969'); ?>" id="text_color" />
                    </div> 
                    <div class="input">
                        <label for="style_3_top">Button style 3, top gradient</label>
                        <input data-value="<?php echo get_option('style_3_top', '#f0f0f0'); ?>" readonly style="background: <?php echo get_option('style_3_top', '#f0f0f0'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_3_top" value="<?php echo get_option('style_3_top', '#f0f0f0'); ?>" id="text_color" />
                    </div>
                    <div class="input">
                        <label for="style_3_bottom">Button style 3, bottom gradient</label>
                        <input data-value="<?php echo get_option('style_3_bottom', '#d4d4d4'); ?>" readonly style="background: <?php echo get_option('style_3_bottom', '#d4d4d4'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="style_3_bottom" value="<?php echo get_option('style_3_bottom', '#d4d4d4'); ?>" id="text_color" />
                    </div>  
                    
                    <br /><hr /><br />
                    <h3>Icons wrapper</h3>
                     
                    <div class="input">
                        <label for="icons_top">Icons gradient top</label>
                        <input data-value="<?php echo get_option('icons_top', '#719400'); ?>" readonly style="background: <?php echo get_option('icons_top', '#719400'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="icons_top" value="<?php echo get_option('icons_top', '#719400'); ?>" id="text_color" />
                    </div> 
                    <div class="input">
                        <label for="icons_bottom">Icons gradient bottom</label>
                        <input data-value="<?php echo get_option('icons_bottom', '#668500'); ?>" readonly style="background: <?php echo get_option('icons_bottom', '#668500'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="icons_bottom" value="<?php echo get_option('icons_bottom', '#668500'); ?>" id="text_color" />
                    </div>  
                     
                     <br /><br />
                     
                    <div class="input">
                        <label for="icons_top">Icons gradient top hover</label>
                        <input data-value="<?php echo get_option('icons_top_hover', '#a0d100'); ?>" readonly style="background: <?php echo get_option('icons_top_hover', '#a0d100'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="icons_top_hover" value="<?php echo get_option('icons_top_hover', '#a0d100'); ?>" id="text_color" />
                    </div> 
                    <div class="input">
                        <label for="icons_bottom">Icons gradient bottom hover</label>
                        <input data-value="<?php echo get_option('icons_bottom_hover', '#83ab00'); ?>" readonly style="background: <?php echo get_option('icons_bottom_hover', '#83ab00'); ?>" class="color-pick-color"><input class="color-pick" type="text" name="icons_bottom_hover" value="<?php echo get_option('icons_bottom_hover', '#83ab00'); ?>" id="text_color" />
                    </div> 
                                   
                    <br/><br/><br/><br/><br/><br/><br/>
                </div>
                <input type="submit" value="Save all changes" />

            </form>

            <div class="clear"></div></div>

        <?php
    }

    public function dummy() {

        if (isset($_GET['save_dummy']))
            $this->dummy_save();



        if ($this->dummy_select()) :
            ?>

            <form action="themes.php?page=theme_options&sub_page=dummy_content&save_dummy" method="post">

                <div class="content-inner">

                    <h3>Insert dummy content: posts, pages, categories</h3>

                    <p>If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done.</p>

                    <center><input type="submit" class="dummy" onclick = "return dummy(); " id="dummy-twice" value="Insert dummy content" /></center>

                </div>


                <script type="text/javascript">
                            
                    function dummy () {
                        var reply = confirm("WARNING: You have already insert dummy content and by inserting it again, you will have duplicate content.\r\n\We recommend doing this ONLY if something went wrong the first time and you have already cleared the content.");
                                
                        return reply;
                    }
                            
                            
                </script>

            </form>

                        <?php else : ?>

            <form action="themes.php?page=theme_options&sub_page=dummy_content&save_dummy" method="post">

                <div class="content-inner">

                    <h3>Insert dummy content: posts, pages, categories</h3>

                    <p>If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done.</p>

                    <center><input type="submit" class="dummy" value="Insert dummy content" /></center>

                </div>

            </form>

        <?php
        endif;
    }

    private function dummy_save() {

        global $wpdb;



        if (!file_exists(ABSPATH . 'wp-content/uploads'))
            mkdir(ABSPATH . 'wp-content/uploads');



        if (!file_exists(ABSPATH . 'wp-content/uploads/2012'))
            mkdir(ABSPATH . 'wp-content/uploads/2012');



        if (!file_exists(ABSPATH . 'wp-content/uploads/2012/08'))
            mkdir(ABSPATH . 'wp-content/uploads/2012/08');



        if (!file_exists(ABSPATH . 'wp-content/uploads/2012/09'))
            mkdir(ABSPATH . 'wp-content/uploads/2012/09');



        /* $files_08 = scandir(TEMPLATEPATH.'/dummy_content/2012/08');

          unset($files_08[0], $files_08[1]);



          foreach ($files_08 as $item) {

          if (!file_exists($item))

          copy(TEMPLATEPATH.'/dummy_content/2012/08/'.$item, ABSPATH.'wp-content/uploads/2012/08/'.$item);

          }



          $files_09 = scandir(TEMPLATEPATH.'/dummy_content/2012/09');

          unset($files_09[0], $files_09[1]);



          foreach ($files_09 as $item) {

          if (!file_exists($item))

          copy(TEMPLATEPATH.'/dummy_content/2012/09/'.$item, ABSPATH.'wp-content/uploads/2012/09/'.$item);

          } */

        $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_account (id, responsive, responsive_demand, email, google_analytics, facebook, google, twitter, linkedin, vimeo, youtube, flickr, copyright, copyright_on, top_menu, top_menu_label, top_menu_input, boxed, pattern) VALUES (1, 'on', 'on','info@yourdomain.com', 'UA-YOUR CODE', 'facebook', 'google', 'twitter', 'linkedin', 'vimeo', 'youtube', 'flickr', 'copyright 2012 yourdomain.com  |  PSD theme by anps - Blocked', 'on','on', 'call us', '+386 (0)40 000 000', '-1', 1) ON DUPLICATE KEY UPDATE responsive = 'on'");

   $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_media (id, type, url) VALUES (1, 'favicon', '" . site_url() . "/wp-content/uploads/2012/11/favicon.gif') ON DUPLICATE KEY UPDATE type = 'favicon';");

        $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_media (id, type, url) VALUES (2, 'logo', '" . site_url() . "/wp-content/uploads/2012/11/logo.png') ON DUPLICATE KEY UPDATE type = 'logo';");

        $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_account SET dummy=1 WHERE id=1");

        include_once 'importer/wordpress-importer.php';

        $parse = new WP_Import();

        $parse->import(TEMPLATEPATH . '/admin-functions/importer/dummy.xml');
        
        $menu_id = wp_get_nav_menus();
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id[0]->term_id;

        set_theme_mod('nav_menu_locations', $locations);
        update_option('menu_check', true);
        
        
        
    }

    private function dummy_select() {

        global $wpdb;



        $data = $wpdb->get_results("SELECT id FROM " . $wpdb->prefix . "envoo_account WHERE dummy=1");



        return $data;
    }

    private function info_save() {

        $slider = $_POST['slider'];
        update_option('slider', $slider);

        $breadcrumbs = $_POST['breadcrumbs'];
        update_option('breadcrumbs', $breadcrumbs);

        $rtl = $_POST['rtl'];
        update_option('rtl', $rtl);

        $cart = $_POST['cart'];
        update_option('cart', $cart);

        $shop_hover = $_POST['shop_hover'];
        update_option('shop_hover', $shop_hover);

        $shop_num = $_POST['shop_num'];
        update_option('shop_num', $shop_num);

        $shop_dec_len = $_POST['shop_dec_len'];
        update_option('shop_dec_len', $shop_dec_len);

        $cat_layout_chk = $_POST['cat_layout_chk'];
        update_option('cat_layout_chk', $cat_layout_chk);

         $cat_layout_left = $_POST['cat_layout_left'];
        update_option('cat_layout_left', $cat_layout_left);       

         $cat_layout_right= $_POST['cat_layout_right'];
        update_option('cat_layout_right', $cat_layout_right);  


        $single_product_left = $_POST['single_product_left'];
        update_option('single_product_left', $single_product_left);       

         $single_product_right= $_POST['single_product_right'];
        update_option('single_product_right', $single_product_right);  

        $faq_page = $_POST['faq_page'];
        update_option('faq_page', $faq_page);

        global $wpdb;

        $id_info = $this->info_account_select();

        $id_media = $this->info_media_select();

        $id_pages = $this->info_pages_select();


        /* INSERT OR UPDATE ACCOUNT INFO */

        if (!$id_info)
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_account (responsive, responsive_demand, email, google_analytics, facebook, google, twitter, linkedin, vimeo, youtube, flickr, copyright, copyright_on, top_menu, top_menu_label, top_menu_input, boxed, pattern, custom_pattern, type) VALUES ('" . $_POST['responsive'] . "', '" . $_POST['responsive_demand'] . "', '" . $_POST['email'] . "','" . $_POST['google_analytics'] . "','" . $_POST['facebook'] . "', '" . $_POST['google'] . "', '" . $_POST['twitter'] . "', '" . $_POST['linkedin'] . "', '" . $_POST['vimeo'] . "', '" . $_POST['youtube'] . "', '" . $_POST['flickr'] . "', '" . $_POST['copyright'] . "', '" . $_POST['copyright_on'] . "', '" . $_POST['top_menu'] . "', '" . $_POST['top_menu_label'] . "', '" . $_POST['top_menu_input'] . "', '" . $_POST['boxed'] . "', '" . $_POST['pattern'] . "', '" . $_POST['custom_pattern'] . "', '" . $_POST['type'] . "')");

        elseif (empty($_POST))
            return true;

        else
            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_account SET responsive='" . $_POST['responsive'] . "', responsive_demand='" . $_POST['responsive_demand'] . "', email='" . $_POST['email'] . "', google_analytics='" . $_POST['google_analytics'] . "',facebook='" . $_POST['facebook'] . "', google='" . $_POST['google'] . "', twitter='" . $_POST['twitter'] . "', linkedin='" . $_POST['linkedin'] . "', vimeo='" . $_POST['vimeo'] . "', youtube='" . $_POST['youtube'] . "', flickr='" . $_POST['flickr'] . "', copyright='" . $_POST['copyright'] . "', copyright_on='" . $_POST['copyright_on'] . "', top_menu='" . $_POST['top_menu'] . "', top_menu_label='" . $_POST['top_menu_label'] . "', top_menu_input='" . $_POST['top_menu_input'] . "', boxed='" . $_POST['boxed'] . "', pattern='" . $_POST['pattern'] . "', custom_pattern='" . $_POST['custom_pattern'] . "', type='" . $_POST['type'] . "' WHERE id=" . $id_info[0]->id);



        /* INSERT OR UPDATE MEDIA INFO */

        if (!$id_media)
            $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_media (type, url) VALUES ('favicon', '" . $_POST['favicon'] . "'), ('logo', '" . $_POST['logo'] . "')");

        elseif (empty($_POST))
            return true;

        else {

            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_media SET url='" . $_POST['favicon'] . "' WHERE type='favicon'");

            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_media SET url='" . $_POST['logo'] . "' WHERE type='logo'");
        }


        /* INSERT OR UPDATE PAGES INFO */

        $portfolio = $_POST['portfolio_page'] . ";" . $_POST['pagination_type'] . ";" . $_POST['limit_items'] . ";" . $_POST['filter_pag']; 
        $blog = $_POST['blog_page'] . ";" . $_POST['blog_type'] . ";" . $_POST['single_blog_type'];
        $error = $_POST['error_page'];


        if (!$id_pages) {

            $wpdb->query("INSERT INTO " . $wpdb->prefix . "envoo_pages (type, details) VALUES ('blog', '$blog'), ('portfolio', '$portfolio'), ('error', '$error')");

            update_option('page_on_front ', $_POST['front_page']);
        } elseif (empty($_POST)) {

            return true;
        } else {

            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_pages SET details='$blog' WHERE type='blog'");

            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_pages SET details='" . $portfolio . "' WHERE type='portfolio'");
            
            $wpdb->query("UPDATE " . $wpdb->prefix . "envoo_pages SET details='" . $error . "' WHERE type='error'");

            update_option('page_on_front ', $_POST['front_page']);
        }
        ?>

        <script type="text/javascript">window.location = 'themes.php?page=theme_options&sub_page=options';</script>  

    <?php
    }

    private function info_account_select() {

        global $wpdb;

        $data = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "envoo_account");



        return $data;
    }

    private function info_media_select() {

        global $wpdb;

        $data = $wpdb->get_results("SELECT type, url FROM " . $wpdb->prefix . "envoo_media");



        return $data;
    }

    private function info_pages_select() {

        global $wpdb;

        $data = $wpdb->get_results("SELECT type, details FROM " . $wpdb->prefix . "envoo_pages ORDER BY id ASC");



        return $data;
    }

    private function contact_save() {

        global $wpdb;



        if (empty($_POST))
            return true;



        if (count($this->contact_select()) > 0) {

            $wpdb->query("TRUNCATE " . $wpdb->prefix . "contact");
        }

        $j = 0;

        foreach ($_POST as $postname => $post) {

            if (strpos($postname, 'label') > -1) {

                $j++;
            }
        }



        for ($i = 1; $i <= $j; $i++) {

            $wpdb->query("INSERT INTO " . $wpdb->prefix . "contact (label, form_type, required, placeholder, validation) 

                            VALUES ('" . $_POST['label_' . $i] . "', '" . $_POST['input_type_' . $i] . "','" . $_POST['is_required_' . $i] . "', '" . $_POST['placeholder_' . $i] . "', '" . $_POST['validation_' . $i] . "')");
        }
        ?>

        <script type="text/javascript">window.location = 'themes.php?page=theme_options&sub_page=contact_form';</script> 

    <?php
    }

    private function contact_select() {

        global $wpdb;

        $data = $wpdb->get_results("SELECT label, form_type, required, placeholder, validation FROM " . $wpdb->prefix . "contact");



        return $data;
    }

    private function style_save() {

        $heading1 = $_POST['heading1'];
        update_option('heading1', $heading1);

        $heading2 = $_POST['heading2'];
        update_option('heading2', $heading2);

        $heading3 = $_POST['heading3'];
        update_option('heading3', $heading3);

        $heading4 = $_POST['heading4'];
        update_option('heading4', $heading4);

        $heading5 = $_POST['heading5'];
        update_option('heading5', $heading5);

        $font_type_1 = $_POST['font_type_1'];
        $font_type_2 = $_POST['font_type_2'];
        $text_color = $_POST['text_color'];
        $headings_color = $_POST['headings_color'];
        $primary_color = $_POST['primary_color'];
        $hover_color = $_POST['hover_color'];
        $portfolio_primary = $_POST['portfolio_primary'];
        $portfolio_secondary = $_POST['portfolio_secondary'];
        
        $style_1_text = $_POST['style_1_text'];
        $style_1_top = $_POST['style_1_top'];
        $style_1_bottom = $_POST['style_1_bottom'];
        
        $style_2_text = $_POST['style_2_text'];
        $style_2_top = $_POST['style_2_top'];
        $style_2_bottom = $_POST['style_2_bottom'];
        
        $style_3_text = $_POST['style_3_text'];
        $style_3_top = $_POST['style_3_top'];
        $style_3_bottom = $_POST['style_3_bottom'];
        
        $icons_top = $_POST['icons_top'];
        $icons_bottom = $_POST['icons_bottom'];
        
        $icons_top_hover = $_POST['icons_top_hover'];
        $icons_bottom_hover = $_POST['icons_bottom_hover'];
        
        $footer_top_primary_color = $_POST['footer_top_primary_color'];
        $footer_top_second_color = $_POST['footer_top_second_color'];
        $copyright_back_color = $_POST['copyright_back_color'];
        $copyright_text_color = $_POST['copyright_text_color'];
        
        $menu_text_color = $_POST['menu_text_color'];
        $menu_text_color_hover = $_POST['menu_text_color_hover'];
        $menu_text_color_selected = $_POST['menu_text_color_selected'];

        update_option('font_type_1', $font_type_1);
        update_option('font_type_2', $font_type_2);
        update_option('text_color', $text_color);
        update_option('headings_color', $headings_color);
        update_option('primary_color', $primary_color);
        update_option('hover_color', $hover_color);
        
        update_option('footer_top_primary_color', $footer_top_primary_color);
        update_option('footer_top_second_color', $footer_top_second_color);
        update_option('copyright_back_color', $copyright_back_color);
        update_option('copyright_text_color', $copyright_text_color);
        
        update_option('menu_text_color', $menu_text_color);
        update_option('menu_text_color_hover', $menu_text_color_hover);
        update_option('menu_text_color_selected', $menu_text_color_selected);
        update_option('portfolio_primary', $portfolio_primary);
        update_option('portfolio_secondary', $portfolio_secondary);
        
        update_option('style_1_text', $style_1_text);
        update_option('style_1_top', $style_1_top);
        update_option('style_1_bottom', $style_1_bottom);
        
        update_option('style_2_text', $style_2_text);
        update_option('style_2_top', $style_2_top);
        update_option('style_2_bottom', $style_2_bottom);
        
        update_option('style_3_text', $style_3_text);
        update_option('style_3_top', $style_3_top);
        update_option('style_3_bottom', $style_3_bottom);
        
        update_option('icons_top', $icons_top);
        update_option('icons_bottom', $icons_bottom);
        
        update_option('icons_top_hover', $icons_top_hover);
        update_option('icons_bottom_hover', $icons_bottom_hover);
        ?>

        <script type="text/javascript">window.location = 'themes.php?page=theme_options&sub_page=theme_style';</script>

    <?php
    }

}