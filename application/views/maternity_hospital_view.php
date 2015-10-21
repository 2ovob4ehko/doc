<div>
	<div id="form">
		<form action="/main/registr_action" method="post">
			<input class="el" type="hidden" name="firm" value="<?=$this->uri->segment(3,0)?>">
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
				<? foreach ($person as $item):?>
				<option value="<?=$item->id?>" data-subtitle="<?=$item->login?>" data-left="<img src='/data/photo/<?=$item->photo=='' ? 'imgres.jpg' : $item->photo?>'>"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></option>
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
		<? foreach ($client as $item):?>
		<div class="post_element">
			<table>
				<tr>
					<td rowspan="7"><img src="/data/photo/<?=$item->photo=='' ? 'imgres.jpg' : $item->photo?>"></td>
					<td colspan="2" class="post_title"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_blood?>:</td>
					<td class="data_text"><?=$item->blood_name?></td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_sex?>:</td>
					<td class="data_text"><?=${'text_'.$item->sex_name}?></td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_born?>:</td>
					<td class="data_text"><?=Date("d.m.Y", strtotime($item->born))?></td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_height?>:</td>
					<td class="data_text">50 см.</td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_weight?>:</td>
					<td class="data_text">5 кг.</td>
				</tr>
				<tr>
					<td class="data_name"><?=$text_parents?>:</td>
					<td class="data_text">Ірина Валентинівна Головченко (Чернешенко),<br> Микола Іванович Головченко</td>
				</tr>
			</table>
		</div>
		<? endforeach;?>
	</div>
</div>
