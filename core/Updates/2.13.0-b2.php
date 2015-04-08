<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Updates;

use Piwik\Config;
use Piwik\Updates;

class Updates_2_13_0_b2 extends Updates
{
    static function update()
    {
        $pluginManager = \Piwik\Plugin\Manager::getInstance();

        try {
            $pluginManager->activatePlugin('Diagnostics');
        } catch(\Exception $e) {
        }
    }
}
