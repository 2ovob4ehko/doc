<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Реєстрація</title>
		<link rel="stylesheet" href="<?=base_url()?>data/css/style.css" type="text/css" media="all" />
		<script src="<?=base_url()?>data/js/jquery.js" type="text/javascript"></script>
		<script src="<?=base_url()?>data/js/action.js" type="text/javascript"></script>
	</head>
	<body>
	<div class="page_title">Реєстрація</div>
		<form method="POST" action="<?=base_url()?>main/regist_action" enctype="multipart/form-data">
			<div id="author_pos">
				<div id="author">
					<table>
						<tr>
							<td>Логін</td><td><input id="login" type="text" name="login"></td>
						</tr>
						<tr>
							<td>Пароль</td><td><input id="pass" type="password" name="pass"></td>
						</tr>
						<tr>
							<td>Ім’я</td><td><input id="name" type="text" name="name"></td>
						</tr>
						<tr>
							<td>По-батькові</td><td><input id="secondname" type="text" name="secondname"></td>
						</tr>
						<tr>
							<td>Прізвище</td><td><input id="surname" type="text" name="surname"></td>
						</tr>
						<tr>
							<td>Стать</td><td>
								<select name="sex" id="sex">
									<? foreach($sex as $item): ?>
									<option value="<?=$item->id?>"><?=$item->name?></option>
									<? endforeach; ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Дата народження</td><td><input id="born" type="date" name="born"></td>
						</tr>
						<tr>
							<td>Фото</td><td><input type="file" name="photo"></td>
						</tr>
						<tr>
							<td colspan="2"><input id="send" type="submit" value="Відправити"></td>
						</tr>
						<?if(!empty($error)){
						echo '
						<tr><td class="error" colspan="2">'.urldecode($error).'</td></tr>';
						}?>
					</table>
				</div>
			</div>
		</form>
		<script>checkFields();</script>
	</body>
</html>