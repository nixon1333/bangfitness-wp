<head>
	<?php $title = is_front_page() ? get_bloginfo('name') : get_the_title(); ?>
	<title><?php echo $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory') ?>/dist/fonts/1506-JVVEDJ.css">  
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory') ?>/dist/images/favicon.png">
	<meta property="og:url" content="<?php bloginfo('url') ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php bloginfo('name') ?>" />
	<meta property="og:description" content="<?php bloginfo('description') ?>" />
	<meta property="og:image" content="<?php bloginfo('stylesheet_directory') ?>/dist/images/bangfitness_fbshare.jpg" />

	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-65585288-1', 'auto');
		ga('send', 'pageview');

		(function (tos) {
			var poller = setInterval(function () {
				tos = (function (t) {
					return  t[0] == 50 ? (parseInt(t[1]) + 1) + ':00' : (t[1] || '0') + ':' + (parseInt(t[0]) + 10);
				})(tos.split(':').reverse());
				if (parseInt(tos.split(':')[0]) < 5) {
					ga('send', 'event', 'Time', 'Log', tos);
				} 
				else {
					clearInterval(poller);
				}
			}, 10000);
		})('00');
	</script>
	<script async src="//63199.tctm.co/t.js"></script>
	<script src="//load.sumome.com/" data-sumo-site-id="7c129023fc7c3d6a9b73e1c8864e29fba2266750a6083fb3b0bc8ab2cfb3ef25" async="async"></script>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');

	fbq('init', '973026292815760');
	fbq('track', "PageView");</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=973026292815760&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

	<?php wp_head(); ?>
</head>
