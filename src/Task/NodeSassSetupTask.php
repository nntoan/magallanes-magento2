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
 * Setup NodeSass and its dependencies.
 *
 * on-deploy:
 *     - sass/setup { timeout: 300 }
 */
class NodeSassSetupTask extends AbstractTask
{
    public function getName()
    {
        return 'sass/setup';
    }

    public function getDescription()
    {
        return '[SASS] Setup SCSS for ARM64';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('src/vendor/snowdog/frontools', 'yarn install; npm i --silent node-sass@npm:sass; yarn install');

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return true; // force the process going on
    }
}
