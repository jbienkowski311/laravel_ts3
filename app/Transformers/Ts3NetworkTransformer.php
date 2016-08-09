<?php
namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class Ts3NetworkTransformer extends TransformerAbstract
{
    /**
     * Network transformer.
     *
     * @param array $ts3Info
     * @return array
     */
    public function transform(array $ts3Info)
    {
        return [
            'ping' => (double)$ts3Info['virtualserver_total_ping']->toString(),
            'packetloss' => [
                'total' => (double)100*$ts3Info['virtualserver_total_packetloss_total']->toString(),
                'speech' => (double)100*$ts3Info['virtualserver_total_packetloss_speech']->toString(),
                'keepalive' => (double)100*$ts3Info['virtualserver_total_packetloss_keepalive']->toString(),
                'control' => (double)100*$ts3Info['virtualserver_total_packetloss_control']->toString(),
            ],
            'weblist' => (bool)$ts3Info['virtualserver_weblist_enabled']
        ];
    }
}