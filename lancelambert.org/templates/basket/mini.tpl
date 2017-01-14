<span>
	<img src="/resources/images/gist/header-cart-icon.png" alt="Basket">
	Cart:
{if !$smarty.session.basket}
	empty
{else}
	{assign var=basket value=$smarty.session.basket}
	{assign var=total value=$basket->GetTotals()}
	<a href="{$seourl->_("/Basket/View")}" title="View basket">{$total.quantity} item{if $total.quantity>1}s{/if}
{/if}
	[{$smarty.const.CURRENCY_SIGN}{$total.value*$vat_multiply|string_format:"%.2f"}]</a>
</span>
