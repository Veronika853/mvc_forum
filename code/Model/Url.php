<?php
namespace Model;

class Url
{
    public function getUrl($path, $parameters){
        $baseUrl = \App::getBaseUrl();
        $strParameters = '';
        foreach ($parameters as $key => $value) {
            $strParameters .= '/' . $key . '/' . $value;
        }
        $url = $baseUrl . $path . $strParameters;
        return $url;
    }

    public function getStaticUrl($type ,$fileName){
        $baseUrl = \App::getBaseUrl();
        return "{$baseUrl}/static/{$type}/{$fileName}";
    }

}