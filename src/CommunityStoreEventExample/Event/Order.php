<?php
namespace Concrete\Package\CommunityStoreEventExample\Event;

use Log;

class Order
{
    public function orderPlaced($event)
    {
        $order = $event->getOrder();
        // at this point $order can be used to fetch any details needed
        Log::addInfo('Order placed: #' . $order->getOrderID(). ' at ' . $order->getOrderDate()->format('Y-m-d H:i:s'));
    }

    public function orderStatusUpdate($event)
    {
        $order = $event->getOrder();
        $previousStatusHandle = $event->getPreviousStatusHandle();
        Log::addInfo('Order changed from: ' . $previousStatusHandle . ' to ' . $order->getStatusHandle());
    }

    public function orderPaymentComplete($event)
    {
        $order = $event->getOrder();
        Log::addInfo('Order payment complete. Transaction reference: ' . $order->getTransactionReference());
    }
}
