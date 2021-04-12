<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita11568009b70b4a7a4940499c86306d7
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SkyVerge\\WooCommerce\\Checkout_Add_Ons\\' => 38,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SkyVerge\\WooCommerce\\Checkout_Add_Ons\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita11568009b70b4a7a4940499c86306d7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita11568009b70b4a7a4940499c86306d7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}