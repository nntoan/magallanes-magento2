<?php
/**
 * MagepackSetup.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Generate Magepack bundle.
 *
 * on-deploy:
 *     - magepack/setup { timeout: 300 }
 */
class MagepackSetupTask extends AbstractTask
{
    public function getName()
    {
        return 'magepack/setup';
    }

    public function getDescription()
    {
        return '[Magepack] Set up';
    }

    public function execute()
    {
        $timeout = 300;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('/', 'npm i -g magepack', true);

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
