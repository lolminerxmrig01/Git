<?php

namespace App\Services;

use App\Domain;
use App\Exceptions\FailedToUpdateDomainDnsException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class NamecheapManager
{
    public $user;

    public $password;

    public $apiUrl = 'https://api.namecheap.com/xml.response';

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function getDomains()
    {
        return Http::get($this->apiUrl, [
            'ApiUser' => $this->user,
            'ApiKey' => $this->password,
            'UserName' => $this->user,
            'Command' => 'namecheap.domains.getList',
            'ClientIp' => '159.89.48.31',
        ]);
    }

    public function updateDNS(Domain $domain)
    {
        $request = Http::get($this->apiUrl, [
            'apiuser' => $this->user,
            'ApiKey' => $this->password,
            'UserName' => $this->user,
            'ClientIp' => '159.89.48.31',
            'Command' => 'namecheap.domains.dns.setHosts',
            'SLD' => $domain->sld(),
            'TLD' => $domain->tld(),
            'HostName1' => '@',
            'RecordType1' => 'A',
            'Address1' => env('REDIRECT_IP'),
            'TTL1' => 100,
        ]);

        if ($this->isSuccess($request->body())) {

            $domainName = $domain->sld().".".$domain->tld();

            $siteData = array(
                "domain" => $domainName,
                "project_type" => "php",
                "directory" => "/",
                "isolated" => false,
                "php_version" => "php74"
            );
            $site = json_decode($this->laravelForge("https://forge.laravel.com/api/v1/servers/509468/sites",$siteData));        
            if(isset($site->site)){
                $site_id = $site->site->id;  
                $siteGIT = array(
                    "provider" => "github",
                    "repository" => "amitthink360/cfr",
                    "branch" => "main",
                    "composer" => false
                );
                $site = json_decode($this->laravelForge("https://forge.laravel.com/api/v1/servers/509468/sites/".$site_id."/git",$siteGIT));   
                if(isset($site->site)){
                    Domain::where('domain', $domainName)->update(['site_id'=>$site_id]);
                }
            }

            return true;
        }

        throw new FailedToUpdateDomainDnsException($this->getError($request->body()));
    }

    /**
     * Get the first error from a failed Namecheap response.
     *
     * @param  string $body
     * @return string
     */
    protected function getError($body)
    {
        $body = (string) $body;

        $xml = simplexml_load_string($body);

        $error = Arr::first((array) $xml->Errors);

        return is_array($error) ? $error[0] : $error;
    }

    /**
     * Determine if the API call was a success.
     *
     * @param  string $body
     * @return boolean
     */
    protected function isSuccess($body)
    {
        $body = (string) $body;

        $xml = simplexml_load_string($body);

        $status = (array) $xml['Status'];
        $status = $status[0];

        return $status === 'OK';
    }

    protected function laravelForge($url,$params=array())
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($params),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODJjNDU1ODhmYmZhY2RlZDcyMjEyNzA0ZjM0NTYyNzU5ZGU4MGNjMjgxM2NkNTg1Y2YwNTU5Y2EzOGMzZjAyNWMxYTg4YmU1Yzk5YmY2MmYiLCJpYXQiOjE2MzU5Njk4NDIuMDM3Mzc2LCJuYmYiOjE2MzU5Njk4NDIuMDM3Mzc4LCJleHAiOjE5NTE1MDI2NDIuMDA5MTI4LCJzdWIiOiIxNjAwODEiLCJzY29wZXMiOltdfQ.DWit_YpCKJyK0LkRntDOvXKrI8Jqnr8nNP7RDR4LkBt2JjA2F2mwvCOp4Opelz6JEQ4oUrXWOFc_ecD_RaXa50J8vuOrDu_IfMy53-yZTFWct83ETI_4YfZM8OdDVO78rnLVnLihLkgnSdPVQ2CJ7Cn9AQNgzzxXcZmWYvsgbvkDels9m9FyNkTxXGzcKV-F8sMIGSdKgksLvnLuU2__SZAYPSe3PLxVOxsS2DGjpRVV8fvxo5yHJhmNrZn9P53xH8BcWRwngAnFb_VzorDkPVr_9uV22K5foFGVZl-AM9pKSoVyHDSeoy-8f3jJanJbLEq_4TweO9Tt0UTTDgcl116Akrd4y8RtNv_uc8GghFU28MULlnRG6X7jGphdsec3D5l8Zid8c5yQG-Olc9Gy-4FxFUzXdUaO24m8dpl3ntJ8hM_FdWvCWbvVZRtRueppyNWfySMC_Z_PE0vIWdlszQm4QhYBmo5GyrBHF5ibvk1gYoha1Rack_0YXutK6yqCpvyP0aENZZezuh0_OlbRmVuJukQO2tfDwRVQG5ZZerCO95iltjq6ThpDTwPObK472rKsPaGt-8mz-Yw_zNIPokbGJR9sqiCkt_oMmTSEQ9KMZN0vqJRC0JNN7A9GL7TdM4ywv4KZ5M9tZFV0GIlbLYdYOfSyVRzjb1clJQe4xYA',
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
