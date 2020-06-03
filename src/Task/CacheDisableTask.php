<?php
/**
 * MagentoCacheDisableTask.
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
 *     - magento/cache-disable
 */
class CacheDisableTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/cache-disable';
    }

    public function getDescription()
    {
        return '[Magento] Disable Magento cache';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('cache:disable');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
