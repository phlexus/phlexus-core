<?php declare(strict_types=1);

namespace Phlexus\Theme;

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
            throw new ThemeException('Themes directory do not exists');
        }

        if (!is_dir($themesPath . DIRECTORY_SEPARATOR . $themeName)) {
            throw new ThemeException('Theme directory do not exists');
        }

        if (!is_dir($assetsPath)) {
            throw new ThemeException('Assets directory do not exists.');
        }

        $this->themeName = $themeName;
        $this->themesPath = $themesPath;
        $this->assetsPath = $assetsPath;
    }

    /**
     * Install theme
     */
    public function install()
    {
        $path = $this->themesPath . DIRECTORY_SEPARATOR . $this->themeName;
    }

    /**
     * Uninstall theme
     */
    public function uninstall()
    {

    }
}
