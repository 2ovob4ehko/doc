<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><? echo $site_name;?> | <? echo $autorisation;?></title>
		<link rel="stylesheet" href="<?=base_url()?>data/css/style.css" type="text/css" media="all" />
		<link rel="icon" href="<?=base_url()?>data/css/favicon.png" type="image/x-icon"/>
		<script src="<?=base_url()?>data/js/jquery.js" type="text/javascript"></script>
		<script src="<?=base_url()?>data/js/action.js" type="text/javascript"></script>
	</head>
	<body>
	<div class="page_title"><? echo $autorisation;?></div>
		<form method="POST" action="<?=base_url()?>main/author_action" enctype="multipart/form-data">
			<div id="author_pos">
				<div id="author">
					<table>
						<tr>
							<td><? echo $login;?></td><td><input style="width:100%" type="text" name="login"></td>
						</tr>
						<tr>
							<td><? echo $key;?></td><td><input type="file" name="key"></td>
						</tr>
						<tr>
							<td colspan="2" class="submit"><input type="submit" value="<? echo $log_in;?>"></td>
						</tr>
						<?if(!empty($error)){
						echo '
						<tr><td class="error" colspan="2">'.urldecode($error).'</td></tr>';
						}?>
					</table>
				</div>
			</div>
		</form>
	</body>
</html>
