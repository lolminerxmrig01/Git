<?php

namespace App\Jobs;

use App\Jobs\IncrementFileUploadBreakdown;
use App\Lead;
use App\Carrier;
use App\Support\CarrierLookup;
use App\Suppression;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

class ConvertFileUploadRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileUpload;

    public $record;

    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fileUpload, $record)
    {
        $this->onQueue('convert-file-upload-record');
        $this->fileUpload = $fileUpload;
        $this->record = array_values($record);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'first_name' => $this->getColumn('first_name'),
            'last_name' => $this->getColumn('last_name'),
            'email' => $this->getColumn('email'),
            'phone' => number($this->getColumn('phone')),
            'region' => $this->getColumn('state'),
            'city' => $this->getColumn('city'),
            'catalog_id' => $this->fileUpload->catalog_id,
            'team_id' => $this->fileUpload->team_id,
        ];
		
		if($data['phone'] !== ""){
			$teamInfo = DB::table('teams')->where('id', $this->fileUpload->team_id)->first();
			
			if($teamInfo->clean_access == 1){
				if ($this->fileUpload->catalog->leads()->where('phone', $data['phone'])->exists()) {
					return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'duplicates');
				}
				
				$phone = $data['phone'];
			
				if(strlen($data['phone']) == 11){
					$phone = ltrim($data['phone'], '1');
				}
				
				$carrierInformation = $this->getCarrierInfo($phone);

				if ($carrierInformation->number_type !== "M") {
					return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'landlines');
				}

				if (
					$this->isSuppressed($data['phone'], $this->fileUpload->team_id)
				) {
					return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'rejected');
				}
				
				$mainCarriers = [
					'Verizon', 'T-Mobile', 'AT&T', 'Metro PCS', 'U.S Cellular', 'Sprint'
				];        
				
				if ($this->carrierExist($carrierInformation->carrier_name, $mainCarriers) !== false) {
					
					$sys_carrier = $this->carrierExist($carrierInformation->carrier_name, $mainCarriers);
					
					$carrier = Carrier::where('name', $sys_carrier)->first();
					
					if($sys_carrier == 'Sprint'){
						$carrier_id = 4;
					}else{
						$carrier_id = $carrier->id;
					}
					
				}elseif($carrierInformation->carrier_name == "CINGULAR WIRELESS-NSR/2"){
					$carrier_id = 8;
				}elseif($carrierInformation->carrier_name == "TMOBILE"){
					$carrier_id = 4;
				}else{
					$carrier_id = 7;
				}

				$data['city'] = $data['city'] ?: "US";
				$data['region'] = $data['region'] ?: "US";
				$data['timezone'] = "America/Chicago";
				$data['carrier'] = $carrierInformation->carrier_name;
				$data['carrier_id'] = $carrier_id;
				$data['type'] = $carrierInformation->number_type;
				$data['start_hour'] = 8;
				$data['end_hour'] = 20;

				Lead::create($data);
			}else{
				
				$carrierInformation = CarrierLookup::phone($data['phone']);
				[$startHour, $endHour] = $carrierInformation->sendingHours();
				
				if ($this->fileUpload->catalog->leads()->where('phone', $data['phone'])->exists()) {
					return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'duplicates');
				}

				if ($this->isSuppressed($data['phone'], $this->fileUpload->team_id)) {
					return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'rejected');
				}
				
				//$ucarrier = $this->getColumn('carrier');
				
				if($this->getColumn('carrier')){
					$ucarrier = $this->getColumn('carrier');
					$carrier_info = $this->getColumn('carrier');
					
					$mainCarriers = [
						'Verizon', 'T-Mobile', 'AT&T', 'Metro PCS', 'U.S Cellular', 'Sprint'
					];        
					
					if ($this->carrierExist($ucarrier, $mainCarriers) !== false) {
						
						$sys_carrier = $this->carrierExist($ucarrier, $mainCarriers);
						
						$carrier = Carrier::where('name', $sys_carrier)->first();
						
						if($sys_carrier == 'Sprint'){
							$carrier_info_id = 4;
						}else{
							$carrier_info_id = $carrier->id;
						}
						
					}elseif($ucarrier == "TMOBILE"){
						$carrier_info_id = 4;
					}elseif($ucarrier == "CINGULAR WIRELESS-NSR/2"){
						$carrier_info_id = 8;
					}elseif($ucarrier == "US CELLULAR CORP."){
						$carrier_info_id = 5;
					}else{
						$carrier_info_id = 7;
					}
				}else{
					if (!$carrierInformation->mobile()) {
						return IncrementFileUploadBreakdown::dispatch($this->fileUpload, 'landlines');
					}
					
					if($carrierInformation->carrier == 'T-Mobile' || $carrierInformation->carrier == 'Sprint'){
						$carrier_info = 'T-Mobile';
						$carrier_info_id = 4;
					}else{
						$carrier_info = $carrierInformation->carrier;
						$carrier_info_id = $carrierInformation->carrierObject()->id;
					}
				}

				$data['city'] = $data['city'] ?: $carrierInformation->city;
				$data['region'] = $data['region'] ?: $carrierInformation->region;
				$data['timezone'] = $carrierInformation->timezone;
				$data['carrier'] = $carrier_info;
				$data['carrier_id'] = $carrier_info_id;
				$data['type'] = $carrierInformation->type;
				$data['start_hour'] = $startHour;
				$data['end_hour'] = $endHour;

				Lead::create($data);
			}
		}
    }
	
	public function getCarrierInfo($phone)
    {
        $curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://txtria.info/s3cr3t/syn_lookup_number.php?key=M2QLapHf9ddDjUgw&number='.$phone,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$result = json_decode($response);
		//echo"<pre/>";print_r($result);

        return $result;
    }
	
	function carrierExist($str, array $arr)
	{
		foreach($arr as $a) {
			if (stripos($str,$a) !== false) return $a;
		}
		return false;
	}	

    public function getColumn($column)
    {
        if (
            !array_key_exists($column, $this->fileUpload->mapping) ||
            !array_key_exists($this->fileUpload->mapping[$column], $this->record)
        ) {
            return null;
        }

        return $this->record[$this->fileUpload->mapping[$column]];
    }

    public function isSuppressed($phone, $teamId)
    {
        return Suppression::isSuppressed($teamId, $phone) || Lead::where('team_id', $teamId)->where('phone', $phone)->whereNotNull('suppressed_at')->exists();
    }

    public function tags()
    {
        return ['ConvertFileUploadRecord'];
    }
}
