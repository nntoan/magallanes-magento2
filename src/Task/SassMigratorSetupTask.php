<?php
/**
 * NodeSassSetup.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Setup SASS Migrator
 *
 * on-deploy:
 *     - sass-migrator/setup { timeout: 300 }
 */
class SassMigratorSetupTask extends AbstractTask
{
    public function getName()
    {
        return 'sass-migrator/setup';
    }

    public function getDescription()
    {
        return '[SASS] Migrator Setup';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('/', 'npm i -g sass-migrator', true);

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
