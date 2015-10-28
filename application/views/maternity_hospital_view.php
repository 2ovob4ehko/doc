<div>
	<div id="form">
		<form id="regForm" action="/main/registr_action" method="post" enctype="multipart/form-data">
			<input class="el" type="hidden" name="firm" value="<?=$this->uri->segment(3,0)?>">
			<input class="el" type="text" name="f_name" placeholder="<?=$text_f_name?>" maxlength="256" size="20"><br>
			<input class="el" type="text" name="s_name" placeholder="<?=$text_s_name?>" maxlength="256" size="20"><br>
			<input class="el" type="text" name="surname" placeholder="<?=$text_surname?>" maxlength="256" size="20"><br>
			<select class="el" name="blood">
				<option value="0"><?=$text_blood?></option>
				<? foreach ($blood as $item):?>
				<option value="<?=$item->id?>"><?=$item->name?></option>
				<? endforeach;?>
			</select><br>
			<select class="el" name="sex">
				<option value="0"><?=$text_sex?></option>
				<? foreach ($sex as $item):?>
				<option value="<?=$item->id?>"><?=${'text_'.$item->name}?></option>
				<? endforeach;?>
			</select><br>
			<input class="el" name="born" type="text" value="" id="datetimepicker" placeholder="<?=$text_born?>"><br>
			<input class="el" type="text" name="height" placeholder="<?=$text_height?>" maxlength="256" size="15"><?=$text_cm?><br>
			<input class="el" type="text" name="weight" placeholder="<?=$text_weight?>" maxlength="256" size="15"><?=$text_kg?><br>
			<select class="el" id="perentpicker" name="perents[]" multiple>
				<? foreach ($person as $item):?>
				<option value="<?=$item->id?>" data-subtitle="<?=$item->login?>" data-left="<img src='/data/photo/<?=$item->photo=='' ? 'imgres.jpg' : $item->photo?>'>"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></option>
				<? endforeach;?>
			</select><br>
			<input class="el" type="submit" value="<?=$text_submit?>">
			<input class="el" type="reset" value="<?=$text_reset?>">
		</form>
		<script>
			$.datetimepicker.setLocale('<?=$text_lang?>');
			$('#datetimepicker').datetimepicker({dayOfWeekStart:1,step:10,format:'Y-m-d H:i:s',});
			$(function(){
				$('#perentpicker').selectator({labels:{search: '<?=$text_parents?>'}});
				showPatient();
			});
			$("input[type='reset']").click(function(event){
				event.preventDefault();
				$(this).closest('form').get(0).reset();
				$('#perentpicker').selectator('refresh');
			});
			setInterval(function(){
				if($("input[name='f_name']").val()==''||$("input[name='s_name']").val()==''||$("input[name='surname']").val()==''||$("select[name='blood']").val()==0||$("select[name='sex']").val()==0||$("input[name='born']").val()==''||$("input[name='weight']").val()==''||$("input[name='height']").val()==''){
					$("input[type='submit']").attr('disabled','disabled');
				}else{
					$("input[type='submit']").removeAttr('disabled');
				}
			},500);
			var page=1;
			setInterval(function(){
				showPatient(page);
				if($("#data").height()-160>$("#data div").height()){
					page++;
				}
			},2000);
			function showPatient(p){
				$.ajax({
					url: "/ajax/patient_list/<?=$this->uri->segment(3,0)?>/3/"+p,
					cache: false,
					dataType: 'html',
					success: function(html){
						$('#patient_list').html(html);
					}
				});
			}
			$("#data").scroll(function(){
				var bufer=2;
				if(this.offsetHeight+this.scrollTop+bufer>=this.scrollHeight){
					page++;
				}
			});
		</script>
	</div>
	<div id="patient_list"></div>
</div>
