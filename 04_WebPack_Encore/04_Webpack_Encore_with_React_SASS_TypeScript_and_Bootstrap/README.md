# Purpose of the Demo - 04 Webpack Encore with React, SASS, TypeScript and Bootstrap

We will do an installation from the beginning where we will include **Webpack Encore**, along with **React**, **Sass**, **TypeScript** and **Bootstrap**.

---------------------------------------------------------------------------------------

We will take as a starting point [03 Webpack Encore with React and SASS](../03_Webpack_Encore_with_React_and_SASS/):

---------------------------------------------------------------------------------------

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. [Installation and Configuration of **TypeScript**](#2installation-and-configuration-of-typescript)
3. [Installation and configuration of **Bootstrap**](#3installation-and-configuration-of-bootstrap)

---------------------------------------------------------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 04_Webpack_Encore_with_React_SASS_TypeScript_and_Bootstrap`

---------------------------------------------------------------------------------------

# Summary of the components of the Webpack to use

* Enabling TypeScript (ts-loader), `npm install --save-dev typescript ts-loader` [Enabling TypeScript (ts-loader)](https://symfony.com/doc/current/frontend/encore/typescript.html)
* JQuery Component, `npm install --save jquery`
* Bootstrap Componente, `npm install --save bootstrap`

# Source

* [https://medium.com/@aminebelais/validate-react-forms-in-symfony-4-990457dedfe0](https://medium.com/@aminebelais/validate-react-forms-in-symfony-4-990457dedfe0)

# 04 Webpack Encore with Reac SASS, TypeScript and Bootstrap

--------------------------------------------------------------------------------------------

## 1.Continue Project

--------------------------------------------------------------------------------------------

1. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer install
```

2. 1. Installs **Webpack** and its dependencies from the previous phase: 

```bash
npm install
```

--------------------------------------------------------------------------------------------

## 2.Installation and Configuration of **TypeScript**

--------------------------------------------------------------------------------------------

[Enabling TypeScript (ts-loader)](https://symfony.com/doc/current/frontend/encore/typescript.html)

1. First, install the dependencies:

```bash
npm install --save-dev typescript ts-loader
```

2. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

_[webpack.config.js](webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');
Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
--  .addEntry('js/app', './assets/js/app.js')
++  .addEntry('js/app', './assets/js/app.jsx')
    .addStyleEntry('css/app', './assets/scss/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()    
++  .enableTypeScriptLoader()
    .enableReactPreset()
;
module.exports = Encore.getWebpackConfig();
```
3. This plugin requires that you have a [tsconfig.json](tsconfig.json) file that is setup correctly.

_[tsconfig.json](tsconfig.json)_
```json
{
  "compilerOptions": {
    "target": "es6",
    "module": "es6",
    "moduleResolution": "node",
    "declaration": false,
    "noImplicitAny": false,
    "jsx": "react",
    "sourceMap": true,
    "noLib": false,
    "suppressImplicitAnyIndexErrors": true
  },
  "compileOnSave": false,
  "exclude": [
    "node_modules"
  ]
}
```

4. Now, we can modify de extension of files.
* [./assets/js/app.js](./assets/js/app.js) will be [./assets/js/app.jsx](./assets/js/app.jsx)
* [./assets/js/Components/app.js](./assets/js/Components/app.js) will be [./assets/js/Components/app.jsx](./assets/js/Components/app.jsx)

Inside the files.

_[./assets/js/Components/app.jsx](./assets/js/Components/app.jsx)_
```diff
import '../scss/app.scss';
import React from 'react';
import ReactDOM from 'react-dom';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

-- import ItemCard from './Components/ItemCard';
++ import ItemCard from './Components/ItemCard.jsx';

class App extends React.Component {
  constructor() {
    super();

    this.state = {
      entries: []
    };
  }
  //...
```

--------------------------------------------------------------------------------------------

## 2.Installation and Configuration of **Bootstrap**

--------------------------------------------------------------------------------------------

1. To import **Bootstrap** in our project we will only have to execute.

```bash
npm install --save jquery
```

to install **Jquery**, and

```bash
npm install --save bootstrap
```

to install **Bootstrap** in its version 4.

2. Additionally in this demo we will install the library **popper.js** using the command:

```bash
npm install popper.js
```

with it we will generate the windows with floating information.

3. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives. And we will uncomment the following line of the file [webpack.config.js](webpack.config.js) to facilitate **jQuery** to **Bootstrap**.

_[webpack.config.js](webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())

    // uncomment to define the assets of the project
    .addEntry('js/app', './assets/js/app.jsx')
    .addStyleEntry('css/app', './assets/scss/app.scss')

    // uncomment if you use Sass/SCSS files
    .enableSassLoader()
    // uncomment for legacy applications that require $/jQuery as a global variable
--  // .autoProvidejQuery()
++  .autoProvidejQuery()
    .enableTypeScriptLoader() 
    .enableReactPreset()
;
module.exports = Encore.getWebpackConfig();
```

4. And now, we can add bootstrap our style sheet file in **SASS**[./assets/scss/app.scss](./assets/scss/app.scss).

_[./assets/scss/app.scss](./assets/scss/app.scss)_
```diff
++ @import '~bootstrap/scss/bootstrap';

html {
  font-family: Arial, Helvetica, sans-serif;
}

.footer {
  display: flex;
  justify-content: center;
}
```

5. Finally, we launch **loader** via `npm run watch`, and the **server** `php bin/console server:run` so we can see the results by clicking [http://127.0.0.1:8000](http://127.0.0.1:8000).

The final result is three React cards that fill the available space on the page.

![Final Result](../../99_Readme_Resources/04_WebPack_Encore/03_Webpack_Encore_with_React/final-result.png)