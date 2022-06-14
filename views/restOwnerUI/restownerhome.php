<?php
session_start();
require '../../connection/dbase.php';

$year = date('Y');
$month = date('m');

$arrayMonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
$arrayMonthNum = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
$arrayMonthLength = count($arrayMonth);

$queryorder = "SELECT * from orderlist where year(OrderDate) = $year and month(OrderDate) = $month";
$resultorder = mysqli_query($con, $queryorder) or die(mysqli_error($con));
$countorder = mysqli_num_rows($resultorder);

$sum = 0; 
$totalSum = 0; 
$sumDay = 0;
$totalSumByDay = 0;
$sumAcc = 0;
$totalSumAcc = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Foody | Restaurant Owner </title>
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon.png">
	<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
	<link rel="stylesheet" href="../../vendor/chartist/css/chartist.min.css">
	<link href="../../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="../../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="../../css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body>

	<!--*******************
        Preloader start
    ********************-->
	<div id="preloader">
		<div class="sk-three-bounce">
			<div class="sk-child sk-bounce1"></div>
			<div class="sk-child sk-bounce2"></div>
			<div class="sk-child sk-bounce3"></div>
		</div>
	</div>
	<!--*******************
        Preloader end
    ********************-->

	<!--**********************************
        Main wrapper start
    ***********************************-->
	<div id="main-wrapper">

		<!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header">
			<a href="restownerhome.php" class="brand-logo">
				<img class="logo-abbr" src="../../images/logo.png" alt="">
				<img class="logo-compact" src="../../images/logo-text.png" alt="">
				<img class="brand-title" src="../../images/logo-text.png" alt="">
			</a>

			<div class="nav-control">
				<div class="hamburger">
					<span class="line"></span><span class="line"></span><span class="line"></span>
				</div>
			</div>
		</div>
		<!--**********************************
            Nav header end
        ***********************************-->

		<!--**********************************
            Header start
        ***********************************-->
		<div class="header">
			<div class="header-content">
				<nav class="navbar navbar-expand">
					<div class="collapse navbar-collapse justify-content-between">
						<div class="header-left">
							<div class="dashboard_bar">
								Dashboard
							</div>
						</div>
						<ul class="navbar-nav header-right">
							<li class="nav-item">
								<div class="input-group search-area d-xl-inline-flex d-none">
									<div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
									</div>
									<input type="text" class="form-control" placeholder="Search here...">
								</div>
							</li>
							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-toggle="dropdown">
									<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M22.75 15.8385V13.0463C22.7471 10.8855 21.9385 8.80353 20.4821 7.20735C19.0258 5.61116 17.0264 4.61555 14.875 4.41516V2.625C14.875 2.39294 14.7828 2.17038 14.6187 2.00628C14.4546 1.84219 14.2321 1.75 14 1.75C13.7679 1.75 13.5454 1.84219 13.3813 2.00628C13.2172 2.17038 13.125 2.39294 13.125 2.625V4.41534C10.9736 4.61572 8.97429 5.61131 7.51794 7.20746C6.06159 8.80361 5.25291 10.8855 5.25 13.0463V15.8383C4.26257 16.0412 3.37529 16.5784 2.73774 17.3593C2.10019 18.1401 1.75134 19.1169 1.75 20.125C1.75076 20.821 2.02757 21.4882 2.51969 21.9803C3.01181 22.4724 3.67904 22.7492 4.375 22.75H9.71346C9.91521 23.738 10.452 24.6259 11.2331 25.2636C12.0142 25.9013 12.9916 26.2497 14 26.2497C15.0084 26.2497 15.9858 25.9013 16.7669 25.2636C17.548 24.6259 18.0848 23.738 18.2865 22.75H23.625C24.321 22.7492 24.9882 22.4724 25.4803 21.9803C25.9724 21.4882 26.2492 20.821 26.25 20.125C26.2486 19.117 25.8998 18.1402 25.2622 17.3594C24.6247 16.5786 23.7374 16.0414 22.75 15.8385ZM7 13.0463C7.00232 11.2113 7.73226 9.45223 9.02974 8.15474C10.3272 6.85726 12.0863 6.12732 13.9212 6.125H14.0788C15.9137 6.12732 17.6728 6.85726 18.9703 8.15474C20.2677 9.45223 20.9977 11.2113 21 13.0463V15.75H7V13.0463ZM14 24.5C13.4589 24.4983 12.9316 24.3292 12.4905 24.0159C12.0493 23.7026 11.716 23.2604 11.5363 22.75H16.4637C16.284 23.2604 15.9507 23.7026 15.5095 24.0159C15.0684 24.3292 14.5411 24.4983 14 24.5ZM23.625 21H4.375C4.14298 20.9999 3.9205 20.9076 3.75644 20.7436C3.59237 20.5795 3.50014 20.357 3.5 20.125C3.50076 19.429 3.77757 18.7618 4.26969 18.2697C4.76181 17.7776 5.42904 17.5008 6.125 17.5H21.875C22.571 17.5008 23.2382 17.7776 23.7303 18.2697C24.2224 18.7618 24.4992 19.429 24.5 20.125C24.4999 20.357 24.4076 20.5795 24.2436 20.7436C24.0795 20.9076 23.857 20.9999 23.625 21Z" fill="#01ACA6" />
									</svg>
									<div class="pulse-css"></div>
								</a>
								<!-- Notifications -->
								<div class="dropdown-menu rounded dropdown-menu-right">
									<div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
										<ul class="timeline">
											<li>
												<div class="timeline-panel">
													<div class="media mr-2 media-primary">
														<i class="fa fa-home"></i>
													</div>
													<div class="media-body">
														<h6 class="mb-1">Reminder : Treatment Time!</h6>
														<small class="d-block">29 July 2020 - 02:26 PM</small>
													</div>
												</div>
											</li>
										</ul>
									</div>
									<a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>
								</div>
							</li>
							<li class="nav-item dropdown notification_dropdown">
								<a class="nav-link bell bell-link" href="javascript:void(0)">
									<svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M22.4605 3.84888H5.31688C4.64748 3.84961 4.00571 4.11586 3.53237 4.58919C3.05903 5.06253 2.79279 5.7043 2.79205 6.3737V18.1562C2.79279 18.8256 3.05903 19.4674 3.53237 19.9407C4.00571 20.4141 4.64748 20.6803 5.31688 20.6811C5.54005 20.6812 5.75404 20.7699 5.91184 20.9277C6.06964 21.0855 6.15836 21.2995 6.15849 21.5227V23.3168C6.15849 23.6215 6.24118 23.9204 6.39774 24.1818C6.5543 24.4431 6.77886 24.6571 7.04747 24.8009C7.31608 24.9446 7.61867 25.0128 7.92298 24.9981C8.22729 24.9834 8.52189 24.8863 8.77539 24.7173L14.6173 20.8224C14.7554 20.7299 14.918 20.6807 15.0842 20.6811H19.187C19.7383 20.68 20.2743 20.4994 20.7137 20.1664C21.1531 19.8335 21.4721 19.3664 21.6222 18.8359L24.8966 7.05011C24.9999 6.67481 25.0152 6.28074 24.9414 5.89856C24.8675 5.51637 24.7064 5.15639 24.4707 4.84663C24.235 4.53687 23.931 4.28568 23.5823 4.11263C23.2336 3.93957 22.8497 3.84931 22.4605 3.84888ZM23.2733 6.60304L20.0006 18.3847C19.95 18.5614 19.8432 18.7168 19.6964 18.8275C19.5496 18.9381 19.3708 18.9979 19.187 18.9978H15.0842C14.5856 18.9972 14.0981 19.1448 13.6837 19.4219L7.84171 23.3168V21.5227C7.84097 20.8533 7.57473 20.2115 7.10139 19.7382C6.62805 19.2648 5.98628 18.9986 5.31688 18.9978C5.09371 18.9977 4.87972 18.909 4.72192 18.7512C4.56412 18.5934 4.4754 18.3794 4.47527 18.1562V6.3737C4.4754 6.15054 4.56412 5.93655 4.72192 5.77874C4.87972 5.62094 5.09371 5.53223 5.31688 5.5321H22.4605C22.5905 5.53243 22.7188 5.56277 22.8353 5.62076C22.9517 5.67875 23.0532 5.76283 23.1318 5.86646C23.2105 5.97008 23.2642 6.09045 23.2887 6.21821C23.3132 6.34597 23.308 6.47766 23.2733 6.60304Z" fill="#01ACA6" />
										<path d="M7.84173 11.4233H12.0498C12.273 11.4233 12.4871 11.3347 12.6449 11.1768C12.8027 11.019 12.8914 10.8049 12.8914 10.5817C12.8914 10.3585 12.8027 10.1444 12.6449 9.98661C12.4871 9.82878 12.273 9.74011 12.0498 9.74011H7.84173C7.61852 9.74011 7.40446 9.82878 7.24662 9.98661C7.08879 10.1444 7.00012 10.3585 7.00012 10.5817C7.00012 10.8049 7.08879 11.019 7.24662 11.1768C7.40446 11.3347 7.61852 11.4233 7.84173 11.4233Z" fill="#01ACA6" />
										<path d="M15.4162 13.1066H7.84173C7.61852 13.1066 7.40446 13.1952 7.24662 13.3531C7.08879 13.5109 7.00012 13.725 7.00012 13.9482C7.00012 14.1714 7.08879 14.3855 7.24662 14.5433C7.40446 14.7011 7.61852 14.7898 7.84173 14.7898H15.4162C15.6394 14.7898 15.8535 14.7011 16.0113 14.5433C16.1692 14.3855 16.2578 14.1714 16.2578 13.9482C16.2578 13.725 16.1692 13.5109 16.0113 13.3531C15.8535 13.1952 15.6394 13.1066 15.4162 13.1066Z" fill="#01ACA6" />
									</svg>
									<div class="pulse-css"></div>
								</a>
							</li>

							<li class="nav-item dropdown header-profile">
								<a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
									<img src="../../images/profile/17.jpg" width="20" alt="" />
									<div class="header-info">
										<span class="text-black"><strong><?php echo $_SESSION["username"]; ?></strong></span>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a href="./restownerprofile.php" class="dropdown-item ai-icon">
										<svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
										<span class="ml-2">Profile </span>
									</a>
									<a href="../../views/page-login.php" class="dropdown-item ai-icon">
										<svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
											<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
											<polyline points="16 17 21 12 16 7"></polyline>
											<line x1="21" y1="12" x2="9" y2="12"></line>
										</svg>
										<span class="ml-2">Logout </span>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

		<!--**********************************
            Sidebar start
        ***********************************-->
		<div class="deznav">
			<div class="deznav-scroll">
				<ul class="metismenu" id="menu">
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="restownerhome.php">Dashboard</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-user-3"></i>
							<span class="nav-text">Profile</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="restownerprofile.php">Profile</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fi-rr-book-alt"></i>
							<span class="nav-text">Menu</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="restownermenu.php">Menu</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="fi fi-rr-box"></i>
							<span class="nav-text">Order</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="restownerorder.php">Order</a></li>
						</ul>
					</li>
					<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notepad-2"></i>
							<span class="nav-text">Report</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="restownerreport.php">Report</a></li>
						</ul>
					</li>
				</ul>


			</div>
		</div>
		<!--**********************************
            Sidebar end
        ***********************************-->

		<!--**********************************
            Content body start
        ***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-6 col-xxl-12">
						<div class="row">
							<div class="col-sm-3">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-success mr-md-4 mr-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
													<g clip-path="url(#clip2)">
														<path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z" fill="#27BC48" />
														<path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" fill="#27BC48" />
													</g>
													<defs>
														<clipPath id="clip2">
															<rect width="40" height="40" fill="white" />
														</clipPath>
													</defs>
												</svg>

											</span>
											<div class="media-body">

												<p class="fs-14 mb-2">Number of orders in June</p>
												<span class="title text-black font-w600"><?php echo $countorder; ?></span>
											</div>
										</div>
									</div>
									<div class="effect bg-success"></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-secondary  mr-md-4 mr-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
													<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" fill="#A02CFA" />
												</svg>
											</span>
											<div class="media-body">
												<p class="fs-14 mb-2">Total Payment (Today)</p>
												<?php
												$todayDate = date('Y-m-d');
												$queryorderDay = "SELECT * from orderlist where OrderDate = '$todayDate'";
												$resultorderDay = mysqli_query($con, $queryorderDay) or die(mysqli_error($con));

												while ($row = mysqli_fetch_array($resultorderDay)) {
													$sumDay = $sumDay + $row['amountPaid'];
													$totalSumByDay = $totalSumByDay + ($row['amountPaid']);
												}
												?>
												<span class="title text-black font-w600">RM<?php echo $totalSumByDay; ?></span>
											</div>
										</div>
									</div>
									<div class="effect bg-secondary"></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-danger mr-md-4 mr-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
													<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" fill="#FF3282" />
												</svg>
											</span>
											<div class="media-body">
												<p class="fs-14 mb-2">Total Payment in <?php echo date('F') ?></p>
												<?php
												while ($row = mysqli_fetch_array($resultorder)) {
													$sum = $sum + $row['amountPaid'];
													$totalSum = $totalSum + ($row['amountPaid']);
												}
												?>
												<span class="title text-black font-w600">RM<?php echo $totalSum ?></span>
											</div>
										</div>
									</div>
									<div class="effect bg-danger"></div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="card avtivity-card">
									<div class="card-body">
										<div class="media align-items-center">
											<span class="activity-icon bgl-warning  mr-md-4 mr-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
													<path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z" fill="#FFBC11" />
												</svg>
											</span>
											<div class="media-body">
												<p class="fs-14 mb-2">Total Payment (Overall)</p>
												<?php
												$todayDate = date('Y-m-d');
												$queryorderAcc = "SELECT * from orderlist";
												$resultorderAcc = mysqli_query($con, $queryorderAcc) or die(mysqli_error($con));

												while ($row = mysqli_fetch_array($resultorderAcc)) {
													$sumAcc = $sumAcc + $row['amountPaid'];
													$totalSumAcc = $totalSumAcc + ($row['amountPaid']);
												}
												if ($totalSumAcc > 999 && $totalSumAcc <= 999999) {
													$totalGrandSum = floor($totalSumAcc / 1000) . 'K';
												} elseif ($totalSumAcc > 999999) {
													$totalGrandSum = floor($totalSumAcc / 1000000) . 'M';
												} else {
													$totalGrandSum = $totalSumAcc;
												}

												?>
												<span class="title text-black font-w600">RM<?php echo $totalGrandSum ?></span>
											</div>
										</div>
									</div>
									<div class="effect bg-warning"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="row">
							<div class="col-xl-8 col-lg-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Restaurant Performance For Last 7 days</h4>
									</div>
									<div class="card-body">
										<div id="linechart_profitday"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Menu Category</h4>
									</div>
									<div class="card-body">
										<div id="piechart_category"></div>
									</div>
								</div>
							</div>
							<div class="col-xl-12 col-lg-12 col-sm-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">Restaurant Performance in June</h4>
									</div>
									<div class="card-body">
										<div id="columnchart_material"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--**********************************
            Content body end
        ***********************************-->


	<!--**********************************
            Footer start
        ***********************************-->
	<?php include('../../views/footer.php'); ?>
	<!--**********************************
            Footer end
        ***********************************-->

	<!--**********************************
           CHART DASHBOARD AREA 
        ***********************************-->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Date', 'Profit (RM)', 'No. of orders'],

				<?php

				$queryWeekday = "SELECT DISTINCT OrderDate, month(OrderDate), day(OrderDate) FROM orderlist WHERE OrderDate BETWEEN DATE_SUB( CURDATE( ), INTERVAL 7 DAY ) AND CURDATE( ) order by OrderDate asc";
				$resultweekDay = mysqli_query($con, $queryWeekday) or die(mysqli_error($con));

				
				if (mysqli_num_rows($resultweekDay) > 0) {
					while ($row = mysqli_fetch_array($resultweekDay)) {
						$day = $row['OrderDate'];

						$sumTotal = 0;
						$totalSumTotal = 0;
						$queryCountOrderDay = "SELECT * from orderlist where OrderDate = '$day'";
						$resultCountOrderDay = mysqli_query($con, $queryCountOrderDay) or die(mysqli_error($con));
						$countOrderListDay = mysqli_num_rows($resultCountOrderDay);

						$date = "$day";
						$dateFullName = date('l', strtotime($date));
						$dateMonth = $row['month(OrderDate)'];
						$dateDay = $row['day(OrderDate)'];

						while ($row = mysqli_fetch_array($resultCountOrderDay)) {
							$sumTotal = $sumTotal + $row['amountPaid'];
							$totalSumTotal = $totalSumTotal + ($row['amountPaid']);
						}

				?>

						["<?php echo $dateFullName ?> <?php echo $dateDay . '/' . $dateMonth ?> ", <?php echo $totalSumTotal ?>, <?php echo $countOrderListDay ?>], <?php }
																																} ?>
			]);

			var view = new google.visualization.DataView(data);
			view.setColumns([0, 1, {
				calc: 'stringify',
				sourceColumn: 1,
				type: 'string',
				role: 'annotation'
			}, 2, {
				calc: 'stringify',
				sourceColumn: 2,
				type: 'string',
				role: 'annotation'
			}, ]);


			var options = {
				curveType: 'function',
				legend: {
					position: 'bottom'
				},
				pointSize: 5,
				crosshair: {
					trigger: 'both',
					color: 'red'
				},
				vAxis: {
					/*viewWindow:{
					    max:100,
					    min:0
					  },*/
					minValue: 0
				},
				//colors: ['#8bb4dd', '#44739b'],
				maxwidth: 550,
				height: 220,
				chartArea: {
					top: 20,
					bottom: 50,
					right: 50,
					left: 40
				},
			};

			var chart = new google.visualization.LineChart(document.getElementById('linechart_profitday'));

			chart.draw(view, options);
		}
	</script>

	<!-- PIE CHART FOR CATEGORY -->
	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['corechart']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {

			var data = google.visualization.arrayToDataTable([
				['Task', 'Hours per Day'],
				<?php
				$queryCategoryType = "SELECT * from menucategory where restaurantID = 1";
				$resultCategoryType = mysqli_query($con, $queryCategoryType) or die(mysqli_error($con));
				$countCategoryType = mysqli_num_rows($resultCategoryType);
				if (mysqli_num_rows($resultCategoryType) > 0) {
					while ($row = mysqli_fetch_array($resultCategoryType)) {
						$catID = $row["categoryID"];

						$querymenulist = "SELECT * from menulist where categoryID = $catID";
						$resultmenulist = mysqli_query($con, $querymenulist) or die(mysqli_error($con));
						$countmenulist = mysqli_num_rows($resultmenulist);

				?>['<?php echo $row['categoryName']; ?>', <?php echo $countmenulist ?>],
				<?php }
				} ?>
			]);

			var options = {
				legend: {
					position: 'bottom'
				},
			};

			var chart = new google.visualization.PieChart(document.getElementById('piechart_category'));

			chart.draw(data, options);
		}
	</script>

	<!-- Bar chart performance -->

	<script type="text/javascript">
		google.charts.load('current', {
			'packages': ['bar']
		});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Month', 'No. of orders'],

				<?php
				$monthDate = date('m');
				$yearDate = date('Y');
				$queryMonth = "SELECT DISTINCT OrderDate, month(OrderDate), day(OrderDate), year(OrderDate) FROM orderlist WHERE month(OrderDate) = $monthDate and year(OrderDate) = $yearDate order by day(OrderDate) asc";
				$resultMonth = mysqli_query($con, $queryMonth) or die(mysqli_error($con));

				if (mysqli_num_rows($resultMonth) > 0) {
					while ($row = mysqli_fetch_array($resultMonth)) {
						$day = $row['OrderDate'];

						$queryCountOrderDay1 = "SELECT *, day(OrderDate) from orderlist where OrderDate = '$day' order by day(OrderDate) desc";
						$resultCountOrderDay1 = mysqli_query($con, $queryCountOrderDay1) or die(mysqli_error($con));
						$countOrderListDay1 = mysqli_num_rows($resultCountOrderDay1);

						$date = "$day";
						$dateFullName = date('l', strtotime($date));
						$dateMonth = $row['month(OrderDate)'];
						$dateDay = $row['day(OrderDate)'];
						$dateYear = $row['year(OrderDate)'];
				?>['<?php echo $dateDay . '/' . $dateMonth ?>', <?php echo $countOrderListDay1 ?>], <?php }
																							} ?>
			]);

			var options = {
				chartArea: {
					width: '50%'
				},
				hAxis: {
					minValue: 0
				},
				maxwidth: 600,
				height: 350,
				chartArea: {
					top: 50,
					bottom: 80,
					right: 50,
					left: 200
				},
				legend: {
					position: "bottom"
				},

			};

			var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

			chart.draw(data, google.charts.Bar.convertOptions(options));
		}
	</script>


	<!--**********************************
           CHART DASHBOARD AREA END
        ***********************************-->


	</div>
	<!--**********************************
        Main wrapper end
    ***********************************-->

	<!--**********************************
        Scripts
    ***********************************-->
	<!-- Required vendors -->
	<script src="../../vendor/global/global.min.js"></script>
	<script src="../../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="../../vendor/chart.js/Chart.bundle.min.js"></script>
	<script src="../../js/custom.min.js"></script>
	<script src="../../js/deznav-init.js"></script>
	<script src="../../vendor/owl-carousel/owl.carousel.js"></script>

	<!-- Chart piety plugin files -->
	<script src="../../vendor/peity/jquery.peity.min.js"></script>

	<!-- Apex Chart -->
	<script src="../../vendor/apexchart/apexchart.js"></script>

	<!-- Dashboard 1 -->
	<script src="../../js/dashboard/dashboard-1.js"></script>
	<script>
		function carouselReview() {
			/*  testimonial one function by = owl.carousel.js */
			jQuery('.testimonial-one').owlCarousel({
				loop: true,
				autoplay: true,
				margin: 30,
				nav: false,
				dots: false,
				left: true,
				navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
				responsive: {
					0: {
						items: 1
					},
					484: {
						items: 2
					},
					882: {
						items: 3
					},
					1200: {
						items: 2
					},

					1540: {
						items: 3
					},
					1740: {
						items: 4
					}
				}
			})
		}
		jQuery(window).on('load', function() {
			setTimeout(function() {
				carouselReview();
			}, 1000);
		});
	</script>
</body>

</html>