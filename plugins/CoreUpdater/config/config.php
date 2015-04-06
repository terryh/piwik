<?php

return array(
    'Piwik\Plugins\CoreUpdater\Updater' => DI\object()
        ->constructorParameter('tmpPath', DI\link('path.tmp')),

    'diagnostics.optional' => DI\add(array(
        DI\link('Piwik\Plugins\CoreUpdater\Diagnostic\HttpsUpdateCheck'),
    )),
);
