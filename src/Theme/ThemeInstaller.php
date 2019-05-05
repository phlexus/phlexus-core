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

        $directoryIterator = new RecursiveDirectoryIterator($themeAssets, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $asset) {
            $destination = $publicAssets . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            $exists = file_exists($destination);

            if ($asset->isDir()) {
                // Must be inside isDir() condition
                if (!$exists) {
                    mkdir($destination);
                }
            } else {
                // In case if file was updated
                if ($exists) {
                    unlink($destination);
                }

                copy($asset->getPathName(), $destination);
            }
        }
    }

    /**
     * Uninstall theme
     */
    public function uninstall(): void
    {
        $this->removeDirectory($this->assetsPath . DIRECTORY_SEPARATOR . $this->themeName);
        $this->removeDirectory($this->themePath);
    }

    /**
     * Remove theme directory
     *
     * Recursive removal of install theme directory
     *
     * @param string $path
     * @return void
     */
    protected function removeDirectory(string $path): void
    {
        $directoryIterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                rmdir($item->getRealPath());
            } else {
                unlink($item->getRealPath());
            }
        }

        rmdir($path);
    }
}
