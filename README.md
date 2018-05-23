# Laravel Forge Sites List

Sometimes you just need to know what sites do you have.

![screenshot](https://pbs.twimg.com/media/DcxK3UxX4AENbHr.jpg 'Screenshot')

# Installation

> **Requires [PHP 7.1.3+](https://php.net/releases/)**

Require Forge Sites cloning this repository to any location on your system:

```bash
git clone https://github.com/justutiz/forge-sites.git forge-sites
```

Install the composer dependencies:

```bash
cd forge-sites && composer install
```

Configure the .env:

```bash
cp .env.example .env
```

# Configuration

You can change table columns in `app.php`.

Available headers: name, directory, wildcards, status, repository, repository_provider, repository_branch, repository_status, quick_deploy, deployment_status, project_type, app, app_status, hipchat_room, slack_channel, created_at, deployment_url, forge_site_url

[Get api token here https://forge.laravel.com/user/profile#/api](https://forge.laravel.com/user/profile#/api)

# Usage

```bash
php artisan sites
```

## License

Forge Sites is an open-sourced software licensed under the [MIT license](LICENSE.md).

# Todo

* Deploy Now from command line
* Get Deployment Log
* Reboot server
