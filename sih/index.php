<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RHCMS : Rural housing and construction monitoring system</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- themify CSS -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- front-img -->
    <link rel="stylesheet" href="css/fimg.css">
    
    
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="index.html"> <img src="img/logo.png" style="width:100px;;"alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="ti-menu"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin/house_owner.php">Check Construction status</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin/">Admin login</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- Image Section-->

    <section>
        <div id="front-img">
        <img width="100%" height="550px" src="img/bg3.jpg" alt="hech">
        </div>
    </section>

    <!-- banner part start-->
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-xl-12">
             	<?php
include 'admin/db/dc.php';
$dataPoints = array();
try{
    $handle = $db_con->prepare('SELECT old_project.year,old_project.project FROM old_project '); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->year, "y"=> $row->project));
    }
	$db_con = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}	
?>
            	<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2",
	title:{
		text: "Old Project"
	},
	data: [{
		type: "column",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                
    </div>
    </div>
    </div>
    </section>


    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner" id="abt_us">
                            <h1>About Us</h1>
                            <p>This is the official website of Sikkim Government,to implement the rural development of Sikkim as referred by the Department of Rural Development<br> and Housing, Government of Sikkim.</p>

                                <p>It was established with a mission of planned, holistic and inclusive<br>development of Sikkim.</p>
                                
                                <p>It is charged and empowered to create basic infrastructure to meet<br> the needs of the ever-increasing population and also for the<br> required expansion of the city ensuring sustainable & orderly<br> growth supported with effective monitoring  and regulation<br> through innovative and citizen participatory approach.  </p>
                            <!-- <a href="#" class="btn_1">View project </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- about part start-->
    <!-- <section class="about_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-lg-6">
                    <div class="about_part_img">
                        <img src="img/about_part_img.png" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="about_part_text">
                        <h2>Engineering Your
                            Dreams With Us</h2>
                        <p>Which cattle fruitful he fly visi won't let above lesser stars. Fly form wonder every let third form two air seas after us said day won light also  together midst two female she great to open.</p>
                        <ul>
                            <li>
                                <span class="flaticon-drop"></span>
                                <h3>Certified Company</h3>
                                <p>Be man air male shall under create light together grass fly dat also also his brought itself air abundantly </p>
                            </li>
                            <li>
                                <span class="flaticon-ui"></span>
                                <h3>Experience Employee</h3>
                                <p>Be man air male shall under create light together grass fly do also also his brought itself air abundantly </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- about part end-->

    <!-- our_service start-->
    <section class="our_service padding_top">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="section_tittle">
                        <h2>our services</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-xl-4">
                    <div class="single_feature">
                        <div class="single_service">
                            <span class="flaticon-ui"></span>
                            <h4>Tracking Project Timeline</h4>
                            <p>Check currect progress of ongoing project</p>
                            <p>Day to Day update through images</p>
                            <p>Reasons of delay</p>
                            <a href="#" class="btn_3">read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="single_feature">
                        <div class="single_service">
                                <span class="flaticon-ui"></span>
                            <h4>Expected Computation Time</h4>
                            <p>Remaining time of completion</p>
                            <p>Estimated project deadline</p>
                            <p>Meeting daily targets</p>
                            <a href="#" class="btn_3">read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="single_feature">
                        <div class="single_service single_service_2">
                                <span class="flaticon-ui"></span>
                            <h4>Tracking Spendings</h4>
                            <p>Provides bills of material being used via images</p>
                            <p>Estimated Quotation for project</p>
                            <p>Reviewing workers daily wage </p>
                            <a href="#" class="btn_3">read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="single_feature">
                        <div class="single_service single_service_2">
                                <span class="flaticon-ui"></span>
                            <h4>Real Time Chat</h4>
                            <p>RTC with contractor via audio,video & chat</p>
                            <p>Regular interaction with contractor</p>
                            <p>Keep eye on ongoing work</p>
                            <a href="#" class="btn_3">read more</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="single_feature">
                        <div class="single_service single_service_2">
                                <span class="flaticon-ui"></span>
                            <h4>Others</h4>
                            <p>More clear view through Graphical Reprentation</p>
                            <p>Reminders on regular basis</p>
                            <p></p>
                            <a href="#" class="btn_3">read more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our_service part end-->

    <!-- about part start-->
    <!-- <section class="about_part experiance_part section_padding">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 col-lg-6">
                    <div class="about_part_text">
                        <h2>We Are Experience
                                in Construction</h2>
                        <p>Their whose made waters there our, air above first give dry fruit that second whose herb creeping it us light spirit appear mans. So green abundantly She'd. Greater divide dry bearing years ourends herb upon which open lights had blessed replenish Cattle give his. Abundantly over saying which beast dominion multiply behold to wateo.</p>
                        <div class="about_text_iner">
                            <div class="about_text_counter">
                                <h2>20</h2>
                            </div>
                            <div class="about_iner_content">
                                <h3>year <span>of Experience</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="about_part_img">
                        <img src="img/experiance_img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- about part end-->

    <!-- our_project part start-->
    <section class="our_project section_padding" id="portfolio">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5 col-sm-10">
                    <div class="section_tittle">
                        <h2>Our Projects</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-10">
                    <div class="filters portfolio-filter project_menu_item">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".buildings">Buildings</li>
                            <li data-filter=".rebuild">Rebuild</li>
                            <li data-filter=".architecture">Architecture</li>
                            <li data-filter=".architecture">On going </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="filters-content">
                <div class="row justify-content-between portfolio-grid">
                    <div class="col-lg-4 col-sm-6 all buildings">
                        <div class="single_our_project">
                            <div class="single_offer">
                                <img src="img/project_1.png" alt="offer_img_1">
                                <div class="hover_text">
                                    <p>Bank Protected</p>
                                    <a href="#"><h2>Banking & Finance</h2></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 all rebuild">
                        <div class="single_our_project">
                            <div class="single_offer">
                                <img src="img/project_2.png" alt="offer_img_1">
                                <div class="hover_text">
                                    <p>Bank Protected</p>
                                    <a href="#"><h2>Banking & Finance</h2></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 all architecture">
                        <div class="single_our_project">
                            <div class="single_offer">
                                <img src="img/project_3.png" alt="offer_img_1">
                                <div class="hover_text">
                                    <p>Bank Protected</p>
                                    <a href="#"><h2>Banking & Finance</h2></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our_project part end-->

    <!-- member_counter counter start -->
    <section class="member_counter padding_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single_counter_icon">
                        <img src="img/icon/Icon_1.svg" alt="">
                    </div>
                    <div class="single_member_counter">
                        <span class="counter">60</span>
                        <h4> <span>Satisfied</span> Client</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_counter_icon">
                        <img src="img/icon/Icon_2.svg" alt="">
                    </div>
                    <div class="single_member_counter">
                        <span class="counter">80</span>
                        <h4> <span>Total</span> Projects</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_counter_icon">
                        <img src="img/icon/Icon_3.svg" alt="">
                    </div>
                    <div class="single_member_counter">
                        <span class="counter">54</span>
                        <h4> <span>Ongoing</span> Projects</h4>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single_counter_icon">
                        <img src="img/icon/Icon_4.svg" alt="">
                    </div>
                    <div class="single_member_counter">
                        <span class="counter">24</span>
                        <h4> <span>Work</span> Finished</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- member_counter counter end -->

    <!-- review part start-->
    <section class="review_part section_padding">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-end">
                <div class="col-lg-5 col-xl-4">
                    <div class="tour_pack_text">
                        <h2>Some Feedback
                                From Client</h2>
                        <p>Here, are some feedbacks from our satisfied clients...</p>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="review_part_cotent owl-carousel">
                        <div class="single_review_part">
                            <img src="img/client/client_2.png" alt="">
                            <div class="tour_pack_content">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Impedit suscipit unde asperiores totam, neque labore repellat earum quae ipsum rem? Ipsam itaque cupiditate neque maiores ducimus at ipsum ullam sapiente.
                                </p>
                                <h4>Ravindra Singh</h4>
                            </div>
                        </div>
                        <div class="single_review_part">
                            <img src="img/client/client_1.png" alt="">
                            <div class="tour_pack_content">
                                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium libero accusamus voluptate impedit! Expedita pariatur reprehenderit ipsum provident ea? Vitae ipsa praesentium nostrum aliquid cumque.
                                </p>
                                <h4>Piyush Agarwal</h4>
                            </div>
                        </div>
                        <div class="single_review_part">
                            <img src="img/client/client_1.png" alt="">
                            <div class="tour_pack_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla cupiditate animi, eveniet amet rerum, dolore id ipsum debitis laudantium laboriosam distinctio, culpa accusamus! Illo atque reprehenderit accusantium.</p>
                                <h4>Anushka Sharma</h4>
                            </div>
                        </div>
                        <div class="single_review_part">
                            <img src="img/client/client_2.png" alt="">
                            <div class="tour_pack_content">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident est soluta cumque et ea incidunt dolor alias magni non architecto illum amet suscipit ullam praesentium, at eum fugit aliquam blanditiis accusantium.</p>
                                <h4>Abhishek Saini</h4>
                            </div>
                        </div>
                        <div class="single_review_part">
                            <img src="img/client/client_1.png" alt="">
                            <div class="tour_pack_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nisi voluptates quia nobis iure soluta tempore saepe, possimus necessitatibus reprehenderit sequi officia reiciendis a. Voluptas fuga necessitatibus accusantium.</p>
                                <h4>Poonam Kanwar</h4>
                            </div>
                        </div>
                        <div class="single_review_part">
                            <img src="img/client/client_1.png" alt="">
                            <div class="tour_pack_content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In quidem et ut ipsum repudiandae earum magnam exercitationem ipsa nemo aliquam quos velit cumque, numquam tenetur recusandae nam esse vel placeat!</p>
                                <h4>Sarvesh Kumar</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- review part end-->

    <!--::blog_part start::-->
    <section class="blog_part section_padding">
        <div class="container">
            <div class="row ">
                <div class="col-xl-5">
                    <div class="section_tittle ">
                        <h2>Recent news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_1.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                                <a href="blog.html">
                                    <h5 class="card-title">Our two firmament called us kind in face midst</h5>
                                </a>
                                <a href="#" class="btn_3">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_2.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                                <a href="blog.html">
                                    <h5 class="card-title">Our two firmament called us kind in face midst</h5>
                                </a>
                                <a href="#" class="btn_3">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 col-xl-4">
                    <div class="single-home-blog">
                        <div class="card">
                            <img src="img/blog/blog_3.png" class="card-img-top" alt="blog">
                            <div class="card-body">
                                <ul>
                                    <li> <span class="ti-comments"></span>2 Comments</li>
                                    <li> <span class="ti-heart"></span>2k Like</li>
                                </ul>
                                <a href="blog.html">
                                    <h5 class="card-title">Our two firmament called us kind in face midst</h5>
                                </a>
                                <a href="#" class="btn_3">read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::blog_part end::-->

    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <a href="index.html"> <img src="img/footer_logo.png" alt=""> </a>
                        <!-- <p>So seed seed green that winged cattle in Gahesd thing made fly you're no divided deep move lan Gathering thing us land years living on floor me the cavaty do buty fresh</p> -->
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Useful links</h4>
                        <div class="contact_info">
                            <ul>
                                <li>
                                    <a href="#">General Contracting</a>
                                </li>
                                <li>
                                    <a href="#">Mechanical Engineering</a>
                                </li>
                                <li>
                                    <a href="#">Civil Engineering</a>
                                </li>
                                <li>
                                    <a href="#">Bridge Construction</a>
                                </li>
                                <li>
                                    <a href="#">Electrical Engineering</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Our Gallery</h4>
                        <div class="footer_img">
                            <a href="#"><img src="img/footer_img/footer_1.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_2.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_3.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_4.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_5.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_6.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_7.png" alt=""></a>
                            <a href="#"><img src="img/footer_img/footer_8.png" alt=""></a>
                        </div>
                    </div>
                </div> -->
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Contact info</h4>
                        <div class="contact_info"> 
                            <p>4361 Morningview Lane Artland , Street
                                    Latimer, IA 50452 / 23654</p>
                            <p><span> Address :</span> Hath of it fly signs bear be one blessed after </p>
                            <p><span> Phone :</span> +2 36 265 (8060)</p>
                            <p><span> Email : </span>info@colorlib.com </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </footer>
    <div>
       <center>&copy; Copyright  All rights reserved!!!......</center>
    </div>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- isotope js -->
    <script src="js/isotope.pkgd.min.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- swiper js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>
</html>