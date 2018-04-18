# Purpose of the Demo - 04 Webpack Encore with React, SASS, TypeScript and Bootstrap

We will do an installation from the beginning where we will include **Webpack Encore**, along with **React**, **Sass**, **TypeScript** and **Bootstrap**.

# Phases of the Demo
1. [Project creation and ready](#1project-creation-and-ready)
2. [Installation of **WebPack Encore**](#2installation-of-webpack-encore)
3. [Installation and Configuration of **SASS**](#3installation-and-configuration-of-sass)
4. [Installation and configuration of **React**](#4installation-and-configuration-of-react)
5. [Create our component **React**](#5create-our-component-react)

-------------------------------------------------- -------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 04_Webpack_Encore_with_React_SASS_TypeScript_and_Bootstrap`

---------------------------------------------------------------------------------------

# Summary of Symfony components to use

* Profiler Component, `composer require --dev profiler`, allows you to view the **Debug toolbar**.
* Server Component, `composer require server --dev`, allows launching the **local server**.
* Twig Component, `composer require twig`
* Asset Component, `composer require symfony/asset`
* WebPack Encore, `composer require encore`

# Summary of the components of the Webpack to use

* Npm.js Component, `npm install @symfony/webpack-encore --save-dev`
* Sass-loader Component, `npm install sass-loader --save-dev`
* Node Sass Component, `npm install node-sass --save-dev`
* Babel-preset-react Component, `npm install --save-dev babel-preset-react`
* React, React-Dom and Prop-types Component, `npm install react react-dom prop-types`
* Enabling TypeScript (ts-loader), `npm install --save-dev typescript ts-loader` [Enabling TypeScript (ts-loader)](https://symfony.com/doc/current/frontend/encore/typescript.html)
* JQuery Component, `npm install --save jquery`
* Bootstrap Componente, `npm install --save bootstrap`

# Source

* [https://medium.com/@aminebelais/validate-react-forms-in-symfony-4-990457dedfe0](https://medium.com/@aminebelais/validate-react-forms-in-symfony-4-990457dedfe0)

# 04 Webpack Encore with Reac SASS, TypeScript and Bootstrap

--------------------------------------------------------------------------------------------

## 1.Project Creation and Ready

--------------------------------------------------------------------------------------------

1. We create our project using the commands of the console: 

```bash
composer create-project symfony/skeleton 04_Webpack_Encore_with_React_SASS_TypeScript_and_Bootstrap
```

2. In the next step, we will access the project folder using:

```bash
cd 04_Webpack_Encore_with_React_SASS_TypeScript_and_Bootstrap
```

3. We will create the **Controller**, [src/Controller/DefaultController.php](src/Controller/DefaultController.php), which will manage the view with the following content.