<?php
namespace App\Transformers;

use App\Traits\Ts3Trait;
use League\Fractal\TransformerAbstract;

class Ts3ClientTransformer extends TransformerAbstract
{
    use Ts3Trait;

    /** @var \TeamSpeak3_Node_Server $ts3 */
    private $ts3;

    /**
     * List of includes.
     *
     * @var array
     */
    protected $availableIncludes = [
        'channel'
    ];

    /**
     * Ts3ClientTransformer constructor.
     */
    public function __construct()
    {
        $this->ts3 = $this->connectTs3Query();
    }

    /**
     * Client transformer.
     *
     * @param \TeamSpeak3_Node_Client $ts3Client
     * @return array
     */
    public function transform(\TeamSpeak3_Node_Client $ts3Client)
    {
        return [
            'client_id' => (int)$ts3Client['clid'],
            'client_database_id' => (int)$ts3Client['client_database_id'],
            'client_ip' => $ts3Client['connection_client_ip'],
            'nickname' => $ts3Client['client_nickname']->toString(),
            'country' => $ts3Client['client_country'],
            'channel_group' => [
                'id' => (int)$ts3Client['client_channel_group_id'],
                'name' => $this->getChannelGroupName($ts3Client['client_channel_group_id'])
            ],
            'server_groups' => $this->getServerGroups($ts3Client['client_servergroups']),
            'away' => [
                'away' => (bool)$ts3Client['client_away'],
                'message' => $ts3Client['client_away_message']
            ],
            'permissions' => [
                'priority_speaker' => (bool)$ts3Client['client_is_priority_speaker'],
                'channel_commander' => (bool)$ts3Client['client_is_channel_commander']
            ],
            'input' => [
                'muted' => (bool)$ts3Client['client_input_muted'],
                'hardware' => (bool)$ts3Client['client_input_hardware']
            ],
            'output' => [
                'muted' => (bool)$ts3Client['client_output_muted'],
                'hardware' => (bool)$ts3Client['client_output_hardware']
            ],
            'talk' => [
                'power' => (int)$ts3Client['client_talk_power'],
                'is_talker' => (bool)$ts3Client['client_is_talker'],
            ],
            'ts3' => [
                'platform' => $ts3Client['client_platform']->toString(),
                'version' => $this->getClientVersion($ts3Client['client_version'])
            ],
            'icon_id' => (int)$ts3Client['client_icon_id']
        ];
    }

    /**
     * Include Client Channel.
     *
     * @param \TeamSpeak3_Node_Client $ts3Client
     * @return \League\Fractal\Resource\Item
     */
    public function includeChannel(\TeamSpeak3_Node_Client $ts3Client)
    {
        $channelId = $ts3Client['cid'];
        $channel = $this->ts3->channelGetById($channelId);

        return $this->item($channel, new Ts3ChannelTransformer);
    }

    /**
     * Get TS3 client version from ServerQuery string.
     *
     * @param $version
     * @return string
     */
    private function getClientVersion($version)
    {
        $pattern = "/[0-9]+(?:\.[0-9]+){3}/s";
        if (1 === preg_match($pattern, $version->toString(), $matches))
        {
            return $matches[0];
        } else {
            return $version->toString();
        }
    }

    /**
     * Get channel group name from cgid.
     *
     * @param $channelGroupId
     * @return string
     */
    private function getChannelGroupName($channelGroupId)
    {
        $channelGroup = $this->ts3->channelGroupGetById($channelGroupId);

        return $channelGroup['name']->toString();
    }

    /**
     * Get array of server groups with names from sgid/sgids.
     *
     * @param $serverGroups
     * @return array
     */
    private function getServerGroups($serverGroups)
    {
        $arr = [];

        if($serverGroups instanceof \TeamSpeak3_Helper_String)
        {
            // groups separated by comma - explode
            $ids = explode(',', $serverGroups->toString());
        } else {
            // single server group - put into array
            $ids = [$serverGroups];
        }
        foreach ($ids as $id) {
            $serverGroup = $this->ts3->serverGroupGetById($id);
            array_push($arr, [
                'id' => $id,
                'name' => $serverGroup['name']->toString()
            ]);
        }
        return $arr;
    }
}