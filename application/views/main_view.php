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
					<?
					if(isset($text_persons)){
						echo '<li>'.$text_persons.'</li>
						<li>'.$text_firms.'</li>
						<li onclick="location.href=\'/main/del_cookie\';">'.$text_exit.'</li>';
					}else{
						echo '<li>
							<select onchange="location.href=\''.base_url().'main/change_lang/\'+this.options[this.selectedIndex].value">
								<option value="">'.$text_select_language.'</option>
								<option value="uk">UA</option>
								<option value="ru">RU</option>
								<option value="en">EN</option>
							</select>
						</li>';
					}
					?>
				</ul>
			</div>
			<div id="left_menu">
				<?
				if(isset($text_my_page)){
					echo '<div>'.$text_my_page.'</div>
					<div>'.$text_chosen_persons.'</div>
					<div>'.$text_chosen_firms.'</div>
					<div>'.$text_messages.'</div>
					<div>'.$text_settings.'</div>';
				}
				?>
			</div>
			<div id="data">
				<? echo $content;?>
			</div>
		</div>
	</body>
</html>
