<?php

use Repository\ArticleRepository;
use Repository\CategoryRepository;
use Repository\UserRepository;
use Service\UserManager;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function (Twig_Environment $twig, Application $app) {
    // add custom globals, filters, tags, ...
    
    // Pour avoir accès au service UserManager dans les templates
    $twig->addGlobal('user_manager', $app['user.manager']);
    
    return $twig;
});

$app->register(
        new DoctrineServiceProvider(),
        [
            'db.options' => [
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'dbname' => 'silex_blog',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ]
        ]
);
$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());

// Repositories
$app['category.repository'] = function () use ($app){
    return new CategoryRepository($app['db']);
};

$app['article.repository'] = function () use ($app){
    return new ArticleRepository($app['db']);
};

$app['user.repository'] = function () use ($app){
    return new UserRepository($app['db']);
};

$app['user.manager'] = function () use ($app){
    return new UserManager($app['session']);
};

return $app;
