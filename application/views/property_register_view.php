<div>
	<div>
		<button onclick="$('.form').css('display','none');$('#realtyForm').css('display','block');$('#personpicker').selectator({labels:{search: '<?=$text_search?>'}});"><?=$text_realty?></button>
		<button onclick="$('.form').css('display','none');$('#landForm').css('display','block');"><?=$text_land_plot?></button>
		<button onclick="$('.form').css('display','none');$('#transportForm').css('display','block');"><?=$text_transport?></button>
	</div>
	<div id="form">
		<form class="form" id="landForm">Форма Землі</form>
		<form class="form" id="transportForm">Форма транспорту</form>
		<form class="form" id="realtyForm" action="/main/realty_action" method="post">
			<input class="el" type="hidden" name="firm" value="<?=$this->uri->segment(3,0)?>">
			<textarea class="el" type="text" name="address" rows="4" cols="35" placeholder="<?=$text_address?>"></textarea><br>
			<input class="el" type="text" name="square" placeholder="<?=$text_square?>" maxlength="256" size="20"><br> <!--кому замінювати на крапку-->
			<select class="el" name="type">
				<option value="0"><?=$text_type?></option>
				<? foreach ($blood as $item):?>
				<option value="<?=$item->id?>"><?=$item->name?></option>
				<? endforeach;?>
			</select><br>
			<input class="el" type="text" name="rooms" placeholder="<?=$text_rooms_quantity?>" maxlength="256" size="20"><br>
			<input class="el" name="date" type="text" value="" id="datetimepicker" placeholder="<?=$text_date_create?>"><br>
			<select class="el" id="personpicker" name="persons">
				<option value="0"><?=$text_owner?><option>
				<? foreach ($person as $item):?>
				<option value="<?=$item->id?>" data-subtitle="<?=$item->login?>" data-left="<img src='/data/photo/<?=$item->photo=='' ? 'imgres.jpg' : $item->photo?>'>"><?=$item->f_name?> <?=$item->s_name?> <?=$item->surname?><?=$item->priv_surname=='' ? '' : ' ('.$item->priv_surname.')'?></option>
				<? endforeach;?>
			</select><br>
			<input class="el" type="submit" value="<?=$text_submit?>">
			<input class="el" type="reset" value="<?=$text_reset?>">
		</form>
		<script>
			$.datetimepicker.setLocale('<?=$text_lang?>');
			$('#datetimepicker').datetimepicker({dayOfWeekStart:1,timepicker:false,step:10,format:'Y-m-d',});
			$(function(){

				showPatient();
			});
			$("input[type='reset']").click(function(event){
				event.preventDefault();
				$(this).closest('form').get(0).reset();
				$('#personpicker').selectator('refresh');
			});
			setInterval(function(){
				if($("textarea[name='address']").val()==''||$("input[name='square']").val()==''||$("input[name='rooms']").val()==''||$("select[name='type']").val()==0||$("select[name='persons']").val()==0||$("input[name='date']").val()==''){
					$("input[type='submit']").attr('disabled','disabled');
				}else{
					$("input[type='submit']").removeAttr('disabled');
				}
			},500);
			/*var page=1;
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
			});*/
		</script>
	</div>
	<div id="patient_list"></div>
</div>
