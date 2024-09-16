<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(''); ?></title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="manifest" href="/favicon/site.webmanifest">
    <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#000000">
    <meta name="theme-color" content="#000000">
    <!-- Favicon End -->

	<!-- Global site tag (gtag.js) - Google Ads: 966509594 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-966509594"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
      gtag('config', 'AW-966509594');
	</script>
	
	<!-- Event snippet for Submit lead form - Almost Friday conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
   <script>
		function gtag_report_conversion(url) {
		  var callback = function () {
			if (typeof(url) != 'undefined') {
			  window.location = url;
			}
		  };
		  gtag('event', 'conversion', {
			  'send_to': 'AW-966509594/Mwy1CI7_q5ECEJqI78wD',
			  'event_callback': callback
		  });
		  return false;
		}
    </script>
	
    <?php wp_head(); ?>
</head>
<?php
global $SVG;
?>
<body <?php body_class(); ?> >
<header id="header" class="header" >

    <div class="wrapper">

        <a class="logo" href="<?php echo get_home_url(); ?>">
            <?php echo $SVG['logo'] ?>
        </a>

        <div class="menu-wrap">
            <?php wp_nav_menu($args = array(
                'theme_location'  => 'right',
                'container_class' => 'menu-wrapper',
            )); ?>

            <?php wp_nav_menu($args = array(
                'theme_location'  => 'left',
                'container_class' => 'menu-wrapper',
            )); ?>
        </div>

        <div class="burger">
            <div class="liner">
                <svg class="ham" viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active')">
                    <path
                            class="line top"
                            d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
                    <path
                            class="line middle"
                            d="m 30,50 h 40" />
                    <path
                            class="line bottom"
                            d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
                </svg>
            </div>
        </div>

    </div>

</header>
