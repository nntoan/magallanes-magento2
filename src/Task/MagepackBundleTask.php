<?php
/**
 * MagepackBundle.
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
 *     - magepack/bundle { timeout: 300, path: './path/to/magepack.config.js' }
 */
class MagepackBundleTask extends AbstractTask
{
    public function getName()
    {
        return 'magepack/bundle';
    }

    public function getDescription()
    {
        return '[Magepack] Generating Bundle';
    }

    public function execute()
    {
        $timeout = 300;
        $path = 'magepack.config.js';

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        if (array_key_exists('path', $this->options)) {
            $path = $this->options['path'];
        }

        $cmd = $this->buildCustomCommand('src/tools', sprintf('yarn magepackBundle --config %s', $path));

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
