<h3>Billing /Shipping Information</h3>
<table>
	<tr {if $error.address} class="error"{/if}>
		<th>{$lang->ADDRESS}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="address" class="text required" value="{$payment_input->address}" />
				{if $error.address}<div style="error_form_message">{$error.address}</div>{/if}
			</div>
		</td>
	</tr>

	<tr {if $error.city} class="error"{/if}>
		<th>{$lang->CITY}</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="city" class="text required" value="{$payment_input->city}" />
				{if $error.city}<div style="error_form_message">{$error.city}</div>{/if}
			</div>
		</td>
	</tr>

	<tr {if $error.county} class="error"{/if}>
		<th>State / Province</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="county" class="text required" value="{$payment_input->county}" />
				{if $error.country}<div style="error_form_message">{$error.county}</div>{/if}
			</div>
		</td>
	</tr>

	<tr {if $error.country} class="error"{/if}>
		<th>{$lang->COUNTRY}</th>
		<td>
			{if $payment_input->country}<img src="/resources/icons/flag/{$payment_input->country|lower}.png" alt="{$payment_input->country}" />{/if}
			<select name="country_dummy" class="countries" disabled="disabled">
				<option value="">-- {$lang->PLEASE_SELECT} --</option>
				{foreach from=$countries item=country}
					<option value="{$country->code}"{if $country->code==$payment_input->country} selected="selected"{/if} style="background: #fff url('/resources/icons/flag/{$country->code|lower}.png') center left no-repeat; padding-left: 20px;">{$country->name}</option>
				{/foreach}
			</select>
			{if $error.country}<div style="error_form_message">{$error.country}</div>{/if}
			<input type="hidden" name="country" value="{$payment_input->country}" />
		</td>
	</tr>

	<tr {if $error.postcode} class="error"{/if}>
		<th>Zip / Postal Code</th>
		<td>
			<div style="position: relative;">
				<input type="text" name="postcode_dummy" class="text required" value="{$payment_input->postcode}" disabled="disabled" />
				{if $error.postcode}<div style="error_form_message">{$error.postcode}</div>{/if}
				<input type="hidden" name="postcode" value="{$payment_input->postcode}" />
			</div>
		</td>
	</tr>

</table>
