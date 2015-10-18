<table id="table_list">
	<tr id="table_title">
		<td><?=$text_work_place?></td>
		<td><?=$text_job_title?></td>
		<td><?=$text_from_date?></td>
		<td><?=$text_to_date?></td>
	</tr>
	<? foreach ($work as $item):?>
	<tr class="table_data<?=$item->stop!=null ? ' old"' : ' click" onclick="location.href=\'/main/work_system/'.$item->firm_id.'\'"'?>>
		<td><?=$item->firm?></td>
		<td><?=$item->job_title?></td>
		<td><?=Date("d.m.Y", strtotime($item->start))?></td>
		<td><?=$item->stop==null ? '' : Date("d.m.Y", strtotime($item->stop))?></td>
	</tr>
	<? endforeach;?>
</table>
