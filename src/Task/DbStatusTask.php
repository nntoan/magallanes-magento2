<?php
/**
 * MagentoDbStatusTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Checks if DB schema or data requires upgrade.
 *
 * on-deploy:
 *     - magento/db-status
 */
class DbStatusTask extends AbstractTask
{
    public function getName(): string
    {
        return 'magento/db-status';
    }

    public function getDescription(): string
    {
        return '[Magento] Checks if DB schema or data requires upgrade';
    }

    public function execute(): bool
    {
        $cmd = $this->buildMagentoCommand('setup:db:status');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
