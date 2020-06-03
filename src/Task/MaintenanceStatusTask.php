<?php
/**
 * MagentoMaintenanceStatusTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Displays maintenance mode status.
 *
 * on-deploy:
 *     - magento/maintenance-status
 */
class MaintenanceStatusTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/maintenance-status';
    }

    public function getDescription()
    {
        return '[Magento] Displays maintenance mode status';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('maintenance:status');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
