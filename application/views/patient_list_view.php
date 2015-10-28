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
			<? foreach ($medic[$item->id] as $mitem):?>
			<tr>
				<td class="data_name"><?=${'text_'.$mitem->name}?>:</td>
				<td class="data_text"><?=$mitem->value?> (<?=Date("d.m.Y", strtotime($mitem->exam_date))?>)</td>
			</tr>
			<? endforeach;?>
			<tr>
				<td class="data_name"><?=$text_parents?>:</td>
				<td class="data_text">
					<? foreach ($perent[$item->id] as $pitem):?>
					<a href="" title="<?=$pitem->id?>"><?=$pitem->f_name?> <?=$pitem->s_name?> <?=$pitem->surname?><?=$pitem->priv_surname=='' ? '' : ' ('.$pitem->priv_surname.')'?></a>,<br>
				<? endforeach;?>
				</td>
			</tr>
		</table>
	</div>
<? endforeach;?>
