<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?=$text_site_name?> | <?=$title?></title>
		<link rel="stylesheet" href="<?=base_url()?>data/css/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="<?=base_url()?>data/css/jquery.datetimepicker.css" type="text/css" media="all" />
		<link rel="stylesheet" href="<?=base_url()?>data/css/fm.selectator.jquery.css" type="text/css" media="all" />
		<link rel="icon" href="<?=base_url()?>data/css/favicon.png" type="image/x-icon"/>
		<script src="<?=base_url()?>data/js/jquery.js" type="text/javascript"></script>
		<script src="<?=base_url()?>data/js/action.js" type="text/javascript"></script>
		<script src="<?=base_url()?>data/js/jquery.datetimepicker.full.js" type="text/javascript"></script>
		<!--https://github.com/FaroeMedia/selectator-->
		<script src="<?=base_url()?>data/js/fm.selectator.jquery.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="page">
			<div id="top_menu">
			<div id="logo"></div>
				<ul>
					<? if($title!=$text_autorisation):?>
						<li><?=$text_persons?></li>
						<li><?=$text_firms?></li>
						<li onclick="location.href='/main/del_cookie';"><?=$text_exit?></li>
					<? else:?>
						<li>
							<select onchange="location.href='/main/change_lang/'+this.options[this.selectedIndex].value">
								<option value=""><?=$text_select_language?></option>
								<option value="uk">UA</option>
								<option value="ru">RU</option>
								<option value="en">EN</option>
							</select>
						</li>
					<? endif;?>
				</ul>
			</div>
			<div id="left_menu">
				<? if($title!=$text_autorisation):?>
					<div onclick="location.href='/';"><?=$text_my_page?></div>
					<div onclick="location.href='/main/work_list';"><?=$text_my_work?></div>
					<div onclick="location.href='/';"><?=$text_my_property?></div>
					<div><?=$text_chosen_persons?></div>
					<div><?=$text_chosen_firms?></div>
					<div><?=$text_messages?></div>
					<div><?=$text_settings?></div>
				<? endif; ?>
			</div>
			<div id="data">
				<?=$content?>
			</div>
		</div>
	</body>
</html>
