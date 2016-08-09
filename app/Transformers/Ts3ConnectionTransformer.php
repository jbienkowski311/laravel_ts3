<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class Ts3ConnectionTransformer extends TransformerAbstract
{
    /**
     * Connection transformer.
     *
     * @param array $ts3Info
     * @return array
     */
    public function transform(array $ts3Info)
    {
        return [
            'filetransfer' => [
                'bandwidth_sent' => $ts3Info['connection_filetransfer_bandwidth_sent'],
                'bandwidth_received' => $ts3Info['connection_filetransfer_bandwidth_received'],
                'bytes_sent_total' => $ts3Info['connection_filetransfer_bytes_sent_total'],
                'bytes_received_total' => $ts3Info['connection_filetransfer_bytes_received_total']
            ],
            'packets' => [
                'sent_speech' => $ts3Info['connection_packets_sent_speech'],
                'received_speech' => $ts3Info['connection_packets_received_speech'],
                'sent_keepalive' => $ts3Info['connection_packets_sent_keepalive'],
                'received_keepalive' => $ts3Info['connection_packets_received_keepalive'],
                'sent_control' => $ts3Info['connection_packets_sent_control'],
                'received_control' => $ts3Info['connection_packets_received_control'],
                'sent_total' => $ts3Info['connection_packets_sent_total'],
                'received_total' => $ts3Info['connection_packets_received_total']
            ],
            'bytes' => [
                'sent_speech' => $ts3Info['connection_bytes_sent_speech'],
                'received_speech' => $ts3Info['connection_bytes_received_speech'],
                'sent_keepalive' => $ts3Info['connection_bytes_sent_keepalive'],
                'received_keepalive' => $ts3Info['connection_bytes_received_keepalive'],
                'sent_control' => $ts3Info['connection_bytes_sent_control'],
                'received_control' => $ts3Info['connection_bytes_received_control'],
                'sent_total' => $ts3Info['connection_bytes_sent_total'],
                'received_total' => $ts3Info['connection_bytes_received_total']
            ],
            'bandwidth' => [
                'sent_last_second_total' => $ts3Info['connection_bandwidth_sent_last_second_total'],
                'received_last_second_total' => $ts3Info['connection_bandwidth_received_last_second_total'],
                'sent_last_minute_total' => $ts3Info['connection_bandwidth_sent_last_minute_total'],
                'received_last_minute_total' => $ts3Info['connection_bandwidth_received_last_minute_total']
            ]
        ];
    }
}