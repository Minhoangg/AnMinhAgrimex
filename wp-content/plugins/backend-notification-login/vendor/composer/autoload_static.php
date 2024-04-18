<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8b5d134ede72555c6aefaaa52ef7370
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tino\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tino\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8b5d134ede72555c6aefaaa52ef7370::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8b5d134ede72555c6aefaaa52ef7370::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8b5d134ede72555c6aefaaa52ef7370::$classMap;

        }, null, ClassLoader::class);
    }
}
