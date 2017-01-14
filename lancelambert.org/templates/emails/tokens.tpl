Filibrary.com - Download instructions

Invoice / order number: {$order->id}
Date: {$smarty.now|date_format}



{foreach from=$tokens item=item name=token_loop}
{$smarty.foreach.token_loop.index+1}. {$item->product->name} - {$item->product_file->title} : {$item->token}

http://{$smarty.server.SERVER_NAME}/Product/Download/{$item->token}

{/foreach}



Thank you for shopping at http://www.filibrary.com