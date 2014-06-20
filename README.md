Rbac Hierarchy
==============
This small extension helps you to see whole rbac hierarchy by each role and see hierarchy for current user

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist mutogen/yii2-rbac-widget "*"
```

or add

```
"mutogen/yii2-rbac-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \mutogen\rbacw\AutoloadExample::widget(); ?>```