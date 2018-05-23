<?php

namespace App\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\ClientException;
use LaravelZero\Framework\Commands\Command;

class ListSites extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'sites';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List all sites from forge.laravel.com';

    /**
     * Forge response codes.
     *
     * https://forge.laravel.com/api-documentation#errors
     *
     * @var array
     */
    protected $responseCodes = [
        200 => 'Everything is ok.',
        400 => 'Valid data was given but the request has failed.',
        401 => 'No valid API Key was given.',
        404 => 'The request resource could not be found.',
        422 => 'The payload has missing required parameters or invalid data was given.',
        429 => 'Too many attempts.',
        500 => 'Request failed due to an internal error in Forge.',
        503 => 'Forge is offline for maintenance.',
    ];

    protected $except;

    public function __construct()
    {
        parent::__construct();

        $this->except = config('app.except');
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $servers = $this->getServers()->pluck('id');
        $bar     = $this->output->createProgressBar(count($servers));

        $sites = $servers->map(function ($serverId) use ($bar) {
            $bar->advance();

            return $this->getSites($serverId);
        })->flatten(1);

        $bar->finish();
        $this->info(' Done!');

        $sites = $sites->map(function ($site) {
            $site['forge_site_url'] = str_before($site['deployment_url'], '/deploy');

            return collect($site)->except($this->except);
        });

        $headers = array_keys(collect($sites->first())
                        ->except($this->except)
                        ->toArray());

        $this->table($headers, $sites->toArray());
    }

    private function getServers()
    {
        $response = $this->request('servers');

        return collect(json_decode($response->getBody()->getContents(), true)['servers']);
    }

    private function getSites(int $serverId)
    {
        $response = $this->request("servers/{$serverId}/sites");

        return collect(json_decode($response->getBody()->getContents(), true)['sites']);
    }

    private function request(string $url): Response
    {
        try {
            $client = new Client(['base_uri' => 'https://forge.laravel.com/api/v1/']);

            return $client->get($url, [
                    'headers' => [
                        'Authorization'  => 'Bearer ' . config('app.api_token'),
                        'Accept'         => 'application/json',
                        'Content-Type'   => 'application/json',
                    ],
                ]);
        } catch (ClientException $e) {
            echo PHP_EOL;
            $this->error($this->error($this->responseCodes[$e->getCode()] ?? $e->getCode()));
            exit;
        }
    }
}
