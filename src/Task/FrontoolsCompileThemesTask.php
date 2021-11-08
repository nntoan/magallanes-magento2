<?php
/**
 * FrontoolsCompileThemesTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Compile theme static view files with Frontools.
 *
 * on-deploy:
 *     - frontools/compile-themes { timeout: 300 }
 */
class FrontoolsCompileThemesTask extends AbstractTask
{
    public function getName()
    {
        return 'frontools/compile-themes';
    }

    public function getDescription()
    {
        return '[Frontools] Compile theme files';
    }

    public function execute()
    {
        $timeout = 120;

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        $cmd = $this->buildCustomCommand('src/tools', 'gulp styles --prod --ci && gulp babel --prod && gulp svg');

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
