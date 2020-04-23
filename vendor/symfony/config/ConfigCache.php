<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5ea00cc67502b\Symfony\Component\Config;

use _PhpScoper5ea00cc67502b\Symfony\Component\Config\Resource\SelfCheckingResourceChecker;
/**
 * ConfigCache caches arbitrary content in files on disk.
 *
 * When in debug mode, those metadata resources that implement
 * \Symfony\Component\Config\Resource\SelfCheckingResourceInterface will
 * be used to check cache freshness.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Matthias Pigulla <mp@webfactory.de>
 */
class ConfigCache extends \_PhpScoper5ea00cc67502b\Symfony\Component\Config\ResourceCheckerConfigCache
{
    private $debug;
    /**
     * @param string $file  The absolute cache path
     * @param bool   $debug Whether debugging is enabled or not
     */
    public function __construct($file, $debug)
    {
        $this->debug = (bool) $debug;
        $checkers = [];
        if (\true === $this->debug) {
            $checkers = [new \_PhpScoper5ea00cc67502b\Symfony\Component\Config\Resource\SelfCheckingResourceChecker()];
        }
        parent::__construct($file, $checkers);
    }
    /**
     * Checks if the cache is still fresh.
     *
     * This implementation always returns true when debug is off and the
     * cache file exists.
     *
     * @return bool true if the cache is fresh, false otherwise
     */
    public function isFresh()
    {
        if (!$this->debug && \is_file($this->getPath())) {
            return \true;
        }
        return parent::isFresh();
    }
}