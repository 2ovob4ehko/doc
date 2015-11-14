<div>
	<div id="form">
		<form id="messageForm" action="/main/message_action" method="post">
			<select class="el" id="personpicker" name="person" style="width:300px;">
				<option value="0"><?=$text_recipient?><option>
				<? foreach ($person as $item):?>
				<option value="p<?=$item->id?>" data-subtitle="<?=$item->login?>" data-left="<img src='/data/photo/<?=$item->photo=='' ? 'imgres.jpg' : $item->photo?>'>"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></option>
				<? endforeach;?>
				<? foreach ($firm as $item):?>
				<option value="f<?=$item->id?>" data-subtitle="<?=$item->login?>" data-left="<img src='/data/logo/<?=$item->logo=='' ? 'logo_default.png' : $item->logo?>'>"><?=$item->name?></option>
				<? endforeach;?>
			</select><br>
			<textarea class="el" type="text" name="message" rows="4" cols="35" placeholder="<?=$text_message?>"></textarea><br>
			<input class="el" type="submit" value="<?=$text_submit?>">
			<input class="el" type="reset" value="<?=$text_reset?>">
		</form>
		<script>
			var chat=0;
			$("input[type='reset']").click(function(event){
				event.preventDefault();
				$(this).closest('form').get(0).reset();
				$('#personpicker').selectator('refresh');
			});
			setInterval(function(){
				if($("textarea[name='message']").val()==''||$("select[name='person']").val()==0){
					$("input[type='submit']").attr('disabled','disabled');
				}else{
					$("input[type='submit']").removeAttr('disabled');
				}
			},500);
			$(function(){
				$('#personpicker').selectator({labels:{search: '<?=$text_search?>'}});
				showDialogs(1);
				$('#message_list').on('click','.dialog',function(){
					showChat($(this).attr('id'));
				});
				$('#message_list').on('click','#back',function(){
					chat=0;
					showDialogs(page);
				});
			});
			function showDialogs(p){
				if(!chat){
					$.ajax({
						url: "/ajax/dialog_list/3/"+p,
						cache: false,
						dataType: 'html',
						success: function(html){
							$('#message_list').html(html);
						}
					});
				}
			}
			function showChat(d){
				chat=1;
				$.ajax({
					url: "/ajax/chat/"+d,
					cache: false,
					dataType: 'html',
					success: function(html){
						$('#message_list').html(html);
					}
				});
			}
			$("#data").scroll(function(){
				var bufer=2;
				if(this.offsetHeight+this.scrollTop+bufer>=this.scrollHeight){
					page++;
				}
			});
			page=1;
			setInterval(function(){
				showDialogs(page);
				if($("#data").height()-160>$("#data div").height()){
					page++;
				}
			},2000);
		</script>
	</div>
	<div id="message_list">Список повідомлень</div>
</div>
