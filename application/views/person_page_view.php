<table>
	<tr>
		<td style="width:150px;">
			<img id="photo" src="data/photo/imgres.jpg">
		</td>
		<td>
			<div class="data_container">
				<h4><b><?=$text_own_data?></b></h4>
				<table>
					<tr>
						<td class="data_name"><?=$text_f_name?>:</td>
						<td class="data_text"><?=$f_name?></td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_s_name?>:</td>
						<td class="data_text"><?=$s_name?></td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_surname?>:</td>
						<td class="data_text"><?=$surname?></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="data_name"><?=$text_born?>:</td>
						<td class="data_text"><?=Date("d.m.Y", strtotime($born))?></td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_sex?>:</td>
						<td class="data_text"><?=$sex?></td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_blood?>:</td>
						<td class="data_text"><?=$blood?></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="data_name"><?=$text_parents?>:</td>
						<td class="data_text"><a href="">Ірина Валентинівна Головченко (Чернешенко)</a>,<br> <a href="">Микола Іванович Головченко</a></td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="data_container">
				<h4><b><?=$text_own_data?></b></h4>
				<table>
					<tr>
						<td class="data_name"><?=$text_f_name?>:</td>
						<td class="data_text">Максим</td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_s_name?>:</td>
						<td class="data_text">Миколайович</td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_surname?>:</td>
						<td class="data_text">Головченко</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
