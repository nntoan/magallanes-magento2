<?php
/**
 * MagentoDbDataUpgradeTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Upgrades data fixtures.
 *
 * on-deploy:
 *     - magento/data-upgrade
 */
class DbDataUpgradeTask extends AbstractTask
{
    public function getName(): string
    {
        return 'magento/data-upgrade';
    }

    public function getDescription(): string
    {
        return '[Magento] Upgrades data fixtures';
    }

    public function execute(): bool
    {
        $cmd = $this->buildMagentoCommand('setup:db-data:upgrade');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }
}
