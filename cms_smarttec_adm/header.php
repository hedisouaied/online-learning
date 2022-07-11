<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php
			if ((isset($pagetitle))) {
				echo $pagetitle;
			}
			?></title>



	<?php
	if ((isset($pagetitle)) && ($pagetitle == "calendrier")) {
	?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
	<?php
	}
	?>
	<link rel="stylesheet" href="assets/plugin/select2/css/select2.min.css">
	
	<!-- Touch Spin -->
	<link rel="stylesheet" href="assets/plugin/touchspin/jquery.bootstrap-touchspin.min.css">
	<!-- Main Styles -->
	<link rel="stylesheet" href="assets/styles/style.min.css">
	<!-- Dropify -->

	<!-- Material Design Icon -->
	<link rel="stylesheet" href="assets/fonts/material-design/css/materialdesignicons.css">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="assets/plugin/sweet-alert/sweetalert.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="assets/plugin/datatables/media/css/jquery.dataTables.min.css">

	<!-- Percent Circle -->
	<link rel="stylesheet" href="assets/plugin/percircle/css/percircle.css">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="assets/plugin/chart/chartist/chartist.min.css">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="assets/plugin/fullcalendar/fullcalendar.print.css" media='print'>

	<!-- Color Picker -->
	<link rel="stylesheet" href="assets/color-switcher/color-switcher.min.css">


	<!-- Remodal -->
	<link rel="stylesheet" href="assets/plugin/modal/remodal/remodal.css">
	<link rel="stylesheet" href="assets/plugin/modal/remodal/remodal-default-theme.css">
	<!-- Jquery UI -->
	<link rel="stylesheet" href="assets/plugin/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="assets/plugin/jquery-ui/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="assets/plugin/jquery-ui/jquery-ui.theme.min.css">

	<link rel="stylesheet" href="assets/plugin/dropify/css/dropify.min.css">

	<link rel="stylesheet" href="assets/plugin/form-wizard/prettify.css">


	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


	<?php
	if ((isset($pagetitle)) && ($pagetitle == "calendrier")) {
	?>

		<script>
			$(document).ready(function() {
				var calendar = $('#calendar').fullCalendar({
					lang: 'fr',
					editable: true,
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month'
					},
					events: 'load.php?id=<?php echo $_GET['cal_id']; ?>',
					selectable: true,
					selectHelper: true,
					select: function(start, end, allDay) {
						var title = prompt("Entrer le titre de session");
						if (title) {
							var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
							var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
							$.ajax({
								url: "insert.php?id=<?php echo $_GET['cal_id']; ?>",
								type: "POST",
								data: {
									title: title,
									start: start,
									end: end
								},
								success: function(data) {
									calendar.fullCalendar('refetchEvents');
									alert("Session ajoutée avec succès");
								}
							})
						}
					},
					editable: true,
					eventResize: function(event) {
						var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
						var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
						var title = event.title;
						var id = event.id;
						$.ajax({
							url: "update.php",
							type: "POST",
							data: {
								title: title,
								start: start,
								end: end,
								id: id
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert('Session modifiée');
							}
						})
					},

					eventDrop: function(event) {
						var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
						var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
						var title = event.title;
						var id = event.id;
						$.ajax({
							url: "update.php",
							type: "POST",
							data: {
								title: title,
								start: start,
								end: end,
								id: id
							},
							success: function() {
								calendar.fullCalendar('refetchEvents');
								alert("Session modifiée");
							}
						});
					},

					eventClick: function(event) {
						if (confirm("Vous êtes sûre de supprimer cette session?")) {
							var id = event.id;
							$.ajax({
								url: "delete.php",
								type: "POST",
								data: {
									id: id
								},
								success: function() {
									calendar.fullCalendar('refetchEvents');
									alert("Session supprimée");
								}
							})
						}
					},

				});
			});
		</script>


		<style>
			.fc-day-grid-event .fc-time {
				display: none;

			}

			.fc-view-container *,
			.fc-view-container :after,
			.fc-view-container :before {
				color: white;
			}
		</style>
	<?php
	}
	?>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '.editor_yes'
		});
	</script>

	<style>
		.tox-notifications-container,
		.tox-statusbar__text-container {
			display: none !important;
		}
	</style>

</head>

