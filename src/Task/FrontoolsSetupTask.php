<?php
/**
 * FrontoolsSetup.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Setup Frontools and its dependencies.
 *
 * on-deploy:
 *     - frontools/setup { timeout: 300 }
 */
class FrontoolsSetupTask extends AbstractTask
{
    public function getName()
    {
        return 'frontools/setup';
    }

    public function getDescription()
    {
        return '[Frontools] Setup Gulp';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('src/vendor/snowdog/frontools', 'yarn install || npm i --silent; gulp setup');

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
