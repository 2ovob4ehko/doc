<div>
	<div id="form">
		<form action="/main/registr_action" method="post">
			<input class="el" type="hidden" name="film" value="<?=$this->uri->segment(3,0)?>">
			<input class="el" type="text" name="f_name" placeholder="<?=$text_f_name?>" maxlength="256" size="20"><br>
			<input class="el" type="text" name="s_name" placeholder="<?=$text_s_name?>" maxlength="256" size="20"><br>
			<input class="el" type="text" name="surname" placeholder="<?=$text_surname?>" maxlength="256" size="20"><br>
			<select class="el" name="blood">
				<option value="0"><?=$text_blood?></option>
				<? foreach ($blood as $item):?>
				<option value="<?=$item->id?>"><?=$item->name?></option>
				<? endforeach;?>
			</select><br>
			<select class="el" name="sex">
				<option value="0"><?=$text_sex?></option>
				<? foreach ($sex as $item):?>
				<option value="<?=$item->id?>"><?=${'text_'.$item->name}?></option>
				<? endforeach;?>
			</select><br>
			<input class="el" name="born" type="text" value="" id="datetimepicker" placeholder="<?=$text_born?>"><br>
			<input class="el" type="text" name="height" placeholder="<?=$text_height?>" maxlength="256" size="15"><?=$text_cm?><br>
			<input class="el" type="text" name="weight" placeholder="<?=$text_weight?>" maxlength="256" size="15"><?=$text_kg?><br>
			<select class="el" id="perentpicker" name="perents" multiple>
				<? foreach ($sex as $item):?>
				<option value="1" class="option_one" data-subtitle="maksym.holovchenko.1990" data-left="<img src='/data/photo/IMG_1303.JPG'>">Максим Миколайович Головченко</option>
				<? endforeach;?>
			</select><br>
			<input class="el" type="submit" value="<?=$text_submit?>">
		</form>
		<script>
			$.datetimepicker.setLocale('<?=$text_lang?>');
			$('#datetimepicker').datetimepicker({dayOfWeekStart:1,step:10,format:'Y-m-d H:i:s',});
			$(function(){
				$('#perentpicker').selectator({labels:{search: '<?=$text_parents?>'}});
			});
		</script>
	</div>
	<div>
		<div>
			<table style="font-size:13px;">
				<tr>
					<td rowspan="7"><div style="border:1px solid black;width:50px;height:66px;"></div></td>
					<td colspan="2">Максим Миколайович Головченко</td>
				</tr>
				<tr><td>Група крові:</td><td>0(I) Rh(+)</td></tr>
				<tr><td>Стать:</td><td>чоловіча</td></tr>
				<tr><td>Дата народження:</td><td>02.10.1990</td></tr>
				<tr><td>Зріст:</td><td>50 см.</td></tr>
				<tr><td>Вага:</td><td>5 кг.</td></tr>
				<tr><td>Батьки:</td><td>Ірина Валентинівна Головченко (Чернешенко),<br> Микола Іванович Головченко</td></tr>
			</table>
		</div>
		<div>
			<table style="font-size:13px;">
				<tr>
					<td rowspan="7"><div style="border:1px solid black;width:50px;height:66px;"></div></td>
					<td colspan="2">Максим Миколайович Головченко</td>
				</tr>
				<tr><td>Група крові:</td><td>0(I) Rh(+)</td></tr>
				<tr><td>Стать:</td><td>чоловіча</td></tr>
				<tr><td>Дата народження:</td><td>02.10.1990</td></tr>
				<tr><td>Зріст:</td><td>50 см.</td></tr>
				<tr><td>Вага:</td><td>5 кг.</td></tr>
				<tr><td>Батьки:</td><td>Ірина Валентинівна Головченко (Чернешенко),<br> Микола Іванович Головченко</td></tr>
			</table>
		</div>

	</div>
</div>
