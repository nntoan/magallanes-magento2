<?php
/**
 * MagentoDbSchemaUpgradeTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Upgrades database schema.
 *
 * on-deploy:
 *     - magento/db-schema-upgrade
 */
class DbSchemaUpgradeTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/schema-upgrade';
    }

    public function getDescription()
    {
        return '[Magento] Upgrades database schema';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('setup:db-schema:upgrade');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }
}
