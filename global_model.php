<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class global_model extends CI_Model
{

     public function city()
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT cityMasterId AS `value`,cityName AS label FROM citymaster WHERE active = 1 ORDER BY label ASC");
          return $query->result_array();
     }

     public function customerCities()
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT DISTINCT cr.cityId AS 'value',cm.cityName AS label FROM companyreferred AS cr INNER JOIN citymaster AS cm ON (cm.cityMasterId = cr.cityId) WHERE GCRId IS NULL ORDER BY label ASC");
          return $query->result_array();
     }

     public function internalCities()
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT DISTINCT hm.cityMasterId AS 'value',cm.cityName AS label FROM hotelsmaster AS hm INNER JOIN citymaster AS cm ON (cm.cityMasterId = hm.cityMasterId) ORDER BY label ASC");
          return $query->result_array();
     }

     public function gcrCities()
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT DISTINCT gcr.cityMasterId AS 'value',cm.cityName AS label FROM globalclientrepository AS gcr INNER JOIN citymaster AS cm ON (cm.cityMasterId = gcr.cityMasterId) ORDER BY label ASC");
          return $query->result_array();
     }

     public function corpCities()
     {
          $query = $this->db->query("SELECT DISTINCT cr.cityMasterId AS `value`,cy.city AS label FROM corp_registration AS cr 
                                        INNER JOIN city AS cy ON (cr.cityMasterId = cy.id) WHERE GCRId IS NULL ORDER BY label ASC");
          return $query->result_array();          

     }

     public function hobseCities()
     {
          $otherdb = $this->load->database('otherdb',true);
          $query = $otherdb->query("SELECT cm.cityName AS 'label',hobse.citymasterid AS 'value' FROM (SELECT DISTINCT citymasterid FROM travelagencymaster WHERE GCRId IS NULL 
          UNION SELECT DISTINCT citymasterid FROM hotelsmaster WHERE GCRId IS NULL AND hotelsMasterId > '6000') AS hobse INNER JOIN citymaster AS cm ON (cm.citymasterid = hobse.citymasterid) ORDER BY cm.cityName ASC");
          return $query->result_array();

     }


     public function crmCities()
     {
          $query = $this->db->query("SELECT DISTINCT csv.cityID AS `value`,cy.city AS label FROM clientcsv AS csv 
                                        INNER JOIN city AS cy ON (csv.cityID = cy.id) WHERE GCRId IS NULL ORDER BY label ASC");
          return $query->result_array();          

     }

     public function companyFilters()
     {
          $otherdb = $this->load->database('otherdb',true);
          if($_POST['type'] == '1')
          {
               $hQuery = $otherdb->query("SELECT DISTINCT hm.hotelsMasterId AS 'value', hm.hotelName AS 'label' FROM companyreferred AS cr INNER JOIN hotelsmaster AS hm ON (cr.referrerMaster = hm.hotelsMasterId) WHERE cr.referrerType = '".$_POST['type']."'");
               $hQuery = $hQuery->result_array();
               echo json_encode($hQuery);

          }
          else if ($_POST['type'] == '3' || $_POST['type'] == 4)
          {
               $hQuery = $otherdb->query("SELECT DISTINCT tam.travelAgencyMasterId AS 'value',tam.travelAgencyName AS 'label' FROM companyreferred AS cr INNER JOIN travelagencymaster AS tam ON (cr.referrerMaster = tam.travelAgencyMasterId) WHERE cr.referrerType = '".$_POST['type']."'");
               $hQuery = $hQuery->result_array();
               echo json_encode($hQuery);
          }
     }

     public function corpData()
     {
          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND cr.cityMasterId = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $clientNameQry = '';
          $clientName = isset($_POST['clientName']) ? addslashes($_POST['clientName']) : '';
          if($clientName <> '')
          {
               $clientNameQry = " AND cr.company_name LIKE '%$clientName%'";
          }
          else
          {
               $clientNameQry = '';
          }
          $corpNewEntries = $this->db->query("SELECT cr.*,cy.city AS cityName,
                                             CASE 
                                                  WHEN clientTypeMasterId = 1 THEN 'Hotel'
                                                  WHEN clientTypeMasterId = 3 THEN 'Company'
                                                  WHEN clientTypeMasterId = 4 THEN 'Travel Agent'
                                                  END AS type 
                                             FROM corp_registration AS cr 
                                             LEFT JOIN city AS cy ON (cr.cityMasterId = cy.id)  
                                             WHERE GCRId IS NULL $cityQry $clientNameQry
                                             ORDER BY company_name ASC");
          $data['data'] = $corpNewEntries->result_array();
          echo json_encode($data);
     }

     public function crmData()
     {
          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND csv.cityID = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $clientNameQry = '';
          $clientName = isset($_POST['clientName']) ? addslashes($_POST['clientName']) : '';
          if($clientName <> '')
          {
               $clientNameQry = " AND csv.clientName LIKE '%$clientName%'";
          }
          else
          {
               $clientNameQry = '';
          }
          $crmNewEntries = $this->db->query("SELECT csv.*,cy.city AS cityName, 
                                             CASE 
                                                  WHEN clientType = 1 THEN 'Hotel'
                                                  WHEN clientType = 3 THEN 'Company'
                                                  WHEN clientType = 4 THEN 'Travel Agent'
                                                  END AS type 
                                             FROM clientcsv AS csv
                                             LEFT JOIN city AS cy ON (csv.cityID = cy.id) 
                                             WHERE GCRId IS NULL $cityQry $clientNameQry 
                                             ORDER BY clientName ASC");
          $data['data'] = $crmNewEntries->result_array();
          echo json_encode($data);
     }

     public function hobseData()
     {
          $otherdb = $this->load->database('otherdb',true);
          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND hobse.cityMasterId = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $clientNameQry = '';
          $clientName = isset($_POST['clientName']) ? addslashes($_POST['clientName']) : '';
          if($clientName <> '')
          {
               $clientNameQry = " AND hobse.clientName LIKE '%$clientName%'";
          }
          else
          {
               $clientNameQry = '';
          }
          $hobseNewEntries = $otherdb->query("SELECT hobse.*,cm.cityName,
                                             CASE
                                                  WHEN clientTypeMasterId = 1 THEN 'Hotel'
                                                  WHEN clientTypeMasterId = 3 THEN 'Company'
                                                  WHEN clientTypeMasterId = 4 THEN 'Travel Agent'
                                                  END AS type
                                             FROM
          (SELECT hotelName AS clientName,cityMasterId,1 AS 'clientTypeMasterId',hotelsMasterId AS id FROM hotelsmaster WHERE GCRId IS NULL AND hotelsMasterId > '6000'
          UNION
          SELECT travelAgencyName AS clientName,cityMasterId,clientTypeMasterId,travelAgencyMasterId AS id FROM travelAgencyMaster WHERE GCRId IS NULL) AS hobse 
          LEFT JOIN cityMaster AS cm ON (hobse.cityMasterId = cm.cityMasterId)
          WHERE 1 $cityQry $clientNameQry
          ORDER BY clientName ASC");
          $data['data'] = $hobseNewEntries->result_array();
          echo json_encode($data);

     }

     public function companyData()
     {
          $otherdb = $this->load->database('otherdb',true);

          $cityQry = '';
          $cityId = isset($_POST['cityId']) ? $_POST['cityId'] : '';
          if($cityId <> '')
          {
               $cityQry = " AND cr.cityId = '$cityId'";
          }          
          else
          {
               $cityQry = '';
          }

          $clientTypeQry = '';
          $clientType = isset($_POST['clientType']) ? $_POST['clientType'] : '';
          if($clientType <> '')
          {
               $clientTypeQry = " AND cr.referrerType = '$clientType'";
          }
          else
          {
               $clientTypeQry = ' ';
          }

          $clientMasterQry = '';
          $clientMasterId = isset($_POST['clientMasterId']) ? $_POST['clientMasterId'] : '';
          if($clientMasterId <> '')
          {
               $clientMasterQry = " AND cr.referrerMaster = '$clientMasterId'";
          }
          else
          {
               $clientMasterQry = ' ';
          }

          $companyNewEntries = $otherdb->query("SELECT cr.*,cm.cityName AS cityName,
                                                  CASE
                                                       WHEN partnerType = 1 THEN 'Hotel'
                                                       WHEN partnerType = 3 THEN 'Company'
                                                       WHEN partnerType = 4 THEN 'Travel Agent'
                                                       END AS type
                                                       FROM companyreferred AS cr 
                                                       LEFT JOIN cityMaster AS cm ON (cr.cityId = cm.cityMasterId)
                                                       WHERE cr.isFromImport = 1 AND cr.GCRId IS NULL $clientTypeQry $cityQry $clientMasterQry
                                                       ORDER BY companyName ASC");
          $data['data'] = $companyNewEntries->result_array();
          echo json_encode($data);

     }

     public function searchMatchGCR()
     {
          $otherdb = $this->load->database('otherdb',true);
          $HotelName = $_POST['hotelName'];
          $cityId = $_POST['cityId'];
          $clientTypeId = $_POST['clientTypeId'];
          $source = isset($_POST['source']) ? $_POST['source'] : 0 ;
          if($source == '1')
          {
               $sourceQry = "AND (regId = '0' OR regId = NULL) ";
          }
          else if ($source == '3' || $source == '4')
          {
               $sourceQry = "AND (clientMasterId = '0' OR clientMasterId = NULL) ";
          }
          else
          {
               $sourceQry = '';
          }

          $notAllow = array("The", "the", "Hotel", "hotel", "Hotels", "hotels", "Resort", "resort", "Resorts", "resorts", "Guesthouse", "guesthouse", "apartments", "apartment", "Service apartments", "Serviced apartments", "Boutique", "boutique", "inn", "Inn", "INN", "By", "by","Ltd","ltd");
          $stngs = explode(" ", trim($HotelName));
          $final = array();
          $final1 = array();
          foreach($stngs as $index => $qData)
          {
               if (!in_array($qData, $notAllow) && strlen($qData)>1)
               {
                    array_push($notAllow, $qData);
                    $sql = "SELECT DISTINCT * FROM globalclientrepository
                    WHERE clientName like '%".str_replace("'", "\\'", $qData)."%' AND clientType = $clientTypeId $sourceQry AND clientMasterId is not null ORDER BY clientName ASC";
                    $result = $otherdb->query($sql);
                    $values = $result->result_array();
                    foreach($values as $value)
                    {
                         $final[] = $value;
                    }     
               }            
          }
          $final = array_map("unserialize", array_unique(array_map("serialize", $final)));
          foreach($final as $fin)
          {
               $final1[] = $fin;
          }
          return $final1;
     }

     public function searchMatchCRM()
     {
          $HotelName = $_POST['hotelName'];
          $cityId = $_POST['cityId'];
          $clientTypeId = $_POST['clientTypeId'];
          $notAllow = array("The", "the", "Hotel", "hotel", "Hotels", "hotels", "Resort", "resort", "Resorts", "resorts", "Guesthouse", "guesthouse", "apartments", "apartment", "Service apartments", "Serviced apartments", "Boutique", "boutique", "inn", "Inn", "INN", "By", "by","Ltd","ltd");
          $stngs = explode(" ", trim($HotelName));
          $final = array();
          $final1 = array();
          foreach($stngs as $index => $qData)
          {
               if (!in_array($qData, $notAllow) && strlen($qData)>1)
               {
                    array_push($notAllow, $qData);
                    $sql = "SELECT DISTINCT * FROM clientcsv
                    WHERE clientName like '%".str_replace("'", "\\'", $qData)."%' AND GCRId IS NULL";
                    $result = $this->db->query($sql);
                    $values = $result->result_array();
                    foreach($values as $value)
                    {
                         $final[] = $value;
                    }     
               }            
          }
          $final = array_map("unserialize", array_unique(array_map("serialize", $final)));
          foreach($final as $fin)
          {
               $final1[] = $fin;
          }
          return $final1;
     }

     public function searchMatchTAM()
     {
          $otherdb = $this->load->database('otherdb',true);
          $HotelName = $_POST['hotelName'];
          $cityId = $_POST['cityId'];
          $clientTypeId = $_POST['clientTypeId'];
          $notAllow = array("The", "the", "Hotel", "hotel", "Hotels", "hotels", "Resort", "resort", "Resorts", "resorts", "Guesthouse", "guesthouse", "apartments", "apartment", "Service apartments", "Serviced apartments", "Boutique", "boutique", "inn", "Inn", "INN", "By", "by","Ltd","ltd");
          $stngs = explode(" ", trim($HotelName));
          $final = array();
          $final1 = array();
          foreach($stngs as $index => $qData)
          {
               if (!in_array($qData, $notAllow) && strlen($qData)>1)
               {
                    array_push($notAllow, $qData);
                    $sql = "SELECT DISTINCT *, travelAgencyName AS clientName, travelAgencyMasterId AS clientId FROM travelagencymaster
                    WHERE travelAgencyName like '%".str_replace("'", "\\'", $qData)."%' AND GCRId IS NULL";
                    $result = $otherdb->query($sql);
                    $values = $result->result_array();
                    foreach($values as $value)
                    {
                         $final[] = $value;
                    }     
               }            
          }
          $final = array_map("unserialize", array_unique(array_map("serialize", $final)));
          foreach($final as $fin)
          {
               $final1[] = $fin;
          }
          return $final1;
     }

     public function searchMatchHM()
     {
          $otherdb = $this->load->database('otherdb',true);
          $HotelName = $_POST['hotelName'];
          $cityId = $_POST['cityId'];
          $clientTypeId = $_POST['clientTypeId'];
          $notAllow = array("The", "the", "Hotel", "hotel", "Hotels", "hotels", "Resort", "resort", "Resorts", "resorts", "Guesthouse", "guesthouse", "apartments", "apartment", "Service apartments", "Serviced apartments", "Boutique", "boutique", "inn", "Inn", "INN", "By", "by","Ltd","ltd");
          $stngs = explode(" ", trim($HotelName));
          $final = array();
          $final1 = array();
          foreach($stngs as $index => $qData)
          {
               if (!in_array($qData, $notAllow) && strlen($qData)>1)
               {
                    array_push($notAllow, $qData);
                    $sql = "SELECT DISTINCT *,hotelName AS clientName,hotelsMasterId AS clientId, 1 AS clientTypeMasterId  FROM hotelsmaster
                    WHERE hotelName like '%".str_replace("'", "\\'", $qData)."%' AND GCRId IS NULL AND hotelsMasterId > '6000' ";
                    $result = $otherdb->query($sql);
                    $values = $result->result_array();
                    foreach($values as $value)
                    {
                         $final[] = $value;
                    }     
               }            
          }
          $final = array_map("unserialize", array_unique(array_map("serialize", $final)));
          foreach($final as $fin)
          {
               $final1[] = $fin;
          }
          return $final1;
     }

     public function searchMatchCORP()
     {
          $HotelName = $_POST['hotelName'];
          $cityId = $_POST['cityId'];
          $clientTypeId = $_POST['clientTypeId'];
          $notAllow = array("The", "the", "Hotel", "hotel", "Hotels", "hotels", "Resort", "resort", "Resorts", "resorts", "Guesthouse", "guesthouse", "apartments", "apartment", "Service apartments", "Serviced apartments", "Boutique", "boutique", "inn", "Inn", "INN", "By", "by","Ltd","ltd");
          $stngs = explode(" ", trim($HotelName));
          $final = array();
          $final1 = array();
          foreach($stngs as $index => $qData)
          {
               if (!in_array($qData, $notAllow) && strlen($qData)>1)
               {
                    array_push($notAllow, $qData);
                    $sql = "SELECT DISTINCT * FROM corp_registration
                    WHERE company_name like '%".str_replace("'", "\\'", $qData)."%' AND GCRId IS NULL ";
                    $result = $this->db->query($sql);
                    $values = $result->result_array();
                    foreach($values as $value)
                    {
                         $final[] = $value;
                    }     
               }            
          }
          $final = array_map("unserialize", array_unique(array_map("serialize", $final)));
          foreach($final as $fin)
          {
               $final1[] = $fin;
          }
          return $final1;
     }

     public function fetchFromCRM()
     {
          $id = $_POST['id'];
          $crm = $this->db->query("SELECT cy.city,cv.*, 
                                   CASE
                                   WHEN cv.clientType = 1 THEN 'Hotel'
                                   WHEN cv.clientType = 3 THEN 'Company'
                                   WHEN cv.clientType = 4 THEN 'Travel Agent'
                                   END AS type
                                   FROM clientcsv AS cv 
                                   LEFT JOIN city AS cy ON (cv.cityID = cy.id) 
                                   WHERE cv.id = '$id'");
          return $crm->result_array();
     }

     public function fetchFromHM()
     {
          $otherdb = $this->load->database('otherdb',true);
          $id = $_POST['id'];
          $hm = $otherdb->query("SELECT 'Hotel' AS type,cm.cityName,hm.* 
                                   FROM hotelsmaster AS hm 
                                   LEFT JOIN cityMaster AS cm ON (hm.cityMasterId = cm.cityMasterId) 
                                   WHERE hm.hotelsMasterId = '$id'");
          return $hm->result_array();
          
     }

     public function fetchFromTAM()
     {
          $otherdb = $this->load->database('otherdb',true);
          $id = $_POST['id'];
          $tam = $otherdb->query("SELECT 
                                   CASE
                                   WHEN clientTypeMasterId = 3 THEN 'Company'
                                   WHEN clientTypeMasterId = 4 THEN 'Travel Agent'
                                   END AS type,
                                   cm.cityName,tam.*
                                   FROM travelagencymaster AS tam
                                   LEFT JOIN cityMaster AS cm ON (tam.cityMasterId = cm.cityMasterId)
                                   WHERE tam.travelAgencyMasterId = '$id'");
          return $tam->result_array();
          
     }

     public function fetchFromCORP()
     {
          $id = $_POST['id'];
          $corp = $this->db->query("SELECT 
                                   CASE
                                   WHEN clientTypeMasterId = 1 THEN 'Hotel'
                                   WHEN clientTypeMasterId = 3 THEN 'Company'
                                   WHEN clientTypeMasterId = 4 THEN 'Travel Agent'
                                   END AS type,
                                   cy.city,corp.*
                                   FROM corp_registration AS corp
                                   LEFT JOIN city AS cy ON (corp.cityMasterId = cy.id)
                                   WHERE corp.id = '$id'");
          return $corp->result_array();
     }

     public function fetchFromCompanyReferred()
     {
          $otherdb = $this->load->database('otherdb',true);
          $id = $_POST['id'];
          $select = $otherdb->query("SELECT * FROM companyreferred WHERE companyReferredId = '$id'");
          $data = $select->result_array()[0];

          if($data['referrerType'] == '1')
          {
               $companyRef = $otherdb->query("SELECT 
                                        CASE
                                        WHEN partnerType = 1 THEN 'Hotel'
                                        WHEN partnerType = 3 THEN 'Company'
                                        WHEN partnerType = 4 THEN 'Travel Agent'
                                        END AS type,
                                        cm.cityName,cr.*,hm.hotelName AS referrerName
                                        FROM companyreferred AS cr
                                        INNER JOIN hotelsmaster AS hm ON (cr.referrerMaster = hm.hotelsMasterId)
                                        LEFT JOIN cityMaster AS cm ON (cr.cityId = cm.cityMasterId)
                                        WHERE cr.companyReferredId = '$id'");
               return $companyRef->result_array();
          }
          else if($data['referrerType'] == '3' || $data['referrerType'] == '4')
          {
               $companyRef = $otherdb->query("SELECT 
                                        CASE
                                        WHEN partnerType = 1 THEN 'Hotel'
                                        WHEN partnerType = 3 THEN 'Company'
                                        WHEN partnerType = 4 THEN 'Travel Agent'
                                        END AS type,
                                        cm.cityName,cr.*,tam.travelAgencyName AS referrerName
                                        FROM companyreferred AS cr
                                        INNER JOIN travelagencymaster AS tam ON (cr.referrerMaster = tam.travelAgencymasterId)
                                        LEFT JOIN cityMaster AS cm ON (cr.cityId = cm.cityMasterId)
                                        WHERE cr.companyReferredId = '$id'");
               return $companyRef->result_array();
          }
          else if($data['referrerType'] == '0')
          {
               $companyRef = $otherdb->query("SELECT 
                                        CASE
                                        WHEN partnerType = 1 THEN 'Hotel'
                                        WHEN partnerType = 3 THEN 'Company'
                                        WHEN partnerType = 4 THEN 'Travel Agent'
                                        END AS type,
                                        cm.cityName,cr.*,'Not Mentioned' AS referrerName
                                        FROM companyreferred AS cr
                                        LEFT JOIN cityMaster AS cm ON (cr.cityId = cm.cityMasterId)
                                        WHERE cr.companyReferredId = '$id'");
               return $companyRef->result_array();
          }
     }

     public function fetchFromGCR()
     {
          $otherdb = $this->load->database('otherdb',true);
          $id = $_POST['id'];
          $gcr = $otherdb->query("SELECT 
                                   CASE
                                   WHEN clientType = 1 THEN 'Hotel'
                                   WHEN clientType = 3 THEN 'Company'
                                   WHEN clientType = 4 THEN 'Travel Agent'
                                   END AS type,
                                   cm.cityName,gcr.*
                                   FROM globalclientrepository AS gcr
                                   LEFT JOIN cityMaster AS cm ON (gcr.cityMasterId = cm.cityMasterId)
                                   WHERE gcr.GCRId = '$id'");
          return $gcr->result_array();
     }

     public function corpSubmit()
     {
         
          $hobseId = trim($_POST['hId']);
          $city = $_POST['city'];

          $gcr = explode('___',$_POST['gcr']);
          // $gcrId = $gcr[1];
          if(isset($gcr[1]))
          {
               $gcrId = $gcr[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $crm = explode('___',$_POST['crm']);
          if(isset($crm[1]))
          {
               $crmId = $crm[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $tam = explode('___',$_POST['tam']);
          $clientMasterId = isset($tam[1])? $tam[1] : 0;
          $clientType = isset($tam[2])? $tam[2] : 0;
         
          $masterId = $_POST['master'];

          $masterQry = $this->db->query("SELECT * FROM corp_registration WHERE id = $masterId");
          $masterData = $masterQry->result_array()[0];
          $masterData['company_name'] = addslashes($masterData['company_name']);
          $masterData['address'] = addslashes($masterData['address']);
          $masterData['website'] = addslashes($masterData['website']);

          
          $val = $masterData['primary_contact'];
          $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
          $phone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;

          $val2 = $masterData['email'];
          $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
          $mail = is_array($mail) ? $mail[0]['mailId'] : $mail;

          // city update
          $cityQry = $this->db->query("UPDATE corp_registration SET cityMasterId = '".$_POST['city']."' WHERE id='$masterId'");

          $sourceTypeId = 0;
          $sourceId = 1;
          $importRefId = 0;
          // $clientType = $masterData['clientTypeMasterId'];
          
          if($gcrId <> 0)
          {
               $updateCORP = $this->db->query("UPDATE corp_registration SET GCRId = '$gcrId' WHERE id = $masterId");
               if($crmId <> '0')
               {
                    $this->gm->updateCRM($gcrId,$crmId,$city);
               }
               else
               {
                    echo "MATCHAVAILABLE";
                    exit;
               }


               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($gcrId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($gcrId,$clientMasterId);
                    }
               }
               $otherdb = $this->load->database('otherdb',true);
               $updatehId = $otherdb->query("UPDATE globalclientrepository SET hobseId = '$hobseId' WHERE gcrId = $gcrId");
               $updatecId = $otherdb->query("UPDATE globalclientrepository SET cityMasterId = '$city' WHERE gcrId = $gcrId");
               $updaterId = $otherdb->query("UPDATE globalclientrepository SET regId = '$masterId' WHERE gcrId = $gcrId");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['company_name'],$city,$clientType,$gcrId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['company_name'],$city,$clientType,$gcrId,$clientMasterId);
               }
               
               echo "Updated Successfully.....";
               
          }
          else if($gcrId == 0)
          {
               $otherdb = $this->load->database('otherdb',true);
               $insert = $otherdb->query("INSERT INTO globalclientrepository 
               (sourceTypeId,sourceId,clientType,clientName,`address`,phone1,phone2,email,email2,web,crmId,regId,onboardStatus,importRefId,hobseId,cityMasterId) 
               VALUES 
               ('$sourceTypeId','$sourceId','$clientType','".$masterData['company_name']."','".$masterData['address']."','$phone','$phone','$mail','$mail','".$masterData['website']."','$crmId','$masterId','".$masterData['onboardStatus']."','$importRefId','$hobseId','$city')");
               
               $insertedId = $otherdb->insert_id();

               if($crmId <> '0')
               {
                    $this->gm->updateCRM($insertedId,$crmId,$city);
               }
               else
               {
                    $this->gm->createCRM($insertedId,$clientType,$masterId,1,$city);
               }

               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($insertedId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($insertedId,$clientMasterId);
                    }
               }

               $updateCORP = $this->db->query("UPDATE corp_registration SET GCRId = '$insertedId' WHERE id = $masterId");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['company_name'],$city,$clientType,$insertedId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['company_name'],$city,$clientType,$insertedId,$clientMasterId);
               }
               

               echo "Inserted Successfully......";
          }
          else
          {
               echo "ERRRR";
          }
     }

     public function crmSubmit()
     {
          $time = time();
          $hobseId = trim($_POST['hId']);
          $city = $_POST['city'];

          $gcr = explode('___',$_POST['gcr']);
          // $gcrId = $gcr[1];
          if(isset($gcr[1]))
          {
               $gcrId = $gcr[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $corp = explode('___',$_POST['corp']);
          $regId = isset($corp[1])? $corp[1] : 0;

          $tam = explode('___',$_POST['tam']);
          $clientMasterId = isset($tam[1])? $tam[1] : 0;
          $clientType = isset($tam[2])? $tam[2] : 0;
          
          $masterId = $_POST['master'];

          $masterQry = $this->db->query("SELECT * FROM clientcsv WHERE id = $masterId");
          $masterData = $masterQry->result_array()[0];
          $masterData['clientName'] = addslashes($masterData['clientName']);
          $masterData['address'] = addslashes($masterData['address']);
          $masterData['website'] = addslashes($masterData['website']);

          $val = $masterData['mobileNo'];
          $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
          $phone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;
          $masterData['mobileNo'] = $phone;

          $val2 = $masterData['mailId'];
          $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
          $mail = is_array($mail) ? $mail[0]['mailId'] : $mail;
          $masterData['mailId'] = $mail;

          // city update
          $cityQry = $this->db->query("UPDATE clientcsv SET cityID = '".$_POST['city']."' WHERE id='$masterId'");


          $sourceTypeId = 0;
          $sourceId = 2;
          $importRefId = 0;
          // $clientType = $masterData['clientType'];

          if( $gcrId <> '0') 
          {
               // $this->gm->updateCRM($GCRId,$masterId,$city);
               $updateCRM = $this->db->query("UPDATE clientcsv SET GCRId = '$gcrId', updatedBy = 'GCR Tool', updatedDate = '$time' WHERE id = $masterId");

               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($gcrId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($gcrId,$clientMasterId);
                    }
               }

               if($regId <> 0)
               {
                    $this->gm->updateCORP($gcrId,$regId,$city);
               }

               $otherdb = $this->load->database('otherdb',true);
               $updatehId = $otherdb->query("UPDATE globalclientrepository SET hobseId = '$hobseId' WHERE gcrId = $gcrId");
               $updatecId = $otherdb->query("UPDATE globalclientrepository SET cityMasterId = '$city' WHERE gcrId = $gcrId");
               $updaterId = $otherdb->query("UPDATE globalclientrepository SET crmId = '$masterId' WHERE gcrId = $gcrId");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['clientName'],$city,$clientType,$gcrId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['clientName'],$city,$clientType,$gcrId,$clientMasterId);
               }

               echo "Updated Successfully.....";
               
          }
          else if( $gcrId == '0')
          {
               $otherdb = $this->load->database('otherdb',true);
               $insert = $otherdb->query("INSERT INTO globalclientrepository 
               (sourceTypeId,sourceId,clientType,clientName,`address`,phone1,phone2,email,email2,web,crmId,callPositionId,importRefId,hobseId,cityMasterId) 
               VALUES 
               ('$sourceTypeId','$sourceId','$clientType','".$masterData['clientName']."','".$masterData['address']."','".$masterData['mobileNo']."','".$masterData['mobileNo']."','".$masterData['mailId']."','".$masterData['mailId']."','".$masterData['website']."','$masterId','".$masterData['callPositionId']."','$importRefId','$hobseId','$city')");
               
               $insertedId = $otherdb->insert_id();

               if($regId <> '0')
               {
                    $this->gm->updateCORP($insertedId,$regId,$city);
               }

               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($insertedId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($insertedId,$clientMasterId);
                    }
               }

               // $this->gm->updateCRM($insertedId,$masterId,$city);
               $updateCRM = $this->db->query("UPDATE clientcsv SET GCRId = '$insertedId', updatedBy = 'GCR Tool', updatedDate = '$time' WHERE id = $masterId");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['clientName'],$city,$clientType,$insertedId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['company_name'],$city,$clientType,$insertedId,$clientMasterId);
               }

               echo "Inserted Successfully......";
          }
          else
          {
               echo "ERRRR";
          }
     }

     public function hobseSubmit()
     {
          // log_message('error','post valies'.print_r($_POST,true));
          // exit;

          $hobseId = trim($_POST['hId']);
          $city = $_POST['city'];

          // print_r($_POST);exit;
          $gcr = explode('___',$_POST['gcr']);
          // $gcrId = $gcr[1];
          if(isset($gcr[1]))
          {
               $gcrId = $gcr[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $corp = explode('___',$_POST['corp']);
          $regId = isset($corp[1])? $corp[1] : 0;

          $crm = explode('___',$_POST['crm']);
          if(isset($crm[1]))
          {
               $crmId = $crm[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }
          
          $master = explode('&',$_POST['master']);
          $clientType = $master[1];
          $clientMasterId = $master[0];

          if($clientType == '1')
          {
               $otherdb = $this->load->database('otherdb',true);
               $masterQry = $otherdb->query("SELECT *,hotelName AS clientName FROM hotelsmaster WHERE hotelsMasterId = $clientMasterId");
               $masterData = $masterQry->result_array()[0];
               $masterData['hotelName'] = addslashes($masterData['hotelName']);
               $masterData['clientName'] = addslashes($masterData['clientName']);
               $masterData['address'] = addslashes($masterData['address']);
          }
          else
          {
               $otherdb = $this->load->database('otherdb',true);
               $masterQry = $otherdb->query("SELECT *,travelAgencyName AS clientName FROM travelagencymaster WHERE travelAgencyMasterId = $clientMasterId");
               $masterData = $masterQry->result_array()[0];    
               $masterData['travelAgencyName'] = addslashes($masterData['travelAgencyName']);
               $masterData['clientName'] = addslashes($masterData['clientName']);
               $masterData['address'] = addslashes($masterData['address']);
          }
          
          $sourceTypeId = 0;
          // $sourceId = 0;

          if($gcrId <> 0)
          {
               
               if($crmId <> '0')
               {
                    $this->gm->updateCRM($gcrId,$crmId,$city);
               }
               else
               {
                    echo "MATCHAVAILABLE";
                    exit;
               }

               if($regId <> 0)
               {
                    $this->gm->updateCORP($gcrId,$regId,$city);
               }

               $otherdb = $this->load->database('otherdb',true);
               
               if($clientType == '1')
               {
                    $this->gm->updateHM($gcrId,$clientMasterId);
                    
                    // $updateHM = $otherdb->query("UPDATE hotelsmaster SET GCRId = '$gcrId' WHERE hotelsMasterId = $clientMasterId");
               }
               else
               {
                    $this->gm->updateTAM($gcrId,$clientMasterId);
                    // $updateTAM = $otherdb->query("UPDATE travelAgencyMaster SET GCRId = '$gcrId' WHERE travelAgencyMasterId = $clientMasterId");
               }
               
               $updatehId = $otherdb->query("UPDATE globalclientrepository SET hobseId = '$hobseId' WHERE gcrId = '$gcrId'");
               $updatecId = $otherdb->query("UPDATE globalclientrepository SET cityMasterId = '$city' WHERE gcrId = '$gcrId'");
               $updatecId = $otherdb->query("UPDATE globalclientrepository SET clientMasterId = '$clientMasterId' WHERE gcrId = '$gcrId'");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['clientName'],$city,$clientType,$gcrId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['clientName'],$city,$clientType,$gcrId,$clientMasterId);
               }

               echo "Updated Successfully.....";
               
          }
          else if($gcrId == '0')
          {
               $otherdb = $this->load->database('otherdb',true);

               if($clientType == '1')
               {
                    $sourceId = 3;
                    $insert = $otherdb->query("INSERT INTO globalclientrepository 
                    (sourceTypeId,sourceId,clientType,clientName,`address`,hobseId,cityMasterId) 
                    VALUES 
                    ('$sourceTypeId','$sourceId','$clientType','".$masterData['hotelName']."','".$masterData['address']."','$hobseId','$city')");
     
                    $insertedId = $otherdb->insert_id();

                    // $this->gm->updateHM($insertedId,$clientMasterId);

               }
               else
               {
                    $sourceId = 4;
                    $insert = $otherdb->query("INSERT INTO globalclientrepository 
                    (sourceTypeId,sourceId,clientType,clientName,`address`,hobseId,cityMasterId) 
                    VALUES 
                    ('$sourceTypeId','$sourceId','$clientType','".$masterData['travelAgencyName']."','".$masterData['address']."','$hobseId','$city')");
     
                    $insertedId = $otherdb->insert_id();

                    // $this->gm->updateTAM($insertedId,$clientMasterId);
               }

               if($regId <> '0')
               {
                    $this->gm->updateCORP($insertedId,$regId,$city);
               }

               if($crmId <> '0')
               {
                    $this->gm->updateCRM($insertedId,$crmId,$city);
               }
               else
               {
                    $this->gm->createCRM($insertedId,$clientType,$clientMasterId,3,$city);
               }

               if($clientType == '1')
               {
                    $this->gm->updateHM($insertedId,$clientMasterId);
                    
               }
               else
               {
                    $this->gm->updateTAM($insertedId,$clientMasterId);
               }

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred($masterData['clientName'],$city,$clientType,$insertedId,$clientMasterId);
               }
               else
               {
                    $this->gm->matchCompanyReferred2($masterData['clientName'],$city,$clientType,$insertedId,$clientMasterId);
               }

               echo "Inserted Successfully......";
          }
          else
          {
               echo "ERRRR";
          }
     }
     
     public function customerSubmit()
     {
          // log_message('error','post valies'.print_r($_POST,true));
          // exit;

          $hobseId = trim($_POST['hId']);
          $city = $_POST['city'];

          $gcr = explode('___',$_POST['gcr']);
          // $companyName = $gcr[0];
          if(isset($gcr[1]))
          {
               $gcrId = $gcr[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $corp = explode('___',$_POST['corp']);
          $regId = isset($corp[1])? $corp[1] : 0;

          $crm = explode('___',$_POST['crm']);
          if(isset($crm[1]))
          {
               $crmId = $crm[1];
          }
          else
          {
               echo "ERRRR";
               exit;
          }

          $tam = explode('___',$_POST['tam']);
          $clientMasterId = isset($tam[1])? $tam[1] : 0;
          
          $master = explode('&',$_POST['master']);
          $clientType = $master[1];
          $masterId = $master[0];

          $otherdb = $this->load->database('otherdb',true);
          $masterQry = $otherdb->query("SELECT * FROM companyreferred WHERE companyReferredId = $masterId");
          $masterData = $masterQry->result_array()[0];
          $masterData['companyName'] = addslashes($masterData['companyName']);
          $masterData['address'] = addslashes($masterData['address']);
          $masterData['contactName'] = addslashes($masterData['contactName']);

          $companyName = $masterData['companyName'];
          $companyMail = $masterData['email'];
          $companyAddress = $masterData['address'];
          $companyPhone = $masterData['phone'];
          $contactPerson = $masterData['contactName'];
          
          // Check mail address already exist in DB 
          if($clientMasterId == '0' && $clientType == '1')
          {
               $otherdb->query("SELECT * FROM hotelsmaster WHERE userName = '$companyMail'");
               if($otherdb->affected_rows() > 0)
               {
                    echo "mail";
                    exit;
               }
          }
          elseif($clientMasterId == '0' && ($clientType == '3' || $clientType == '4'))
          {
               $otherdb->query("SELECT * FROM travelagencyusers WHERE email = '$companyMail'");
               if($otherdb->affected_rows() > 0)
               {
                    echo "mail";
                    exit;
               }
          }
          
          $sourceTypeId = 0;
          $sourceId = 5;

          if($gcrId <> '0')
          {
               
               if($crmId <> '0')
               {
                    $this->gm->updateCRM($gcrId,$crmId,$city);
               }
               else
               {
                    echo "MATCHAVAILABLE";
                    exit;
               }

               if($regId <> 0)
               {
                    $this->gm->updateCORP($gcrId,$regId,$city);
               }

               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($gcrId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($gcrId,$clientMasterId);
                    }
               }
              
               $otherdb = $this->load->database('otherdb',true);
               
               $updateCompanyReferred = $otherdb->query("UPDATE companyreferred SET cityId = '$city' WHERE companyReferredId = $masterId");
               
               $updatehId = $otherdb->query("UPDATE globalclientrepository SET hobseId = '$hobseId' WHERE gcrId = $gcrId");
               $updatecId = $otherdb->query("UPDATE globalclientrepository SET cityMasterId = '$city' WHERE gcrId = $gcrId");

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred1($companyName,$city,$clientType,$gcrId,$clientMasterId,$companyMail,$companyAddress,$companyPhone);
               }
               else
               {
                    $this->gm->matchCompanyReferred3($companyName,$city,$clientType,$gcrId,$clientMasterId,$companyMail,$companyAddress,$companyPhone,$contactPerson);
               }
               
               
               echo "Updated Successfully.....";
               
          }
          else if($gcrId == '0')
          {
               $otherdb = $this->load->database('otherdb',true);

               $insert = $otherdb->query("INSERT INTO globalclientrepository 
               (sourceTypeId,sourceId,clientType,clientName,`address`,phone1,phone2,email,email2,importRefId,hobseId,cityMasterId) 
               VALUES 
               ('$sourceTypeId','$sourceId','$clientType','".$masterData['companyName']."','".$masterData['address']."','".$masterData['phone']."','".$masterData['phone']."','".$masterData['email']."','".$masterData['email']."','".$masterData['companyReferredId']."','$hobseId','$city')");

               $insertedId = $otherdb->insert_id();

               // $updateCompanyReferred = $otherdb->query("UPDATE companyreferred SET GCRId = '$insertedId' WHERE companyReferredId = '$masterId'");               

               if($regId <> '0')
               {
                    $this->gm->updateCORP($insertedId,$regId,$city);
               }

               if($crmId <> '0')
               {
                    $this->gm->updateCRM($insertedId,$crmId,$city);
               }
               else
               {
                    $this->gm->createCRM($insertedId,$clientType,$masterId,4,$city);
               }

               if($clientMasterId <> '0')
               {
                    if($clientType == '1')
                    {
                         $this->gm->updateHM($insertedId,$clientMasterId);
                    }
                    else
                    {
                         $this->gm->updateTAM($insertedId,$clientMasterId);
                    }
               }

               if($clientType == '1')
               {
                    $this->gm->matchCompanyReferred1($companyName,$city,$clientType,$insertedId,$clientMasterId,$companyMail,$companyAddress,$companyPhone);
               }
               else
               {
                    $this->gm->matchCompanyReferred3($companyName,$city,$clientType,$insertedId,$clientMasterId,$companyMail,$companyAddress,$companyPhone,$contactPerson);
               }

               echo "Inserted Successfully......";
          }
          else
          {
               echo "ERRRR";
          }
     }

     public function updateCORP($GCRId,$regId,$city='')
     {
          // Corp Registration GCRId Update
          $updateCORP = $this->db->query("UPDATE corp_registration SET GCRId = '$GCRId' WHERE id = $regId");
          
          if($city <> '')
          {
               $updateCORPcity = $this->db->query("UPDATE corp_registration SET CityMasterId = '$city' WHERE id = $regId");
          }

          // Corp Registration Details
          $corpQry = $this->db->query("SELECT * FROM corp_registration WHERE id = $regId");
          $corpData = $corpQry->result_array()[0];

          $val = $corpData['primary_contact'];
          $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
          $corpPhone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;

          $val2 = $corpData['email'];
          $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
          $corpMail = is_array($mail) ? $mail[0]['mailId'] : $mail;

          $onboardStatus = $corpData['onboardStatus'];

          // GCR Details & Update
          $otherdb = $this->load->database('otherdb',true);
          $gcrQry = $otherdb->query("SELECT * FROM globalclientrepository WHERE GCRId = $GCRId");
          $gcrData = $gcrQry->result_array()[0];
          $gcrphone1 = $gcrData['phone1'];
          $gcrphone2 = $gcrData['phone2'];
          $gcremail = $gcrData['email'];
          $gcremail2 = $gcrData['email2'];

          $updateGCR = $otherdb->query("UPDATE globalclientrepository SET 
                                             phone1 = '$gcrphone1|$corpPhone', 
                                             phone2 = '$gcrphone2|$corpPhone',
                                             email = '$gcremail|$corpMail',
                                             email2 = '$gcremail2|$corpMail',
                                             regId = '$regId',
                                             onboardStatus = '$onboardStatus' 
                                        WHERE GCRId = $GCRId");
     }

     public function checkGCRHobseId()
     {
          $otherdb = $this->load->database('otherdb',true);
          $hobseId = trim($_POST['hobseId']);
          $hobseIdCheck = $otherdb->query("SELECT * FROM globalclientrepository WHERE hobseId = '$hobseId'");
          if($hobseIdCheck->num_rows() > 0)
          {
               echo "false";
          }
          else
          {
               echo "true";
          }
     }

     public function updateCRM($GCRId,$crmId,$city='')
     {
          $time = time();
          // CRM  GCRId Update
          $updateCRM = $this->db->query("UPDATE clientcsv SET GCRId = '$GCRId', updatedBy = 'GCR Tool', updatedDate = '$time' WHERE id = $crmId");
          if($city <> '')
          {
               $updateCRMcity = $this->db->query("UPDATE clientcsv SET cityID = '$city' WHERE id = $crmId");
          }

          // CRM Details
          $crmQry = $this->db->query("SELECT * FROM clientcsv WHERE id = $crmId");
          $crmData = $crmQry->result_array()[0];
          $callPositionId = $crmData['callPositionId'];

          $val = $crmData['mobileNo'];
          $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
          $phone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;
          $crmPhone = $phone;

          $val2 = $crmData['mailId'];
          $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
          $mail = is_array($mail) ? $mail[0]['mailId'] : $mail;
          $crmMail = $mail;

          // GCR Details & Update
          $otherdb = $this->load->database('otherdb',true);
          $gcrQry = $otherdb->query("SELECT * FROM globalclientrepository WHERE GCRId = $GCRId");
          $gcrData = $gcrQry->result_array()[0];
          $gcrphone1 = $gcrData['phone1'];
          $gcrphone2 = $gcrData['phone2'];
          $gcremail = $gcrData['email'];
          $gcremail2 = $gcrData['email2'];

          $updateGCR = $otherdb->query("UPDATE globalclientrepository SET 
                                             phone1 = '$gcrphone1|$crmPhone', 
                                             phone2 = '$gcrphone2|$crmPhone',
                                             email = '$gcremail|$crmMail',
                                             email2 = '$gcremail2|$crmMail',
                                             callpositionId = '$callPositionId',
                                             crmId = '$crmId' 
                                        WHERE GCRId = $GCRId");

     }

     public function updateHM($GCRId,$clientMasterId)
     {
          $otherdb = $this->load->database('otherdb',true);

          // Hotelsmaster GCRId Update 
          $updateHM = $otherdb->query("UPDATE hotelsmaster SET GCRId = '$GCRId' WHERE hotelsMasterId = $clientMasterId");

          // Hotelsmaster Details
          $hmQry = $otherdb->query("SELECT * FROM hotelsmaster WHERE hotelsMasterId = $clientMasterId");
          $hmData = $hmQry->result_array()[0];
          // log_message('error','hmData-----------------------'.json_encode($hmData,true));
          $latitude = $hmData['lat'];
          $longitude = $hmData['longitude'];
          $cityMasterId = $hmData['cityMasterId'];
          $cityLocalityId = $hmData['cityLocalityId'];
          $stateMasterId = $hmData['stateMasterId'];
          $countryMasterId = $hmData['countryMasterId'];
          $phone = $hmData['phone1'];
          $fax = $hmData['fax'];
          $email = $hmData['email1'];
          $web = $hmData['web'];
          $hobseStatus = $hmData['hobseStatus']; 
          $zip = $hmData['zip'];

          // GCR Details & Update
          $gcrQry = $otherdb->query("SELECT * FROM globalclientrepository WHERE GCRId = $GCRId");
          $gcrData = $gcrQry->result_array()[0];
          $gcrphone1 = $gcrData['phone1'];
          $gcrphone2 = $gcrData['phone2'];
          $gcremail = $gcrData['email'];
          $gcremail2 = $gcrData['email2'];
          $gcrweb = $gcrData['web'];

          $updateGCR = $otherdb->query("UPDATE globalclientrepository SET 
                                             phone1 = '$gcrphone1|$phone', 
                                             phone2 = '$gcrphone2|$phone',
                                             email = '$gcremail|$email',
                                             email2 = '$gcremail2|$email',
                                             fax = '$fax',
                                             web = '$gcrweb|$web',
                                             hobseStatus = '$hobseStatus',
                                             clientMasterId = '$clientMasterId',
                                             zip = '$zip'
                                        WHERE GCRId = $GCRId");
     }

     public function updateTAM($GCRId,$clientMasterId)
     {
          $otherdb = $this->load->database('otherdb',true);

          // TravelAgencyMaster GCRId Update
          $updateTAM = $otherdb->query("UPDATE travelagencymaster SET GCRId = '$GCRId' WHERE travelAgencyMasterId = $clientMasterId");

          // TravelAgencyMaster Details
          $tamQry = $otherdb->query("SELECT * FROM travelagencymaster WHERE travelAgencyMasterId = $clientMasterId");
          $tamData = $tamQry->result_array()[0];
          $latitude = 0;
          $longitude = 0;
          $cityMasterId = $tamData['cityMasterId'];
          $cityLocalityId = 0;
          $stateMasterId = $tamData['stateMasterId'];
          $countryMasterId = $tamData['countryMasterId'];
          $phone = $tamData['phone'];
          $fax = $tamData['fax'];
          $email = $tamData['email'];
          $web = $tamData['website'];
          $hobseStatus = 1; 

          // GCR Details & Update
          $gcrQry = $otherdb->query("SELECT * FROM globalclientrepository WHERE GCRId = $GCRId");
          $gcrData = $gcrQry->result_array()[0];
          $gcrphone1 = $gcrData['phone1'];
          $gcrphone2 = $gcrData['phone2'];
          $gcremail = $gcrData['email'];
          $gcremail2 = $gcrData['email2'];
          $gcrweb = $gcrData['web'];
          $updateGCR = $otherdb->query("UPDATE globalclientrepository SET 
                                             phone1 = '$gcrphone1|$phone', 
                                             phone2 = '$gcrphone2|$phone',
                                             email = '$gcremail|$email',
                                             email2 = '$gcremail2|$email',
                                             fax = '$fax',
                                             hobseStatus = '$hobseStatus',
                                             web = '$gcrweb|$web',
                                             clientMasterId = '$clientMasterId'
                                        WHERE GCRId = $GCRId");
     }

     public function createCRM($GCRId,$clientType,$masterId,$type,$city = '')
     {
          $time = time();
          if($type == 1)
          {
               $masterQry = $this->db->query("SELECT * FROM corp_registration WHERE id = '$masterId'");
               $masterData = $masterQry->result_array()[0];
               
               $masterData['company_name'] = addslashes($masterData['company_name']);
               $masterData['address'] = addslashes($masterData['address']);
               $masterData['contact_name'] = addslashes($masterData['contact_name']);
               $masterData['starCategory'] = addslashes($masterData['starCategory']);
               $masterData['website'] = addslashes($masterData['website']);

               $val = $masterData['primary_contact'];
               $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
               $phone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;

               $val2 = $masterData['email'];
               $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
               $mail = is_array($mail) ? $mail[0]['mailId'] : $mail;


               $insertCRM = $this->db->query("INSERT INTO clientcsv(clientName,clientType,mailId,`address`,mobileNo,contactpersion,starRating,website,cityID,createdBy,createdDate) 
                                             VALUES
                                             ('".$masterData['company_name']."','$clientType','$mail','".$masterData['address']."','$phone','".$masterData['contact_name']."','".$masterData['starCategory']."','".$masterData['website']."','$city','GCR Tool','$time')");
               
               $insertedId = $this->db->insert_id();
               $this->gm->updateCRM($GCRId,$insertedId,$city);
          }
          else if($type == 3)
          {
               if($clientType == 1)
               {
                    $otherdb = $this->load->database('otherdb',true);
                    $masterQry = $otherdb->query("SELECT * FROM hotelsmaster WHERE hotelsMasterId = '$masterId'");
                    $masterData = $masterQry->result_array()[0]; 
                    $masterData['hotelName'] = addslashes($masterData['hotelName']);
                    $masterData['address'] = addslashes($masterData['address']);
                    $masterData['web'] = addslashes($masterData['web']);
                    
                    $insertCRM = $this->db->query("INSERT INTO clientcsv(clientName,clientType,longitude,latitude,mailId,`address`,mobileNo,website,cityID,createdBy,createdDate) 
                                             VALUES
                                             ('".$masterData['hotelName']."','$clientType','".$masterData['longitude']."','".$masterData['lat']."','".$masterData['email1']."','".$masterData['address']."','".$masterData['phone1']."','".$masterData['web']."','$city','GCR Tool','$time')");
                    $insertedId = $this->db->insert_id();
                    $this->gm->updateCRM($GCRId,$insertedId,$city);
               }
               else
               {
                    $otherdb = $this->load->database('otherdb',true);
                    $masterQry = $otherdb->query("SELECT * FROM travelagencymaster WHERE travelAgencyMasterId = '$masterId'");
                    $masterData = $masterQry->result_array()[0];

                    $masterData['travelAgencyName'] = addslashes($masterData['travelAgencyName']);
                    $masterData['address'] = addslashes($masterData['address']);
                    $masterData['website'] = addslashes($masterData['website']);

                    $insertCRM = $this->db->query("INSERT INTO clientcsv(clientName,clientType,mailId,`address`,mobileNo,website,cityID,createdBy,createdDate) 
                                             VALUES
                                             ('".$masterData['travelAgencyName']."','$clientType','".$masterData['email']."','".$masterData['address']."','".$masterData['phone']."','".$masterData['website']."','$city','GCR Tool','$time')");
                    $insertedId = $this->db->insert_id();
                    $this->gm->updateCRM($GCRId,$insertedId,$city);
               }
          }
          else if($type == 4)
          {
               $otherdb = $this->load->database('otherdb',true);
               $masterQry = $otherdb->query("SELECT * FROM companyreferred WHERE companyReferredId = '$masterId'");
               $masterData = $masterQry->result_array()[0];
               $masterData['companyName'] = addslashes($masterData['companyName']);
               $masterData['address'] = addslashes($masterData['address']);
               $masterData['contactName'] = addslashes($masterData['contactName']);
               
               $insertCRM = $this->db->query("INSERT INTO clientcsv(clientName,clientType,mailId,`address`,mobileNo,contactpersion,cityId,createdBy,createdDate) 
                                             VALUES
                                             ('".$masterData['companyName']."','$clientType','".$masterData['email']."','".$masterData['address']."','".$masterData['phone']."','".$masterData['contactName']."','$city','GCR Tool','$time')");
               $insertedId = $this->db->insert_id();
               $this->gm->updateCRM($GCRId,$insertedId,$city);
          }
     }
     
     public function fetchcrmDetails()
     {
          $qry = $this->db->query("SELECT clientName FROM clientcsv WHERE id = '".$_POST['id']."'");
          echo json_encode($qry->result_array());
     }

     public function fetchcorpDetails()
     {
          $qry = $this->db->query("SELECT company_name FROM corp_registration WHERE id = '".$_POST['id']."'");
          echo json_encode($qry->result_array());
     }

     public function fetchhobseDetails()
     {
          $type = $_POST['type'];
          $otherdb = $this->load->database('otherdb',true);
          if($type == '1')
          {
               $qry = $otherdb->query("SELECT hotelName AS clientName FROM hotelsMaster WHERE hotelsMasterId = '".$_POST['id']."'");
               echo json_encode($qry->result_array());
          }
          else
          {
               $qry = $otherdb->query("SELECT travelAgencyName AS clientName FROM travelAgencyMaster WHERE travelAgencyMasterId = '".$_POST['id']."'");
               echo json_encode($qry->result_array());
          }
     }

     // searching the same clientname
     public function matchCompanyReferred($companyName,$city,$clientType,$gcrId,$clientMasterId)
     {
          if($clientMasterId <> '0' AND $clientType == '1')
          {
               $originType = 1;
               $hid = $clientMasterId;
          }
          else
          {
               $originType = 2;
               $clientMasterId = 0;
          }
          $otherdb = $this->load->database('otherdb',true);
          $matchQry = $otherdb->query("SELECT * FROM `companyreferred` WHERE companyName = '$companyName' AND cityId = '$city' AND partnerType = '$clientType' AND ( originType = '2' OR originType = '3' ) ");
          $matchResult = $matchQry->result_array();
          $ch = curl_init();
          $url = $this->config->item('curl_url').'index.php/json/jsonp.html?mode=6&fnname=syjp09Nflat9A4S4Ur3hz3UWarhi7qZQH3PUML46R6NxvmM2BTUdc8QR0UN43JyUMPtLjgzBEssddRT5VW7b9vD1Y3HU1XHILcifQ1TBssddcQzpntGtssddY4deOxYs37uJNJW9cqdmBcs0rhMqreNoGBeprHrh9S-loXuPP8NAvmvkKN3Q33&fdname=hotelsMasterId';
          if(count($matchResult) > 0)
          {
               foreach($matchResult AS $data)
               {
                    $masterId = $data['companyReferredId'];
                    $cAddress = $data['address'];
                    $cPhone = $data['phone'];
                    $cEmail = $data['email'];
                    $tamId = $data['referrerMaster'];
                    $updateCompanyReferred = $otherdb->query("UPDATE companyreferred SET GCRId = '$gcrId', originType = '$originType', partnerMaster = '$clientMasterId' WHERE companyReferredId = $masterId");
                    $updateGlobalClient = $otherdb->query("UPDATE globalclientrepository SET `address` = concat(address,'|$cAddress'), phone1 = concat(phone1,'|$cPhone'), phone2 = concat(phone2,'|$cPhone'), email = concat(email,'|$cEmail'), email2 = concat(email2,'|$cEmail') WHERE GCRId = $gcrId ");

                    if(isset($hid) && sizeof($hid)  > 0)
                    {
                         $data = array(
                              'hid' => $hid,
                              'travelAgencyMasterId' => '0',
                              'hotelsAgencyId' => $tamId,
                              'uId' => 0,
                              'diffid' => 2,
                         );
                         curl_setopt($ch, CURLOPT_URL, $url);
                         curl_setopt($ch, CURLOPT_POST, count($data));   
                         curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                         $result = curl_exec($ch);
                         $err = curl_error($ch);
                    }
               }
          }
          curl_close($ch);
     }

     public function matchCompanyReferred2($companyName,$city,$clientType,$gcrId,$clientMasterId)
     {
          $otherdb = $this->load->database('otherdb',true);
          if($clientMasterId <> '0')
          {
               $originType = 1;
          }
          else
          {
               $originType = 2;
          }
          $matchQry = $otherdb->query("SELECT * FROM `companyreferred` WHERE companyName = '$companyName' AND cityId = '$city' AND partnerType = '$clientType' AND ( originType = '2' OR originType = '3' ) ");
          $matchResult = $matchQry->result_array();
          if(sizeof($matchResult) > 0)
          {
               foreach($matchResult AS $data)
               {
                    $masterId = $data['companyReferredId'];
                    $cAddress = $data['address'];
                    $cPhone = $data['phone'];
                    $cEmail = $data['email'];
                    $updateCompanyReferred = $otherdb->query("UPDATE companyreferred SET GCRId = '$gcrId', originType = '$originType', partnerMaster = '$clientMasterId' WHERE companyReferredId = $masterId");
                    $updateGlobalClient = $otherdb->query("UPDATE globalclientrepository SET `address` = concat(address,'|$cAddress'), phone1 = concat(phone1,'|$cPhone'), phone2 = concat(phone2,'|$cPhone'), email = concat(email,'|$cEmail'), email2 = concat(email2,'|$cEmail') WHERE GCRId = $gcrId ");
               }
          }
     }

     public function matchCompanyReferred1($companyName,$city,$clientType,$gcrId,$clientMasterId,$companyMail,$companyAddress,$companyPhone)
     {
          if($clientMasterId == '0')
          {
               $this->gm->insertToHotelsMaster($companyName,$city,$clientType,$gcrId,$companyMail,$companyPhone,$companyAddress);
          }
          else
          {
               $this->gm->matchCompanyReferred($companyName,$city,$clientType,$gcrId,$clientMasterId);
          }
     }

     public function matchCompanyReferred3($companyName,$city,$clientType,$gcrId,$clientMasterId,$companyMail,$companyAddress,$companyPhone,$contactPerson)
     {
          if($clientMasterId == '0')
          {
               $this->gm->insertToTravelAgencyMaster($companyName,$city,$clientType,$gcrId,$companyMail,$companyPhone,$companyAddress,$contactPerson);
               // $this->gm->matchCompanyReferred2($companyName,$city,$clientType,$gcrId,$clientMasterId);
          }
          else
          {
               $this->gm->matchCompanyReferred2($companyName,$city,$clientType,$gcrId,$clientMasterId);
          }
     }

     public function insertToHotelsMaster($hotelName,$cityMasterId,$clientType,$gcrId,$userName,$phone,$address)
     {
          $otherdb = $this->load->database('otherdb',true);

          $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
          $pass = array(); //remember to declare $pass as an array
          $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
          for($i = 0; $i < 6; $i++)
          {
               $n = rand(0, $alphaLength);
               $pass[] = $alphabet[$n];
          }
          $password = implode($pass);
          $ch = curl_init();
          $url = $this->config->item('curl_url').'index.php/admin/user/login?signUp=1';
          $data = array(
               'hotelname' => $hotelName,
               'cityMasterId' => $cityMasterId,
               'username' => $userName,
               'password' => $password,
               'confirmpassword' => $password,
               'phone' => $phone,
               'website' => '',
               'agree' => 1,
               'address' => $address,
               'isFactual' => 1
          );
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, count($data));   
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $result = curl_exec($ch);
          $err = curl_error($ch);
          curl_close($ch);

          $hotelsMasterQry = $otherdb->query("SELECT hotelsMasterId FROM hotelsmaster WHERE userName = '$userName' AND `passWord` = '$password' AND hotelName = '$hotelName'");
          $hotelsMasterQryRes = $hotelsMasterQry->result_array()[0];

          $hotelsMasterId = $hotelsMasterQryRes['hotelsMasterId'];

          $addressUpdateQry = $otherdb->query("UPDATE hotelsmaster SET `address` = '$address' WHERE hotelsMasterId = '$hotelsMasterId'");

          $gcrUpdateQry = $otherdb->query("UPDATE globalclientrepository SET clientMasterId = '$hotelsMasterId' WHERE GCRId = '$gcrId'");

          $this->gm->updateHM($gcrId,$hotelsMasterId);

          $this->gm->matchCompanyReferred($hotelName,$cityMasterId,$clientType,$gcrId,$hotelsMasterId);
     }

     public function insertToTravelAgencyMaster($companyName,$cityMasterId,$clientType,$gcrId,$userName,$phone,$address,$contactPerson)
     {
          $otherdb = $this->load->database('otherdb',true);

          // Password
          $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
          $pass = array(); //remember to declare $pass as an array
          $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
          for($i = 0; $i < 6; $i++)
          {
               $n = rand(0, $alphaLength);
               $pass[] = $alphabet[$n];
          }
          $password = implode($pass);

          // Country, State Details
          $sel = $otherdb->query("SELECT stateMasterId, countryMasterId FROM citymaster WHERE cityMasterId = $cityMasterId");
          $res = $sel->result_array();
          if(sizeof($res) > 0)
          {
               $stateMasterId = $res[0]['stateMasterId'];
               $countryMasterId = $res[0]['countryMasterId'];
          }
          else
          {
               $stateMasterId = 35;
               $countryMasterId = 101;
          }

          $ch = curl_init();
          $url = $this->config->item('curl_url').'index.php/signup/signUpAgent';
          $data = array(
               'usertype' => $clientType,
               'agency' => $companyName,
               'website' => '',
               'first_name' => $contactPerson,
               'last_name' => '',
               'phone' => $phone,
               'username' => $userName,
               'password' => $password,
               'confirmpassword' => $password,
               'companyPhone' => $phone,
               'companyEmail' => $userName,
               'address' => $address,
               'countryMasterId' => $countryMasterId,
               'stateMasterId' => $stateMasterId,
               'cityMasterId' => $cityMasterId,
               'termsCondition' => 1,
               'isFactual' => 1
          );
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, count($data));   
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $result = curl_exec($ch);
          $err = curl_error($ch);
          curl_close($ch);

          $tam = $otherdb->query("SELECT travelAgencyMasterId FROM travelagencymaster WHERE email = '$userName' AND clientTypeMasterId = '$clientType' AND `password` = '$password' AND GCRId IS NULL AND travelAgencyName = '$companyName' ");
          $tamId = $tam->result_array()[0]['travelAgencyMasterId'];

          $gcrUpdateQry = $otherdb->query("UPDATE globalclientrepository SET clientMasterId = '$tamId' WHERE GCRId = '$gcrId'");    
          
          $this->gm->updateTAM($gcrId,$tamId);

          $this->gm->matchCompanyReferred2($companyName,$cityMasterId,$clientType,$gcrId,$tamId);
     }
}
?>