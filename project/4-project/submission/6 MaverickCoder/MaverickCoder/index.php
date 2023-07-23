<!DOCTYPE html>

<!--
Group: Maverick Coder
1. Name: EL INSYIRAAH FATHIN BINTI AMIRUDDIN, Matrix No: SX22034ECJHS04, Github ID: elleamyr
2. SITI DZIN NORSYAFIKA BINTI MOHD ISA, Matrix No: SX220330ECJHS04, Github ID: dzinsyafika97
3. Name: MOHAMED HARIS BIN MOHAMED MAZLAN, Matrix No: SX221954ECJHF04, Github ID: harismazlan
4. Name: MUHAMMAD FAIZ FITRI BIN MOHD NOH, Matrix No: SX220354ECJHS04, Github ID: AshuraRin
-->


<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="KuehRaye by MaverickCoder">

	<!-- title -->
	<title>KuehRaye</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="css/responsive.css">

</head>

<body>

	<?php
	// Include the database configuration file
	require_once 'database/db_config.php';

	// Include the db_connection.php file to trigger the database connection process
	require_once 'database/db_connection.php';

	// Include the db_create.php file to trigger the table creation process
	require_once 'database/db_create.php';

	// Include the db_seed.php file to trigger the data seeding process
	require_once 'database/db_seed.php';

	// Start the session (if not already started)
	session_start();

	// Check if the user is not logged in
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
		// Redirect to the login page
		header("Location: pages/login.php");
		exit; // Ensure that the script stops executing after the redirect
	}
	?>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">

						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="images/logo.png" alt="">
							</a>
						</div>

						<div class="header-icons text-white">
							<?php
							$username = $_SESSION['username'];
							$profile_pic = $_SESSION['profile_picture'];
							?>
							Welcome
							<?php echo $username; ?>!
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="#">Home</a>
								</li>

								<li><a href="pages/about.php">About</a></li>

								</li>
								<li><a href="pages/news.php">News</a>
									<ul class="sub-menu">
										<li><a href="pages/news.php">News</a></li>
										<li><a href="pages/single-news.php">News of the Week</a></li>
									</ul>
								</li>
								<li><a href="pages/contact.php">Contact</a></li>
								<li><a href="pages/shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="pages/shop.php">Shop</a></li>
										<li><a href="pages/checkout.php">Check Out</a></li>
										<li><a href="pages/cart.php">My Cart</a></li>
									</ul>
								</li>
								<?php
								// Check if the user's role is 'admin'
								if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
									// Display the "Stocks" link for admin
									echo '<li><a href="pages/stocks.php">Stocks</a></li>';
								}
								?>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="pages/cart.php"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
										<a class="mobile-hide" href="pages/logout.php"><i class="fas fa-sign-out-alt"></i></a>
										<a class="mobile-hide" href="#">
											<img class="round-profile-pic" src="<?php echo $profile_pic; ?>" alt="Profile Picture">
										</a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" id="searchInput" placeholder="Keywords">
							<button type="submit" id="searchBtn"><i class="fas fa-search"></i>
								Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="searchResults" class="results-container"></div>
	</div>
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-right">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Fresh From The Oven</p>
							<h1>Delicious <span class="orange-text">Kueh</span>Raye</h1>
							<div class="hero-btns">
								<a href="pages/shop.php" class="boxed-btn">Eid al-Adha Collection</a>
								<a href="pages/contact.php" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Free Shipping</h3>
							<p>When order over RM100</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>24/7 Support</h3>
							<p>Get support all day</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Refund</h3>
							<p>Get refund within 3 days!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Our</span> Products</h3>
						<p>We offer a wide selection of exquisite "kueh" to cater to your every craving. With our
							diverse range of options, you can delight your family and impress your relatives with an
							abundance of choices.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="pages/single-product.php"><img src="images/products/product-img-1.jpg" alt=""></a>
						</div>
						<h3>Almond London</h3>
						<p class="product-price"><span>Per Bottle (50 pieces)</span> RM50 </p>
						<a href="pages/cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to My
							Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="pages/single-product.php"><img src="images/products/product-img-2.jpg" alt=""></a>
						</div>
						<h3>Honey Cornflakes</h3>
						<p class="product-price"><span>Per Bottle (30 pieces)</span> RM20 </p>
						<a href="pages/cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to My
							Cart</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="pages/single-product.php"><img src="images/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Nutella Pod</h3>
						<p class="product-price"><span>Per Bottle (40 pieces)</span> RM45 </p>
						<a href="pages/cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to My
							Cart</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- ----------------------------------------------Divider------------------------------------------- -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">


				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<div class="price-box">
							<div class="inner-price">
								<span class="price">
									<strong>10%<br>Off</strong>
								</span>
							</div>
						</div>
						<img src="images/a.jpg" alt="">
					</div>
				</div>


				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
					<br>
					<h4>Buy 5 Bottles, Get 10% Off</h4>
					<div class="text">Indulge in our irresistible promotions featuring generous discounts, allowing you
						to bring home an abundance of "kueh" for your loved ones without breaking the bank. Treat your
						family and impress your relatives with a delectable assortment at unbelievably affordable
						prices.</div>

					<!--Countdown Timer-->
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="2023/7/31">
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Days</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Hours</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Mins</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Secs</div>
							</div>
						</div>
					</div>
					<a href="pages/cart.php" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Add to My
						Cart</a>
				</div>
			</div>
		</div>
	</section>
	<!-- end cart banner section -->

	<!-- ----------------------------------------------Divider------------------------------------------- -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="images/avatars/avatar1.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Saira Hakim<span>Housewife</span></h3>
								<p class="testimonial-body">
									"I have tried many cookies, but KuehRaye's cookies are in a league of their own! The
									perfect balance of flavors and textures makes each bite an absolute delight. I can't
									get enough of their mouthwatering creations."
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="images/avatars/avatar2.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Adam Mirza<span>Engineer</span></h3>
								<p class="testimonial-body">
									"KuehRaye have become a staple in my family's gatherings. The incredible variety of
									flavors ensures that there is something for everyone, and they never disappoint.
									These "kueh raya" have elevated our celebrations to a whole new level!"
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="images/avatars/avatar3.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Aisha Jawwad<span>Local shop owner</span></h3>
								<p class="testimonial-body">
									"I was searching for cookies that capture the essence of tradition while offering a
									modern twist, and KuehRaye exceeded my expectations. Their cookies are a testament
									to their commitment to quality and innovation. I highly recommend trying them!"
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->


	<!-- ----------------------------------------------Divider------------------------------------------- -->

	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="abt-bg">
						<a href="https://www.youtube.com/watch?v=vpYClahlC88" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Since Year 2015</p>
						<h2>We are <span class="orange-text">Kueh</span>Raye</h2>
						<p>At KuehRaye, we are deeply committed to curating the finest selection of "kuih" that not only
							delights your taste buds but also strengthens the bonds with your loved ones. We understand
							the importance of shared moments and the joy that comes from indulging in delicious treats
							together. That's why we take pride in offering you an extensive range of delectable options
							to choose from.</p>
						<p>From our best-selling classics like Almond London, Nutella Pod, Dahlia, and Honey Cornflakes
							to a tantalizing array of flavors, textures, and shapes, we strive to cater to every palate.
							Whether you're seeking traditional favorites or unique creations, our diverse collection
							ensures there's something for everyone to savor and enjoy.</p>
						<a href="pages/about.php" class="boxed-btn mt-4">Know More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->


	<!-- ----------------------------------------------Divider------------------------------------------- -->

	<!-- shop banner -->
	<section class="shop-banner">
		<div class="container">
			<h3>Eid al-Adha SALE is On!</h3>
			<div class="sale-percent"><span>Buy 5 Bottles & Get</span>10% Off</span></div>
			<a href="pages/shop.php" class="cart-btn btn-lg">Shop Now</a>
		</div>
	</section>
	<!-- end shop banner -->

	<!-- ----------------------------------------------Divider------------------------------------------- -->

	<!-- latest news -->
	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Our</span> News</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
							beatae optio.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="pages/single-news.php">
							<div class="latest-news-bg news-bg-1"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="pages/single-news.php">KuehRaye Unveils Exclusive Eid al-Adha Delights:
									Experience
									the Perfect Blend of Tradition and Innovation</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">As the joyous occasion of Eid al-Adha approaches, KuehRaye, the renowned
								purveyor of delectable traditional treats, has unveiled an exclusive range of Eid
								al-Adha delights that promise to captivate taste buds and celebrate the essence of this
								auspicious festival.</p>
							<a href="pages/single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="pages/single-news.php">
							<div class="latest-news-bg news-bg-2"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="pages/single-news.php">Celebrating Ramadan with KuehRaye's Irresistible Kueh
									Raya:
									Elevate Your Festive Season with Exquisite Sweet Treats</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">As the holy month of Ramadan unfolds, KuehRaye, the esteemed purveyor of
								delectable traditional treats, is delighted to present their exquisite collection of
								Kueh Raya, specially curated to enhance the joy and sweetness of the festive season.</p>
							<a href="pages/single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href="pages/single-news.php">
							<div class="latest-news-bg news-bg-3"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="pages/single-news.php">Discover the Essence of Eid al-Adha with KuehRaye:
									Delight in
									Unforgettable Flavors and Celebrate the Joy of the Season</a></h3>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i> Admin</span>
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">KuehRaye, the esteemed purveyor of delectable traditional treats, invites
								you to embark on a culinary journey of taste and tradition with their limited edition
								Eid al-Adha collection.</p>
							<a href="pages/single-news.php" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="pages/news.php" class="boxed-btn">More News</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end latest news -->



	<!-- logo carousel -->


	<div class="logo-carousel-section">
		<div class="container">

			<center>
				<div class="section-title">
					<h3><span class="orange-text">Find Our Kueh</span>Raye Near You</h3>
				</div>
			</center>

			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="images/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="images/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="images/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="images/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="images/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Since our establishment in 2015, KuehRaye has steadily grown and evolved to become a trusted
							name in the world of "kuih". Our journey has been guided by a deep-rooted passion for
							delivering exceptional taste experiences and creating lasting memories.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>KuehRaye HQ:<br>123 Jalan Delima, Taman Perindustrian, Kuala Lumpur 50200, Malaysia</li>
							<li>support@kuehraye.com</li>
							<li>+60 1362 29954</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="pages/about.php">About</a></li>
							<li><a href="pages/shop.php">Shop</a></li>
							<li><a href="pages/news.php">News</a></li>
							<li><a href="pages/contact.php">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.php">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2023 - <b><span class="orange-text">KuehRaye</span></b>, All Rights Reserved.
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="js/sticker.js"></script>
	<!-- main js -->
	<script src="js/main.js"></script>

</body>

</html>