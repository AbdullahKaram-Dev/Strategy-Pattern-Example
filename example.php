<?php


    interface ShippingInterface
    {
        public function __construct(array $transaction);
        public function shippingNow();
    }
    class BostaShipping implements ShippingInterface
    {
        protected $shippingSettings;
        protected $transaction;

        public function __construct(array $transaction)
        {
            $this->transaction      = $transaction;
        }

        public function shippingNow()
        {
            return 'bosta shipping now ....';
        }
    }
    class AramexShipping implements ShippingInterface
    {
        protected $shippingSettings;
        protected $transaction;

        public function __construct(array $transaction)
        {
            $this->transaction      = $transaction;
        }

        public function shippingNow()
        {
            return 'aramex shipping now ....';
        }
    }
    class ShippingFactory
    {
        protected $shipping;

        public function __construct(ShippingInterface $shipping)
        {
            $this->shipping = $shipping;
        }

        public function shippingNow()
        {
            return $this->shipping->shippingNow();
        }
    }
    class Shipping
    {
        public static function shippNow($method,$transcation)
        {
            return (new ShippingFactory(new $method($transcation)))->shippingNow();
        }
    }

    $request = [
      'Bosta' => 'BostaShipping',
      'Aramex' => 'AramexShipping'
    ];

    $transcation = [
        'id' => 2515,
        'price' => "500 EGP"
    ];
    $result1 = Shipping::shippNow($request['Bosta'],$transcation);
    dump($result1);


    $transcation = [
        'id' => 2515,
        'price' => "700 EGP"
    ];
    $result2 = Shipping::shippNow($request['Aramex'],$transcation);
    dd($result2);
