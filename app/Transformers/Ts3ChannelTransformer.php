<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class Ts3ChannelTransformer extends TransformerAbstract
{
    /**
     * Channel transformer.
     *
     * @param \TeamSpeak3_Node_Channel $ts3Channel
     * @return array
     */
    public function transform(\TeamSpeak3_Node_Channel $ts3Channel)
    {
        return [
            'channel_id' => $ts3Channel['cid'],
            'parent_id' => $ts3Channel['pid'],
            'order' => $ts3Channel['channel_order'],
            'name' => $ts3Channel['channel_name'],
            'topic' => $ts3Channel['channel_topic'],
            'clients' => $ts3Channel['total_clients'],
            'clients_max' => $ts3Channel['channel_maxclients'],
            'flags' => [
                'default' => (bool)$ts3Channel['channel_flag_default'],
                'password' => (bool)$ts3Channel['channel_flag_password'],
                'permanent' => (bool)$ts3Channel['channel_flag_permanent'],
                'semi_permanent' => (bool)$ts3Channel['channel_flag_semi_permanent']
            ],
            'voice' => [
                'codec' => (int)$ts3Channel['channel_codec'],
                'codec_quality' => (int)$ts3Channel['channel_codec_quality']
            ],
            'permissions' => [
                'needed_talk_power' => $ts3Channel['channel_needed_talk_power'],
                'needed_subscribe_power' => $ts3Channel['channel_needed_subscribe_power']
            ],
            'icon_id' => (int)$ts3Channel['channel_icon_id']
        ];
    }
}