<?php
/**
 * ApplyQualityPatchesTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Magento Apply Quality Patches
 *
 * on-deploy:
 *     - magento/apply-patches { patches: 'MDVA-36021 MDVA-38346', timeout: 300 }
 */
class ApplyQualityPatchesTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/apply-patches';
    }

    public function getDescription()
    {
        return '[Magento] Apply Quality Patches';
    }

    public function execute()
    {
        $timeout = 120;
        $onParamPatches = '';
        $availablePatches = $this->runtime->getMergedOption('patches');

        if (array_key_exists('timeout', $this->options)) {
            $timeout = $this->options['timeout'];
        }

        if (array_key_exists('patches', $this->options)) {
            $onParamPatches = ' ' . $options['patches'];
        }

        $listPatches = implode(' ', $availablePatches) . $onParamPatches;
        $cmd = $this->buildCustomCommand('src/', './vendor/bin/magento-patches apply ' . $listPatches);

        $process = $this->runtime->runCommand(trim($cmd), $timeout);

        return $process->isSuccessful();
    }
}
