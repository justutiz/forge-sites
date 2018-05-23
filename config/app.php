<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'name' => 'Forge Sites',

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    |
    | This value determines the "version" your application is currently running
    | in. You may want to follow the "Semantic Versioning" - Given a version
    | number MAJOR.MINOR.PATCH when an update happens: https://semver.org.
    |
    */
    'version' => app('git.version'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Should be true in production.
    |
    */
    'production' => true,

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */
    'providers' => [
        App\Providers\AppServiceProvider::class,
    ],

    /**
     * Laravel forge API token.
     *
     * Visit https://forge.laravel.com/user/profile#/api to get one.
     */
    'api_token' => env('API_TOKEN', null),

    /**
     * Headers remove from table.
     *
     * Available headers:
     * name, directory, wildcards, status, repository, repository_provider, repository_branch,
     * repository_status, quick_deploy, deployment_status, project_type, app, app_status,
     * hipchat_room, slack_channel, created_at, deployment_url, forge_site_url
     */
    'except' => [
        'id',
        'status',
        'repository_provider',
        'repository_status',
        'deployment_status',
        'created_at',
        'project_type',
        'app_status',
        'app',
        'hipchat_room',
        'wildcards',
        'deployment_url',
    ],
];
