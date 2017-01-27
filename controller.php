<?php
namespace Concrete\Package\CommunityStoreEventExample;
use Package;
use Core;
use Events;
use Whoops\Exception\ErrorException;

class Controller extends Package {
    protected $pkgHandle = 'community_store_event_example';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '1.0';

    public function getPackageDescription() {
        return t("An example how to use Community Store events");
    }

    public function getPackageName() {
        return t("Community Store Event Example");
    }

    public function install() {
        $installed = Package::getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        }
        parent::install();
    }

    public function on_start() {
        // orders
        $orderlistener = Core::make('\Concrete\Package\CommunityStoreEventExample\Src\Event\Order');
        Events::addListener('on_community_store_order', array($orderlistener, 'orderPlaced'));
        Events::addListener('on_community_store_payment_complete', array($orderlistener, 'orderPaymentComplete'));
        Events::addListener('on_community_store_order_status_update', array($orderlistener, 'orderStatusUpdate'));

        // products
        $productlistener = Core::make('\Concrete\Package\CommunityStoreEventExample\Src\Event\Product');
        Events::addListener('on_community_store_product_add', array($productlistener, 'productAdded'));
        Events::addListener('on_community_store_product_update', array($productlistener, 'productUpdated'));
        Events::addListener('on_community_store_product_delete', array($productlistener, 'productDeleted'));
        Events::addListener('on_community_store_product_duplicate', array($productlistener, 'productDuplicated'));
    }


}