<body>
	<div class="main-menu">
		<header class="header">
			<a href="dashboard.php" class="logo">SmartTec</a>
			<button type="button" class="button-close fa fa-times js__menu_close"></button>
		</header>
		<!-- /.header -->
		<div class="content">

			<div class="navigation">
				<ul class="menu js__accordion">
					<li class="">
						<a class="waves-effect" href="dashboard.php"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span></a>
					</li>
                    <li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-photo"></i><span>Sliders</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-slider.php">Ajout slider</a></li>
							<li><a href="liste-sliders.php">Liste sliders</a></li>

						</ul>

					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-shopping-cart"></i><span>Commandes</span><span class="menu-arrow fa fa-angle-down"></span><span class="notice notice-blue"><?php
																																																										$req_or_cm = "SELECT * FROM checkout";
																																																										$exec_or_cm = mysqli_query($conn, $req_or_cm);
																																																										$check_or_cm = mysqli_num_rows($exec_or_cm);
																																																										echo $check_or_cm;

																																																										?></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajou-commande.php">Ajouter une commande</a></li>
							<li><a href="list-orders.php">Afficher les commandes</a></li>
							<li><a href="list-orders-live.php">les commandes Direct</a></li>
						</ul>
					</li>
                    <li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-tag"></i><span>Coupons</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-coupon.php?do=add">Ajouter Coupon</a></li>
							<li><a href="liste-coupons.php">Liste Coupons</a></li>
						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-file"></i><span>Categories Docs</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="categorie_docs.php?do=add">Ajouter Categorie</a></li>
							<li><a href="categorie_docs.php">Afficher Categories</a></li>
						</ul>
					</li>


					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-file"></i><span>Packs Documentaires</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="formation_docs.php?do=add">Ajouter un Pack</a></li>
							<li><a href="formation_docs.php">Liste des Packs</a></li>

						</ul>
						<!-- /.sub-menu js__content -->
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-camera"></i><span>Categories E-learning</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajou-category.php">Ajouter Categorie</a></li>
							<li><a href="list-category.php">Afficher Categories</a></li>
						</ul>
						<!-- /.sub-menu js__content -->
					</li>


					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-camera"></i><span>Cours E-learning</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-cours.php">Ajouter Cours</a></li>
							<li><a href="liste-cours.php">Liste des Cours</a></li>

						</ul>
						<!-- /.sub-menu js__content -->
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Categories Live</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-categorie-live.php">Ajouter Categorie</a></li>
							<li><a href="list-category-live.php">Afficher Categories</a></li>
						</ul>
						<!-- /.sub-menu js__content -->
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-folder-multiple"></i><span>Formation Live</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-formation.php">Ajouter Formation</a></li>
							<li><a href="liste-formations.php">Liste des Formation</a></li>

						</ul>
						<!-- /.sub-menu js__content -->
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi fa fa-trophy"></i><span>Certificats</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajou-certificats.php">Ajout certificats</a></li>
							<li><a href="liste-certificats.php">Liste certificats E-learning</a></li>
							<li><a href="liste-certificats-direct.php">Liste certificats Direct</a></li>

						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi fa fa-user"></i><span>Utilisateurs</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-utilisateur.php">Ajout Utilisateur</a></li>
							<li><a href="users-list.php">Liste Utilisateurs</a></li>

						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-photo"></i><span>partenaires</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="partenaires.php">Ajout partenaires</a></li>
							<li><a href="liste-partenaires.php">Liste partenaires</a></li>

						</ul>

					</li>
					<li class="">
						<a class="waves-effect" href="list-services.php"><i class="menu-icon fa fa-code"></i><span>Services</span></a>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-users"></i><span>Nos clients</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="clients.php">Ajout clients</a></li>
							<li><a href="liste-clients.php">Liste clients</a></li>

						</ul>

					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi fa fa-user"></i><span>Admins</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-admin.php">Ajout Admin</a></li>
							<li><a href="admin-list.php">Liste Admins</a></li>

						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-building-o"></i><span>Equipe</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-equipe.php">Ajout Membre</a></li>
							<li><a href="equipe-list.php">Liste Membres</a></li>

						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-bullhorn"></i><span>Feedback</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="feedback.php">Ajout Feedback</a></li>
							<li><a href="feedback-list.php">Liste Feedback</a></li>

						</ul>
					</li>
					<li>
						<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-book"></i><span>Blogs</span><span class="menu-arrow fa fa-angle-down"></span></a>
						<ul class="sub-menu js__content">
							<li><a href="ajout-blog.php">Ajout Blog</a></li>
							<li><a href="blog-list.php">Liste Blogs</a></li>
							<li><a href="comentaires.php">Liste Commentaires</a></li>

						</ul>

					</li>
					
					<li class="">
						<a class="waves-effect" href="liste-message.php"><i class="menu-icon fa fa-envelope-o"></i><span>Liste De Messages</span></a>
					</li>
					
					<li class="">
						<a class="waves-effect" href="parametres.php"><i class="menu-icon fa fa-cog"></i><span>Parametres de site</span></a>
					</li>
					<li class="">
						<a class="waves-effect" href="about-us.php"><i class="menu-icon fa fa-info"></i><span>A propos</span></a>
					</li>





					<!-- /.menu js__accordion -->
				</ul>
				<!-- /.navigation -->
			</div>
			<!-- /.content -->
		</div>
	</div>
	<div class="fixed-navbar">
		<div class="pull-left">
			<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
			<h1 class="page-title"><?php
									if ((isset($pagetitle))) {
										echo $pagetitle;
									}
									?></h1>
			<!-- /.page-title -->
		</div>
		<!-- /.pull-left -->
		<div class="pull-right">
			<div class="ico-item">
				<a href="#" class="ico-item fa fa-search js__toggle_open" data-target="#searchform-header"></a>
				<form action="#" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="fa fa-search button-search" type="submit"></button></form>
				<!-- /.searchform -->
			</div>
			<!-- /.ico-item -->
			<div class="ico-item fa fa-arrows-alt js__full_screen"></div>
			<!-- /.ico-item fa fa-fa-arrows-alt -->
			<div class="ico-item toggle-hover js__drop_down ">


				<!-- /.toggle-content -->
			</div>
			<!-- /.ico-item -->
			<a href="liste-message.php" class="ico-item fa fa-envelope notice-alarm js__toggle_open"></a>
			<a href="#" class="ico-item pulse"><span class="ico-item fa fa-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a>
			<div class="ico-item">
				<img src="../uploads/avatars/unk.jpeg" alt="" class="ico-img">
				<ul class="sub-ico-item">
					<li><a href="#">Settings</a></li>
					<li><a class="" href="logout.php">Log Out</a></li>
				</ul>
				<!-- /.sub-ico-item -->
			</div>
			<!-- /.ico-item -->
		</div>
		<!-- /.pull-right -->
	</div>