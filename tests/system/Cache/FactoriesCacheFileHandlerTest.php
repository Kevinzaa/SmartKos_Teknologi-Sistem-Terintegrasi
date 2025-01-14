<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Cache;

use CodeIgniter\Cache\FactoriesCache\FileVarExportHandler;
use Config\Cache as CacheConfig;
use PHPUnit\Framework\Attributes\Group;

/**
 * @internal
 */
#[Group('Others')]
final class FactoriesCacheFileHandlerTest extends FactoriesCacheFileVarExportHandlerTest
{
    /**
     * @var CacheInterface|FileVarExportHandler
     */
    protected $handler;

    protected function createFactoriesCache(): void
    {
        $this->handler = CacheFactory::getHandler(new CacheConfig(), 'file');
        $this->cache   = new FactoriesCache($this->handler);
    }
}
