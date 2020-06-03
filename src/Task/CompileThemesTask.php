<?php
/**
 * CompileThemesTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Deploys static view files.
 *
 * on-deploy:
 *     - magento/compile-themes: { flags: 'en_AU en_US' }
 */
class CompileThemesTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/compile-themes';
    }

    public function getDescription()
    {
        return '[Magento] Deploys static view files';
    }

    public function execute()
    {
        $parameters = ' ';
        if (array_key_exists('flags', $this->options)) {
            $parameters .= $this->options['flags'];
        }

        $cmd = $this->buildMagentoCommand('setup:static-content:deploy' . $parameters);

        $process = $this->runtime->runCommand(trim($cmd));

        return $process->isSuccessful();
    }

}
