<? foreach ($messages as $item):?>
	<div class="post_element" title="<?=$item->dialog_id?>">
		<table>
			<tr>
				<td rowspan="2" style="width:50px;"><img src="/data/photo/<?=$logo[$item->id]=='' ? 'imgres.jpg' : $logo[$item->id]?>"></td>
				<td class="data_text" style="vertical-align:bottom;width:30%;font-weight:bold;"><?=$name[$item->id]?></td>
				<td rowspan="2" class="data_text" style="vertical-align:top;"><?=$item->text?></td>
			</tr>
			<tr>
				<td class="data_name" style="vertical-align:top;"><?=Date("d.m.Y H:i:s", strtotime($item->time))?></td>
			</tr>
		</table>
	</div>
<? endforeach;?>
