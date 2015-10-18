<div>
	<div>
		<form action="/main/registr_action" method="post">
			<input type="hidden" name="film" value="<?=$this->uri->segment(3,0)?>">
			<input type="text" name="f_name" placeholder="<?=$text_f_name?>" maxlength="256" size="20"><br>
			<input type="text" name="s_name" placeholder="<?=$text_s_name?>" maxlength="256" size="20"><br>
			<input type="text" name="surname" placeholder="<?=$text_surname?>" maxlength="256" size="20"><br>
			<select>
				<option value="0"><?=$text_blood?></option>
				<option value="1">0(I) Rh(+)</option>
				<option value="2">A(II) Rh(+)</option>
			</select><br>
			<select>
				<option value="0"><?=$text_sex?></option>
				<option value="1">чоловіча</option>
				<option value="2">жіноча</option>
			</select><br>
			<input type="text" value="" id="datetimepicker"><br>
			<input type="submit" value="<?=$text_submit?>">
		</form>
		<script>
			$.datetimepicker.setLocale('<?=$text_lang?>');
			$('#datetimepicker').datetimepicker({dayOfWeekStart:1,step:10,format:'Y-m-d H:i:s',});
		</script>
	</div>
	<div>
		<div>
			Максим Миколайович Головченко<br>
			02.10.90<br>
			50 см. 5 кг.
		</div>
		<div>
			Максим Миколайович Головченко<br>
			02.10.90<br>
			50 см. 5 кг.
		</div>
	</div>
</div>
