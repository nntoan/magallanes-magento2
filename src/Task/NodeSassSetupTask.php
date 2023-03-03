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

        $cmd = $this->buildCustomCommand(
            'src/vendor/snowdog/frontools', 'yarn install --ignore-scripts; npm uninstall --silent node-sass; npm i --silent node-sass@npm:sass; npm rebuild node-sass;');

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
