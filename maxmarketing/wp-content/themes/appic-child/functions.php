<?php

function child_ts_theme_widgets_init(){
	register_sidebar( array(
        'name' => __( 'Header Top', 'liva' ),
        'id' => 'header-top',
        'before_widget' => '<div id="%1$s" class="header_top sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 1', 'liva' ),
        'id' => 'coyright-area-1',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 2', 'liva' ),
        'id' => 'coyright-area-2',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer left', 'liva' ),
        'id' => 'footer-left',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer center', 'liva' ),
        'id' => 'footer-center',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer right', 'liva' ),
        'id' => 'footer-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar(array(
        'name' => __( 'My Facebook', 'theretailer' ),
        'id' => 'my_facebook',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ));
}

add_action( 'widgets_init', 'child_ts_theme_widgets_init' );

add_shortcode( 'healthcheck_online', 'show_healthcheck_online' );

function show_healthcheck_online($atts, $content = null) {
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    $questions = set_questions();

    $results = set_results();

    $output = '<form id="form_calculate">';

    foreach ($questions as $key => $value) {
        $output .= '<div class="question_row">';
            $output .= '<div class="question_name">' . $value['question'] . '</div>';
            $output .= '<div class="question_answers">';
                $output .= '<input type="radio" name="question_'.$key.'" value="yes">Yes';
                $output .= '<input type="radio" name="question_'.$key.'" value="no">No';
                $output .= '<input type="hidden" id="answer_yes_'.$key.'" value="'.$value["yes"].'" />';
                $output .= '<input type="hidden" id="answer_no_'.$key.'" value="'.$value["no"].'" />';
            $output .= '</div>';
        $output .= '</div>';
    }
    
    $output .= '<div class="clear"></div>';

    //if ($_SERVER['REMOTE_ADDR'] == '151.230.240.5') {
    $output .= '<div class="question_row2">';
        $output .= '<label for="the_name">Name: </label>';
        $output .= '<input type="text" name="the_name" />';
    $output .= '</div>';

    $output .= '<div class="question_row2">';
        $output .= '<label for="the_position">Position: </label>';
        $output .= '<input type="text" name="the_position" />';
    $output .= '</div>';

    $output .= '<div class="question_row2">';
        $output .= '<label for="the_name">Company Name: </label>';
        $output .= '<input type="text" name="the_company_name" />';
    $output .= '</div>';

    $output .= '<div class="question_row2">';
        $output .= '<label for="the_name">Region: </label>';
        $output .= '<input type="text" name="the_region" />';
    $output .= '</div>';



    //}

    $output .= '<div id="calculate" class="but">Get Results</div>';
    //$output .= '<span id="clear_result" class="but">Clear Results</span>';
    $output .= '<div class="clear"></div>';
    $output .= '<div id="email_row">';
        $output .= '<input type="text" id="healthcheck_email" />'; 
        $output .= '<span id="get_results_by_email" class="but">Get Results by Email</span>';
    $output .= '</div>';
    $output .= '<div id="select_all">Please answer all questions first!</div>';
    $output .= '<div id="no_email">Please add your email address!</div>';
    $output .= '<div id="invalid_email">Please add a valid email address!</div>';
    $output .= '<div id="success_email">Thank you. Please check your inbox for HealthCheck results</div>';
    $output .= '<input type="hidden" id="results_0" value="'.$results[0].'" />';
    $output .= '<input type="hidden" id="results_1" value="'.$results[1].'" />';
    $output .= '<input type="hidden" id="results_2" value="'.$results[2].'" />';
    $output .= '<input type="hidden" id="results_3" value="'.$results[3].'" />';
    $output .= '<input type="hidden" id="results_4" value="'.$results[4].'" />';
    $output .= '</form>';
    $output .= '<div id="final_result"></div>';
    $output .= '
<script type="text/javascript">
jQuery(document).ready(function($){
    function check_fields_first(good_number){
        console.log("checking fields");
        total_checked = 0;
        for (i=0; i<25; i++){
            var x = $("input[name=question_"+i+"]").is(":checked");
            if (x) total_checked++;
        }

        var other_fields = true;
        
        if (!$("input[name=the_name]").val()) {
            $("input[name=the_name]").css("border", "1px solid red");
            other_fields = false;
        } else {
            $("input[name=the_name]").css("border", "1px solid #ccc");
        }

        if (!$("input[name=the_position]").val()) {
            $("input[name=the_position]").css("border", "1px solid red");
            other_fields = false;
        } else {
            $("input[name=the_position]").css("border", "1px solid #ccc");
        }

        if (!$("input[name=the_company_name]").val()) {
            $("input[name=the_company_name]").css("border", "1px solid red");
            other_fields = false;
        } else {
            $("input[name=the_company_name]").css("border", "1px solid #ccc");
        }

        if (!$("input[name=the_region]").val()) {
            $("input[name=the_region]").css("border", "1px solid red");
            other_fields = false;
        } else {
            $("input[name=the_region]").css("border", "1px solid #ccc");
        }

        if (total_checked == good_number && other_fields){
            $("#select_all").hide();
            $("#email_row").slideDown();
            return false;
        } else{
            $("#select_all").hide();
            $("#select_all").slideDown("fast");
            return false;
        }
    }

    function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    } 

    $("#calculate").click(function(){
        if (check_fields_first(' . count($questions) . ')){
            
        }

        total = 0;
        var answers = [];

        for (i=0; i<25; i++){
            var x = $("input[name=question_"+i+"]:checked", "#form_calculate").val();
            answers.push( x );
            //console.log(i + " ANSWER: " + x);
            if ($("#answer_"+x+"_"+i).val()){
                total += parseInt($("#answer_"+x+"_"+i).val());
            }
        }
        console.log(answers);
    });

    $("#get_results_by_email").click(function(){
        var email = $("#healthcheck_email").val();
        
        if (!email){
            $("#no_email").hide();
            $("#invalid_email").hide();
            $("#no_email").slideDown("fast");
            return false;
        } else
        if (!validateEmail(email)){
            $("#invalid_email").hide();
            $("#no_email").hide();
            $("#invalid_email").slideDown("fast");
            return false;
        } else {
            console.log("here");
            send_the_email();
            //return true;
        }
    });

    $("#clear_result").click(function(){
        $("#final_result").text("");
    });

    function send_the_email(){
        total = 0;
        var answers = [];

        for (i=0; i<25; i++){
            var x = $("input[name=question_"+i+"]:checked", "#form_calculate").val();
            answers.push( x );
            //console.log(i + " ANSWER: " + x);
            if ($("#answer_"+x+"_"+i).val()){
                total += parseInt($("#answer_"+x+"_"+i).val());
            }
        }
        //console.log(answers);
        /*
        if (total < 0)  $("#final_result").text($("#results_0").val());
        if (total >= 0 && total < 50)  $("#final_result").text($("#results_1").val());
        if (total >= 50 && total < 100)  $("#final_result").text($("#results_2").val());
        if (total >= 100 && total < 150)  $("#final_result").text($("#results_3").val());
        if (total >= 150)  $("#final_result").text($("#results_4").val());
        */

        $.ajax({
            url: ajaxurl,
            data: {
                "action":"send_healthcheck_email",
                "email" : $("#healthcheck_email").val(),
                "answers" : answers,
                "the_name": $("input[name=the_name]").val(),
                "the_position": $("input[name=the_position]").val(),
                "the_company_name": $("input[name=the_company_name]").val(),
                "the_region": $("input[name=the_region]").val()
            },
            success:function(data) {
                // This outputs the result of the ajax request
                //console.log(data);
                $("#success_email").slideDown("fast");
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    }
});
</script>
    ';
    return $output;

}

function set_questions(){
    $questions = array(
        array(
            'question' => 'Have you been in business for more than 2 years?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you have a current marketing plan?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you know who buys your product/service?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Do you know why they buy from you?',
            'no' => 0,
            'yes' => 10
        ),
        array(
            'question' => 'Do you know your competitors?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Do you know how much market share you have?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Is your offer clear and easy to understand?',
            'no' => -5,
            'yes' => 5
        ),
        array(
            'question' => 'Is your brand relevant and engaging?',
            'no' => -5,
            'yes' => 10
        ),
        array(
            'question' => 'Does your internal culture reflect your brand?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Do your staff, suppliers and partners all promote your business?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you regularly ask customers what they think of your product/service/business?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Do you know why customers leave your product/service/business?',
            'no' => -5,
            'yes' => 10
        ),
        array(
            'question' => 'Do you discount your prices regularly?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Are you getting enough customers?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you understand your sales pipeline?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you know what it costs you to bring on a new customer?',
            'no' => 0,
            'yes' => 10
        ),
        array(
            'question' => 'Do you know how effective your promotional channels are?',
            'no' => 0,
            'yes' => 10
        ),
        array(
            'question' => 'Are you using a Word of Mouth channel for promotion?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Do you target your communications to the most relevant customers?',
            'no' => 0,
            'yes' => 10
        ),
        array(
            'question' => 'Do you capture and track your customer relationship with your business?',
            'no' => -5,
            'yes' => 10
        ),
        array(
            'question' => 'Do you regularly communicate with your existing customers?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Do you understand your customer journey?',
            'no' => -3,
            'yes' => 5
        ),
        array(
            'question' => 'Have you tried to re-engage lapsed customers?',
            'no' => 0,
            'yes' => 5
        ),
        array(
            'question' => 'Are you achieving your Business\' goals and objectives?',
            'no' => 0,
            'yes' => 10
        ),
        array(
            'question' => 'Do you have a plan for where your business needs to innovate in the next 3 years?',
            'no' => 0,
            'yes' => 10
        ),
    );

    return $questions;
}

function set_results(){
    $results = array(
        'Okay - so the marketing health of your business isn\'t good, but at least you recognise there is a problem and are seeking advice. The next steps here would be to get a good understanding of where the key issues are for your business\' marketing so that you can fix them and get back on track.  If you are a newer business or  a start up, you probably didn\'t score well as you are still finding your way and might not have some of these things nutted out yet.  Check out our MaxBasics Plan to get you on the right track and ensure your business has a solid foundation for the year ahead.',
        'It could be worse!  You probably know there are some things in here that need to be addressed, just from doing the healthcheck. Why not print off your scores and do a review of your business this week?  Knowing where you are starting from is the first part towards diagnosis and improving the health of your business.  You may want to consider doing the upgrade to the full MaxHealthcheck programme to get a professional diagnosis on what isn\'t working and some strategies on how to improve them, which will help your business achieve its full potential.',
        'Whilst you may be happy with this result, scores plotted in this bracket are usually the most at risk. Typically there are some marketing essentials that need close attention - competitors coming on the scene, relevancy for your target market or failure to innovate are all high-risk areas where business health can be taken down suddenly.  More at risk than the lower scores, you may be trying lots of different tactics but potentially missing the big picture.  We\'d recommend a MaxAccelerator programme or a MaxHealthcheck to uncover some more insight into where the business needs to focus attention on the next 12mths to ensure it stays in optimum health.',
        'A respectable score. There are lots of good things that you understand about your business, but a score here means you are probably a long way from achieving your company\'s true potential.  Review the MaxJumpstart, BrandEssentials and MaxLoyalty programmes for some targeted results in key areas and watch your business health start to really improve.',
        'Well done!  Your company\'s marketing health looks good.  Like any good preventative treatment you should get a check over once a year from an independent professional to ensure you stay on track. We offer a strategic sounding board service for business leaders and monthly coaching programmes for those who want to keep things moving up.  You could also fine-tune some of your main tactics to drive more growth, or you might be thinking of starting up new product lines or revenue streams for which we can assist with tactical and promotional reviews and feasibility and market analysis studys.'
    );

    return $results;
}

function set_results_header(){
    $r = array(
        '',
        '0 - 50 Marketing health improvement urgently required. ',
        '50 - 100 Marketing health below average',
        '100 - 150 Marketing health below optimum',
        '150+ Great marketing health for your business'
    );

    return $r;
}

add_action('wp_head','ajaxurl');
function ajaxurl() {?>
    <script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}

add_action('wp_ajax_send_healthcheck_email', 'send_healthcheck_email');
add_action('wp_ajax_nopriv_send_healthcheck_email', 'send_healthcheck_email');

function send_healthcheck_email(){
    $questions = set_questions();
    $results = set_results();
    $results_header = set_results_header();
    $content = "";
    $content .= "<h1>Health-check of your business</h1>";

    $total = 0;

    foreach ($questions as $key => $value){
        $content .= "<p>";
        $content .= "<b>" . $questions[$key]['question'] . "</b><br />";
        $content .= "Your answer: " . $_GET['answers'][$key];
        $content .= "</p>";


        $total += $questions[$key][$_GET['answers'][$key]];
    }

    $content .= "<hr />";
    $content .= "<h2>Score ". $total . "</h2>";
    
    if ($total < 0){
        $content .= "<h2>" . $results_header[0] . "</h2>";
        $content .= $results[0];
    } else if ($total >= 0 && $total < 50) {
        $content .= "<h2>" . $results_header[1] . "</h2>";
        $content .= $results[1];
    } else if ($total >= 50 && $total < 100) {
        echo "50 - 100";
        $content .= "<h2>" . $results_header[2] . "</h2>";
        $content .= $results[2];
    } else if ($total >= 100 && $total < 150) {
        $content .= "<h2>" . $results_header[3] . "</h2>";
        $content .= $results[3];
    } else if ($total >= 150) {
        $content .= $results[4];
    }
    //echo "<pre>"; var_dump($results); var_dump($results_header);
    //var_dump($total);
    //echo $content;
    //echo "<pre>";
    //var_dump($_GET['email']);
    //var_dump($_GET['answers']);
    //echo "</pre>"; die();

    $to = $_GET['email'];
    $subject = "Max Marketing - HealthCheck Results Questionaire";
    $message = $content;

    $message .= '<h3><b>Name: </b>' . $_GET['the_name'] . '</h3>';
    $message .= '<h3><b>Position: </b>' . $_GET['the_position'] . '</h3>';
    $message .= '<h3><b>Company Name: </b>' . $_GET['the_company_name'] . '</h3>';
    $message .= '<h3><b>Region: </b>' . $_GET['the_region'] . '</h3>';

    $headers = 'From: Max Marketing <ivone@maxmarketing.co.nz>' . "\r\n";
    $headers .= "Reply-To: ivone@maxmarketing.co.nz\r\n";
    
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $headers .= 'Cc: Louise <louise@maxmarketing.co.nz>' . "\r\n";
    $headers .= 'Cc: Ivone <ivone@maxmarketing.co.nz>' . "\r\n";


    $x = wp_mail( $to, $subject, $message, $headers );
    var_dump($x);

    exit();
}

add_filter( 'wp_mail_content_type', 'set_html_content_type' );

function set_html_content_type() {
    return 'text/html';
}

add_shortcode( 'homepage_team', 'show_team_homepage' );

function show_team_homepage($atts, $content = null) {
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    $limit = 80;

    $columns = 6;

    $query_args = array(
        'post_type'       => 'team',
        'posts_per_page'  => $limit
    );

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'team',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }

    global $post;

    $listings_array = get_posts( $query_args );

    $output = '<div class="featured_listings">';
    $output .= '<div class="row">';

    $output .= '<div id="carousel_container">';
    $output .= '<div id="left_scroll"></div>';
    $output .= '<div id="carousel_inner">';
    $output .= '<ul id="carousel_ul">';

    $count = 0;
    $extra_info = array();

    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $count++;
        $output .= '<li class="li_inactive" id="use_the_'.$count.'">';
            $output .= '<div class=" featured_h" id="featured_listing_'.$count.'">';
                $output .= '<div class="small_featured"><img src="' . get_listing_thumb( $post->ID , 'homepage-featured-listing' ) . '" /></div>';
            $output .= '</div>';
            $output .= '<div class="listing_summary" id="hidden_member_summary_'.$count.'">';
                    $output .= '<a class="featured_listing_title" href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    $output .= '<div class="featured_listing_content">' . $post->post_content . '</div>';
                $output .= '</div>';      
        $output .= '</li>';
    endforeach;

    $output .= '</ul></div>'; //<div id='carousel_inner'>
    $output .= '<div id="right_scroll"></div>';
    $output .= '</div>'; //<div id='carousel_container'>

    $output .= '</div><!--row-->';
    $output .= '</div>'; //<div class="featured_listings">
    return $output;
    //pr($listings_array);
}

function get_listing_thumb($post_id, $thumb){
    $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $thumb );
    //var_dump($url[0]);
    return $url[0];
}

function pr($s){
    echo "<pre>"; var_dump($s); echo "</pre>";
}