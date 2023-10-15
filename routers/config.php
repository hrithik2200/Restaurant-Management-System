<?php

require('stripe-php-master/init.php');


$publishableKey="pk_test_51HeJcnGsSKPXPn0AJHD9Ojb857KUW9tWlDTxnZ1JmLLo3662WVA8Sm2MBFHRGnRUZaFE1ZziYZxPLTeOWOGVfzKO00KpBf8cn9";
$secretKey="sk_test_51HeJcnGsSKPXPn0AM73UDzSh61vNQDwXfR8onvaH2wDccXO5vGpqJayIuJJbI1jXELD0a1jXFvab4B6T7EbCyaMT00cEqtu5N5";


\Stripe\Stripe::setApiKey($secretKey);
?>