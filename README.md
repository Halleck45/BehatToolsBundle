BehatToolsBundle
================

[![Build Status](https://secure.travis-ci.org/Halleck45/BehatToolsBundle.png)](http://travis-ci.org/Halleck45/BehatToolsBundle)

Bundle to manage your Behat's features.

You can:
 - find all your features (with criteriums)
 - know the state of each feature

Installation
-----------

1. Add the bundle to your project
2. Add the following lines to your config.yml file:

    ```yaml
    parameters:
      behat.paths.features: /path/your/features/
      behat.paths.reports:  /path/your/behat/reports/
    ```

Note that you need to run Behat with the formater parameter, in order to generator reports in JUnit format:

    $ behat -f junit --out reports