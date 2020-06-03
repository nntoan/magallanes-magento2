<?php
/**
 * MagentoConfigImportTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs Magento config import.
 *
 * on-deploy:
 *     - magento/config-import
 */
class ConfigImportTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/config-import';
    }

    public function getDescription()
    {
        return '[Magento] Import data from shared config files';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('app:config:import');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
