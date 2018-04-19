# Purpose of the Demo - Sample Installation

We will make our frist installation from scratch **Project Symfony 4**.

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 01_Sample_Installation`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`

# Previous requirements

1. **Local server, APACHE**
2. **PHP**
3. **Composer**

<table>
    <td>
        <tr>
            <strong>IMPORTANT NOTE</strong>: Make sure you are using PHP 7.1, for that. For this the installation of the composer had to be done on <strong> PHP 7.1. </strong>. If it was not done like this or if it is doubt, uninstall and reinstall again.
        </td>
    </tr>
</table>

## Local Server Installation + PHP

* Starting to install a local server in [WAMP](http://www.wampserver.com/en/).
* Download the installable from your website. According to the version of your Windows, we will select one or another option.
* We execute the installer. Select the installation folder (usually [c:/wamp64/] (c:/wamp64/)).
* To start the [WAMP](http://www.wampserver.com/en/), we can do it from the **Start menu >> All programs >> WampServer >> Start WampServer**.

Surely you see a security warning. You can say yes, and the program will open. You can check that it is the correct one on the right side of the start bar, an icon with a capital **W**. Which list first in red, will turn orange and finally will stay green. That means that all the services have been connected correctly.

## Composer installation

For installation in Windows, download [Composer](https://getcomposer.org/download/) of the link and the facilities that follow the steps indicated.

To check if the installation is correct, make sure that the terminal is as open as possible.

```bash
composer -v
```

You'll see something like this:

```bash
   ______
  / ____/___  ____ ___  ____  ____  ________  _____
 / /   / __ \/ __ `__ \/ __ \/ __ \/ ___/ _ \/ ___/
/ /___/ /_/ / / / / / / /_/ / /_/ (__  )  __/ /
\____/\____/_/ /_/ /_/ .___/\____/____/\___/_/
                    /_/
Composer version 1.6.2 2018-01-05 15:28:41

Usage:
  command [options] [arguments]

Options:
  -h, --help                     Display this help message
  -q, --quiet                    Do not output any message
  -V, --version                  Display this application version
      --ansi                     Force ANSI output
      --no-ansi                  Disable ANSI output
  -n, --no-interaction           Do not ask any interactive question
      --profile                  Display timing and memory usage information
      --no-plugins               Whether to disable plugins.
  -d, --working-dir=WORKING-DIR  If specified, use the given directory as working directory.
  -v|vv|vvv, --verbose           Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  about                Shows the short information about Composer.
  archive              Creates an archive of this composer package.
  auto-scripts         Runs the auto-scripts script as defined in composer.json.
  browse               Opens the package's repository URL or homepage in your browser.
  check-platform-reqs  Check that platform requirements are satisfied.
  clear-cache          Clears composer's internal package cache.
  clearcache           Clears composer's internal package cache.
  config               Sets config options.
  create-project       Creates new project from a package into given directory.
  depends              Shows which packages cause the given package to be installed.
  diagnose             Diagnoses the system to identify common errors.
  dump-autoload        Dumps the autoloader.
  dumpautoload         Dumps the autoloader.
  exec                 Executes a vendored binary/script.
  global               Allows running commands in the global composer dir ($COMPOSER_HOME).
  help                 Displays help for a command
  home                 Opens the package's repository URL or homepage in your browser.
  info                 Shows information about packages.
  init                 Creates a basic composer.json file in current directory.
  install              Installs the project dependencies from the composer.lock file if present, or falls back on the composer.json.
  install-recipes      Install missing recipes.
  licenses             Shows information about licenses of dependencies.
  list                 Lists commands
  outdated             Shows a list of installed packages that have updates available, including their latest version.
  prohibits            Shows which packages prevent the given package from being installed.
  remove               Removes a package from the require or require-dev.
  require              Adds required packages to your composer.json and installs them.
  run-script           Runs the scripts defined in composer.json.
  search               Searches for packages.
  self-update          Updates composer.phar to the latest version.
  selfupdate           Updates composer.phar to the latest version.
  show                 Shows information about packages.
  status               Shows a list of locally modified packages.
  suggests             Shows package suggestions.
  unpack               Unpack a Symfony pack.
  update               Upgrades your dependencies to the latest version according to composer.json, and updates the composer.lock file.
  upgrade              Upgrades your dependencies to the latest version according to composer.json, and updates the composer.lock file.
  validate             Validates a composer.json and composer.lock.
  why                  Shows which packages cause the given package to be installed.
  why-not              Shows which packages prevent the given package from being installed.
```

# Sample Installation

1. We will created our project using the console command:

```bash
composer create-project symfony/skeleton 01_Sample_Installation
```

2.  In the next step, we are going to access the project folder using:

```bash
cd 01_Sample_Installation
```

3. Then, we will install the **server component** of symfony using of console command:

```bash
composer require server --dev
```

4. Now, you must write, to launch the server, in the console the command:

```bash
php bin/console server:run
```

5. Finally, you will have click in next link [http://127.0.0.1:8000](http://127.0.0.1:8000) to view your installation project.

The final result is three React cards that fill the available space on the page.

![Final Result](../../99_Readme_Resources/00_Quick_Start/01_Sample_Installation/final-result.jpg)
