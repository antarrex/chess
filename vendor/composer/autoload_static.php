<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb91083877f5fc61160b579c1241a18f2
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb91083877f5fc61160b579c1241a18f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb91083877f5fc61160b579c1241a18f2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}