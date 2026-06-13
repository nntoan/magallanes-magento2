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
    public function getName(): string
    {
        return 'magento/config-import';
    }

    public function getDescription(): string
    {
        return '[Magento] Import data from shared config files';
    }

    public function execute(): bool
    {
        $cmd = $this->buildMagentoCommand('app:config:import');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
