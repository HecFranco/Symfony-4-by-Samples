# Purpose of the Demo - 03 Twig Extension

We will create a ** **. 

> 

# Phases of the Demo
1. [Project Creation](#1project-creation)
2. 

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 03_twig_extension`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Logging with Monolog](https://symfony.com/doc/current/logging.html), `composer require symfony/monolog-bundle`


# Basic Service

--------------------------------------------------------------------------------------------

## 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 03_twig_extension
```

2. In the next step we will access the project folder using:

```bash
cd 03_twig_extension
```

3. Execute `composer update` to install the dependencies defined into [composer.json](./composer.json):

```bash
composer update
```

4. It is necessary to install the **server component**, to use our **Server Local**, through the console command:

```bash
composer require server --dev
```

5. Now, you will be able to view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

--------------------------------------------------------------------------------------------

## 2.

--------------------------------------------------------------------------------------------

(Source: [https://symfony.com/doc/current/service_container/debug.html](https://symfony.com/doc/current/service_container/debug.html))

