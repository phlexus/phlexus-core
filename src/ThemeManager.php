<?php declare(strict_types=1);

namespace Phlexus;

use Composer\Installer\PackageEvent;
use Phlexus\Theme\ThemeInstaller;

/**
 * Class ThemeManager
 *
 * Manager of themes. Installation and removal.
 *
 * @package Phlexus
 */
class ThemeManager
{
    /**
     * Themes directory located in root or project
     */
    public const THEMES_DIR = 'themes';

    /**
     * Assets for themes which must be publicly accessible
     */
    public const THEMES_ASSETS_DIR = 'public/assets/themes';

    /**
     * @param PackageEvent $event
     * @throws Theme\ThemeException
     */
    public static function install(PackageEvent $event): void
    {
        $package = $event->getOperation()->getPackage();
        $themesPath = __DIR__ . DIRECTORY_SEPARATOR . self::THEMES_DIR;
        var_dump($themesPath); exit;
        $publicPath = '';

        (new ThemeInstaller($package, $themesPath, $publicPath))->install();
    }

    public static function uninstall(PackageEvent $event): void
    {

    }
}
