<?php
/**
 * CustomCommand.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Runs a custom Magento command. Use only if you can't create your own tasks.
 *
 * To specify your magento command, pass a "command" parameter:
 * post-release:
 *     - magento/custom: { command: 'yourcommand --yourflags' }
 */
class CustomCommand extends AbstractTask
{
    public function getName()
    {
        return 'magento/custom';
    }

    public function getDescription()
    {
        return '[Magento] Run Magento custom command';
    }

    public function execute()
    {
        // Get options from the command level.
        if (array_key_exists('command', $this->options)) {
            $cmd = $this->buildMagentoCommand($this->options['command']);

            $process = $this->runtime->runCommand(trim($cmd));

            return $process->isSuccessful();
        }

        return false;
    }
}
