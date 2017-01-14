<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Grayscale - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

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
                                <a class="page-scroll active" href="/">Home</a>
                            </li>
                            <li id="link_services">
                                <a class="page-scroll" href="services">Services</a>
                            </li>
                            <li id="link_contact">
                                <a class="page-scroll" href="contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="header home_header">
        <div class="container">
            <h1>Are you tired of the inconveniences <br />of using the laundromat?</h1>
            <div class="row">
                <div class="col-lg-3">
                    <h5>Lugging soiled laundry baskets in and out of the car. </h5>
                    <img src="images/header_home_01.png" />
                </div>
                <div class="col-lg-3">
                    <h5>Driving across town with today's high gas prices. </h5>
                    <img src="images/header_home_02.png" />
                </div>
                <div class="col-lg-3">
                    <h5>Waiting around amongst complete strangers. </h5>
                    <br />
                    <img src="images/header_home_03.png" />
                </div>
                <div class="col-lg-3">
                    <h5>Showing off your<br />dirty laundry.</h5>
                    <img src="images/header_home_04.png" />
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="home_spend">
            <div class="col-lg-6 top_50">
                <img src="images/home_spend.png" />
            </div>
            <div class="col-lg-6">
                <h2>But who wants to spend tons of $$$<br />on a washer and dryer?</h2>
                <ul>
                    <li>Paying interest on debt</li>
                    <li>Dealing with the hassle of installation </li>
                    <li>Worrying about expensive repairs</li>
                    <li>Remembering to complete upkeep and maintenance </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="home_solution">
        <div class="container">
            <div class="col-lg-8">
                <h1>Home laundromat has the solution. <br />We bring the laundromat home to you!</h1>
                <hr />
                <h4>We’ll install a coin operated, space saving, <br />stacked washer and dryer right in your home at <span class="h4_big">no cost to you!</span></h4>
            </div>
            <div class="col-lg-4 top_50 bottom_20">
                <img src="images/home_solution.png" />
            </div>
        </div>
    </div>

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

    <script type="text/javascript">
    jQuery(document).ready(function($){
        var w = $( document ).width();
        //alert(w);
    });
    </script>
</body>

</html>
