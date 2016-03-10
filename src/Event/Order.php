<?php
namespace Concrete\Package\CommunityStoreEventExample\Src\Event;

use Log;

class Order
{
    public function orderPlaced($event)
    {
        $order = $event->getCurrentOrder();
        // at this point $order can be used to fetch any details needed
        Log::addInfo('Order placed: #' . $order->getOrderID(). ' at ' . $order->getOrderDate()->format('Y-m-d H:i:s'));
    }
}
