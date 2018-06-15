# Purpose of the Demo - 01 Basic Service

We will create a **Basic Service**. 

> Your application is full of useful objects: a "Mailer" object might help you send emails while another object might help you save things to the database. Almost everything that your app "does" is actually done by one of these objects. And each time you install a new bundle, you get access to even more!
In Symfony, these useful objects are called services and each service lives inside a very special object called the service container. The container allows you to centralize the way objects are constructed. It makes your life easier, promotes a strong architecture and is super fast!

# Phases of the Demo
1. [Project Creation](#1project-creation)
2. 

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 01_Basic_Service`

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
composer create-project symfony/skeleton 01_Basic_Service
```

2. In the next step we will access the project folder using:

```bash
cd 01_Basic_Service
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

## 2.Basic Service

--------------------------------------------------------------------------------------------

(Source: [https://symfony.com/doc/current/service_container/debug.html](https://symfony.com/doc/current/service_container/debug.html))

