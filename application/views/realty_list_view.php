<? foreach ($realty as $item):?>
	<div class="post_element">
		<table>
			<tr>
				<td class="data_name"><?=$text_address?>:</td>
				<td class="data_text"><?=$item->address?></td>
			</tr>
			<tr>
				<td class="data_name"><?=$text_square?>:</td>
				<td class="data_text"><?=$item->square?></td>
			</tr>
			<tr>
				<td class="data_name"><?=$text_type?>:</td>
				<td class="data_text"><?=${'text_'.$item->name}?></td>
			</tr>
			<tr>
				<td class="data_name"><?=$text_rooms_quantity?>:</td>
				<td class="data_text"><?=$item->rooms?></td>
			</tr>
			<tr>
				<td class="data_name"><?=$text_date_create?>:</td>
				<td class="data_text"><?=Date("d.m.Y", strtotime($item->date))?></td>
			</tr>
			<tr>
				<td class="data_name"><?=$text_owner?>:</td>
				<td class="data_text"><?=$item->person?></td>
			</tr>
		</table>
	</div>
<? endforeach;?>
