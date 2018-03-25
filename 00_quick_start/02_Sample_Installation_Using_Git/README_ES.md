# Objetivo de la demostración - Ejemplo de instalación usando Git

Haremos nuestra instalación desde cero **Project Symfony 4** usando **Git**.

## Nota

**Git** es un software de control de versiones diseñado por Linus Torvalds, pensando en la eficiencia y la confiabilidad de mantener las versiones de las aplicaciones cuando tienen una gran cantidad de archivos fuente. Su propósito es mantener el registro de los archivos en la computadora y coordinar el trabajo que varias personas realizan en archivos compartidos.

Al principio, Git se convirtió en un motor de bajo nivel en el que otras cosas, la interfaz de usuario o la interfaz como Cogito o Stit. Sin embargo, desde entonces se ha convertido en un sistema de control de versiones con funcionalidad completa. Hay algunos proyectos muy importantes que ya usan Git, en particular, el grupo de programación kernel de Linux.

El mantenimiento del software está actualmente supervisado por June Hamano, que recibe contribuciones de alrededor de 280 programadores.

Para Windows, tendremos que descargar el instalador desde la página web: [https://github.com/git-for-window/git/releases/tag/v2.16.1.windows.4](https://github.com/git-for-window/git/releases/tag/v2.16.1.windows.4)

Puede ver su versión de Git en la escritura de la consola:

```bash
git status
git add .
```

---------------------------------------------------------------------------------------

* Crearemos el proyecto a través del comando de la consola: `composer create-project symfony / skeleton 02_Sample_Installation_Using_Git`

-------------------------------------------------- -------------------------------------

# Resumen de los componentes de Symfony para usar

* Componente del servidor,`composer require server --dev`

# Primera página

1. Crearemos nuestro proyecto usando el comando de la consola:

```bash
composer create-project symfony/skeleton 02_Sample_Installation_Using_Git
```

2. En el siguiente paso, accederemos a la carpeta del proyecto usando:

```bash
cd 02_Sample_Installation_Using_Git
```

3. Luego, instalaremos el **componente del servidor** de Symfony usando el comando de la consola:

```bash
composer require server --dev
```

Una vez que tenemos la cuenta, lo que tenemos que hacer es acceder desde la consola de comandos a la carpeta de nuestro proyecto y allí configuraremos Git con el correo electrónico con el que hemos creado la cuenta de Git.

Luego crearemos el **primer commit**, el **repositorio remoto** y cargaremos todos los **archivos** a la rama principal.

```bash
git config user.email "tuemail@dominio.com"
git commit -m "Frist Commit"
git remote add Symfony https://github.com/yourAccount/02_Sample_Installation_Using_Git.git
git push Symfony master
```

o modificando el archivo [.git/config] (.git/config)

_[.git/config](.git/config)_
```diff
[core]
	repositoryformatversion = 0
	filemode = true
	bare = false
	logallrefupdates = true
++[user]
++	email = tuemail@dominio.com
++[remote "Symfony"]
++	url = https://github.com/yourAccount/02_Sample_Installation_Using_Git.git
++	fetch = +refs/heads/*:refs/remotes/Symfony/*
```

Ahora que hemos realizado algunos cambios en nuestro repositorio local, indicaremos que queremos agregar todos los archivos a Git usando **add**.

Lo siguiente será hacer **commit** agregando un mensaje que explique lo que se ha hecho.

Finalmente haremos un **push** para subir todos los cambios a la rama principal.

```bash
git add .
git commit -m "Primer Commit"
git push Symfony-4-Test master
```

4. Ahora, debe escribir, para iniciar el servidor, en la consola el comando:

```bash
php bin/console server:run
```

5. Finalmente, tendrá que hacer clic en el siguiente enlace [http://127.0.0.1:8000](http://127.0.0.1:8000) para ver su proyecto de instalación.