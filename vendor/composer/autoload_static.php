<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9d10c5354a5909ef41bb7c20afeb012
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Adel\\Ffw\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Adel\\Ffw\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9d10c5354a5909ef41bb7c20afeb012::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9d10c5354a5909ef41bb7c20afeb012::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb9d10c5354a5909ef41bb7c20afeb012::$classMap;

        }, null, ClassLoader::class);
    }
}
