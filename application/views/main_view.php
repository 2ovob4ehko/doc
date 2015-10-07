<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><? echo $site_name;?> | <? echo $title;?></title>
		<link rel="stylesheet" href="<?=base_url()?>data/css/style.css" type="text/css" media="all" />
		<link rel="icon" href="<?=base_url()?>data/css/favicon.png" type="image/x-icon"/>
		<script src="<?=base_url()?>data/js/jquery.js" type="text/javascript"></script>
		<script src="<?=base_url()?>data/js/action.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="page">
			<div id="top_menu">
			<div id="logo"></div>
				<ul>
					<li><? echo $text_persons;?></li>
					<li><? echo $text_firms;?></li>
					<li onclick="location.href='/main/del_cookie';"><? echo $text_exit;?></li>
				</ul>
			</div>
			<div id="left_menu">
				<div><? echo $text_my_page;?></div>
				<div><? echo $text_chosen_persons;?></div>
				<div><? echo $text_chosen_firms;?></div>
				<div><? echo $text_messages;?></div>
				<div><? echo $text_settings;?></div>
			</div>
			<div id="data">
				<? echo $content;?>
			</div>
		</div>
	</body>
</html>
