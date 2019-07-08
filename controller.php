<?php
namespace Concrete\Package\CommunityStoreEventExample;

use Concrete\Core\Package\Package;
use Whoops\Exception\ErrorException;
use Concrete\Core\Support\Facade\Events;
use Concrete\Core\Support\Facade\Application;

class Controller extends Package {
    protected $pkgHandle = 'community_store_event_example';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '2.0';

    public function getPackageDescription() {
        return t("An example how to use Community Store events");
    }

    public function getPackageName() {
        return t("Community Store Event Example");
    }

    protected $pkgAutoloaderRegistries = [
        'src/CommunityStoreEventExample' => '\Concrete\Package\CommunityStoreEventExample',
    ];

    public function install() {
        $app = Application::getFacadeApplication();
        $installed = $app->make('Concrete\Core\Package\PackageService')->getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        }
        parent::install();
    }

    public function on_start() {
        $app = Application::getFacadeApplication();

        // orders
        $orderListener = $app->make('\Concrete\Package\CommunityStoreEventExample\Event\Order');
        Events::addListener('on_community_store_order', array($orderListener, 'orderPlaced'));
        Events::addListener('on_community_store_payment_complete', array($orderListener, 'orderPaymentComplete'));
        Events::addListener('on_community_store_order_status_update', array($orderListener, 'orderStatusUpdate'));

        // products
        $productListener = $app->make('\Concrete\Package\CommunityStoreEventExample\Event\Product');
        Events::addListener('on_community_store_product_add', array($productListener, 'productAdded'));
        Events::addListener('on_community_store_product_update', array($productListener, 'productUpdated'));
        Events::addListener('on_community_store_product_delete', array($productListener, 'productDeleted'));
        Events::addListener('on_community_store_product_duplicate', array($productListener, 'productDuplicated'));

        // products
        $cartListener = $app->make('\Concrete\Package\CommunityStoreEventExample\Event\Cart');
        Events::addListener('on_community_store_cart_action', array($cartListener, 'cartAction'));
        Events::addListener('on_community_store_cart_pre_add', array($cartListener, 'cartPreAdd'));
        Events::addListener('on_community_store_cart_post_add', array($cartListener, 'cartPostAdd'));
        Events::addListener('on_community_store_cart_pre_update', array($cartListener, 'cartPreUpdate'));
        Events::addListener('on_community_store_cart_post_update', array($cartListener, 'cartPostUpdate'));
        Events::addListener('on_community_store_cart_pre_remove', array($cartListener, 'cartPreRemove'));
        Events::addListener('on_community_store_cart_post_remove', array($cartListener, 'cartPostRemove'));
        Events::addListener('on_community_store_cart_pre_clear', array($cartListener, 'cartPreClear'));
        Events::addListener('on_community_store_cart_post_clear', array($cartListener, 'cartPostClear'));


    }


}