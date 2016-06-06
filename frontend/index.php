
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="jdecastroc" />

	<!-- Stylesheets
	============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="style.min.css" type="text/css" />
	<link rel="stylesheet" href="css/swiper.css" type="text/css" />
	<link rel="stylesheet" href="css/dark.min.css" type="text/css" />
	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.min.css" type="text/css" />
	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="css/responsive.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<!-- Document Title
	============================================= -->
	<title>Everis - Gestor de curriculums</title>

</head>

<?php
	session_start();
  $lang = "es";
	$allowed = false;
	if (isset($_POST['usuario']) && isset($_POST['password'])){
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];
		$_SESSION["usuario"] = $usuario;
		$_SESSION["password"] = $password;
	}
  if(isset($_SESSION["usuario"]) && isset($_SESSION["password"]))
  {
			$usuario = $_SESSION["usuario"];
			$password = $_SESSION["password"];
			$db = mysqli_connect('hugofs.com','root','universal','everis_cv') or die('Error conectando al servidor de base de datos.');

			$query = "SELECT * FROM usuarios";
			$result = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($result)) {
				if (($usuario == $row['nombre']) && ($password ==  $row['password'])){
					$allowed = true;
					$nombre_db = $row['nombre'];
					$password_db = $row['password'];
					$permisos_db = $row['permisos'];
					$_SESSION["permisos"] = $permisos_db;
				}
			}
  }
?>

<body class="stretched side-header">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="no-sticky">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo" class="nobottomborder">
						<a href="index.php" class="standard-logo" data-dark-logo="img/logo-everis.png"><img src="img/logo-everis.png" alt="Everis logo"></a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu">
						<ul>
							<li class="current"><a href="index.php"><div>Índice</div></a></li>
							<li><a href="gestor.php"><div>Gestión de repositorio</div></a></li>
							<li><a href="buscador.php"><div>Búsqueda de CV</div></a></li>

							<?php
								if ($allowed && $permisos_db == "administrador") {
							?>
							<li><a href="usuarios.php"><div>Gestión de usuarios</div></a> <!-- Solo para administradores-->
							</li>
              <br><br>
							<?php } ?>
              <li><a href="index.html"><div>Ayuda</div></a></li>
              <li><a href="index.html"><div>Contacto</div></a></li>
						</ul>

					</nav><!-- #primary-menu end -->

					<div class="clearfix visible-md visible-lg">
						<a href="#" class="social-icon si-small si-borderless si-github">
							<i class="icon-github"></i>
              <i class="icon-github"></i>
						</a>
					</div>

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Content
		============================================= -->

		<section id="content">

			<div class="content-wrap">

				<div class="promo promo-full promo-border header-stick bottommargin-lg">
					<div class="container clearfix">
						<h3>Bienvenido al gestor de curriculums de Everis</h3>
						<span>Gestione los curriculums y ejecute búsquedas sobre los mismos para encontrar el personal adecuado para el puesto que necesita cubrir.</span>
					</div>
				</div>



				<div class="container clearfix">
					<?php
						if ($allowed) {
					?>
          <div class="widget clearfix">
            <div class="row">
              <div class="col_half bottommargin-sm">
                <div class="counter counter-small"><span data-from="1" data-to="20" data-refresh-interval="80" data-speed="2000" data-comma="true"></span></div>
                <h5 class="nobottommargin">Curriculums en el repositorio</h5>
              </div>

              <div class="col_half col_last bottommargin-sm">
                <div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
                <h5 class="nobottommargin">Búsquedas realizadas</h5>
              </div>
            </div>

          </div>

					<div class="col_full">
						<div>
							<h3>Noticias</h3>
              <h4>Gestión de curriculums versión 0.1</h4>
							<p>Liberada la última versión del gesto de curriculums de everis. A partir de ahora será posible filtrar las búsquedas para obtener resultados más precisos basados en las siguientes categorías: </p>
              <ul>
  							<li>Skill (herramientas o conocimientos de la persona).</li>
  							<li>Empresas (empresas en las que ha trabajado o realizado prácticas).</li>
  							<li>Experiencia (años de antigüedad en el mundo laboral).</li>
  							<li>Idiomas</li>
  						</ul>
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="col_full">
						<div>
							<h3>Usuario incorrecto</h3>
							<p>Usted no tiene acceso para ver esta página. Vuelva a la pantalla de acceso para entrar con el usuario proporcionado por el administrador del sistema.</p>
						</div>
					</div>
					<?php
					}
					?>
				</div>


			</div>

		</section><!-- #content end -->


	</div><!-- #wrapper end -->

	<!-- JavaScripts externos
	============================================= -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script type="text/javascript" src="js/functions.js"></script>

</body>
</html>