<div class="post">
	<h2 class="title">Your store - control panel</h2>
	<div class="post_content">

		<table class="datatable">
			<tr>
				<th>ID</th>
				<th>{$lang->PRODUCT}</th>
				<th>{$lang->CREATED}</th>
				<th>{$lang->STATUS}</th>
				<th>Feedback</th>
				<th>{$lang->ACTION}</th>
			</tr>
			{foreach from=$orders item=order name=order_loop}
			<tr{if $smarty.foreach.order_loop.index%2} class="odd"{/if}>
				<td>{$order->id}</td>
				<td>
					{foreach from=$order->ProductCollectionObjects() item=product}
						{$product->product->name|truncate:30} x{$product->quantity}<br />
					{/foreach}
				</td>
				<td class="center">{$order->purchase_date|date_format:"%Y-%m-%d %H:%m"}</td>
				<td>{$order->GetStatus()} {$order->PayStatus()}</td>

				<td>
					{assign var=feedback value=$order->GetFeedback()}
					{if $feedback}
						{assign var=rate value=$feedback->RateToText()}
						<img src="/{if $rate=='POSITIVE'}resources/icons/silk/emoticon_happy.png{elseif $rate=='NEUTRAL'}resources/icons/silk/emoticon_tongue.png{elseif $rate=='NEGATIVE'}resources/icons/silk/emoticon_unhappy.png{/if}" />
						{if $feedback->comment}<span class="quiet">{$feedback->comment}</span>{/if}
					{elseif $order->GetStatus()=='Despatched'}
						<span class="quiet">Awaiting feedback...</span>
					{elseif $order->GetStatus()=='Cancelled'}
						<span class="quiet">Cancelled</span>
					{else}
						<span class="quiet">Not despatched.</span>
					{/if}
				</td>
				
				<td>
					<a href="/VendorOrder/View/{$order->id}">View</a>
				</td>
			</tr>
			{/foreach}
		</table>

	</div>
</div>
