<select class="el" id="realtypicker" name="realty" style="width:300px;">
  <option value="0"><?=$text_property?></option>
  <? foreach ($realty as $item):?>
  <option value="<?=$item->id?>" data-subtitle="<?=${'text_'.$item->property_type}?>, <?=${'text_'.$item->realty_type}?> (<?=$item->square?><?=$text_sq_m?>)"><?=$item->address?></option>
  <? endforeach;?>
</select>
<select class="el" id="property" name="property" style="width:300px;">
  <option value="0"><?=$text_ownership?></option>
  <? foreach ($property as $item):?>
    <option value="<?=$item->id?>"><?=${'text_'.$item->name}?></option>
  <? endforeach;?>
</select>
<input class="el" type="text" name="square" style="width:300px;" placeholder="<?=$text_square?>">
<script>
$(function(){
  $('#realtypicker').selectator({labels:{search: '<?=$text_search?>'}});
});
</script>
