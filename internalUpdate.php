<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class internalUpdate extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          $this->load->database();
          $this->load->model('internalUpdate_model','im');
     }

     public function gridData()
     {
          $this->im->fetchHotels();
     }

     public function gridReadData()
     {
          $this->im->gcrData();
     }

     public function gridUpdateData()
     {
          $this->im->gcrUpdateClientName();
     }

     public function update()
     {
          $this->im->update();
     }

     public function cityUpdate()
     {
          $this->im->getCities();
     }

     public function fetchCityDetails()
     {
          $this->im->getCityDetails();
     }

     public function updateCityDetails()
     {
          $this->im->updateCityDetails();
     }

     public function fetchLocalities()
     {
          $this->im->fetchLocalities();
     }

     public function fetchLocalityDetails()
     {
          $this->im->fetchLocalityDetails();
     }

     public function updateLocalityDetails()
     {
          $this->im->updateLocalityDetails();
     }
}
?>