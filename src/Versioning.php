<?php
/**
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/orchestra-io/versioning/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@orchestra.io so we can send you a copy immediately.
 */

namespace orchestra;

/**
 * This class allows developers to rapidly include versioning for static
 * assets in any of their frameworks. It is not made to be elegant or cover
 * every single possible range of possibilities but rather allow developers
 * to have a rapid, locally cached access to the version of their choice.
 *
 * It is important to note that the local cache is on a per-request basis.
 *
 * Usage example:
 *
 * <code>
 * <?php
 *     require 'Orchestra/Versioning.php';
 *
 *     // Automatic echo with ::version
 *     orchestra\Versioning::version('some');
 *
 *     // Non-automatic (you have to explicitely call echo)
 *     echo orchestra\Versioning::version('some');
 *
 *     // No cache with implicit echo call.
 *     orchestra\Versioning::version();
 *
 *     // Other version explicit echo call.
 *     echo orchestra\Versioning::get('last-release');
 * ?>
 * </code>
 *
 *
 * @license New BSD
 * @package orchestra
 * @link    http://github.com/orchestra-io/versioning
 * @link    http://orchestra.io
 * @version 0.1.2
 */
class Versioning
{
    /**
     * The static version of the file once it's been set.
     *
     * @var array A map of the existing versions for a request.
     *            if multiple versions are required, the map will contain
     *            a local cache for those versions.
     */
    protected static $_version = array();

    /**
     * No cache required. This varaible is used to hold the static
     * time() value when the nocache is invoked.
     *
     * @var string It contains the value of the *time()* call after
     *             its first instantiation.
     */
    protected static $_nocache = false;

    /**
     * This variable is used as the "static" version to use across
     * your application.
     *
     * @var string The static version to use.
     */
    protected static $_staticVersion = false;

    /**
     * Get a version.
     *
     * Get a version out of the local cache. If this version hasn't
     * been instantiated yet we instantiate it, cache it and use it.
     *
     * @param mixed $version Either a string, int, double, etc containing
     *                       a textual value of the version to use.
     *
     * @return string Returns the version requested or the value of "no_cache"
     *                which is a temporal value for the current time in our
     *                present dimension.
     */
    public static function get($version = false)
    {
        if ($version !== false && !isset(self::$_version[$version])) {
            self::$_version[$version] = $version;
        }

        return isset(self::$_version[$version]) ?
            self::$_version[$version] : self::nocache();
    }

    /**
     * Do not use a cached version.
     *
     * Even though this method is called <strong>nocache</strong> it is
     * theoretically possible that 2 requests will come at the same time
     * resulting in it being cached for a split second (until the next request).
     *
     * This aforementioned dual-cache issue is to prevent concurrent connection from
     * generating the same cache twice.
     *
     * @return string Returns the current time() value and caches it locally.
     */
    public static function nocache()
    {
        if (!self::$_nocache) {
            self::$_nocache = time();
        }

        return self::$_nocache;
    }

    /**
     * Set a certain version.
     *
     * This method is used to set a certain version across the board. By using
     * this method in conjunction with self::version() you are effectively removing
     * the ability to have various versions.
     *
     * If you really need a special version, you want to use orchestra\Versioning::get(...);
     *
     * @param string $version The static version to set.
     * @return void
     */
    public static function set($version = 'XXX')
    {
        self::$_version[$version] = $version;
        self::$_staticVersion = $version;
    }
    /**
     * Version.
     *
     * This method is merely a helper-function. It contains an implicit
     * <strong>echo</strong> call of the self::_get() method.
     *
     * @param mixed $version Either a string, int, double, etc containing
     *                       a textual value of the version to use.
     *
     * @return void
     */
    public function version($version = false, $static = false)
    {
        if ($version !== false && $static !== false) {
            self::$_version[$version] = $version;
            self::$_staticVersion = $version;
        }

        if ($version === false && self::$_staticVersion !== false) {
            echo self::$_staticVersion;
            return;
        }

        echo self::get($version);
    }
}
