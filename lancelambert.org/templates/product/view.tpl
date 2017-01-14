<div class="post product">

	<div class="post_content product_view">

		{assign var=image value=$product->GetMainImage()}
		{if $image->id}
			<div class="image_holder">
				<a href="/Product/Image/0x0/{$image->id}/{$image->GetFilename()}" class="thickbox" alt="Zoom">
					<img src="/Product/Image/336x336/{$image->id}/{$image->GetFilename()}" title="{$image->title}" class="thickbox main_image" />

				
					<center>
					<div class="enlarge_image" style="margin-top: 5px;">
							<img src="/resources/images/gist/magnify.png" alt="Zoom" style="margin-bottom: -7px;" />
							<span style="color: white;">Enlarge Photo</span>
					</div>
					</center>
				</a>
			</div>
		{/if}

		<div>

			{if $product->price == 0}
				<h1 class="title">Model: {$product->name}</h1>
			{else}
				<h1 class="title">{$product->name}</h1>
				<h2>Model: {$product->upc}</h2>
			{/if}
			
			{if $product->condition}<div style="margin: 10px 0;"><strong>Condition:</strong> {$product->condition}</div>{/if}
			{if $product->style}<div style="margin: 10px 0;"><strong>Base Style:</strong> {$product->style}</div>{/if}
			{if $product->size}<div style="margin: 10px 0;"><strong>Size:</strong> {$product->size}</div>{/if}

			<div class="description">{$product->description|strip_tags|nl2br}</div>
			<br /> 
			
			{if $product->price == 0}
			<div class="inquire">
				<a href="/Contactus/Product/{$product->id}/{$product->name|escape:url}" title="Inquire about this product">Inquire about this product.</a>
			</div>
			{/if}
			
			<div style="width: 45%;">
				{if $product->price > 0}<center><h3 class="price">{$smarty.const.CURRENCY_SIGN}{$product->price*$vat_multiply|string_format:"%.2f"}</h3></center>{/if}

				{if $product->price > 0}
					<form action="/Basket/Add/{$product->id}" method="post" class="validate">
						
						{if $product->variants}
							<div class="variants">
							{foreach from=$product->variants item=variant name=variant_loop}
								{if $new_type!=$variant->type}
									{if !$smarty.foreach.variant_loop.first}</ul>{/if}
									{assign var=new_type value=$variant->type}
									<h5>{$new_type}</h5><ul>
								{/if}
								<li>
									<input type="radio" value="{$variant->id}" id="variant_{$variant->id}" name="variant_{$variant->type|replace:' ':'_'}"{if $variant->default} checked="checked"{/if} />
									<label for="variant_{$variant->id}"><strong>{$variant->name}</strong></label>
									<span>Price change: {if $variant->price_change>0}+{/if}{$smarty.const.CURRENCY_SIGN}{$variant->price_change*$vat_multiply|string_format:"%.2f"}</span>
								</li>
								{if $smarty.foreach.variant_loop.last}</ul>{/if}
							{/foreach}
							</div>
						{/if}
						
						{if $product->custom_text_length}
						<fieldset class="custom_text">
							<legend>Custom Text</legend>
							<label>{$product->custom_text_name}</label>
							<input type="text" class="required" style="padding: 2px 5px;{if $product->custom_text_length<10} width: {$product->custom_text_length}em;{/if}" name="custom_text" maxlength="{$product->custom_text_length}" />
							{if $product->custom_text_description}<p class="quiet">{$product->custom_text_description}</p>{/if}
						</fieldset>
						{/if}
						
						{if $product->custom_text2_length}
						<fieldset class="custom_text">
							<legend>Custom Text #2</legend>
							<label>{$product->custom_text2_name}</label>
							<input type="text" class="required" style="padding: 2px 5px;{if $product->custom_text2_length<10} width: {$product->custom_text2_length}em;{/if}" name="custom_text2" maxlength="{$product->custom_text2_length}" />
							{if $product->custom_text2_description}<p class="quiet">{$product->custom_text2_description}</p>{/if}
						</fieldset>
						{/if}
						
						{if $product->custom_text3_length}
						<fieldset class="custom_text">
							<legend>Custom Text #3</legend>
							<label>{$product->custom_text3_name}</label>
							<input type="text" class="required" style="padding: 2px 5px;{if $product->custom_text3_length<10} width: {$product->custom_text3_length}em;{/if}" name="custom_text3" maxlength="{$product->custom_text3_length}" />
							{if $product->custom_text3_description}<p class="quiet">{$product->custom_text3_description}</p>{/if}
						</fieldset>
						{/if}

						<div class="inquire">
							<input type="hidden" id="quantity" name="quantity" value="1" maxlength="10" />
							<img src="/resources/images/gist/cart-add-icon.png" alt="" onclick="return addProductToBasket({$product->id});" style="margin-bottom: -5px;" />
							<input type="submit" value="ADD TO CART" {*onclick="return addProductToBasket({$product->id});"*} style="font-size: 11px; color: #fff; padding: 0; border: none; background-color: transparent; cursor: pointer;" />
						</div>
						<center><a href="{$seourl->_("/Basket/View/")}" title="Your cart" class="view_cart_link">view cart</a></center>
					</form>
				{/if}
			<center><a href="#"><img src="/resources/images/gist/back-button.jpg" alt="Back" onclick="history.go(-1);" /></a></center>
			</div>
		</div>
		
		{if $product->images|@count > 1}
		<div style="clear: both;">
			{foreach from=$product->images item=image}
			
				{if $image!=$product->GetMainImage()}
				<div style="float: left; padding: 10px; margin: 10px;">
					<a href="/Product/Image/650x650/{$image->id}/{$image->GetFilename()}" class="thickbox">
						<img src="/Product/Image/100x100/{$image->id}/{$image->GetFilename()}" title="{$image->title}" />
					</a>
				</div>
				{/if}

			{/foreach}
			<div style="clear: both;"></div>
		</div>
		{/if}

		{if $related_products}
			<div class="hr" style="margin: 20px 0;"></div>
			
			<h3>Related products:</h3>
			{foreach from=$related_products item=product_mini}
				{include file="product/in_category_view.tpl"}
			{/foreach}
			<div style="clear: both;"></div>
		{/if}
	</div>
	
	<div style="clear: both;"></div>
</div>
<div class="post_close"></div>

<script type="text/javascript">
	jQuery('.validate').validate();
</script>
