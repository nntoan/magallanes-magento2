<?php
/**
 * MagentoDeployModeProductionTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Enables production mode.
 *
 * on-deploy:
 *     - magento/deploy-mode-production
 */
class DeployModeProductionTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/deploy-mode-production';
    }

    public function getDescription()
    {
        return '[Magento] Enables production mode';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('deploy:mode:set production --skip-compilation');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
