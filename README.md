# PICLEAKS - the free open source picture gallery

## Requirements

* Apache Server 2.2
* PHP 5.2.4 or greater
* MySQL v5.0 or greater

## Optional requirements

* XAMPP / WAMP Server environment for developing locally
* (alternative is to use your own web server or shared hosting)
* for installation see INSTALL

## Instructions for obtaining the latest code and developing it

* create your local fork by clicking 'Fork' (located on the upper right corner of this page)

* go to the root folder of your web server

```bash
cd www
```

* clone the repo from private URL (remember to have your SSH key(s) added under "Account Settings")
* this point will be called origin (you can rename it later, if you want)

```bash
git clone git@github.com:{your_user_name}/PicLeaks.git
```

* enter the directory
* create an upstream remote from public URL

```bash
cd PicLeaks
git remote add upstream git://github.com/elcynico/PicLeaks.git
```

* fetch the latest upstream content
* if you haven't developed for awhile, remember to fetch, otherwise it's not necessary

```bash
git pull upstream master
```

* code something!
* don't forget to commit your changes

```bash
git add .
git commit -m "your comments"
```

* then push the staged area code to your fork

```bash
git push origin master
```

## Pull requests

* when you want to collaborate on the main fork (elcynico/PicLeaks)
* send me a pull request by clicking the 'Pull Request' link, that simple
