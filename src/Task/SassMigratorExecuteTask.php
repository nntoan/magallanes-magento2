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
 *     - sass-migrator/execute { timeout: 300 }
 */
class SassMigratorExecuteTask extends AbstractTask
{
    public function getName()
    {
        return 'sass-migrator/execute';
    }

    public function getDescription()
    {
        return '[SASS] Migrator Execute';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        if ($this->isArm64Machine() === true) {
            $cmd = $this->buildCustomCommand('src/', 'sass-migrator division **/*.scss');

            $process = $this->runtime->runCommand(trim($cmd), $timeout);

            return $process->isSuccessful();
        }

        return true;
    }
}
