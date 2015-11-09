<table id="table_list">
	<tr id="table_title">
		<td><?=$text_realty?></td>
		<td><?=$text_ownership?></td>
		<td><?=$text_square?></td>
	</tr>
	<? foreach ($realty as $item):?>
	<tr class="table_data">
		<td><?=$item->realty_type?> <?=$item->address?></td>
		<td><?=$item->job_title?></td>
	</tr>
	<? endforeach;?>
</table>
