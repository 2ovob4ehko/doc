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
