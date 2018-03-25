# Propósito de la demostración - Instalación de muestra

Realizaremos una instalación desde cero de un **Proyecto Symfony 4**.

---------------------------------------------------------------------------------------

* Crearemos el proyecto a través del comando de la consola: `composer create-project symfony/skeleton 01_Sample_Installation`

---------------------------------------------------------------------------------------

# Resumen de los componentes de Symfony para usar

* Componente del servidor,`composer require server --dev`

# Requisitos Previos

1. **Servidor local, APACHE**
2. **PHP**
3. **Composer** 
4. **IDE o editor de Texto**

<table>
    <td>
        <tr>
        	<strong>NOTA IMPORTANTE</strong> : Asegúrese de estar usando PHP 7.1, para ello. Para ello la instalación de composer debió realizarse sobre <strong>PHP 7.1.</strong>. Si no se realizó así o se duda, desinstalar y reinstalar nuevamente.
        </td>
    </tr>
</table>

## Instalación del Servidor Local + PHP

* Empezando a instalar un servidor local en [WAMP](http://www.wampserver.com/en/).
* Descargamos el instalable desde su página web. Según la versión de vuestro Windows, seleccionaremos una u otra opción.
* Ejecutamos el instalador. Selecciona la carpeta de instalación (normalmente [c:/wamp64/](c:/wamp64/)).
* Para iniciar el [WAMP](http://www.wampserver.com/en/), podemos hacerlo desde el menú de Inicio -> Todos los programas -> WampServer -> Start WampServer. 

Seguramente os aparezca un aviso de seguridad. Podéis decir que Sí, y se abrirá el programa. Podréis comprobar que se ejecuta correctamente al ver en la parte derecha de la barra de inicio, un icono con una **W** mayúscula. La cual aparecerá primero en rojo, pasará a naranja y finalmente se quedará en verde. Eso significa que todos los servicios se han iniciado correctamente.

## Instalación de Composer

Para la instalación en Windows descargaremos [Composer](https://getcomposer.org/download/) del enlace y lo instalaremos siguiendo los pasos que se indiquen.

Para comprobar su correcta instalación es mejor que cerreis el terminal si lo tenéis abierto, lo volváis a ejecutar y pongais lo siguiente en el terminal:

```bash 
composer -v
```

Verás algo parecido a esto:

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

# Instalación de muestra

1. Crearemos nuestro proyecto usando el comando de la consola: 

```bash
composer create-project symfony/skeleton 01_Sample_Installation
```

2. En el siguiente paso, vamos a acceder a la carpeta del proyecto usando:

```bash
cd 01_Sample_Installation
```

3. Luego, instalaremos el componente del servidor de Symfony usando el comando de la consola:

```bash
composer require server --dev
```

4. Ahora, debe escribir, para iniciar el servidor, en la consola el comando:

```bash
php bin/console server:run
```

5. Finalmente, tendrá que hacer clic en el siguiente enlace [127.0.0.1:8000](127.0.0.1:8000) para ver su proyecto de instalación.