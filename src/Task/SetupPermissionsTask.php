<?php
/**
 * MagentoSetupPermissionsTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

use Mage\Task\Exception\ErrorException;

/**
 * Sets proper permissions on application.
 *
 * on-deploy:
 *     - magento/setup-permissions: { file: 0644, directory: 0755 }
 */
class SetupPermissionsTask extends AbstractTask
{
    public function getName()
    {
        return 'magento/setup-permissions';
    }

    public function getDescription()
    {
        return '[Magento] Sets proper permissions on application';
    }

    public function execute()
    {
        if (!array_key_exists('file', $this->options) || !array_key_exists('directory', $this->options)) {
            throw new ErrorException('Parameters "file" and "directory" are required.');
        }

        $fileCmd = sprintf(
            'find . -type f ! -perm %s -exec chmod %s {}',
            $this->options['file'],
            $this->options['file']
        );
        $directoryCmd = sprintf(
            'find . -type d ! -perm %s -exec chmod %s {}',
            $this->options['directory'],
            $this->options['directory']
        );

        $fileProcess = $this->runtime->runCommand(trim($fileCmd));
        $dirProcess = $this->runtime->runCommand(trim($directoryCmd));

        return $fileProcess->isSuccessful() && $dirProcess->isSuccessful();
    }

}
