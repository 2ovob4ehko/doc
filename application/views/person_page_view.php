<table>
	<tr>
		<td style="width:150px;">
			<img id="photo" src="data/photo/<?=$photo=='' ? 'imgres.jpg' : $photo?>">
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
						<td class="data_text"><?=$sex_name?></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="data_name"><?=$text_parents?>:</td>
						<td class="data_text">
							<? foreach ($perent as $item):?>
								<a href="" title="<?=$item->id?>"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></a>,<br>
							<? endforeach;?>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div class="data_container">
				<h4><b><?=$text_medic_data?></b></h4>
				<table>
					<tr>
						<td class="data_name"><?=$text_blood?>:</td>
						<td class="data_text"><?=$blood_name?></td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_height?>:</td>
						<td class="data_text">178</td>
					</tr>
					<tr>
						<td class="data_name"><?=$text_weight?>:</td>
						<td class="data_text">65</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
