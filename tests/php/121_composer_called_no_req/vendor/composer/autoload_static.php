<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita3c42f44640e06fb676c0805a84b0949
{
    public static $files = array (
        'cd06a75bf5ded1857b4f3942155e9b45' => __DIR__ . '/..' . '/vk/rpc/rpc121.php',
        'c23824722e5b5e3f0dc8519896d38952' => __DIR__ . '/..' . '/vk/strings/strings121.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInita3c42f44640e06fb676c0805a84b0949::$classMap;

        }, null, ClassLoader::class);
    }
}