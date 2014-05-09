<?php
Yii::import('application.vendors.*');
require_once('Mierendo/imageSmoothArc_optimized.php');


class ActivityMarker
{
	public $latitude;
	public $longitude;
	public $weight;
	public $range;

	// copied from Player.php
	public function calcDistance($model){
		$distance = 0;
		if($model!==null){

			// set up some constants
			$deltaLatitude = $model->latitude - $this->latitude;
			$deltaLongitude = $model->longitude - $this->longitude;
			$alpha = $deltaLatitude / 2;
			$beta = $deltaLongitude / 2;
		
			// calculate distance
			$partial = 	sin(deg2rad($alpha)) * 
					sin(deg2rad($alpha)) + cos(deg2rad($this->latitude)) * 
					cos(deg2rad($model->latitude)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
			$partial = asin(min(1, sqrt($partial)));
			$distance = 2 * Player::EARTH_RADIUS * $partial;
			$distance = round($distance, 0);
		}		
		return $distance;
	}
}

class DailyCommand extends CConsoleCommand
{
	const APNS_HOST="feedback.push.apple.com";
	const APNS_PORT=2196;

	const EXPECTED_DAYS=90;
	const EXPECTED_DAILY_PLAYER_MISSIONS=0.15;
	const MINIMUM_PLAYERS=1000;

	// activity contants
	const ACTIVITY_TIME=86400; 		// 1 day in seconds
	const ACTIVITY_RANGE=20000;		// meters
//	const ACTIVITY_RANGE=2000000;		// meters
	const ACTIVITY_THRESHOLD=1;

	private $dailyStatistics;

	public function run($args)
	{
		if(in_array("all",$args) || (sizeof($args)==0)){
			$this->genDailyStats();
			$this->genActivityMap();
			$this->updatePlayerCount();
			$this->updateNationLevels();
			$this->updateNationKeys();
			$this->cleanExpiredMissions();
			$this->cleanExpiredMissionLocations();
			$this->cleanExpiredNpcs();
			$this->cleanExpiredResetPasswords();
			$this->removeExpiredTokens();
		}
		else{
			foreach($args as $arg){
				switch(strtolower($arg)){
					case "updateplayercount":
						$this->updatePlayerCount();
						break;
					case "updatenationlevels":
						$this->updateNationLevels();
						break;
					case "updatenationkeys":
						$this->updateNationKeys();
						break;
					case "cleanexpiredmissions":
						$this->cleanExpiredMissions();
						break;
					case "cleanexpiredmissionlocations":
						$this->cleanExpiredMissionLocations();
						break;
					case "cleanexpirednpcs":
						$this->cleanExpiredNpcs();
						break;
					case "cleanexpiredresetpasswords":
						$this->cleanExpiredResetPasswords();
						break;
					case "genactivitymap":
						$this->genActivityMap();
						break;
					case "removeexpiredtokens":
						$this->removeExpiredTokens();
						break;
				}
			}
		}
	}

	/**
	 * Create an entry in the daily statistics table.
	 */
	public function genDailyStats()
	{
		$constants=Constants::model()->findbyPk(1);
		$this->dailyStatistics=new DailyStatistics;
		$this->dailyStatistics->roundId=$constants->roundId;
		$this->dailyStatistics->timeStamp=time();
		$this->dailyStatistics->timeOffset=rand(-5879,5879); // +- 97 minutes and 59 seconds
		$this->dailyStatistics->save();
	}

