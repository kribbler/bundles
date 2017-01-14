<div class="post ui-widget ui-widget-content ui-corner-all">
	<h2 class="title">{if $module_edit}Module: '{$module_edit->name}' editing{else}New Module{/if}</h2>

	<div class="post_content">
		<form action="/ModuleAdmin/Edit/{$module_edit->id}" method="post">
			<table>
				<tr>
					<td>
						<div class="post_cell ui-widget ui-widget-content ui-corner-all">
							<label>Name</label>
							<br />
							<input class="textinput" type="text" name="name" value="{$module_edit->name}" maxlength="255" />

							<br />
							<br />
							<label>Content:</label>
							<br />
							<textarea cols="80" rows="10" name="params">{$module_edit->params}</textarea>

							{if $smarty.const.TINY_MCE}
								{include file="admin/tiny_mce.tpl"}
							{/if}
						</div>
					</td>
					<td style="padding-left: 10px;">
						<div class="post_cell ui-widget ui-widget-content ui-corner-all">
							<table>
								<tr>
									<td><label>Type:</label></td>
									<td>
										<select name="type">
											<option value="text" {if $module_edit->type=='text'}selected="selected"{/if}>Text</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label for="position">Postition:</label>
									</td>
									<td>
										<select name="position" id="position">
											<option value="">-- please select --</option>
											{foreach from=$positions item=position}
												<option value="{$position}"{if $position==$module_edit->position} selected="selected"{/if}>{$position}</option>
											{/foreach}
										</select>
									</td>
								</tr>
							</table>
						</div>
						
						{if $module_edit}
						<div class="post_cell ui-widget ui-widget-content ui-corner-all">
							<label for="locations">Locations:</label>
								{assign var=locations value=$module_edit->LocationCollection()}
								{if $locations}
									<table class="admin_table">
										<tr>
											<th>Location</th>
											<th></th>
										</tr>
									{foreach from=$locations item=location}
										<tr>
											<td>
												{if $location->url}
													{$location->url->artificial}
												{else}{strip}
													{if $location->controller}/{$location->controller}{else}/*{/if}
													{if $location->action}/{$location->action}{else}/*{/if}
													{if $location->params}/{$location->params}{else}/*{/if}
														
													{/strip}
												{/if}
											</td>
											<td>
												<a href="/ModuleAdmin/EditLocation/{$module_edit->id}/{$location->id}">Edit</a>
												<span> / </span>
												<a href="/ModuleAdmin/DeleteLocation/{$location->id}" onclick="return confirm('Do you really want to delete assignment?')">Delete</a>
											</td>
										</tr>
									{/foreach}
									</table>
								{else}
									<p>There are no locations assigned yet.</p>
								{/if}
							
							<p><a href="/ModuleAdmin/EditLocation/{$module_edit->id}" class="ui-state-default ui-corner-all"><img src="/resources/icons/mini/icon_wand.gif" alt="New Location" />New Location</a></p>

						</div>
						{/if}
					</td>
				</tr>
				
				<tr>
					<td colspan="2" style="padding-top: 10px;">
						<input type="submit" value="Save" class="submit ui-state-default ui-corner-all" style="font-size: 11px;" />
					</td>
				</tr>
			</table>

		</form>
	</div>
</div>

