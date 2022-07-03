<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6bfaf7fdc805986e0b2730dee5edb0a3
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Safasherinsulaiman\\Searchengine\\' => 32,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Safasherinsulaiman\\Searchengine\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit6bfaf7fdc805986e0b2730dee5edb0a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6bfaf7fdc805986e0b2730dee5edb0a3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6bfaf7fdc805986e0b2730dee5edb0a3::$classMap;

        }, null, ClassLoader::class);
    }
}
