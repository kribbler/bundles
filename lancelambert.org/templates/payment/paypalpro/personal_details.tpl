<h3>{$lang->PERSONAL_DETAILS}</h3>
<table>
	<tr {if $error.firstname} class="error"{/if}>
		<th>{$lang->FIRSTNAME}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="firstname" class="text required" value="{$payment_input->firstname}" />
				{if $error.firstname}<div style="error_form_message">{$error.firstname}</div>{/if}
			</div>
		</td>
	</tr>
	
	<tr {if $error.lastname} class="error"{/if}>
		<th>{$lang->LASTNAME}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="lastname" class="text required" value="{$payment_input->lastname}" />
				{if $error.lastname}<div style="error_form_message">{$error.lastname}</div>{/if}
			</div>
		</td>
	</tr>
	
	<tr {if $error.phone} class="error"{/if}>
	
		<th>{$lang->PHONE}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="phone" class="text required" value="{$payment_input->phone}" />
				{if $error.phone}<div style="error_form_message">{$error.phone}</div>{/if}
			</div>
		</td>
	</tr>
	
	<tr {if $error.email} class="error"{/if}>
	
		<th>{$lang->EMAIL}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="email" class="text required email" value="{$payment_input->email}" />
				{if $error.email}<div style="error_form_message">{$error.email}</div>{/if}
			</div>
		</td>
	</tr>
	
</table>
