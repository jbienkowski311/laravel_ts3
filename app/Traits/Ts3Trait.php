<?php
namespace App\Traits;

trait Ts3Trait {
    public function connectTs3Query()
    {
        $ts3_server_ip = env('TS3_IP');
        $ts3_server_port = env('TS3_PORT');
        $ts3_query_port = env('TS3_QUERY_PORT');
        $ts3_user = env('TS3_LOGIN');
        $ts3_pass = env('TS3_PASSWORD');

        return \TeamSpeak3::factory("serverquery://{$ts3_user}:{$ts3_pass}@{$ts3_server_ip}:{$ts3_query_port}/?server_port={$ts3_server_port}");
    }
}