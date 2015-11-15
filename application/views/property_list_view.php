<table id="table_list">
	<tr id="table_title">
		<td><?=$text_realty?></td>
		<td><?=$text_ownership?></td>
		<td><?=$text_square?></td>
	</tr>
	<? foreach ($realty as $item):?>
	<tr class="table_data">
		<td><div class="letter"><b style="color:#777;"><?=${'text_'.$item->realty_type}?>:</b> <?=$item->address?></div></td>
		<td><?=${'text_'.$item->property_type}?></td>
		<td><?=$item->square?> <?=$text_sq_m?></td>
	</tr>
	<? endforeach;?>
</table>
