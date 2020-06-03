<?php
/**
 * MagentoSetupUpgradeTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs setup upgrade with flag.
 *
 * on-deploy:
 *     - magento/setup-upgrade: { zero_downtime: true }
 */
class SetupUpgradeTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/setup-upgrade';
    }

    public function getDescription()
    {
        return '[Magento] Updates the module load sequence and upgrades database schemas and data fixtures';
    }

    public function execute()
    {
        $parameter = ' ';
        if (array_key_exists('zero_downtime', $this->options)) {
            $parameter .= '--keep-generated';
        }

        $cmd = $this->buildMagentoCommand('setup:upgrade' . $parameter);

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
