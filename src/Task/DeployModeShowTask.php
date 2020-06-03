<?php
/**
 * MagentoDeployModeShowTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Displays current application mode.
 *
 * on-deploy:
 *     - magento/show-app-mode
 */
class DeployModeShowTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/show-app-mode';
    }

    public function getDescription()
    {
        return '[Magento] Displays current application mode';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('deploy:mode:show');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
