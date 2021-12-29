<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Database\Live\OCI8;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

/**
 * @group DatabaseLive
 *
 * @internal
 */
final class CallStoredProcedureTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $refresh = true;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->db->DBDriver !== 'OCI8') {
            $this->markTestSkipped('Only OCI8 has its own implementation.');
        }
    }

    public function testCallPackageProcedure()
    {
        $result = 0;

        $this->db->storedProcedure('calculator.plus', [
            [
                'name'  => ':left',
                'value' => 2,
            ],
            [
                'name'  => ':right',
                'value' => 5,
            ],
            [
                'name'  => ':output',
                'value' => &$result,
            ],

        ]);

        $this->assertSame($result, '7');
    }

    public function testCallStoredProcedure()
    {
        $result = 0;

        $this->db->storedProcedure('plus', [
            [
                'name'  => ':left',
                'value' => 2,
            ],
            [
                'name'  => ':right',
                'value' => 5,
            ],
            [
                'name'  => ':output',
                'value' => &$result,
            ],

        ]);

        $this->assertSame($result, '7');
    }
}
