<?php
/**
 * CompileCodeTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs dependency injection compilation routine.
 *
 * on-deploy:
 *     - magento/compile-code: { timeout: 300 }
 */
class CompileCodeTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/compile-code';
    }

    public function getDescription()
    {
        return '[Magento] Runs dependency injection compilation routine';
    }

    public function execute()
    {
        $timeout = 120;
        $cmd = $this->buildMagentoCommand('setup:di:compile');

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }

}
