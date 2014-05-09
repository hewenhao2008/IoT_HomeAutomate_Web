<?php

class Location
{
	const EARTH_RADIUS=6378137; // meters

	private $m_oTarget;

	/***********************************************************************
	 * byDistance		<Location.php>
	 *
	 * usage:		mixed byDistance($aData, $fLatitude, $fLongitude);
	 *
	 * description:		sorts an array of locations by distance to specified
	 *				latitude and longitude
	 *
	 * parameteres:		aData - array of data needed to insert a new location_sort
	 *			fLatitude - latitude coordinate
	 *			fLongitude - coordinate
	 *
	 * returns:		sorted array
	 ***********************************************************************/
	public function byDistance($aData, $oTarget){
		$this->m_oTarget = $oTarget;
		usort($aData, array($this,"distanceCallback"));
		return $aData;
	}
		
	/***********************************************************************
	 * distanceCallback	<Location.php>
	 *
	 * usage:		distanceCallback();
	 *
	 * description:		tests a set of coordinates to determine if they 
	 *			correspond to a know business location_sort
	 *
	 * parameteres:		aA - array containing location cooridinates
	 *			aB - array containing location cooridinates
	 *
	 * returns:		0 if equal
	 *			-1 if A < B
	 *			1 otherwise
	 ***********************************************************************/
	public function distanceCallback($aA, $aB){

		// calculate the distances from A and B to coordinates
		$iDistanceA = $this->calcDistance($this->m_oTarget,$aA);
		$iDistanceB = $this->calcDistance($this->m_oTarget,$aB);

		// return the comparison
		if($iDistanceA == $iDistanceB) return 0;
		return ($iDistanceA < $iDistanceB) ? -1 : 1;
	}	

	/***********************************************************************
	 * calcDistance		<Location.php>
	 *
	 * usage:		calcDistance();
	 *
	 * description:		calculate the distance between points A and B using
	 *			the Haversine Formula
	 *			http://sgowtham.net/blog/2009/08/04/php-calculating-distance-between-two-locations-given-their-gps-coordinates/
	 *
	 * parameteres:		aA - array containing location cooridinates
	 *			aB - array containing location cooridinates
	 *
	 * returns:		distance in meters
	 ***********************************************************************/
	public function calcDistance($aA, $aB){

		// set up some constants
		$fDeltaLatitude = $aB->reportedLatitude - $aA->reportedLatitude;
		$fDeltaLongitude = $aB->reportedLongitude - $aA->reportedLongitude;
		$fAlpha = $fDeltaLatitude / 2;
		$fBeta = $fDeltaLongitude / 2;
		
		// calculate distance
		$fPartial = sin(deg2rad($fAlpha)) * sin(deg2rad($fAlpha)) + cos(deg2rad($aA->reportedLatitude)) * cos(deg2rad($aB->reportedLatitude)) * sin(deg2rad($fBeta)) * sin(deg2rad($fBeta)) ;
		$fPartial = asin(min(1, sqrt($fPartial)));
		$fDistance = 2 * Location::EARTH_RADIUS * $fPartial;
		$fDistance = round($fDistance, 0);
		
		return $fDistance;
	}

	/***********************************************************************
	 * calcDeltaByRange	<Location.php>
	 *
	 * usage:		calcDeltaByRange();
	 *
	 * description:		calculate two deltas to form a coordinate square, centered
	 *			at point $aA, with sides equal to 2 * $iRange using
	 *			a manipulation of the Haversine Formula
	 *			http://sgowtham.net/blog/2009/08/04/php-calculating-distance-between-two-locations-given-their-gps-coordinates/
	 *
	 * parameteres:		aA - array containing location cooridinates
	 *			aB - array containing location cooridinates
	 *
	 * returns:		array of delta to apply to center point to form a
	 *			coordinate square
	 ***********************************************************************/
	function calcDeltaByRange($aA, $iRange){
		$aDeltas = array();
		
		// first, refactor the Haversine Formula to solve for deltaLat and deltaLong
		// d 		= 2R * arcsin[ min(1, sqrt(sin^2(deltaLat/2) + cos(LatA)*cos(LatB)*sin^2(deltaLong/2))) ]
		// d/2R 	= arcsin[ min(1, sqrt(sin^2(deltaLat/2) + cos(LatA)*cos(LatB)*sin^2(deltaLong/2))) ]
		// sin(d/2R) 	= sqrt(sin^2(deltaLat/2) + cos(LatA)*cos(LatB)*sin^2(deltaLong/2))
		// sin^2(d/2R)	= sin^2(deltaLat/2) + cos(LatA)*cos(LatB)*sin^2(deltaLong/2)
		
		// now solve for deltaLong (assuming LatA equals LatB, deltaLat = 0)
		// sin^2(d/2R)					= sin^2(0) + cos(LatA)*cos(LatA)*sin^2(deltaLong/2)
		// sin^2(d/2R)					= cos(LatA)*cos(LatA)*sin^2(deltaLong/2)
		// sin^2(d/2R)					= cos^2(LatA)*sin^2(deltaLong/2)
		// sin^2(d/2R)/cos^2(LatA)			= sin^2(deltaLong/2)
		// sqrt(sin^2(d/2R)/cos^2(LatA))		= sin(deltaLong/2)
		// asin(sqrt(sin^2(d/2R)/cos^2(LatA)))		= deltaLong/2
		// 2*asin(sqrt(sin^2(d/2R)/cos^2(LatA)))	= deltaLong
		$fSine = sin($iRange / (2 * Location::EARTH_RADIUS));
		$fCosine = cos(deg2rad($aA->reportedLatitude));
		$fPartial = ($fSine * $fSine) / ($fCosine * $fCosine) ;
		$aDeltas["longitude"] = 2 * rad2deg(asin(min(1, sqrt($fPartial))));
		
		// now solve for deltaLat (assuming LongA equals LongB, deltaLong = 0)
		// sin^2(d/2R)			= sin^2(deltaLat/2) + cos(LatA)*cos(LatB)*sin^2(0)
		// sin^2(d/2R)			= sin^2(deltaLat/2)
		// sqrt(sin^2(d/2R)		= sin(deltaLat/2)
		// asin(sqrt(sin^2(d/2R))	= deltaLat/2
		// 2*asin(sqrt(sin^2(d/2R))	= deltaLat
		$fSine = sin($iRange / (2 * Location::EARTH_RADIUS));
		$fPartial = $fSine * $fSine;
		$aDeltas["latitude"] = 2 * rad2deg(asin(min(1, sqrt($fPartial))));

		// return	
		return $aDeltas;
	}

	/***********************************************************************
	 * criteriaByRange	<Location.php>
	 *
	 * usage:		criteriaByRange();
	 *
	 * description:		generates a CDbCriteria object to locate records
	 *				within the specified range
	 *
	 * parameteres:		aA - object to search from
	 *			iRange - range to search in meters
	 *
	 * returns:		CDbCriteria object approximating range with a rectangle
	 ***********************************************************************/
	function criteriaByRange($aA, $iRange){
		$aDeltas = self::calcDeltaByRange($aA, $iRange);
		$criteria = new CDbCriteria;
		$criteria->condition = 'reportedLatitude >= '.($aA->reportedLatitude - $aDeltas['latitude']).' AND '.
					'reportedLatitude <= '.($aA->reportedLatitude + $aDeltas['latitude']).' AND '.
					'reportedLongitude >= '.($aA->reportedLongitude - $aDeltas['longitude']).' AND '.
					'reportedLongitude <= '.($aA->reportedLongitude + $aDeltas['longitude']);
		return $criteria;
	}	

}
