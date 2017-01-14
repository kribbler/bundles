<?php $sent = false;
if ($_POST) {
    $to = 'jesse@divinedesigns.ca';
    //$to = "daniel.oraca@divinedesigns.com";
//echo "<pre>";var_dump($_POST); echo "</pre>"; //die();
    $subject = 'A Message from Homelaundromat.com';

    $headers = "From: " . "contact@homelaundromat.com" . "\r\n";
    $headers .= "Reply-To: ". "contact@homelaundromat.com" . "\r\n";
    $headers .= "CC: daniel.oraca@gmail.com\r\n";
    $headers .= "CC: web-QDWHIo@mail-tester.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = '<html>';
    $message .= '<body>';
    $message .= '<p><b>First Name</b>: ' . $_POST['first_name'] . '</p>';
    $message .= '<p><b>Last Name</b>: ' . $_POST['last_name'] . '</p>';
    $message .= '<p><b>Company</b>: ' . $_POST['company'] . '</p>';
    $message .= '<p><b>Phone</b>: ' . $_POST['phone'] . '</p>';
    $message .= '<p><b>Address 1</b>: ' . $_POST['address1'] . '</p>';
    $message .= '<p><b>Address 2</b>: ' . $_POST['address2'] . '</p>';
    $message .= '<p><b>City</b>: ' . $_POST['city'] . '</p>';
    $message .= '<p><b>Country</b>: ' . $_POST['country'] . '</p>';
    $message .= '<p><b>Province</b>: ' . $_POST['province'] . '</p>';
    $message .= '<p><b>Postal Code</b>: ' . $_POST['postal_code'] . '</p>';
    $message .= '<p><b>Comments</b>: ' . $_POST['comments'] . '</p>';

    $message .= '</body>';
    $message .= '</html>';
//    echo $message; die();
    $sent = mail($to, $subject, $message, $headers);

} ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Homelaundromat.com - Get in Touch!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <nav class="navbar navbar-custom navbar-fixed-top_____" role="navigation">
        <div class="container">
            <div class="row">
                <div class="col-md-6 the_logo">
                    <a href="/"><img src="images/logo.png" id="logo" title="" alt="" /></a>
                </div>

                <div class="col-md-6 the_nav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                        <ul class="nav navbar-nav">
                            <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li id="link_home">
                                <a class="page-scroll" href="/">Home</a>
                            </li>
                            <li id="link_services">
                                <a class="page-scroll" href="services">Services</a>
                            </li>
                            <li id="link_contact">
                                <a class="page-scroll active" href="contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="header contact_header">
        <div class="container">
            <h1>Get in touch!</h1>
        </div>
    </div>

    <div class="container">
        <div class="row block1">
            <div class="col-lg-12 my_col-md-offset-4">
            <?php if ($sent) {?>
                <div id="contact_form"><h3>Thanks for making contact. We will be in touch shortly.</h3></div>
            <?php } else { ?>
                <form method="POST" id="contact_form">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" />
                            <label>Last Name</label>
                            <input type="text" name="last_name" />
                            <label>Company</label>
                            <input type="text" name="company" />
                            <label>Phone</label>
                            <input type="text" name="phone" />
                            <label>Address 1</label>
                            <input type="text" name="address1" />
                            <label>Address 2</label>
                            <input type="text" name="address2" />

                            <div class="row">
                                <div class="col-lg-8">
                                    <label>City</label>
                                    <input type="text" name="city" />
                                    <label>Country</label>
                                    <input type="text" name="country" />
                                </div>
                                <div class="col-lg-4">
                                    <label>Province</label>
                                    <input type="text" name="province" />
                                    <label>Postal Code</label>
                                    <input type="text" name="postal_code" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Comments Box</label> 
                            <textarea name="comments"></textarea>
                            <input type="submit" value="Request info!">
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
            
        </div>
    </div>

<script type="text/javascript">
jQuery(document).ready(function($){
    $('#contact_form').submit(function(){
        var errors = false;
        var first_name = $("input[name=first_name]").val();
        var last_name = $("input[name=last_name]").val();
        var phone = $("input[name=phone]").val();
        var email = $("input[name=email]").val();
        var address1 = $("input[name=address1]").val();
		var city = $("input[name=city]").val();
		var province = $("input[name=province]").val();
		var country = $("input[name=country]").val();
		var postal_code = $("input[name=postal_code]").val();
		var comments = $("textarea[name=comments]").val();
		
        if (first_name == '') {
            $("input[name=first_name]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=first_name]").css('border-color', 'white');
        }

        if (last_name == '') {
            $("input[name=last_name]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=last_name]").css('border-color', 'white');
        }

        if (phone == '') {
            $("input[name=phone]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=phone]").css('border-color', 'white');
        }

        if (email == '') {
            $("input[name=email]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=email]").css('border-color', 'white');
        }

        if (address1 == '') {
            $("input[name=address1]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=address1]").css('border-color', 'white');
        }
        
		if (city == '') {
            $("input[name=city]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=city]").css('border-color', 'white');
        }
		
		if (country == '') {
            $("input[name=country]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=country]").css('border-color', 'white');
        }
		
		if (province == '') {
            $("input[name=province]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=province]").css('border-color', 'white');
        }
		
		if (postal_code == '') {
            $("input[name=postal_code]").css('border-color', 'red');
            errors = true;
        } else {
            $("input[name=postal_code]").css('border-color', 'white');
        }
		
				if (comments == '') {
            $("textarea[name=comments]").css('border-color', 'red');
            errors = true;
        } else {
            $("textarea[name=comments]").css('border-color', 'white');
        }
		
        if (errors)
            return false;
    })
});
</script>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6">
                    <div id="footer_phone">1-844-Orillia</div>
                    <div id="call_us">Call us today!</div>
                </div>

                <div class="col-lg-6">
                    <p>Copyright &copy; 2015 HomeLaundromat.com TM<br />
                    Website Design: <a href="http://divinedesigns.ca/" target="_blank">Divine Designs.ca - Web Design, Graphic Design &amp; Online Marketing</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>
