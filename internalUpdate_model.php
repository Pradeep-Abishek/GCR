<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class internalUpdate_model extends CI_Model
{

     public function fetchHotels()
     {
          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND hm.cityMasterId = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $hotelNameQry = '';
          $hotelName = isset($_POST['hotelName']) ? addslashes($_POST['hotelName']) : '';
          if($hotelName <> '')
          {
               $hotelNameQry = " AND hm.hotelName LIKE '%$hotelName%'";
          }
          else
          {
               $hotelNameQry = '';
          }

          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT * FROM hotelsmaster AS hm LEFT JOIN citymaster AS cm ON (hm.cityMasterId = cm.cityMasterId) WHERE 1 $hotelNameQry $cityQry ORDER BY hotelName ASC");
          $result['data'] = $query->result_array();
          echo json_encode($result,true);
     }

     public function gcrData()
     {
          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND gcr.cityMasterId = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $clientNameQry = '';
          $clientName = isset($_POST['hotelName']) ? addslashes($_POST['hotelName']) : '';
          if($clientName <> '')
          {
               $clientNameQry = " AND gcr.clientName LIKE '%$clientName%'";
          }
          else
          {
               $clientNameQry = '';
          }

          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT *,CASE WHEN gcr.clientType = 1 THEN 'Hotel' WHEN gcr.clientType = 3 THEN 'Company' WHEN gcr.clientType = 4 THEN 'Travel Agent' END AS clientType FROM globalclientrepository AS gcr LEFT JOIN citymaster AS cm ON (gcr.cityMasterId = cm.cityMasterId) WHERE 1 $clientNameQry $cityQry ORDER BY gcr.GCRId DESC");
          $result['data'] = $query->result_array();
          echo json_encode($result,true);
     }

     public function gcrUpdateClientName()
     {
          $GCRId = $_POST['GCRId'];
          $clientName = addslashes($_POST['clientName']);
          $address = addslashes($_POST['address']);
          $otherdb = $this->load->database('otherdb',true);
          $updateQuery = $otherdb->query("UPDATE globalclientrepository SET clientName = '$clientName', `address` = '$address' WHERE GCRId = '$GCRId'");
     }

     public function update()
     {
          $otherdb = $this->load->database('otherdb',true); 
          $hmId = explode(',',$_POST['hmId']);
          $hobseStatus = $_POST['hobseStatus'];
          $bestPriceStatus = $_POST['bestPriceStatus'];
          $saasId = $_POST['saasId'];
          foreach($hmId AS $hotelsMasterId)
          {
               $this->gcrUpdate($hotelsMasterId,$hobseStatus);
               $update = $otherdb->query("UPDATE hotelsmaster SET hobseStatus = $hobseStatus, bestPriceStatus = $bestPriceStatus, saasPackageId = $saasId WHERE hotelsMasterId = $hotelsMasterId");
          }
          echo "Updated Successfully...";
     }

     public function gcrUpdate($id,$value)
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT * FROM hotelsmaster WHERE hotelsMasterId = '$id'");
          $queryData = $query->result_array()[0];
          if($queryData['GCRId'] <> '' && $queryData['GCRId'] > 0)
          {
               $otherdb->query("UPDATE globalclientrepository SET hobseStatus = '$value' WHERE GCRId = '".$queryData['GCRId']."'");
          }
     }

     public function countryMaster()
     {
          $otherdb = $this->load->database('otherdb',true);
          $countryMaster = $otherdb->query("SELECT * FROM countrymaster");
          $countryMasterRes = $countryMaster->result_array();
          return $countryMasterRes;
     }

     public function stateInitial()
     {
          $otherdb = $this->load->database('otherdb',true);
          $stateMaster = $otherdb->query("SELECT * FROM statemaster WHERE countryMasterId = 101");
          $stateMasterRes = $stateMaster->result_array();
          return $stateMasterRes;
     }

     public function getCities()
     {
          $countryId = isset($_POST['countryMasterId']) ? $_POST['countryMasterId'] : '';
          if($countryId <> '')
          {
               $countryQry = "AND cym.countryMasterId = $countryId";
               $countryQry1 = "AND countryMasterId = $countryId";
          }
          else
          {
               $countryQry = '';
               $countryQry1 = '';
          }

          $stateId = isset($_POST['stateMasterId']) ? $_POST['stateMasterId'] : '';
          if($stateId <> '')
          {
               $stateQry = "AND cym.stateMasterId = $stateId";
          }
          else
          {
               $stateQry = '';
          }
          
          $otherdb = $this->load->database('otherdb',true);

          // State list
          $state = $otherdb->query("SELECT * FROM stateMaster WHERE 1 $countryQry1 ORDER BY stateName ASC");
          $stateMasterRes['state'] = $state->result_array();

          // City list
          $stateMaster = $otherdb->query("SELECT cym.cityName AS `label`,cym.cityMasterId AS `value` FROM citymaster AS cym 
                                             WHERE 1 $countryQry $stateQry 
                                             ORDER BY cym.cityName ASC");
          $stateMasterRes['data'] = $stateMaster->result_array();

          echo json_encode($stateMasterRes,true);
     }

     public function getCityDetails()
     {
          $otherdb = $this->load->database('otherdb',true);
          $cityMasterId = $_POST['cityMasterId'];
          $cityQry = $otherdb->query("SELECT * FROM citymaster WHERE cityMasterId = '$cityMasterId'");
          $cityRes = $cityQry->result_array();
          echo json_encode($cityRes);
     }

     public function updateCityDetails()
     {
          $cityName = addslashes($_POST['cityName']);
          $stateMasterId = $_POST['stateMasterId'];
          $countryMasterId = $_POST['countryMasterId'];
          $latitude = $_POST['lat'];
          $longitude = $_POST['longitude'];
          $active = $_POST['active'];
          $cityMasterId = $_POST['cityMasterId'];

          $otherdb = $this->load->database('otherdb',true);
          if($cityMasterId <> 0 )
          {
               $update = $otherdb->query("UPDATE citymaster SET cityName = '$cityName', stateMasterId = '$stateMasterId', countryMasterId = '$countryMasterId', lat = '$latitude', longitude = '$longitude', active = '$active' WHERE cityMasterId = '$cityMasterId'");
               
               echo "Updated Successfully"; 
          }
          else
          {
               $insert = $otherdb->query("INSERT INTO citymaster (cityName,stateMasterId,countryMasterId,lat,longitude,active) VALUES ('$cityName','$stateMasterId','$countryMasterId','$latitude','$longitude','$active')");
               echo $cityName." Added Successfully";
          }
     }

     public function fetchLocalities()
     {
          $otherdb = $this->load->database('otherdb',true);

          $cityMasterId = $_POST['cityMasterId'];
          $radius = $_POST['radius'];
          $pinCode = (isset($_POST['pinCode']) ? $_POST['pinCode'] : '');
          if($pinCode)
          {
               $pinCodeQuery = "UNION SELECT CONCAT(2,'&',lr.id) AS id, lr.localityName AS localityName, 0 AS mapped FROM localityrepository AS lr WHERE lr.postalcode = '$pinCode' AND lr.mappedCityId IS NULL";
          }
          else
          {
               $pinCodeQuery = '';
          }

          $cityDetails = $otherdb->query("SELECT * FROM citymaster WHERE cityMasterId = '$cityMasterId'");
          $cityDetailsRes = $cityDetails->result_array()[0];
          $latitude = $cityDetailsRes['lat'];
          $longitude = $cityDetailsRes['longitude'];
          $mappedLocality = array();
          $unMappedLocality = array();
          $final = array();
          $i = 0;

          $qry = "SELECT * FROM (SELECT total.* FROM 
          (SELECT CONCAT(2,'&',lr.id) AS id, lr.localityname AS localityName, 0 AS mapped FROM localityrepository AS lr WHERE lr.mappedCityId IS NULL AND (lr.latitude BETWEEN ($latitude - ($radius/(69*1.6))) AND ($latitude + ($radius/(69*1.6))) AND lr.longitude BETWEEN ($longitude - ($radius/(69*1.6))) AND ($longitude + ($radius/(69*1.6))) ) UNION SELECT CONCAT(2,'&',lr.id) AS id, lr.localityname AS localityName, 0 AS mapped FROM citymaster AS cm
          JOIN statemaster AS sm ON (cm.stateMasterId = sm.stateMasterId ) LEFT JOIN localityrepository AS lr ON (lr.state = sm.stateName AND ( lr.district LIKE concat('%',cm.cityName,'%') OR lr.taluk like concat('%',cm.cityName,'%'))) WHERE cm.cityMasterId = '$cityMasterId' AND lr.mappedCityId IS NULL $pinCodeQuery) AS total 
          LEFT JOIN citylocality AS cl ON (cl.cityLocalityName = total.localityname AND cl.cityMasterId = '$cityMasterId' AND cl.cLat IS NOT NULL AND cl.cLong IS NOT NULL ) 
          WHERE  cl.cityLocalityId IS NULL) as t 
          UNION
          SELECT CONCAT(1,'&',cityLocalityId) AS id, cityLocalityName AS localityName, CASE  WHEN cLat IS NOT NULL AND cLong IS NOT NULL THEN 1 ELSE 0
          END AS mapped FROM citylocality WHERE cityMasterId = '$cityMasterId' 
          ORDER BY localityName ASC";
          $localityQry = $otherdb->query($qry);
          $localityQryRes = $localityQry->result_array();
          foreach($localityQryRes AS $locality)
          {
               if($locality['id'])
               {
                    if($locality['mapped'] == '1' )
                    {
                         $mappedLocality[] = $locality;
                    }
                    else
                    {
                         $unMappedLocality[] = $locality;
                    }
                    $i++;
               }
          }
          
          $final['mapped'] = $mappedLocality;
          $final['unmapped'] = $unMappedLocality;
          $final['count'] = $i;
          echo json_encode($final);

     }

     public function fetchLocalityDetails()
     {
          $otherdb = $this->load->database('otherdb',true);

          $localityId = $_POST['id'];
          $type = $_POST['type'];
          $cityMasterId = $_POST['cityMasterId'];

          $cityQry = $otherdb->query("SELECT cm.cityMasterId,cm.active,sm.stateName FROM citymaster AS cm JOIN statemaster AS sm ON (cm.stateMasterId = sm.stateMasterId) WHERE cm.cityMasterId = '$cityMasterId'");
          $result[] = $cityQry->result_array()[0];
          // echo json_encode($cityQryRes,true);
          // $type == 1 (City Locality) ; 2 (Locality Repository)

          if($type == '1')
          {
               $fetchLocalityDetails = $otherdb->query("SELECT cityLocalityName AS localityName, cLat AS latitude, cLong AS longitude, 4 AS accuracy FROM citylocality WHERE cityLocalityId = '$localityId'");
               $result[] = $fetchLocalityDetails->result_array()[0];
               echo json_encode($result,true);
          }
          elseif ($type == '2')
          {
               $fetchLocalityDetails = $otherdb->query("SELECT localityName AS localityName, latitude AS latitude, longitude AS longitude, accuracy AS accuracy,taluk, district, `state` FROM localityrepository WHERE id = '$localityId'");
               $result[] = $fetchLocalityDetails->result_array()[0];
               echo json_encode($result,true);
          }
     }

     public function updateLocalityDetails()
     {
          $otherdb = $this->load->database('otherdb',true);
          $localityCityMasterId = $_POST['cityMasterId'];
          $localityId = $_POST['id'];
          $localityType = $_POST['type'];
          $localityName = addslashes($_POST['localityName']);
          $localityLatitude = $_POST['latitude'];
          $localityLongitude = $_POST['longitude'];

          if($localityType == '1')
          {
               $update = $otherdb->query("UPDATE citylocality SET cityLocalityName = '$localityName', cLat = '$localityLatitude', cLong = '$localityLongitude' WHERE cityLocalityId = '$localityId'");
               echo "Updated Successfully";
          }
          else if ($localityType == '2')
          {
               $update = $otherdb->query("UPDATE localityrepository SET mappedCityId = '$localityCityMasterId' WHERE id = '$localityId'");
               $insert = $otherdb->query("INSERT INTO citylocality (cityLocalityName,cLat,cLong,cityMasterId) VALUES ('$localityName','$localityLatitude','$localityLongitude','$localityCityMasterId') ");
               echo "Inserted Successfully";
          }
          else
          {
               echo "false";
          }

     }
}    
?>