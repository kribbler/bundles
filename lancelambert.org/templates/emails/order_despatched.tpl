Hi {$order->customer_name}

{$vendor->name} has despatched your order ({$order->id}).

When you receive it you can leave your feedback by clicking link below
http://{$smarty.const.SITE_ADDRESS}/VendorFeedback/Leave/{$order->id}/{$order->GetFeedbackHash()}

Thank you for shopping at {$smarty.const.SITE_ADDRESS}
