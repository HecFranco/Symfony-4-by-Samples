# Purpose of the Demo - 03 Public and Private Services

We will create a **Service** and change its configuration. 

---------------------------------------------------------------------------------------

We will take as a starting point [02 AutoWiring Autoconfiguring](../02_AutoWiring_Autoconfiguring/):

---------------------------------------------------------------------------------------

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. //...

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Logging with Monolog](https://symfony.com/doc/current/logging.html), `composer require symfony/monolog-bundle`

# Basic Service

--------------------------------------------------------------------------------------------

## 1.Continue Project

--------------------------------------------------------------------------------------------

1. Copy the content of demo [02 AutoWiring Autoconfiguring](../02_AutoWiring_Autoconfiguring/), without folder [vendor](../02_AutoWiring_Autoconfiguring/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer update
```

--------------------------------------------------------------------------------------------

## 2.Change the configuration our services - Autowiring

--------------------------------------------------------------------------------------------

1. 