	/**
	 * Generate the player activity map.
	 */
/*	public function genActivityMap()
	{
		// build activity clusters
		$activityMarkers=array();
		$criteria=new CDbCriteria;
		$criteria->condition="locationTimeStamp > ".(time()-self::ACTIVITY_TIME);			// 24 hours
		$players=Player::model()->findAll($criteria);
		foreach($players as $player){
			$clustered=false;
			$merged=false;
			foreach($activityMarkers as $markerIndex=>$marker){
				$marker=&$activityMarkers[$markerIndex];
				if($player->calcDistance($marker) < $marker->range){
					$marker->weight=$marker->weight + 1;
					$marker->latitude=$marker->latitude + (($player->latitude - $marker->latitude)/$marker->weight);
					$marker->longitude=$marker->longitude + (($player->longitude - $marker->longitude)/$marker->weight);
					$clustered=true;
					for($mergeMarkerIndex=0; $mergeMarkerIndex<sizeof($activityMarkers); $mergeMarkerIndex++){
						$mergeMarker=&$activityMarkers[$mergeMarkerIndex];
						if($mergeMarkerIndex!=$markerIndex){
							$range=$mergeMarker->range > $marker->range ? $mergeMarker->range : $marker->range;
							if($mergeMarker->calcDistance($marker)  < $range){
echo "Merging:\r\n";
echo "mergeMarker ".$mergeMarkerIndex.", marker ".$markerIndex."\r\n";
print_r($marker);
echo "\r\n";
print_r($mergeMarker);
echo "\r\n";
								$newWeight=$mergeMarker->weight + $marker->weight;
								$mergeMarker->latitude=(($mergeMarker->latitude * $mergeMarker->weight) + ($marker->latitude * $marker->weight))/$newWeight;
								$mergeMarker->longitude=(($mergeMarker->longitude * $mergeMarker->weight) + ($marker->longitude * $marker->weight))/$newWeight;
								$mergeMarker->weight=$newWeight;
								$merged=true;
print_r($mergeMarker);
echo "Complete-------\r\n\r\n";
								break;
							}
						}
					}
					break;
				}
			}
			if(!$clustered){
				$marker=new ActivityMarker;
				$marker->latitude=$player->latitude;
				$marker->longitude=$player->longitude;
				$marker->weight=1;
				$marker->range=self::ACTIVITY_RANGE;
				array_push($activityMarkers,$marker);
			}
			else if($merged){
				unset($activityMarkers[$markerIndex]);
				$activityMarkers=array_values($activityMarkers);
			}
print_r($activityMarkers);
		}

		// import map image
		$image=imagecreatefrompng(Yii::app()->basePath.'/../images/ispies/activity/mercator.png');

		// create a temp image for placing markers
		$tempImage=imagecreate(720, 720);
		imagealphablending ($tempImage, true);
		$colorIn = imagecolorallocate($tempImage, 200, 210, 255); 
		$colorOut = imagecolorallocate($tempImage, 190, 200, 255,127);
		imagecopy($tempImage,$image,0,0,0,0,720,720);
		imagedestroy($image);

		// place activity markers
		foreach($activityMarkers as $marker){
			if($marker->weight >= self::ACTIVITY_THRESHOLD){
				$coordinates=$this->gpsToXY($marker);
				imagefilledellipse($tempImage,$coordinates['x'],$coordinates['y'],3,3,$colorIn);
				imageellipse($tempImage,$coordinates['x'],$coordinates['y'],5,5,$colorOut);
			}
		}

		// create the output image
		$cropImage=imagecreate(720,420);
		imagecopy($cropImage,$tempImage,0,0,0,81,720,420);
		imagepng($cropImage, Yii::app()->basePath.'/../images/ispies/activity/satScan.png');
		imagedestroy($cropImage);
		imagedestroy($tempImage);
	}*/

	/**
	 * Generate the player activity map.
	 */
	public function genActivityMap()
	{
		// build activity clusters
		$activityMarkers=array();
		$criteria=new CDbCriteria;
		$criteria->condition="locationTimeStamp > ".(time()-self::ACTIVITY_TIME);			// 24 hours
		$players=Player::model()->findAll($criteria);
		foreach($players as $player){
			$clustered=false;
			$merged=false;
			foreach($activityMarkers as &$marker){
				if($player->calcDistance($marker) < $marker->range){
					$marker->weight=$marker->weight + 1;
					$marker->latitude=$marker->latitude + (($player->latitude - $marker->latitude)/$marker->weight);
					$marker->longitude=$marker->longitude + (($player->longitude - $marker->longitude)/$marker->weight);
					$clustered=true;
					break;
				}
			}
			if(!$clustered){
				$marker=new ActivityMarker;
				$marker->latitude=$player->latitude;
				$marker->longitude=$player->longitude;
				$marker->weight=1;
				$marker->range=self::ACTIVITY_RANGE;
				array_push($activityMarkers,$marker);
			}
		}
//print_r($activityMarkers);

		// import map image
		$image=imagecreatefrompng(Yii::app()->basePath.'/../images/ispies/activity/mercator.png');
		$colorWhite = imagecolorallocate($image, 255, 255, 255);

		// place activity markers
		foreach($activityMarkers as $marker){
			if($marker->weight >= self::ACTIVITY_THRESHOLD){
				$coordinates=$this->gpsToXY($marker);
			        imageSmoothArc (&$image,$coordinates['x'],$coordinates['y'],2,2, array(200,210,255,0), 0, 2*M_PI);
			}
		}

		// create the output image
		$cropImage=imagecreatetruecolor(720,420);
		imagecopy($cropImage,$image,0,0,0,81,720,420);
		imagepng($cropImage, Yii::app()->basePath.'/../images/ispies/activity/satScan.png');
		imagedestroy($cropImage);
		imagedestroy($image);

	}

	private function gpsToXY($marker)
	{
		// image size parameters
		$circumference = 720;
		$radius = $circumference / (2 * M_PI);

		// determine offsets
		$falseEasting = -1.0 * $circumference / 2;
		$falseNorthing = $circumference / 2;

		// calculate coordinates
		$x = ($radius * deg2rad($marker->longitude)) - $falseEasting;
		$y = ( ($radius / 2.0 * log( (1.0 + sin(deg2rad($marker->latitude))) / (1.0 - sin(deg2rad($marker->latitude))) ) ) - $falseNorthing) * -1;

		return array('x'=>$x,'y'=>$y);
	}

