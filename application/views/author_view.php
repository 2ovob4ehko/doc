	<div class="page_title"><? echo $autorisation;?></div>
		<form method="POST" action="<?=base_url()?>main/author_action" enctype="multipart/form-data">
			<div id="author_pos">
				<div id="author">
					<table>
						<tr>
							<td><? echo $login;?></td><td><input style="width:100%" type="text" name="login"></td>
						</tr>
						<tr>
							<td><? echo $key;?></td><td><input type="file" name="key"></td>
						</tr>
						<tr>
							<td colspan="2" class="submit"><input type="submit" value="<? echo $log_in;?>"></td>
						</tr>
						<?if(!empty($error)){
						echo '
						<tr><td class="error" colspan="2">'.urldecode($error).'</td></tr>';
						}?>
					</table>
				</div>
			</div>
		</form>
