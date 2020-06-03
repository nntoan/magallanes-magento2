<?php
/**
 * MagentoMaintenanceEnableTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Enable maintenance mode.
 *
 * on-deploy:
 *     - magento/maintenance-on
 */
class MaintenanceEnableTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/maintenance-on';
    }

    public function getDescription()
    {
        return '[Magento] Enable maintenance mode';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('maintenance:enable');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
