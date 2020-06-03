# Magento Tasks for Magallanes v4
A bunch of tasks for Magento 2 to play with Magallanes v4.

## Available commands
- magento/cache-clean
- magento/cache-flush
- magento/cache-disable
- magento/cache-enable
- magento/cache-status
- magento/compile-code
- magento/compile-themes
- magento/config-dump
- magento/config-import
- magento/config-verify
- magento/data-upgrade
- magento/schema-upgrade
- magento/db-status
- magento/deploy-mode-production
- magento/show-app-mode
- magento/maintenance-on
- magento/maintenance-off
- magento/maintenance-status
- magento/setup-permissions
- magento/setup-upgrade
- magento/custom

## Installation
Install via composer:
```
composer require nntoan/magallanes-magento2
```

Then add the provided tasks as custom tasks in .mage.yml to use them:
```
magephp:
    ...
    custom_tasks:
        - 'Mage\Magento\Task\MagentoCacheFlushTask'
        - 'Mage\Magento\Tasks\MagentoSetupUpgradeTask'
        ...
```

Notes: 
- List of available classes is available in vendor/nntoan/magallanes-magento2/src/Task
- You can add only the tasks you require in your deployment script


## Use

After adding the tasks you want to use to the list of custom classes, you can
use them in any deployment step, like so:
```
magephp:
    environments:
        prod:
            magento: { use_docker: true }
            pre-deploy:
            on-deploy:
                - magento/maintenance-on
                - magento/deploy-mode-production
                - magento/setup-upgrade
                - magento/compile-code
                - magento/compile-themes: { flags: 'en_US en_VN -t Magento/luma' }
            on-release:
            post-release:
                - magento/cache-flush
                - magento/maintenance-off
            post-deploy:
```

All the Magento tasks have the following common parameters:
- use_docker: Required if you are using docker on your environments (optional)
- magento_dir: The path to cd into before running the command (optional)

To avoid repetition, you can specify these parameters with the global configuration
item "magento". This item can be set in the global level or for each environment.
 
Global level:
```
magephp:
    ...
    magento: { use_docker: true }
    ...
```

Per environment:
```
magephp:
    environments:
        uat:
            ...
            magento: { use_docker: false, magento_dir: './src' }
            ...
         
        prod:
            ...
            magento: { use_docker: true } 
            ...
```

Moreover, each configuration item overrides the parent one, so a global magento
configuration can be set and them overridden on a specific environment or even
on a per-command basis.

Examples:
```
magephp:
    magento: { use_docker: true }
    environments:
        uat:
            ...
            # Only UAT env has a different value for whatever reason.
            magento: { use_docker: false }
            ...
        prod:
            ...
            # Will use the global "use_docker" value.
            ...
```

```
magephp:
    magento: { alias: mywebsite }
    environments:
        prod:
            pre-deploy:
                - magento/config-dump { use_docker: false, magento_dir: './src' }
            on-deploy:
            on-release:
            post-release:
                - magento/setup-upgrade: { zero_downtime: true }
                - magento/config-import
                - magento/cache-flush
            post-deploy:
```

## Documentation

###### magento/cache-clean
Description: Clean Magento cache by types
Magento command: `bin/magento cache:clean`

###### magento/cache-flush
Description: Flush Magento cache storage
Magento command: `bin/magento cache:flush`

###### magento/cache-enable
Description: Enable Magento cache
Magento command: `bin/magento cache:enable`

###### magento/cache-disable
Description: Disable Magento cache
Magento command: `bin/magento cache:disable`

###### magento/cache-status
Description: Check Magento cache enabled status
Magento command: `bin/magento cache:status`

###### magento/compile-code
Description: Runs dependency injection compilation routine
Magento command: `bin/magento setup:di:compile`

###### magento/compile-themes
Description: Deploys static view files
Magento command: `bin/magento setup:static-content:deploy`
Options:
  - flags (optional): all options and agruments you would like to pass to this command. Eg: "en_AU en_US --exclude-theme=Magento/luma"

###### magento/config-dump
Description: Create dump of application config
Magento command: `bin/magento app:config:dump`
Options:
  - params (optional): Config scopes you would like to dump. Eg: "scopes themes i18n"

###### magento/config-import
Description: Import data from shared config files
Magento command: `bin/magento app:config:import`

###### magento/config-verify
Description: Checks if config propagation requires update
Magento command: `bin/magento app:config:status`

###### magento/data-upgrade
Description: Upgrades data fixtures
Magento command: `bin/magento setup:db-data:upgrade`

###### magento/schema-upgrade
Description: Upgrades database schema
Magento command: `bin/magento setup:db-schema:upgrade`

###### magento/db-status
Description: Checks if DB schema or data requires upgrade
Magento command: `bin/magento setup:db:status`

###### magento/deploy-mode-production
Description: Enables production mode
Magento command: `bin/magento deploy:mode:set production --skip-compilation`

###### magento/show-app-mode
Description: Displays current application mode
Magento command: `bin/magento deploy:mode:show`

###### magento/maintenance-on
Description: Enable maintenance mode
Magento command: `bin/magento maintenance:enable`

###### magento/maintenance-off
Description: Disable maintenance mode
Magento command: `bin/magento maintenance:disable`

###### magento/maintenance-status
Description: Displays maintenance mode status
Magento command: `bin/magento maintenance:status`

###### magento/setup-upgrade
Description: Updates the module load sequence and upgrades database schemas and data fixtures
Magento command: `bin/magento setup:upgrade`
Options:
  - zero_downtime (optional): Force keep generated files. Eg: "true/false"

###### magento/setup-permissions
Description: Updates the module load sequence and upgrades database schemas and data fixtures
File command: `find . -type f ! -perm %s -exec chmod %s {}`
Directory command: `find . -type d ! -perm %s -exec chmod %s {}`
Options:
  - file (mandatory): Permission you would like to set for all files. Eg: "0644"
  - directory (mandatory): Permission you would like to set for all directories. Eg: "0755"

###### magento/custom
Description: Run a specified `magento` command. Use only if you can't create a proper custom Magallanes task.  
Magento command: `bin/magento <your command>`
Options:
  - command (mandatory): the magento command to run, without the "magento" part. Eg: "indexer:reindex"

## Contributions
Feel free to submit your pull requests to add new Magento commands. Your requests
must be done on branch master.
Rules :
- Magento command must be a command that is helping during multiple deployment process
- Your command class must inherit from Mage\Magento\Task\AbstractTask
