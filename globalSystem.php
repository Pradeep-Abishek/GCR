<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class globalSystem extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('global_model','gm');
          $this->load->model('internalUpdate_model','im');
     }

     public function repository()
     {
          $this->data['city'] = $this->gm->city();
          $this->data['corpCity'] = $this->gm->corpCities();
          $this->data['crmCity'] = $this->gm->crmCities();
          $this->data['hobseCity'] = $this->gm->hobseCities();
          $this->data['customerCity'] = $this->gm->customerCities();
          $this->data['internalCity'] = $this->gm->internalCities();
          $this->data['gcrCity'] = $this->gm->gcrCities();
          $this->data['countryMaster'] = $this->im->countryMaster();
          $this->data['stateMaster'] = $this->im->stateInitial();
          // $this->data['countryMaster'] = $this->im->countryMaster();
          $this->load->view('globalSystem/globalView.php',$this->data);
     }

     public function companyFilters()
     {
          $this->gm->companyFilters();
     }

     public function corpData()
     {
          $this->gm->corpData();
     }

     public function crmData()
     {
          $this->gm->crmData(); 
     }

     public function hobseData()
     {
          $this->gm->hobseData();
     }

     public function companyData()
     {
          $this->gm->companyData();
     } 
     // public function test1()
     // {
     //      echo json_encode($this->gm->corpData());
     // }

     public function corpEditBox()
     {
          $data['clientName'] = $_POST['hotelName'];
          $data['gcr'] = $this->gm->searchMatchGCR();
          $data['crm'] = $this->gm->searchMatchCRM();
          // clientTypeId = 1 => Hotel , 3 => Company , 4 => Travel Agent
          if($_POST['clientTypeId'] == '1')
          {
               $data['tam'] = $this->gm->searchMatchHM();
          }
          else
          {
               $data['tam'] = $this->gm->searchMatchTAM();
          }
          $data['tamCount'] = count($data['tam']) + '0';
          $data['gcrCount'] = count($data['gcr']) + '1';
          $data['crmCount'] = count($data['crm']) + '1';
          echo json_encode($data);
     }

     public function crmEditBox()
     {
          $data['clientName'] = $_POST['hotelName'];
          $data['gcr'] = $this->gm->searchMatchGCR();
          $data['corp'] = $this->gm->searchMatchCORP();
          // clientTypeId = 1 => Hotel , 3 => Company , 4 => Travel Agent
          if($_POST['clientTypeId'] == '1')
          {
               $data['tam'] = $this->gm->searchMatchHM();
          }
          else
          {
               $data['tam'] = $this->gm->searchMatchTAM();
          }
          $data['tamCount'] = count($data['tam']) + '0';
          $data['gcrCount'] = count($data['gcr']) + '1';
          $data['corpCount'] = count($data['corp']) + '0';
          echo json_encode($data);
     }

     public function hobseEditBox()
     {
          $data['clientName'] = $_POST['hotelName'];
          
          $data['gcr'] = $this->gm->searchMatchGCR();
          $data['corp'] = $this->gm->searchMatchCORP();
          $data['crm'] = $this->gm->searchMatchCRM();

          $data['gcrCount'] = count($data['gcr']) + '1';
          $data['corpCount'] = count($data['corp']) + '0';
          $data['crmCount'] = count($data['crm']) + '1';

          echo json_encode($data);
     }

     public function customerEditBox()
     {
          $data['clientName'] = $_POST['hotelName'];
          
          $data['gcr'] = $this->gm->searchMatchGCR();
          $data['corp'] = $this->gm->searchMatchCORP();
          $data['crm'] = $this->gm->searchMatchCRM();

          // clientTypeId = 1 => Hotel , 3 => Company , 4 => Travel Agent
          if($_POST['clientTypeId'] == '1')
          {
               $data['tam'] = $this->gm->searchMatchHM();
          }
          else
          {
               $data['tam'] = $this->gm->searchMatchTAM();
          }
          
          $data['tamCount'] = count($data['tam']) + '0';
          $data['gcrCount'] = count($data['gcr']) + '1';
          $data['corpCount'] = count($data['corp']) + '0';
          $data['crmCount'] = count($data['crm']) + '1';

          echo json_encode($data);
     }

     public function crmReadOnly()
     {
          $data = $this->gm->fetchFromCRM();
          echo json_encode($data);
     }

     public function gcrReadOnly()
     {
          $data = $this->gm->fetchFromGCR();
          echo json_encode($data);
     }

     public function tamReadOnly()
     {
          $data = $this->gm->fetchFromTAM();
          echo json_encode($data);
     }

     public function hmReadOnly()
     {
          $data = $this->gm->fetchFromHM();
          echo json_encode($data);
     }

     public function corpReadOnly()
     {
          $data = $this->gm->fetchFromCORP();
          echo json_encode($data);
     }

     public function companyReferredReadOnly()
     {
          $data = $this->gm->fetchFromCompanyReferred();
          echo json_encode($data);
     }

     public function corpSubmit()
     {
          $data = $this->gm->corpSubmit();
     }

     public function crmSubmit()
     {
          $data = $this->gm->crmSubmit();
     }

     public function hobseSubmit()
     {
          $data = $this->gm->hobseSubmit();
     }

     public function customerSubmit()
     {
          $data = $this->gm->customerSubmit();
     }

     public function crmRecord()
     {
          $this->gm->fetchcrmDetails();
     }

     public function corpRecord()
     {
          $this->gm->fetchcorpDetails();
     }

     public function hobseRecord()
     {
          $this->gm->fetchhobseDetails();
     }

     public function test()
     {
          $mailArray = array();
          $phoneArray = array();
          $masterQry = $this->db->query("SELECT * FROM corp_registration WHERE id = 255");
          $masterData = $masterQry->result_array()[0];
          // print_r($masterData);
          // echo $masterData['primary_contact']."             <br>";
          // echo $masterData['email'].'            ';

          

          $val = $masterData['primary_contact'];
          $phone = is_string($val) && is_array(json_decode($val, true)) ? json_decode($val,true) : $val;
          echo $phone = is_array($phone) ? $phone[0]['phoneNo'] : $phone;

          $val2 = $masterData['email'];
          $mail = is_string($val) && is_array(json_decode($val2, true)) ? json_decode($val2,true) : $val2;
          echo $mail = is_array($mail) ? $mail[0]['mailId'] : $mail;

     }

     public function checkHobseId()
     {
          $this->gm->checkGCRHobseId();
     }

     public function googleMaps()
     {
          $address = "Theni,TamilNadu";
          // https://www.google.co.in/maps/place/$address
          $add='https://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false';
          // $add = 'https://www.google.co.in/maps/place/'.$address;
          // echo $add;
          // $geocode=file_get_contents($add);
          // print_r($geocode);
          // exit;
          // $output= json_decode($geocode);
          // $latitude = $output->results[0]->geometry->location->lat;
          // $longitude = $output->results[0]->geometry->location->lng;
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $add);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
          // This is what solved the issue (Accepting gzip encoding)
          curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");     
          $response = curl_exec($ch);
          curl_close($ch);
          echo $response;
     }
}
?>