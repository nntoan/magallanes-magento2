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
 *     - magento/compile-code
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
        $cmd = $this->buildMagentoCommand('setup:di:compile');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
