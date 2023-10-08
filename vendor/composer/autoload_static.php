<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit58d858af3120b7de5ca1fdb3f9c8cb93
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit58d858af3120b7de5ca1fdb3f9c8cb93::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit58d858af3120b7de5ca1fdb3f9c8cb93::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit58d858af3120b7de5ca1fdb3f9c8cb93::$classMap;

        }, null, ClassLoader::class);
    }
}