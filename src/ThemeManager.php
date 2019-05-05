<?php declare(strict_types=1);

namespace Phlexus;

use Phlexus\Theme\ThemeException;

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
     * ThemeManager constructor.
     *
     * @param string $themeName
     * @param string $themesPath
     * @throws ThemeException
     */
    public function __construct(string $themeName, string $themesPath)
    {
        if (is_dir($themesPath)) {
            throw new ThemeException('Themes directory do not exists');
        }

        if (is_dir($themesPath . DIRECTORY_SEPARATOR . $themeName)) {
            throw new ThemeException('Theme directory do not exists');
        }

        $this->themeName = $themeName;
        $this->themesPath = $themesPath;
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
