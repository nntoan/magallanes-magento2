<?php
/**
 * MagentoCacheFlushTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs Magento clean cache by types.
 *
 * on-deploy:
 *     - magento/cache-flush
 */
class CacheCleanTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/cache-clean';
    }

    public function getDescription()
    {
        return '[Magento] Clean Magento cache by types';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('cache:clean');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
