<?php
/**
 * InstallMediaToolTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Install NodeJS dependencies for media-tool.
 *
 * on-deploy:
 *     - nodejs/install-media-tool { timeout: 300 }
 */
class InstallMediaToolTask extends AbstractTask
{
    public function getName()
    {
        return 'nodejs/install-media-tool';
    }

    public function getDescription()
    {
        return '[NodeJS] Install Media Tool';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('tool-media', 'npm i --silent');

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
