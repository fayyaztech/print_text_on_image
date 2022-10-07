<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit72a7588f65bf9618ede70f9b6df7812f
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Fayyaztech\\PrintTextOnImage\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Fayyaztech\\PrintTextOnImage\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit72a7588f65bf9618ede70f9b6df7812f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit72a7588f65bf9618ede70f9b6df7812f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit72a7588f65bf9618ede70f9b6df7812f::$classMap;

        }, null, ClassLoader::class);
    }
}
