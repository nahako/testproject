<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ce7f313a2a27edcbb240b35d2c9cafb
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Webmozart\\Assert\\' => 17,
        ),
        'G' => 
        array (
            'GO\\' => 3,
        ),
        'C' => 
        array (
            'Cron\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Webmozart\\Assert\\' => 
        array (
            0 => __DIR__ . '/..' . '/webmozart/assert/src',
        ),
        'GO\\' => 
        array (
            0 => __DIR__ . '/..' . '/peppeocchi/php-cron-scheduler/src/GO',
        ),
        'Cron\\' => 
        array (
            0 => __DIR__ . '/..' . '/dragonmantank/cron-expression/src/Cron',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ce7f313a2a27edcbb240b35d2c9cafb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ce7f313a2a27edcbb240b35d2c9cafb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6ce7f313a2a27edcbb240b35d2c9cafb::$classMap;

        }, null, ClassLoader::class);
    }
}
