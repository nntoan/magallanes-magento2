<?php
/**
 * MagentoMaintenanceDisableTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Disable maintenance mode.
 *
 * on-deploy:
 *     - magento/maintenance-off
 */
class MaintenanceDisableTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/maintenance-off';
    }

    public function getDescription()
    {
        return '[Magento] Disable maintenance mode';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('maintenance:disable');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
