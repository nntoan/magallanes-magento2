<?php
/**
 * MagentoConfigDumpTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs Magento config dump.
 *
 * on-deploy:
 *     - magento/config-dump: { params: 'scopes themes i18n' }
 */
class ConfigDumpTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/config-dump';
    }

    public function getDescription()
    {
        return '[Magento] Create dump of application config';
    }

    public function execute()
    {
        $parameters = ' ';
        if (array_key_exists('params', $this->options)) {
            $parameters .= $this->options['params'];
        }

        $cmd = $this->buildMagentoCommand('app:config:dump' . $parameters);

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
