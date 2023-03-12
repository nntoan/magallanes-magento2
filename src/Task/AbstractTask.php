<?php
/**
 * MagentoAbstractTask.
 *
 * @category  MageMagento
 *
 * @author    Toan Nguyen <nntoan@users.noreply.github.com>
 */

namespace Mage\Magento\Task;

/**
 * Abstract Task for Magento CLI.
 *
 * This task is responsible for building the magento call, ie the "magento" +
 * command, preceded by a change directory if necessary.
 *
 * The following options can be set at any level in the .mage.yml file:
 *   - use_docker: Use docker exec to run Magento commands (optional)
 *   - magento_dir: the Magento root folder on the server. Warning, don't forget
 *     to take releases folders into account if you use them (optional)
 *  Example: magento: { use_docker: true, magento_dir: './src' }
 */
abstract class AbstractTask extends \Mage\Task\AbstractTask
{
    private $magentoCommand = '/usr/bin/env php -f bin/magento -- %s';
    private $magentoWithDirCmd = '(cd %s; /usr/bin/env php -f bin/magento -- %s)';
    private $customWithDirCmd = '(cd %s; %s)';
    private $dockerMagentoCmd = 'docker exec -iu www php-fpm sh -c "cd /var/www/%s/src; bin/magento %s"';
    private $dockerCustomCmd = 'docker exec -iu www php-fpm sh -c "cd /var/www/%s/%s; %s"';
    private $dockerCustomRootCmd = 'docker exec -i php-fpm sh -c "cd /var/www/%s/%s; %s"';

    /**
     * Gets options for the global, then the env, then the single task levels, and
     * merge them.
     *
     * @return array
     *   Options to use for the command.
     */
    protected function getOptions()
    {
        return array_merge(
            $this->getMagentoOptions(),
            $this->runtime->getMergedOption('magento', []),
            $this->options
        );
    }

    /**
     * Builds the Magento call for the command.
     *
     * You then just have to concatenate the magento command you want to run,
     * and the possible options.
     *
     * @param string $command
     *
     * @return string
     */
    protected function buildMagentoCommand($command = '')
    {
        $options = $this->getOptions();
        $cmd = sprintf($this->magentoCommand, $command);
        $hostPath = rtrim($this->runtime->getEnvOption('host_path'), '/');
        $currentReleaseId = $this->runtime->getReleaseId();
        $dockerReleaseDir = sprintf('releases/%s', $currentReleaseId);

        if ($this->isMagentoDirExists() === true && $this->isUseDockerExists() === false) {
            $withoutDockerReleaseDir = sprintf(
                '%s/releases/%s/%s',
                $hostPath,
                $currentReleaseId,
                trim($this->options['magento_dir'], './')
            );
            $cmd = sprintf($this->magentoWithDirCmd, $withoutDockerReleaseDir, $command);
        }

        if ($this->isUseDockerExists() === true && $this->isMagentoDirExists() === false) {
            $cmd = sprintf($this->dockerMagentoCmd, $dockerReleaseDir, $command);
        }

        return $cmd;
    }

    /**
     * Builds a custom command. Could be NodeJS, Python..etc
     *
     * @param string $targetDir
     * @param string $command
     * @param bool $isRoot
     *
     * @return string
     */
    protected function buildCustomCommand($targetDir = '', $command = '', $isRoot = false)
    {
        $hostPath = rtrim($this->runtime->getEnvOption('host_path'), '/');
        $currentReleaseId = $this->runtime->getReleaseId();
        $dockerReleaseDir = sprintf('releases/%s', $currentReleaseId);

        if ($this->isMagentoDirExists() === true && $this->isUseDockerExists() === false) {
            $withoutDockerReleaseDir = sprintf(
                '%s/releases/%s/%s',
                $hostPath,
                $currentReleaseId,
                trim($targetDir, './')
            );
            $cmd = sprintf($this->customWithDirCmd, $withoutDockerReleaseDir, $command);
        }

        if ($this->isUseDockerExists() === true && $this->isMagentoDirExists() === false) {
            $cmd = sprintf($this->dockerCustomCmd, $dockerReleaseDir, $targetDir, $command);
        }

        if ($this->isUseDockerExists() === true && $this->isMagentoDirExists() === false && $isRoot === true) {
            $cmd = sprintf($this->dockerCustomRootCmd, $dockerReleaseDir, $targetDir, $command);
        }

        return $cmd;
    }

    /**
     * @return bool
     */
    protected function isMagentoDirExists()
    {
        return array_key_exists('magento_dir', $this->getOptions());
    }

    /**
     * @return bool
     */
    protected function isUseDockerExists()
    {
        return array_key_exists('use_docker', $this->getOptions());
    }

    /**
     * @return bool
     */
    protected function isArm64Machine()
    {
        return posix_uname()['machine'] === 'aarch64';
    }

    /**
     * @return bool
     */
    protected function isAmd64Machine()
    {
        return posix_uname()['machine'] === 'amd64';
    }

    protected function getMagentoOptions()
    {
        return [];
    }
}
