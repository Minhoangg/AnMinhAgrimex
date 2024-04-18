<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

use Closure;

class ComposerStaticInitc200905420e8f0f209b6e2dde9ed79b9 {
	public static $prefixLengthsPsr4 = array(
			'T' =>
					array(
							'TinhDev\\' => 8,
					),
	);

	public static $prefixDirsPsr4 = array(
			'TinhDev\\' =>
					array(
							0 => __DIR__ . '/../..' . '/src',
					),
	);

	public static $classMap = array(
			'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
	);

	public static function getInitializer( ClassLoader $loader ) {
		return Closure::bind( function () use ( $loader ) {
			$loader->prefixLengthsPsr4 = ComposerStaticInitc200905420e8f0f209b6e2dde9ed79b9::$prefixLengthsPsr4;
			$loader->prefixDirsPsr4    = ComposerStaticInitc200905420e8f0f209b6e2dde9ed79b9::$prefixDirsPsr4;
			$loader->classMap          = ComposerStaticInitc200905420e8f0f209b6e2dde9ed79b9::$classMap;

		}, null, ClassLoader::class );
	}
}
