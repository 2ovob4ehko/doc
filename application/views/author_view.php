	<div class="page_title"><?=$text_autorisation?></div>
		<form method="POST" action="<?=base_url()?>main/author_action" enctype="multipart/form-data">
			<div id="author_pos">
				<div id="author">
					<table>
						<tr>
							<td><?=$text_login?></td><td><input style="width:100%" type="text" name="login"></td>
						</tr>
						<tr>
							<td><?=$text_key?></td><td><input type="file" name="key"></td>
						</tr>
						<tr>
							<td colspan="2" class="submit"><input type="submit" value="<?=$text_log_in?>"></td>
						</tr>
						<? if(!empty($error)):?>
						<tr><td class="error" colspan="2"><?=urldecode($error)?></td></tr>
						<? endif;?>
					</table>
				</div>
			</div>
		</form>
