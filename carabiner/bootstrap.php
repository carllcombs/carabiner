<?php

/**
 * Carabiner - A REST API glue
 *
 * @version  0.0.1
 * @author   Carl Combs <carllcombs@gmail.com>
 */

/*
 |---------------------------------------------------------------------
 | Version
 |---------------------------------------------------------------------
 |
 */
define('VERSION', '0.0.1');

/*
 |---------------------------------------------------------------------
 | The path to the root directory.
 |---------------------------------------------------------------------
 |
 */
define ( 'ROOTPATH', realpath( __DIR__ . '/../' ) );

/*
 |---------------------------------------------------------------------
 | The path to the Carabiner directory.
 |---------------------------------------------------------------------
 |
 */
define ( 'SYSPATH', realpath( ROOTPATH . '/carabiner' ) );

/*
 |---------------------------------------------------------------------
 | The path to the application directory.
 |---------------------------------------------------------------------
 |
 */
define ( 'APPPATH', realpath( ROOTPATH . '/application' ) );

/*
 |---------------------------------------------------------------------
 | The path to the storage directory.
 |---------------------------------------------------------------------
 |
 */
define ( 'STORAGEPATH', realpath( ROOTPATH . '/storage' ) );

/*
 |---------------------------------------------------------------------
 | The path to the public directory.
 |---------------------------------------------------------------------
 |
 */
define ( 'PUBPATH', realpath( ROOTPATH . '/public' ) );

/*
 |---------------------------------------------------------------------
 | Autoload Libraries
 |---------------------------------------------------------------------
 | Load Composer libraries and anything else
 |
 */
require_once ( ROOTPATH . '/vendor/autoload.php' );

/*
 |---------------------------------------------------------------------
 | Exception Handler
 |---------------------------------------------------------------------
 | Fire up the whoops
 |
 */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

/*
 |---------------------------------------------------------------------
 | Environment
 |---------------------------------------------------------------------
 | get/set the global environment based on .htaccess
 |
 */
if( getenv('ENV') )
    $env = getenv('ENV');
elseif( php_sapi_name() == 'cli' )
    $env = 'development'; // TODO: Make this dynamic
else
    exit('ENV not set' . "\n");

define('ENV', $env);

/*
 |---------------------------------------------------------------------
 | Configs
 |---------------------------------------------------------------------
 |
 */
$config = new \Sinergi\Config\Config(APPPATH . "/config");
$config->setEnvironment(ENV);

/*
 | --------------------------------------------------------------------
 | Make a globally available ORM instance
 | --------------------------------------------------------------------
 |
 */
$doctrine = new stdClass();

// $arrayCache = new \Doctrine\Common\Cache\ArrayCache;
// $annotationReader = new \Doctrine\Common\Annotations\AnnotationReader;
// $cachedAnnotationReader = new \Doctrine\Common\Annotations\CachedReader(
//     $annotationReader, // use reader
//     $arrayCache        // and a cacheDriver
// );

// \Gedmo\DoctrineExtensions::registerAbstractMappingIntoDriverChainORM(
//     $driverChain,           // our metadata driver chain, to hook into
//     $cachedAnnotationReader // our cached annotation reader
// );
$doctrine->config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($config->get('config.doctrine.paths'), $config->get('config.doctrine.isDevMode'), null, null, false);

$doctrine->evm = new \Doctrine\Common\EventManager();
/* Add extension listeners here */

/* end */

// !TODO: setup autogenerating proxies
//----------------------------------------------
// $doctrine->config->setProxyDir($config->get('config.doctrine.paths.proxies'));
// $doctrine->config->setProxyNamespace('MyProject\Proxies');

// if ($applicationMode == "development")
// {
//     $doctrine->config->setAutoGenerateProxyClasses(true);
// } else {
//     $config->setAutoGenerateProxyClasses(false);
// }

$doctrine->em = \Doctrine\ORM\EntityManager::create($config->get('database.connection'), $doctrine->config, $doctrine->evm);

/*
 |---------------------------------------------------------------------
 | Router
 |---------------------------------------------------------------------
 |
 */
$router = new \Respect\Rest\Router();





















