<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ab93b7998ecaf1d6cba95869d55fbd7
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2ab93b7998ecaf1d6cba95869d55fbd7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2ab93b7998ecaf1d6cba95869d55fbd7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2ab93b7998ecaf1d6cba95869d55fbd7::$classMap;

        }, null, ClassLoader::class);
    }
}
