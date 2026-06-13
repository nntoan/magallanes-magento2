<?php
/**
 * MagentoConfigVerifyTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs Magento config status.
 *
 * on-deploy:
 *     - magento/config-verify
 */
class ConfigVerifyTask extends AbstractTask
{
    public function getName(): string
    {
        return 'magento/config-verify';
    }

    public function getDescription(): string
    {
        return '[Magento] Checks if config propagation requires update';
    }

    public function execute(): bool
    {
        $cmd = $this->buildMagentoCommand('app:config:status');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
