<? foreach ($dialogs as $item):?>
	<div class="post_element<?=$item->readed==0 ? ' noread' : ''?>" id="<?=$item->dialog_id?>">
		<div class="del"></div>
		<table class="dialog">
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
<script>
$(function(){
	$('#message_list').on('click','.del',function(){
		$.ajax({
			url: "/ajax/del_message/1/"+$(this).parent().attr('id'),
			cache: false
		});
	});
});
</script>
