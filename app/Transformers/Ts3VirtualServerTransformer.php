<?php
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class Ts3VirtualServerTransformer extends TransformerAbstract
{
    /**
     * VirtualServer transformer.
     *
     * @param array $ts3Info
     * @return array
     */
    public function transform(array $ts3Info)
    {
        $arr = [];
        $pattern = "/virtualserver_(.*)/";
        foreach ($ts3Info as $key => $value) {
            if (1 === preg_match($pattern, $key, $matches)) {
                if ($value instanceof \TeamSpeak3_Helper_String) {
                    $value = $value->toString();
                }
                $arr = array_merge($arr, [
                    $matches[1] => $value
                ]);
            }
        }
        return $arr;
    }
}
