<?php
namespace App\Transformers;

use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class Ts3DefaultTransformer extends TransformerAbstract
{
    /**
     * List of includes.
     *
     * @var array
     */
    protected $availableIncludes  = [
        'clients',
        'channels',
        'virtualserver',
        'network',
        'connection'
    ];

    /**
     * TeamSpeak3 info transformer.
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return array
     */
    public function transform(\TeamSpeak3_Node_Server $ts3)
    {
        $ts3Info = $ts3->getInfo();

        return [
            'id' => (int)$ts3Info['virtualserver_id'],
            'name' => $ts3Info['virtualserver_name']->toString(),
            'ip' => $this->getIpAddress($ts3Info),
            'port' => (int)$ts3Info['virtualserver_port'],
            'isOnline' => (bool)$ts3Info['virtualserver_status']->toString() === 'online',
            'status' => $ts3Info['virtualserver_status']->toString(),
            'reserved_slots' => $ts3Info['virtualserver_reserved_slots'],
            'clients_online' =>
                (int)($ts3Info['virtualserver_clientsonline'] - $ts3Info['virtualserver_queryclientsonline']),
            'clients_max' => (int)$ts3Info['virtualserver_maxclients'],
            'channels_created' => (int)$ts3Info['virtualserver_channelsonline'],
            'uptime' => $ts3Info['virtualserver_uptime'],
            'uptime_human' => $this->getReadableUptime($ts3Info),
            'created_at' => $ts3Info['virtualserver_created']
        ];
    }

    /**
     * Include Clients.
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return \League\Fractal\Resource\Collection
     */
    public function includeClients(\TeamSpeak3_Node_Server $ts3)
    {
        // Remove ServerAdmin from ClientList
        $ts3Clients = $ts3->clientList();
        $serverAdmin = $ts3->clientList(['client_database_id' => 1]);
        $ts3Clients = array_diff($ts3Clients, $serverAdmin);

        return $this->collection($ts3Clients, new Ts3ClientTransformer);
    }

    /**
     * Include Channels.
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return \League\Fractal\Resource\Collection
     */
    public function includeChannels(\TeamSpeak3_Node_Server $ts3)
    {
        $ts3Channels = $ts3->channelList();

        return $this->collection($ts3Channels, new Ts3ChannelTransformer);
    }

    /**
     * Include Virtualserver
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return \League\Fractal\Resource\Item
     */
    public function includeVirtualserver(\TeamSpeak3_Node_Server $ts3)
    {
        $ts3Info = $ts3->getInfo();

        return $this->item($ts3Info, new Ts3VirtualServerTransformer);
    }

    /**
     * Include Channels.
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return \League\Fractal\Resource\Item
     */
    public function includeNetwork(\TeamSpeak3_Node_Server $ts3)
    {
        $ts3Info = $ts3->getInfo();

        return $this->item($ts3Info, new Ts3NetworkTransformer);
    }

    /**
     * Include Connection.
     *
     * @param \TeamSpeak3_Node_Server $ts3
     * @return \League\Fractal\Resource\Item
     */
    public function includeConnection(\TeamSpeak3_Node_Server $ts3)
    {
        $ts3Info = $ts3->getInfo();

        return $this->item($ts3Info, new Ts3ConnectionTransformer);
    }

    /**
     * Get IP address from ServerQuery string response.
     *
     * @param array $ts3Info
     * @return string
     */
    private function getIpAddress(array $ts3Info)
    {
        $pattern = "/[0-9]+(?:\.[0-9]+){3}/s";
        if (is_null($ts3Info['virtualserver_ip'])) {
            return env('TS3_IP');
        } elseif (1 === preg_match($pattern, $ts3Info['virtualserver_ip']->toString(), $matches)) {
            return $matches[0];
        } else {
            return $ts3Info['virtualserver_ip']->toString();
        }
    }

    /**
     * Create readable uptime string.
     *
     * @param array $ts3Info
     * @return string
     */
    private function getReadableUptime(array $ts3Info)
    {
        $time = $ts3Info['virtualserver_uptime'];
        $diff = Carbon::now()->diff(Carbon::createFromTimestampUTC(time() - $time));
        $uptime = '';
        if ($diff->y > 0) {
            $uptime .= "{$diff->y} years ";
        }
        if ($diff->m > 0) {
            $uptime .= "{$diff->m} months ";
        }
        $uptime .= "{$diff->h} hours {$diff->i} minutes {$diff->s} seconds";

        return $uptime;
    }
}