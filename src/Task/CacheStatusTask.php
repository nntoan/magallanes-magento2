<?php
/**
 * MagentoCacheStatusTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Check Magento cache enabled status.
 *
 * on-deploy:
 *     - magento/cache-status
 */
class CacheStatusTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/cache-status';
    }

    public function getDescription()
    {
        return '[Magento] Check Magento cache enabled status';
    }

    public function execute()
    {
        $cmd = $this->buildMagentoCommand('cache:status');

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
