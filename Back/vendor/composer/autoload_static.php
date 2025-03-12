<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc5c40b9019d2e57cf0410d88fff1a790
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'M' => 
        array (
            'Musielak\\Back\\' => 14,
            'Musielak\\App\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Musielak\\Back\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Back',
        ),
        'Musielak\\App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc5c40b9019d2e57cf0410d88fff1a790::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc5c40b9019d2e57cf0410d88fff1a790::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc5c40b9019d2e57cf0410d88fff1a790::$classMap;

        }, null, ClassLoader::class);
    }
}
