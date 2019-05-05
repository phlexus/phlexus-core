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
     * Install Theme
     *
     * @param PackageEvent $event
     * @throws Theme\ThemeException
     */
    public static function install(PackageEvent $event): void
    {
        $package = $event->getOperation()->getPackage()->getName();
        if (!self::isThemePackage($package)) {
            return;
        }

        $themeName = self::parseThemeName($package);
        $themesPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_DIR;
        $publicPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_ASSETS_DIR;

        (new ThemeInstaller($themeName, $themesPath, $publicPath))->install();
    }

    /**
     * Update Theme
     *
     * @param PackageEvent $event
     * @throws Theme\ThemeException
     */
    public static function update(PackageEvent $event): void
    {
        $package = $event->getOperation()->getInitialPackage()->getName();
        if (!self::isThemePackage($package)) {
            return;
        }

        $themeName = self::parseThemeName($package);
        $themesPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_DIR;
        $publicPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_ASSETS_DIR;

        (new ThemeInstaller($themeName, $themesPath, $publicPath))->install();
    }

    /**
     * Uninstall Theme
     *
     * @param PackageEvent $event
     * @throws Theme\ThemeException
     */
    public static function uninstall(PackageEvent $event): void
    {
        $package = $event->getOperation()->getPackage()->getName();
        if (!self::isThemePackage($package)) {
            return;
        }

        $themeName = self::parseThemeName($package);
        $themesPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_DIR;
        $publicPath = getcwd() . DIRECTORY_SEPARATOR . self::THEMES_ASSETS_DIR;

        (new ThemeInstaller($themeName, $themesPath, $publicPath))->uninstall();
    }

    /**
     * Check if package is theme
     *
     * @param string $package
     * @return bool
     */
    final public static function isThemePackage(string $package): bool
    {
        return preg_match('/-theme$/', $package) === 1;
    }

    /**
     * Parse Theme name from Package name
     *
     * @param string $packageName
     * @return string
     */
    final public static function parseThemeName(string $packageName): string
    {
        return explode('/', $packageName)[1];
    }
}
