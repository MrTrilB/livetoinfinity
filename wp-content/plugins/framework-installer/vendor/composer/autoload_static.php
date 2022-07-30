<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf8b8d2ff3a6438e828090c87171d06ec
{
    public static $files = array (
        'b45b351e6b6f7487d819961fef2fda77' => __DIR__ . '/..' . '/jakeasmith/http_build_url/src/http_build_url.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Framework_Installer_Log_Refsites_Class' => __DIR__ . '/../..' . '/classes/class-log-refsites.php',
        'OTGS\\Toolset\\FrameworkInstaller\\Adapter\\WPML\\TM_ATE_AMS' => __DIR__ . '/../..' . '/application/adapter/wpml/tm_ate_ams.php',
        'OTGS\\Toolset\\FrameworkInstaller\\Adapter\\WordPress\\Options' => __DIR__ . '/../..' . '/application/adapter/wordpress/options.php',
        'Toolset_Framework_Installer' => __DIR__ . '/../..' . '/classes/installer.class.php',
        'Toolset_Framework_Installer_Ajax' => __DIR__ . '/../..' . '/classes/ajax.class.php',
        'Toolset_Framework_Installer_Configure' => __DIR__ . '/../..' . '/classes/configure_site.class.php',
        'Toolset_Framework_Installer_Dashboard' => __DIR__ . '/../..' . '/classes/dashboard.class.php',
        'Toolset_Framework_Installer_Download' => __DIR__ . '/../..' . '/classes/download.class.php',
        'Toolset_Framework_Installer_Finalize' => __DIR__ . '/../..' . '/classes/finalize_site.class.php',
        'Toolset_Framework_Installer_Import_Db' => __DIR__ . '/../..' . '/classes/import_db.class.php',
        'Toolset_Framework_Installer_Install_Step' => __DIR__ . '/../..' . '/classes/helper.class.php',
        'Toolset_Framework_Installer_Unpack' => __DIR__ . '/../..' . '/classes/unpack.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf8b8d2ff3a6438e828090c87171d06ec::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf8b8d2ff3a6438e828090c87171d06ec::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf8b8d2ff3a6438e828090c87171d06ec::$classMap;

        }, null, ClassLoader::class);
    }
}
