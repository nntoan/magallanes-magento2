<?php
/**
 * MagentoCacheEnableTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Enable Magento cache.
 *
 * on-deploy:
 *     - magento/cache-enable
 */
class CacheEnableTask extends AbstractTask
{
    public function getName(): string
    {
        return 'magento/cache-enable';
    }

    public function getDescription(): string
    {
        return '[Magento] Enable Magento cache';
    }

    public function execute(): bool
    {
        $cmd = $this->buildMagentoCommand('cache:enable');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
