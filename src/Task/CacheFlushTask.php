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
 * Runs Magento flush cache.
 *
 * on-deploy:
 *     - magento/cache-flush
 */
class CacheFlushTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/cache-flush';
    }

    public function getDescription()
    {
        return '[Magento] Flush Magento cache storage';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('cache:flush');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }
}