	/**
	 * Count the number of active players.
	 */
	public function updatePlayerCount()
	{
		$constants=Constants::model()->findbyPk(1);
		if($constants!==null){					
			$criteria=new CDbCriteria;
			$criteria->condition="roundId = ".$constants->roundId;
			$agents=Player::model()->count($criteria);
			$constants->playerCount=$agents;
			$constants->save();
		}
	}

	/**
	 * Set the national levels
	 */
	public function updateNationLevels()
	{
		$constants=Constants::model()->findbyPk(1);
		$round=Round::model()->findbyPk($constants->roundId);
		if($round!==null){

			// loop calculating nation levels
			$criteria=new CDbCriteria;
			$condition="roundId = ".$round->roundId." AND victoryTime > ".(time() - 86400);		// 24 hours
			$nations = array(Player::CHINA, Player::RUSSIA, Player::UNITED_STATES, Player::EUROPEAN_UNION);
			foreach($nations as $nation){
				$criteria->condition=$condition." AND victorNation = ".$nation;
				$missions=Mission::model()->count($criteria);

				// determine the weighted average for the nation
				$query="SELECT COUNT(playerId) AS activePlayers, AVG(informationLevel) AS averageLevel FROM Player WHERE roundId = ? AND nation = ? AND locationTimeStamp > ?";
				$parameters=array($round->roundId, $nation, (time()-86400));
				$information=Player::model()->findBySql($query,$parameters);
				if($information!==null)
					$weightedPlayers=$information->activePlayers * $information->averageLevel;
				if($weightedPlayers < self::MINIMUM_PLAYERS)
					$weightedPlayers=self::MINIMUM_PLAYERS;
				
				// determine the percent completed
				$expectedMissions=self::EXPECTED_DAYS * self::EXPECTED_DAILY_PLAYER_MISSIONS * $weightedPlayers;
				$percentComplete=$missions/$expectedMissions;

				// set the nation level
				switch($nation){
					case Player::CHINA:
						$round->percentCh = $round->percentCh + $percentComplete;
						$level=(int)($round->levelRequirement * $round->percentCh);
						$round->levelCh = $level;
						break;
					case Player::RUSSIA:
						$round->percentRu = $round->percentRu + $percentComplete;
						$level=(int)($round->levelRequirement * $round->percentRu);
						$round->levelRu = $level;
						break;
					case Player::UNITED_STATES:
						$round->percentUs = $round->percentUs + $percentComplete;
						$level=(int)($round->levelRequirement * $round->percentUs);
						$round->levelUs = $level;
						break;
					case Player::EUROPEAN_UNION:
						$round->percentEu = $round->percentEu + $percentComplete;
						$level=(int)($round->levelRequirement * $round->percentEu);
						$round->levelEu = $level;
						break;
				}
			}
			$round->save();
		}
	}

	/**
	 * Set the national levels
	 */
	public function updateNationKeys()
	{
		$constants=Constants::model()->findbyPk(1);
		$round=Round::model()->findbyPk($constants->roundId);
		if($round!==null){

			$keySources = array(new KeyFive, new KeySix, new KeySeven, new KeyEight);
			$keyDurations = array(1159200,1076400,993600,910800,828000,745200,662400,579600,496800,414000,331200,248400,165600,82800);

			// loop, updating nation keys as needed
			$nations = array(Player::CHINA, Player::RUSSIA, Player::UNITED_STATES, Player::EUROPEAN_UNION);
			foreach($nations as $nation){
				switch($nation){
					default:
					case Player::CHINA:
						$level = $round->levelCh;
						$keyTime = $constants->keyTimeCh;
						break;
					case Player::RUSSIA:
						$level = $round->levelRu;
						$keyTime = $constants->keyTimeRu;
						break;
					case Player::UNITED_STATES:
						$level = $round->levelUs;
						$keyTime = $constants->keyTimeUs;
						break;
					case Player::EUROPEAN_UNION:
						$level = $round->levelEu;
						$keyTime = $constants->keyTimeEu;
						break;
				}
				$keyDurationIndex = (int)($level / count($keySources));
				if($keyDurationIndex > count($keyDurations))
					$keyDurationIndex = count($keyDurations) - 1;
				$keyDuration = $keyDurations[$keyDurationIndex];
				if($keyTime + $keyDuration < time()){
					$keySourceIndex = $level % count($keySources);
					$keySource = $keySources[$keySourceIndex];
					switch($nation){
						default:
						case Player::CHINA:
							$constants->keyCh = $keySource->getRandomKey()->keyString;
							$constants->codeCh = $keySource->encrypt($constants->keyCh);
							$constants->keyTimeCh = time();
							break;
						case Player::RUSSIA:
							$constants->keyRu = $keySource->getRandomKey()->keyString;
							$constants->codeRu = $keySource->encrypt($constants->keyRu);
							$constants->keyTimeRu = time();
							break;
							break;
						case Player::UNITED_STATES:
							$constants->keyUs = $keySource->getRandomKey()->keyString;
							$constants->codeUs = $keySource->encrypt($constants->keyUs);
							$constants->keyTimeUs = time();
							break;
						case Player::EUROPEAN_UNION:
							$constants->keyEu = $keySource->getRandomKey()->keyString;
							$constants->codeEu = $keySource->encrypt($constants->keyEu);
							$constants->keyTimeEu = time();
							break;
					}
				}
				
			}// foreach($nations...
			$constants->save();
		}// if($round...
	}

