<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.Helper.Date.*',
        'application.components.Helper.String.*',
        'application.components.Helper.Validator.*',
        'application.components.Helper.Email.*',
        'ext.giix-components.*', // giix components
        'ext.Paginator.*', // giix components
        'ext.YiiMailer.YiiMailer',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '12345678',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
                'ext.giix-core', // giix generators
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'CWebUser',
            'autoUpdateFlash' => false
        ),
        'widgetFactory' => array(
            'enableSkin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                #'<controller:\w+>/<action:\w+>/<id:\d+>/<sex:\d+>'=>'<controller>/<action>',
                #'<controller:\w+>/<action:\w+>/<id:\d+>/<sex:\d+>/<userid:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=kensway;port=3306;',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'trinhthanh1992',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => include(dirname(__FILE__) . '/params.php'),
    //theme
    'theme' => 'classic',
);
