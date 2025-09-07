# ihr-plugin-dates
Repository plugin for the "I Have Repository" (ihr) library for dates.

This plugin make auto-set of `created at`, `updated at` and `deleted at` fields.

# usage

## set env

- REPOSITORY__PLUGINS_FILE - set to path with plugins config

## add plugin to the plugins config path:

```php
<?php
use jeyroik\components\repositories\plugins\RepoPluginDates;

return [
    RepoPluginDates::class => [],
    //...
];

```