	/**
	 * Clean up after any expired missions.
	 */
	public function cleanExpiredMissions()
	{
		$constants=Constants::model()->findbyPk(1);
		if($constants!==null){					
			$criteria=new CDbCriteria;
/*			$criteria->condition=	"roundId = ".$constants->roundId." AND (".
							"(pickupPlayerId != 0 AND pickupTimeLimit < ".time().") OR ".			// pickup
							"(dropTimeLimit < ".time()." AND dropTime < ".(time()-Mission::STALE_TIME).")".	// drop
						") AND victorNation != ".Player::NATION_NULL;*/
			$criteria->condition=	"roundId = ".$constants->roundId.
						" AND stage != ".Mission::COMPLETE.
						" AND stage != ".Mission::FAILED.
						" AND stageExpire < UNIX_TIMESTAMP()";
			$missions=Mission::model()->findAll($criteria);
			foreach($missions as $mission)
				$mission->expired();
		}
	}


	/**
	 * Clean up after any expired missions.
	 */
	public function cleanExpiredMissionLocations()
	{
		$criteria=new CDbCriteria;
		$criteria->condition="expire < UNIX_TIMESTAMP()";
		$count=MissionLocation::model()->deleteAll($criteria);
	}

	/**
	 * Clean up after any expired npc players.
	 */
	public function cleanExpiredNpcs()
	{
		$constants=Constants::model()->findbyPk(1);
		if($constants!==null){					
			$criteria = new CDbCriteria;
			$criteria->condition = "roundId = ".$constants->roundId." AND expire < UNIX_TIMESTAMP()";

			// herrings
			$agents = NpcHerring::model()->findAll($criteria);
			foreach($agents as $agent)
				$agent->delete();

			// ambushes
			$agents = NpcAmbush::model()->findAll($criteria);
			foreach($agents as $agent)
				$agent->delete();

			// securities
			$agents = NpcSecurity::model()->findAll($criteria);
			foreach($agents as $agent)
				$agent->delete();
		}
	}


	/**
	 * Clean up any reset password attempts.
	 */
	public function cleanExpiredResetPasswords()
	{				
		$criteria = new CDbCriteria;
		$criteria->condition = "expire < UNIX_TIMESTAMP()";
		$expiredResets = ResetPassword::model()->findAll($criteria);
		foreach($expiredResets as $expired)
			$expired->delete();
	}

	/**
	 * Remove any expired device tokens
	 */
	public function removeExpiredTokens()
	{
		// connect to apns server
		$apnsUrl = 'ssl://'.self::APNS_HOST.':'. self::APNS_PORT;
		$apnsCert = Yii::app()->basepath.'/certificates/iSpies.pem';

		// generate stream
		$streamContext = stream_context_create();
		stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
		
		// create the socket connection
		$apns = stream_socket_client($apnsUrl, $error, $errorMessage, 60, STREAM_CLIENT_CONNECT, $streamContext);
		if(!$apns) {
			echo "ERROR $error: $errorMessage\n";
			return;
		}

		// collect the feedback tokens
		$feedbackTokens = array();
		//and read the data on the connection:
		while(!feof($apns)) {
			$data = fread($apns, 38);
			if(strlen($data)) {
				$feedbackTokens[] = unpack("N1timestamp/n1length/H*devtoken", $data);
			}
		}
		fclose($apns);

		// clear any unresponsive tokens from the database
		if(count($feedbackTokens)){
			$criteria = new CDbCriteria;
			$criteria->condition = "";
			foreach($feedbackTokens as $token){
				if(strlen($criteria->condition) > 0)
					$criteria->condition .= " OR ";
				$tokenSegments = str_split($token['devtoken'],8);
				$criteria->condition .= "deviceToken = '".implode(" ",$tokenSegments)."'";
			}
			Player::model()->updateAll(array("deviceToken" => ""),$criteria);
		}
	}

}
