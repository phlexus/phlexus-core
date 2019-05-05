<?php declare(strict_types=1);

namespace Phlexus\Theme;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Class ThemeInstaller
 *
 * @package Phlexus\Theme
 */
class ThemeInstaller
{
    /**
     * Theme folder name
     *
     * @var string
     */
    protected $themeName;

    /**
     * Install Theme path
     *
     * @var string
     */
    protected $themePath;

    /**
     * Themes path
     *
     * @var string
     */
    protected $themesPath;

    /**
     * Assets path
     *
     * @var string
     */
    protected $assetsPath;

    /**
     * ThemeManager constructor.
     *
     * @param string $themeName
     * @param string $themesPath
     * @param string $assetsPath
     * @throws ThemeException
     */
    public function __construct(string $themeName, string $themesPath, string $assetsPath)
    {
        if (!is_dir($themesPath)) {
            throw new ThemeException('Themes directory do not exists: '. $themesPath);
        }

        $themePath = $themesPath . DIRECTORY_SEPARATOR . $themeName;
        if (!is_dir($themePath)) {
            throw new ThemeException('Theme directory do not exists: ' . $themePath);
        }

        if (!is_dir($assetsPath)) {
            throw new ThemeException('Assets directory do not exists: ' . $assetsPath);
        }

        $this->themeName = $themeName;
        $this->themePath = $themesPath . DIRECTORY_SEPARATOR . $themeName;
        $this->themesPath = $themesPath;
        $this->assetsPath = $assetsPath;
    }

    /**
     * Install theme
     */
    public function install(): void
    {
        $themeAssets = $this->themePath . DIRECTORY_SEPARATOR . 'assets';
        $publicAssets = $this->assetsPath . DIRECTORY_SEPARATOR . $this->themeName;

        if (!file_exists($publicAssets)) {
            mkdir($publicAssets);
        }

        $iterator = new RecursiveDirectoryIterator($themeAssets, RecursiveDirectoryIterator::SKIP_DOTS);
        $assets = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($assets as $asset) {
            if ($asset->isDir()) {
                mkdir($publicAssets . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($asset, $publicAssets . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }

    /**
     * Uninstall theme
     */
    public function uninstall(): void
    {
        $this->removeThemeDirectory($this->themePath);
    }

    /**
     * Remove theme directory
     *
     * Recursive removal of install theme directory
     *
     * @param string $path
     * @return void
     */
    protected function removeThemeDirectory(string $path): void
    {
        $files = glob($path . DIRECTORY_SEPARATOR . '*');
        foreach ($files as $file) {
            is_dir($file) ? $this->removeThemeDirectory($file) : unlink($file);
        }

        rmdir($path);
    }
}
