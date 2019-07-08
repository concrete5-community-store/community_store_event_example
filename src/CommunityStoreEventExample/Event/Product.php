<?php
namespace Concrete\Package\CommunityStoreEventExample\Event;

use Log;

class Product
{
    public function productAdded($event)
    {
        $product = $event->getProduct();
        Log::addInfo('New Product created: ' . $product->getName());
    }

    public function productUpdated($event)
    {
        $product = $event->getProduct();
        $newProduct = $event->getNewProduct();
        Log::addInfo('Product updated. Product name was: ' . $product->getName().', now:' . $newProduct->getName());
    }

    public function productDeleted($event)
    {
        $product = $event->getProduct();
        Log::addInfo('Product deleted: ' . $product->getName());
    }

    public function productDuplicated($event)
    {
        $product = $event->getProduct();
        $newProduct = $event->getNewProduct();
        Log::addInfo('Product duplicated. Original product name: ' . $product->getName(). '. Duplicated to: '. $newProduct->getName());
    }
}
