<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Global System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.3.913/js/kendo.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2019.1.220/styles/kendo.common.min.css" />
<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2019.1.220/styles/kendo.blueopal.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>


<script>
     alertify.set('notifier','position', 'top-center');
</script>

<style>
.ajs-message
{
     color: white;
}
.header{
     min-height:20px;
     background-color:#6D214F;
     color:white;
     text-align:center;
}
.nav-pills>li>a {
     border-radius:0px;
     color:black;
     font-size:12px;
}
.nav-pills{
     background-color:#F97F51;
}
/* #hobse,#customer{
     text-align:center;
     color:#FFF;
     margin:10px;
     width:36%;
     min-height:30px;
     position:relative;
     max-height: calc(100vh - 80px);
     overflow: auto;
     float:left;
} */
.readOnly{
     text-align:center;
     color:#FFF;
     margin:10px;
     width:30%;
     background-color:#337ab7;
     min-height:30px;
     position:relative;
     max-height: calc(100vh - 80px);
     overflow: auto;
     float:right;
}
#corpEditBox,#crmEditBox,#hobseEditBox,#customerEditBox,#crmReadOnly,#tamReadOnly,#hmReadOnly,#gcrReadOnly,#corpReadOnly,#crReadOnly{
     text-align:center;
     color:#FFF;
     margin:0px 19px;
     width:27%;
     background-color:#337ab7;
     min-height:30px;
     position:relative;
     max-height: calc(100vh - 80px);
     overflow: auto;
     float:left;
}
#corpTable,#crmTable,#hobseTable,#companyTable
{
     width:36%;
     min-height:30px;
     position:relative;
     max-height: calc(100vh - 80px);
     float:left;
     text-align:left;
     cursor:pointer;
}


table>tbody>tr:hover{
     background-color:#6D214F;
     color:#FFF;
}
td{
     padding:10px;
}
thead{
     background-color:#F97F51;
     text-align:center;
}
form{
     color:black;
     background-color:white;
     text-align:left;
}
.form-group{
     margin-bottom: 0px;
}
.total{
     min-width:30px;
     text-align:center;
     float:right;
     background-color: #6d214f;
     border-radius: 10px;
     margin: 2px;
     color: white;
     font-size: 15px;
}
/* .form-control:not(#updateForm>div){
     border-radius:0px;
     border: 1px solid #fff;
     border-bottom: 1px solid #6D214F;
} */
textarea[name=readOnly]{
     resize:none;
}
.btn{
     border-radius:20px;
}
.selected{
    background-color: #ededed;
}
#internalUpdate,#gcrData,#corp,#crm,#hobse,#customer,#updateCities,#updateLocality{
    text-align: left;
    bottom:0px;
    /* background-color:#e1f0f7; */
    background-color:#337ab7;
    height: 50px;
    width: 100%;
    padding:10px;
}
#internalUpdate button,#gcrData button,#corp button,#crm button,#hobse button,#customer button,#updateCities button,#updateLocality button{
     position: relative;
     right: 29px;
     height: 30px;
     font-size: 14px;
}

.modal.left .modal-dialog,
.modal.right .modal-dialog {
     position: fixed;
     margin: auto;
     width: 320px;
     height: 100%;
     -webkit-transform: translate3d(0%, 0, 0);
          -ms-transform: translate3d(0%, 0, 0);
          -o-transform: translate3d(0%, 0, 0);
               transform: translate3d(0%, 0, 0);
}

.modal.left .modal-content,
.modal.right .modal-content {
     height: 100%;
     overflow-y: auto;
}

.modal.left .modal-body,
.modal.right .modal-body {
     padding: 15px 15px 80px;
}

/*Left*/
.modal.left.fade .modal-dialog{
     left: -320px;
     -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
          -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
          -o-transition: opacity 0.3s linear, left 0.3s ease-out;
               transition: opacity 0.3s linear, left 0.3s ease-out;
}

.modal.left.fade.in .modal-dialog{
     left: 0;
     width: 50%;
}
     
/*Right*/
.modal.right.fade .modal-dialog {
     right: -320px;
     -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
          -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
          -o-transition: opacity 0.3s linear, right 0.3s ease-out;
               transition: opacity 0.3s linear, right 0.3s ease-out;
}

.modal.right.fade.in .modal-dialog {
     right: 0;
     width: 50%;
}

/* ----- MODAL STYLE ----- */
.modal-content {
     border-radius: 0;
     border: none;
}

.modal-header {
     border-bottom-color: #EEEEEE;
     background-color: #FAFAFA;
}

b{
     color: white;
     font-weight: 100;
}

#badgeCount{
     background-color: green;
     color: white;
}

#cityUpdateEditBox,#localityUpdateEditBox{
     width: 30%;
     margin: 10px;
}

#spanCityMasterId{
    background-color: #ffffff;
}

#sliderDiv{
     width: 200px;
     position: absolute;
     left: 100px;
     top: 57px;
     left: 325px;
}

.irs--round .irs-line,.irs--round .irs-single{
     background-color: white;
     color: black;
}

.irs--round .irs-handle{
     border: 4px solid white;
}

.irs--round .irs-bar,.irs--round .irs-min,.irs--round .irs-max{
     background-color: #0ee00e;
}

.irs--round .irs-from:before,.irs--round .irs-to:before,.irs--round .irs-single:before{
     border-top-color: white;
}

.bnull {
     background-color: white;
}

.k-edit-form-container
{
     width: 700px;
}
.k-edit-form-container>.k-edit-field>input
{
     width: 400px;
}
#rGrid
{
     height: 500px;
     overflow: auto;
}
</style>
</head>
<body>
<div class="header"> Global Client Repository System </div>

<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#corp" onclick="removeClass()">New Registrations</a></li>
    <li><a data-toggle="pill" href="#crm" onclick="removeClass()">CRM Entries</a></li>
    <li><a data-toggle="pill" href="#hobse" onclick="removeClass()">Hobse Entries</a></li>
    <li><a data-toggle="pill" href="#customer" onclick="removeClass()">Customer Imported Entries</a></li>
    <li><a data-toggle="pill" href="#gcrData" onclick="removeClass()" >View GCR Data</a></li>
    <li><a data-toggle="pill" href="#internalUpdate" onclick="removeClass()" >Update Hotel Status</a></li>
    <li><a data-toggle="pill" href="#updateCities" onclick="removeClass()" >Update City Status</a></li>
    <li><a data-toggle="pill" href="#updateLocality" onclick="removeClass(),fetchLocalities()" >Update Localities </a></li>
</ul>


<div class="tab-content">
     
     <div id="corp" class="tab-pane fade in active">
          <select id="city_f2" onchange="filter2()" style="height:30px;">
               <option value=''>All Cities</option>
               <option value='0'>City Not Specified</option>
               <?php foreach($corpCity AS $city2) { ?>
               <option value="<?php echo $city2['value']; ?>"><?php echo $city2['label']; ?></option>
               <?php } ?>
          </select>
          <input type="text" style="width:250px;height:30px;" id="clientName_f2" placeholder="Enter Client Name - Keyword"><button onclick="filter2()"><i class="fa fa-search"></i></button>
          <br><br>
          <div id="corpTable"></div>
     </div>

     <div id="crm" class="tab-pane fade">
          <select id="city_f3" onchange="filter3()" style="height:30px;">
               <option value=''>All Cities</option>
               <option value='0'>City Not Specified</option>
               <?php foreach($crmCity AS $city2) { ?>
               <option value="<?php echo $city2['value']; ?>"><?php echo $city2['label']; ?></option>
               <?php } ?>
          </select>
          <input type="text" style="width:250px;height:30px;" id="clientName_f3" placeholder="Enter Client Name - Keyword"><button onclick="filter3()"><i class="fa fa-search"></i></button>
          <br><br>
          <div id="crmTable"></div>
     </div>
     
     <div id="hobse" class="tab-pane fade">
          <select id="city_f4" onchange="filter4()" style="height:30px;">
               <option value=''>All Cities</option>
               <option value='0'>City Not Specified</option>
               <?php foreach($hobseCity AS $city2) { ?>
               <option value="<?php echo $city2['value']; ?>"><?php echo $city2['label']; ?></option>
               <?php } ?>
          </select>
          <input type="text" style="width:250px;height:30px;" id="clientName_f4" placeholder="Enter Client Name - Keyword"><button onclick="filter4()"><i class="fa fa-search"></i></button>
          <br><br>
          <div id="hobseTable"></div>
     </div>
     
     <div id="customer" class="tab-pane fade">
          <b>Imported By - Client Types :</b>
          <select id="cType" style="height:30px;" onchange="companyFilter()">
               <option value=''>All Types</option>
               <option value='1'>Hotel</option>
               <option value='3'>Company</option>
               <option value='4'>Travel Agent</option>
          </select>
          <b>Client Names : </b>
          <select id='clients' style="height:30px;" onchange="filter5()">
               <option value=''>All Clients</option>
          </select>
          <b>City :</b>
          <select id="city_f5" onchange="filter5()" style="height:30px;">
               <option value=''>All Cities</option>
               <option value='0'>City Not Specified</option>
               <?php foreach($customerCity AS $city2) { ?>
               <option value="<?php echo $city2['value']; ?>"><?php echo $city2['label']; ?></option>
               <?php } ?>
          </select>
          <br><br>
          <div id="companyTable"></div>
     </div>
     
     <div id="gcrData" class="tab-pane fade">
          <select id="city1" onchange="filter1()" style="height:30px;">
               <option value=''>All Cities</option>
               <option value='0'>City Not Specified</option>
               <?php foreach($gcrCity AS $city2) { ?>
               <option value="<?php echo $city2['value']; ?>"><?php echo $city2['label']; ?></option>
               <?php } ?>
          </select>
          <input type="text" style="width:250px;height:30px;" id="hotelName1" placeholder="Enter Client Name - Keyword"><button onclick="filter1()"><i class="fa fa-search"></i></button>
          <br><br>
          <div id="rGrid"></div>
     </div>

     <div id="internalUpdate" class="tab-pane fade">
          <select id="city" onchange="filter()" style="height:30px;">
                    <option value=''>All Cities</option>
                    <option value='0'>City Not Specified</option>
                    <?php foreach($internalCity AS $city1) { ?>
                    <option value="<?php echo $city1['value']; ?>"><?php echo $city1['label']; ?></option>
                    <?php } ?>
          </select>
          <input type="text" style="width:250px;height:30px;" id="hotelName" placeholder="Enter Hotel Name - Keyword"><button onclick="filter()"><i class="fa fa-search"></i></button>
          <button class="btn btn-success btn-sm" id="updateButton" style="float:right" onclick="updates()" > Update Selected Hotels </button>
          <br><br>
          <div id="iGrid"></div>
     </div>

     <div id="updateCities" class="tab-pane fade">
          <b>Country : </b>
          <select id="country" style="height:30px;" onchange="fetchStatesCities(1)">
               <option value=''>All Countries</option>
               <?php foreach($countryMaster AS $country) { ?>
               <option value="<?php echo $country['countryMasterId'] ?>" <?php echo $country['countryMasterId'] == '101' ? "selected" : "" ?>><?php echo $country['countryName']; ?></option>
               <?php } ?>
          </select>
          <b>State : </b>
          <select id="state" style="height:30px;" onchange="fetchCities()">
               <option value=''>All States</option>
               <?php foreach($stateMaster AS $state) { ?>
               <option value="<?php echo $state['stateMasterId'] ?>" <?php echo $state['stateMasterId'] == '35' ? "selected" : "" ?>><?php echo $state['stateName']; ?></option>
               <?php } ?>
          </select>
          <b>City : </b>
          <input type="text" style="width:250px;height:30px;" id="cityUpdate" placeholder="Type City Name">
          <span class="badge badge-pill badge-success" id="badgeCount"></span>
          <button class="btn btn-danger btn-xs" id="addCity" style="float:right" onclick="addNewCity()">Add City</button>
          <br><br>
     </div>

     <div id="updateLocality" class="tab-pane fade">
                    
          <b>City : </b>
          <select id="localityCity" style="height:30px;" onchange="fetchLocalities()">
               <?php foreach($city AS $cityMaster) { ?>
               <option value="<?php echo $cityMaster['value'] ?>"><?php echo $cityMaster['label']; ?></option>
               <?php } ?>
          </select>
          &nbsp;&nbsp;&nbsp;
          <b>Radius : </b>
          <div id="sliderDiv">
               <input type="text" id="radiusSlider">
          </div>
          <input type="number" min=0 style="width:150px;height:30px;margin-left:240px;" id="pinCode" placeholder="Type Pincode Here...">
          <button class="btn btn-danger" id="pinSub" style="line-height:0;right:0px;">Search</button>
          <b style="margin-left:23px;">Locality Name : </b>
          <select id="cityLocalitySelect" style="height:30px;" onchange="fetchLocalityDetails()">
               <option value="">No Locality Found</option>
          </select>
          <span class="badge badge-success" id="cityLocalitySelectCount"></span>
          
     </div>
</div>



<div class="tab-content" id="editBox">

     <div id="corpEditBox" class="tab-pane fade">
          <div id="corpEditBoxName"></div>
          <form class="corpSubmit" method="POST">
               <input type="hidden" name="master" id="corpmaster">
               <br>
               <div class="form-group">
                    Matching Client from GCR <div class="total" id="corpgcrTotal"></div>
                    <input id="corp_gcr" name="gcr" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Hobse ID 
                    <input id="hId" name="hId" class="form-control" data-identity="corp" placeholder="Enter Hobse ID...." onchange="checkHobseId('corp')" required>
               </div>
               <br>
               <div class="form-group">
                    Matching Client from CRM <div class="total" id="corpcrmTotal"></div>
                    <input id="corp_crm" name="crm" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Matching Client from TAM / Hotels Master <div class="total" id="corptamTotal"></div>
                    <input id="corp_tam" class="form-control" name="tam" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group">
                    City
                    <select id="corp_city" name="city" class="form-control" required>
                    <option value=''>Select City</option>
                    <?php foreach($city AS $city3) { ?>
                    <option value="<?php echo $city3['value']; ?>"><?php echo $city3['label']; ?></option>
                    <?php } ?>
                    </select>
               </div>
               <br>
               <button type="reset" onclick="test()" class="btn btn-primary" style="width:50%">Reset</button>
               <button type="submit" id="corpSubmit" class="btn btn-success" style="float:right;width:50%">Submit</button>
          </form>
     </div>

     <div id="crmEditBox" class="tab-pane fade">
          <div id="crmEditBoxName"></div>
          <form class="crmSubmit" method="POST">
               <input type="hidden" name="master" id="crmmaster">
               <br>
               
               <div class="form-group">
                    Matching Client from GCR <div class="total" id="crmgcrTotal"></div>
                    <input id="crm_gcr" name="gcr" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Hobse ID 
                    <input id="hId" name="hId" class="form-control" data-identity="crm" placeholder="Enter Hobse ID...." onchange="checkHobseId('crm')" >
               </div>
               <br>
               <div class="form-group">
                    Matching Client from Registration <div class="total" id="crmcorpTotal"></div>
                    <input id="crm_corp" name="corp" class="form-control" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group"> <div class="total" id="crmtamTotal"></div>
                    Matching Client from TAM / Hotels Master
                    <input id="crm_tam" name="tam" class="form-control" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group">
                    City
                    <select id="crm_city" name="city" class="form-control" required>
                    <option value=''>Select City</option>
                    <?php foreach($city AS $city4) { ?>
                    <option value="<?php echo $city4['value']; ?>"><?php echo $city4['label']; ?></option>
                    <?php } ?>
                    </select>
               </div>
               <br>
               <button type="reset" onclick="test()" class="btn btn-primary" style="width:50%">Reset</button>
               <button type="submit" id="crmSubmit" class="btn btn-success" style="float:right;width:50%">Submit</button>
          </form>
     </div>
     
     <div id="hobseEditBox" class="tab-pane fade">
          <div id="hobseEditBoxName"></div>
          <form class="hobseSubmit" method="POST">
               <input type="hidden" name="master" id="hobsemaster">
               <br>
               
               <div class="form-group">
                    Matching Client from GCR <div class="total" id="hobsegcrTotal"></div>
                    <input id="hobse_gcr" name="gcr" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Hobse ID 
                    <input id="hId" name="hId" class="form-control" data-identity="hobse" placeholder="Enter Hobse ID...." onchange="checkHobseId('hobse')" required>
               </div>
               <br>
               <div class="form-group">
                    Matching Client from Registration <div class="total" id="hobsecorpTotal"></div>
                    <input id="hobse_corp" name="corp" class="form-control" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group">
                    Matching Client from CRM <div class="total" id="hobsecrmTotal"></div>
                    <input id="hobse_crm" name="crm" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    City
                    <select id="hobse_city" name="city" class="form-control" required>
                    <option value=''>Select City</option>
                    <?php foreach($city AS $city5) { ?>
                    <option value="<?php echo $city5['value']; ?>"><?php echo $city5['label']; ?></option>
                    <?php } ?>
                    </select>
               </div>
               <br>
               <button type="reset" onclick="test()" class="btn btn-primary" style="width:50%">Reset</button>
               <button  id="hobseSubmit" class="btn btn-success" style="float:right;width:50%">Submit</button>
          </form>
     </div>
     
     <div id="customerEditBox" class="tab-pane fade">
          <div id="customerEditBoxName"></div>
          <form class="customerSubmit" method="POST">
               <input type="hidden" name="master" id="customermaster">
               <br>
               
               <div class="form-group">
                    Matching Client from GCR <div class="total" id="customergcrTotal"></div>
                    <input id="customer_gcr" name="gcr" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Hobse ID 
                    <input id="hId" name="hId" class="form-control" data-identity="customer" placeholder="Enter Hobse ID...." onchange="checkHobseId('customer')" required>
               </div>
               <br>
               <div class="form-group">
                    Matching Client from Registration <div class="total" id="customercorpTotal"></div>
                    <input id="customer_corp" name="corp" class="form-control" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group">
                    Matching Client from CRM <div class="total" id="customercrmTotal"></div>
                    <input id="customer_crm" name="crm" class="form-control" placeholder="Type here...." required>
               </div>
               <br>
               <div class="form-group">
                    Matching Client from TAM / Hotels Master <div class="total" id="customertamTotal"></div>
                    <input id="customer_tam" name="tam" class="form-control" placeholder="Type here....">
               </div>
               <br>
               <div class="form-group">
                    City
                    <select id="customer_city" name="city" class="form-control" required>
                    <option value=''>Select City</option>
                    <?php foreach($city AS $city6) { ?>
                    <option value="<?php echo $city6['value']; ?>"><?php echo $city6['label']; ?></option>
                    <?php } ?>
                    </select>
               </div>
               <br>
               <button type="reset" onclick="test()" class="btn btn-primary" style="width:50%">Reset</button>
               <button type="submit" id="customerSubmit" class="btn btn-success" style="float:right;width:50%">Submit</button>
          </form>
     </div>

</div>

<div class="tab-content" id="readOnly">

     <div id="corpReadOnly" class="tab-pane fade">
          <div id="corpReadOnlyName"></div>
          <form>
               <br>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="corpReadOnlyType">
               </div>
               <br>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="corpReadOnlyCity">
               </div>
               <br>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="corpReadOnlyAddress" rows="3"></textarea>
               </div>
               <br>
               <div class="form-group">
                    GCR ID
                    <input type="text" readonly class="form-control" id="corpReadOnlyGcrId">
               </div>
               <br>
               <div class="form-group">
                    Registration ID
                    <input type="text" readonly class="form-control" id="corpReadOnlyId">
               </div>
               <br>
          </form>
     </div>

     <div id="crmReadOnly" class="tab-pane fade">
          <div id="crmReadOnlyName"></div>
          <form>
               <br>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="crmReadOnlyType">
               </div>
               <br>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="crmReadOnlyCity">
               </div>
               <br>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="crmReadOnlyAddress" rows="3"></textarea>
               </div>
               <br>
               <div class="form-group">
                    GCR ID
                    <input type="text" readonly class="form-control" id="crmReadOnlyGcrId">
               </div>
               <br>
               <div class="form-group">
                    CRM ID
                    <input type="text" readonly class="form-control" id="crmReadOnlyId">
               </div>
               <br>
          </form>
     </div>
     
     <div id="tamReadOnly" class="tab-pane fade">
          <div id="tamReadOnlyName"></div>
          <form>
               <br>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="tamReadOnlyType">
               </div>
               <br>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="tamReadOnlyCity">
               </div>
               <br>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="tamReadOnlyAddress" rows="3"></textarea>
               </div>
               <br>
               <div class="form-group">
                    GCR ID
                    <input type="text" readonly class="form-control" id="tamReadOnlyGcrId">
               </div>
               <br>
               <div class="form-group">
                    Travel Agency Master ID
                    <input type="text" readonly class="form-control" id="tamReadOnlyId">
               </div>
               <br>
          </form>
     </div>
     
     <div id="hmReadOnly" class="tab-pane fade">
          <div id="hmReadOnlyName"></div>
          <form>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="hmReadOnlyType">
               </div>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="hmReadOnlyCity">
               </div>
               <br>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="hmReadOnlyAddress" rows="3"></textarea>
               </div>
               <br>
               <div class="form-group">
                    GCR ID
                    <input type="text" readonly class="form-control" id="hmReadOnlyGcrId">
               </div>
               <br>
               <div class="form-group">
                    Hobse Status
                    <input type="text" readonly class="form-control" id="hmReadOnlyHobSt">
               </div>
               <br>
               <div class="form-group">
                    Hotels Master ID
                    <input type="text" readonly class="form-control" id="hmReadOnlyId">
               </div>
               <br>
          </form>
     </div>

     <div id="gcrReadOnly" class="tab-pane fade">
          <div id="gcrReadOnlyName"></div>
          <form>
               <div class="form-group">
                    Hobse ID 
                    <input type="text" readonly class="form-control" id="gcrReadOnlyhId">
               </div>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="gcrReadOnlyType">
               </div>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="gcrReadOnlyCity">
               </div>
               <div class="form-group">
                    GCR ID
                    <input type="text" readonly class="form-control" id="gcrReadOnlyGcrId">
               </div>
               <div class="form-group">
                    Registration ID
                    <input type="text" readonly class="form-control" id="gcrReadOnlyRegId">
               </div>
               <div class="form-group">
                    CRM ID
                    <input type="text" readonly class="form-control" id="gcrReadOnlyCrmId">
               </div>
               <div class="form-group">
                    Client Master ID
                    <input type="text" readonly class="form-control" id="gcrReadOnlyCmId">
               </div>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="gcrReadOnlyAddress" rows="2"></textarea>
               </div>
          </form>
     </div>

     <div id="crReadOnly" class="tab-pane fade">
          <div id="crReadOnlyName"></div>
          <form>
               <br>
               <div class="form-group">
                    Type 
                    <input type="text" readonly class="form-control" id="crReadOnlyType">
               </div>
               <br>
               <div class="form-group">
                    City
                    <input type="text" readonly class="form-control" id="crReadOnlyCity">
               </div>
               <br>
               <div class="form-group">
                    Address
                    <textarea name="readOnly" class="form-control" readonly id="crReadOnlyAddress" rows="3"></textarea>
               </div>
               <br>
               <div class="form-group">
                    Referred By
                    <input type="text" readonly class="form-control" id="crReadOnlyReferredName">
               </div>
               <br>
               <div class="form-group">
                    Email
                    <input type="text" readonly class="form-control" id="crReadOnlyEmail">
               </div>
               <br>
               <!-- <div class="form-group">
                    Hotels Master ID
                    <input type="text" readonly class="form-control" id="hmReadOnlyId">
               </div>
               <br> --> 
          </form>
     </div>

</div>

<div class="tab-content" id="cityLocality">
     
     <div id="cityUpdateEditBox" class="tab-pane fade">
          <form class="cityUpdateSubmit" method="POST">
               <input type="hidden" name="cityMasterId" id="editBoxCityMaster">
               <div class="form-group">
                    Country
                    <select id="editBoxCityCountry" name="countryMasterId" class="form-control" onchange="fetchStatesCities(2)" required>
                         <?php foreach($countryMaster AS $country) { ?>
                         <option value="<?php echo $country['countryMasterId'] ?>"><?php echo $country['countryName']; ?></option>
                         <?php } ?>
                    </select>
               </div>
               <br>
               <div class="form-group">
                    State
                    <select id="editBoxCityState" name="stateMasterId" class="form-control" required>
                         <?php foreach($stateMaster AS $state) { ?>
                         <option value="<?php echo $state['stateMasterId'] ?>"><?php echo $state['stateName']; ?></option>
                         <?php } ?>
                    </select>
               </div>
               <br>
               <div class="form-group">
                    City Name <span class="badge badge-danger" id="spanCityMasterId"></span>
                    <input type="text" class="form-control" id="editBoxCityName" name="cityName" required>
               </div>
               <br>
               <div class="form-group">
                    Latitude
                    <input type="number" step="any" class="form-control" id="editBoxCityLat" name="lat" min="0.1" oninvalid="this.setCustomValidity('Enter Valid Latitude')" oninput="this.setCustomValidity('')"  required>
               </div>
               <br>
               <div class="form-group">
                    Longitude
                    <input type="number" step="any" class="form-control" id="editBoxCityLong" name="longitude" min="0.1" oninvalid="this.setCustomValidity('Enter Valid Longitude')" oninput="this.setCustomValidity('')" required>
               </div>
               <br>
               <div class="form-group">
                    Active Status
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label style="color:green">
                         <input type="radio" id="active" name="active" value="1" checked>
                         Active
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label style="color:red">
                         <input type="radio" id="active" name="active" value="0" >
                         In - Active
                    </label>
               </div>
               <br>
               <div style="text-align:center;">
                    <button type="submit" id="citySubmit" class="btn btn-success" style="width:50%">Submit</button>
               </div>
          </form>
     </div>

     <div id="localityUpdateEditBox" class="tab-pane fade">
          <form class="localityUpdateSubmit" method="POST">
               <span class="badge bnull" style="float:left" id="editBoxStateName"></span>
               <span class="badge bnull" style="float:right" id="editBoxCityMasterId"></span>
               <div class="clearfix"></div>
               <br>
               <div class="form-group">
                    Locality Name
                    <input type="text" class="form-control" id="editBoxLocalityName" name="localityName" required>
               </div>
               <span class="badge bnull" id="editBoxLocalityTaluk"></span>
               <span class="badge bnull" id="editBoxLocalityDistrict"></span>
               <span class="badge bnull" id="editBoxLocalityState"></span>
               <div class="clearfix"></div>
               <br>
               <div class="form-group">
                    Latitude
                    <input type="number" step="any" class="form-control" id="editBoxLocalityLatitude" name="latitude" min="0.1" oninvalid="this.setCustomValidity('Enter Valid Latitude')" oninput="this.setCustomValidity('')"  required>
               </div>
               <br>
               <div class="form-group">
                    Longitude
                    <input type="number" step="any" class="form-control" id="editBoxLocalityLongitude" name="longitude" min="0.1" oninvalid="this.setCustomValidity('Enter Valid Longitude')" oninput="this.setCustomValidity('')" required>
               </div>
               <br>
               <div style="text-align:center;">
                    <button type="submit" id="localitySubmit" class="btn btn-success" style="width:50%">Submit</button>
               </div>
          </form>
     </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
     <div class="modal-dialog">
          <div class="modal-content" style="width:90%">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Please Select the Values to Update</h4>
               </div>
               <div class="modal-body">
                    <form id="updateForm" class="internalUpdate" type="POST">
                         <input type="hidden" id="hmId" name="hmId">
                         <div class="form-group">
                              <label>Hobse Status</label>
                              <select class="form-control" id="hobseStatus" name="hobseStatus">
                                   <option value="0">Configuration in Progress - 0</option>
                                   <option value="1">Online - 1</option>
                                   <option value="2">Offline - 2</option>
                              </select>
                         </div>
                         <br>
                         <div class="form-group">
                              <label>Best Price Status</label>
                              <select class="form-control" id="bestPriceStatus" name="bestPriceStatus">
                                   <option value="1">Best Price - 1</option>
                                   <option value="2">Normal Price - 2</option>
                                   <option value="3">High Price - 3</option>
                              </select>
                         </div>
                         <br>
                         <div class="form-group">
                              <label>SAAS Package ID</label>
                              <select class="form-control" id="saasId" name="saasId">
                                   <option value="1">SAAS 1</option>
                                   <option value="2">SAAS 2</option>
                                   <option value="3">SAAS 3</option>
                              </select>
                         </div>
                         <br>
                         <button type="reset" class="btn btn-primary" style="width:50%">Reset</button>
                         <button type="submit" class="btn btn-success" style="float:right;width:50%">Update</button>
                    </form>
               </div>
          </div>
     </div>
</div>



<script>
     $(document).ready(function(){
          
          //Radius Slider 
          $("#radiusSlider").ionRangeSlider({
               // grid: true,
               // type: "double",
               skin: "round",
               min:1, 
               max: 20, 
               from: 10, 
               // to: 50, 
               prefix: "km ", 
               onFinish: function (data)
               {
                    fetchLocalities();
               },
          })

          // Defalt cities to update
          fetchCities();

          // Internal Update Grid
          var grid=$('#iGrid').kendoGrid({
          dataSource:
          {
               type: "POST",
               transport: {
                    read: { url: '<?php echo base_url(); ?>internalUpdate/gridData', type: "POST",
                    data:refreshGridParams, 
                    dataType: "json" },    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) {
                        return data.data.length;
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          dataBound: onDataBound,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: [
               { field: "hotelsMasterId",width: "100px", title: "Hotel ID"},
               { field: "hotelName",width: "300px", title: "Hotel Name"},
               { field: "cityName",width: "100px", title: "City"},
               { field: "address", title: "Address"},
               { field: "hobseStatus",width: "100px", title: "Hobse <br> Status"},
               { field: "bestPriceStatus",width: "100px", title: "Price <br> Status"},
               { field: "saasPackageId",width: "100px", title: "SAAS <br> Package"},
               { field: "", title : "Select to <br> Update", width: "100px", template: "#= checkbox(hotelsMasterId) #"}, 
          ]
          });

          function onDataBound() 
          {
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Hotels found for the selected City.</b></td></tr>');
                    }
          }

          function refreshGridParams()
          {
               var city = $("#city").val(); 
               var hotelName = $("#hotelName").val();
               return {
                    cityId : city,
                    hotelName : hotelName,
               };
          }

          // Read only Grid
          var grid=$('#rGrid').kendoGrid({
          dataSource: 
          {
               type: "POST",
               transport:
               {
                    read: { url: '<?php echo base_url(); ?>internalUpdate/gridReadData', type: "POST",data:refreshGridParams1,dataType: "json" },
                    update: {url: '<?php echo base_url(); ?>internalUpdate/gridUpdateData', type: "POST"}    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) 
                    {
                         return data.data.length;
                    },
                    model:
                    {
                         id: "GCRId",
                         fields: 
                         {
                              GCRId: { editable: false},
                              clientType: { editable: false},
                              clientName: { validation: { required: true } },
                              cityName: { editable: false},
                              address: { validation: { required: true } },
                              hobseStatus: { editable: false},
                              hobseId: { editable: false},
                              crmId: { editable: false},
                              regId: { editable: false},
                              clientMasterId: { editable: false},
                         }
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          dataBound: onDataBound1,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: 
          [
               { field: "GCRId",width: "100px", title: "GCR ID"},
               { field: "clientType", width: "100px", title: "Client<br>Type"},
               { field: "clientName",width: "100px", title: "Client<br>Name"},
               { field: "cityName",width: "100px", title: "City"},
               { field: "address", title: "Address", width: "200px"},
               { field: "hobseStatus",width: "100px", title: "Hobse <br> Status"},
               { field: "hobseId",width: "100px", title: "Customer <br> ID"},
               { field: "crmId",width: "100px", title: "CRM ID"},
               { field: "regId",width: "120px", title: "Registration <br> ID"},
               { field: "clientMasterId",width: "100px", title: "Client <br> Master ID"},
               { command: ["edit"], title: "&nbsp;", width: "100px" },
               // { field: "saasPackageId",width: "100px", title: "SAAS <br> Package"},
               // { field: "", title : "Select to <br> Update", width: "100px", template: "#= checkbox(hotelsMasterId) #"}, 
          ],
          editable:
          {
               mode: "popup",
               window:
               {
                    title: "Edit Details",
                    width: 700,
                    columns:{ field: "clientName"},
               }
          }    
          });
     
          function onDataBound1() 
          {
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) 
               {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Hotels found for the selected City.</b></td></tr>');
               }
          }

          function refreshGridParams1() 
          {
               var city = $("#city1").val(); 
               var hotelName = $("#hotelName1").val();
               return {
                    cityId : city,
                    hotelName : hotelName,
               };
          }

     
          // Corp-Registration Grid
          var grid=$('#corpTable').kendoGrid({
          dataSource: 
          {
               type: "POST",
               transport:
               {
                    read: { url: '<?php echo base_url(); ?>globalSystem/corpData', type: "POST",data:refreshGridParams2,dataType: "json" },    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) 
                    {
                         return data.data.length;
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          selectable: true,
          dataBound: onDataBound2,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: 
          [
               { field: "company_name",width: "100px", title: "Client Name"},
               { field: "cityName", width: "50px", title: "City"},
               { field: "type",width: "50px", title: "Type"},
          ]    
          });
          
          function onDataBound2() 
          {
               var grid = $("#corpTable");
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) 
               {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Records found...</b></td></tr>');
               }
          }

          function refreshGridParams2() 
          {
               removeClass();
               var city = $("#city_f2").val(); 
               var clientName = $("#clientName_f2").val();
               return {
                    cityId : city,
                    clientName : clientName,
               };
          }

          $("#corpTable tbody").on("click", "tr", function(e) 
          {
               var rowElement = this;
               var row = $(rowElement);
               var grid = $("#corpTable").data("kendoGrid");
               var dataItem = grid.dataItem(this);
               corp(dataItem['company_name'],dataItem['cityMasterId'],dataItem['clientTypeMasterId'],dataItem['id'],1);
               grid.select(row);
               grid.clearSelection();

               $("#corp_city").val(dataItem['cityMasterId']);
          });



          // CRM Grid
          var grid=$('#crmTable').kendoGrid({
          dataSource: 
          {
               type: "POST",
               transport:
               {
                    read: { url: '<?php echo base_url(); ?>globalSystem/crmData', type: "POST",data:refreshGridParams3,dataType: "json" },    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) 
                    {
                         return data.data.length;
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          selectable: true,
          dataBound: onDataBound3,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: 
          [
               { field: "clientName",width: "100px", title: "Client Name"},
               { field: "cityName", width: "50px", title: "City"},
               { field: "type",width: "50px", title: "Type"},
          ]    
          });
          
          function onDataBound3() 
          {
               var grid = $("#crmTable");
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) 
               {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Records found...</b></td></tr>');
               }
          }

          function refreshGridParams3() 
          {
               removeClass();
               var city = $("#city_f3").val(); 
               var clientName = $("#clientName_f3").val();
               return {
                    cityId : city,
                    clientName : clientName,
               };
          }

          $("#crmTable tbody").on("click", "tr", function(e) 
          {
               var rowElement = this;
               var row = $(rowElement);
               var grid = $("#crmTable").data("kendoGrid");
               var dataItem = grid.dataItem(this);
               crm(dataItem['clientName'],dataItem['cityID'],dataItem['clientType'],dataItem['id']);
               grid.select(row);
               grid.clearSelection();

               $("#crm_city").val(dataItem['cityID']);
          });


          // Hobse Data

          var grid=$('#hobseTable').kendoGrid({
          dataSource: 
          {
               type: "POST",
               transport:
               {
                    read: { url: '<?php echo base_url(); ?>globalSystem/hobseData', type: "POST",data:refreshGridParams4,dataType: "json" },    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) 
                    {
                         return data.data.length;
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          selectable: true,
          dataBound: onDataBound4,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: 
          [
               { field: "clientName",width: "100px", title: "Client Name"},
               { field: "cityName", width: "50px", title: "City"},
               { field: "type",width: "50px", title: "Type"},
          ]    
          });
          
          function onDataBound4() 
          {
               var grid = $("#hobseTable");
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) 
               {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Records found...</b></td></tr>');
               }
          }

          function refreshGridParams4() 
          {
               removeClass();
               var city = $("#city_f4").val(); 
               var clientName = $("#clientName_f4").val();
               return {
                    cityId : city,
                    clientName : clientName,
               };
          }

          $("#hobseTable tbody").on("click", "tr", function(e) 
          {
               var rowElement = this;
               var row = $(rowElement);
               var grid = $("#hobseTable").data("kendoGrid");
               var dataItem = grid.dataItem(this);
               hobse(dataItem['clientName'],dataItem['cityMasterId'],dataItem['clientTypeMasterId'],dataItem['id']);
               grid.select(row);
               grid.clearSelection();

               $("#hobse_city").val(dataItem['cityMasterId']);
          });

          // company data
          var grid=$('#companyTable').kendoGrid({
          dataSource: 
          {
               type: "POST",
               transport:
               {
                    read: { url: '<?php echo base_url(); ?>globalSystem/companyData', type: 'POST',data:refreshGridParams5,dataType: "json" },    
               },
               schema: 
               {
                    data: "data",
                    total: function(data) 
                    {
                         return data.data.length;
                    }
               },
               error:function(e){alertify.error("Error");},
               pageSize:10,
               serverPaging: false,
               serverFiltering: false,
               serverSorting: false,
          },
          pageable: 
          {
               refresh: true,
               pageSizes: [10, 25, 50, 100]
          },
          selectable: true,
          dataBound: onDataBound5,
          columnMenu:true,
          sortable: false,
          resizable: true,
          reorderable: true,
          filterable: true,
          columns: 
          [
               { field: "companyName",width: "100px", title: "Client Name"},
               { field: "cityName", width: "50px", title: "City"},
               { field: "type",width: "50px", title: "Type"},
          ]    
          });
          
          function onDataBound5() 
          {
               var grid = $("#companyTable");
               var dataSource = grid.data("kendoGrid").dataSource;
               var colCount = grid.find('.k-grid-header colgroup > col').length;
               if (dataSource._view.length == 0) 
               {
                    grid.find('.k-grid-content tbody')
                         .append('<tr class="kendo-data-row"><td colspan="' + colCount + '" style="text-align:center"><b>No Records found...</b></td></tr>');
               }
          }

          function refreshGridParams5() 
          {
               removeClass();
               var city = $("#city_f5").val();
               var clientType = $("#cType").val();
               var clients = $("#clients").val();
               return {
                    cityId : city,
                    clientType : clientType,
                    clientMasterId : clients,
               };
          }

          $("#companyTable tbody").on("click", "tr", function(e) 
          {
               var rowElement = this;
               var row = $(rowElement);
               var grid = $("#companyTable").data("kendoGrid");
               var dataItem = grid.dataItem(this);
               customer(dataItem['companyName'],dataItem['cityId'],dataItem['partnerType'],dataItem['companyReferredId']);
               grid.select(row);
               grid.clearSelection();

               $("#customer_city").val(dataItem['cityId']);
          });

     
     
     });


     var enter = document.getElementById("hotelName");
     enter.addEventListener("keydown", function (e) {
     if (e.keyCode === 13) 
     {  //checks whether the pressed key is "Enter"
          filter();
     }
     });

     var enter1 = document.getElementById("hotelName1");
     enter1.addEventListener("keydown", function (e) {
     if (e.keyCode === 13) 
     {  //checks whether the pressed key is "Enter"
          filter1();
     }
     });

     var enter2 = document.getElementById("clientName_f2");
     enter2.addEventListener("keydown", function (e) {
     if (e.keyCode === 13) 
     {  //checks whether the pressed key is "Enter"
          filter2();
     }
     });

     var enter3 = document.getElementById("clientName_f3");
     enter3.addEventListener("keydown", function (e) {
     if (e.keyCode === 13) 
     {  //checks whether the pressed key is "Enter"
          filter3();
     }
     });

     var enter4 = document.getElementById("clientName_f4");
     enter4.addEventListener("keydown", function (e) {
     if (e.keyCode === 13) 
     {  //checks whether the pressed key is "Enter"
          filter4();
     }
     });

     var enter5 = document.getElementById("pinCode");
     enter5.addEventListener("keydown", function(e){
          if(e.keyCode == 13)
          {
               var pinCode = $("#pinCode").val();
               if(pinCode)
               {
                    fetchLocalities(pinCode);
               }
               else
               {
                    alertify.error('Please Enter Pincode...');
               }
          }
     })

     function corp(name,cityId,clientType,id,source)
     {    
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/corpEditBox',
               dataType:'json',
               data:{'hotelName':name,'cityId':cityId,'clientTypeId':clientType,'source':source},
               success:function(data)
               {
                    $("#editBox>div>form>div>input").val('');
                    
                    var gcr = [];
                    gcr.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['gcr'].length;i++)
                    {
                         gcr.push({value:data['gcr'][i]["clientName"]+'___'+data['gcr'][i]["GCRId"],label:data['gcr'][i]["clientName"]})
                    }

                    $( "#corp_gcr" ).autocomplete({
                         source: gcr,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    var crm = [];
                    crm.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['crm'].length;i++)
                    {
                         crm.push({label:data['crm'][i]["clientName"],value:data['crm'][i]["clientName"]+'___'+data['crm'][i]["id"]})
                    }
                    $( "#corp_crm" ).autocomplete({
                         source: crm,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                                    
                    var tam = [];
                    for(i=0;i<data['tam'].length;i++)
                    {
                         tam.push({value:data['tam'][i]["clientName"]+'___'+data['tam'][i]["clientId"]+'___'+data['tam'][i]["clientTypeMasterId"],label:data['tam'][i]["clientName"]})
                    }

                    $( "#corp_tam" ).autocomplete({
                         source: tam,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    
                    $("#corpEditBoxName").html(data['clientName']);
                    $("#corpgcrTotal").html(data['gcrCount']);
                    $("#corpcrmTotal").html(data['crmCount']);
                    $("#corptamTotal").html(data['tamCount']);
                    $("#corpmaster").val(id);
                    $("#corpEditBox").addClass("in active");
                    fetchFromCORP(id);
                   
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function crm(name,cityId,clientType,id)
     {    
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/crmEditBox',
               dataType:'json',
               data:{'hotelName':name,'cityId':cityId,'clientTypeId':clientType},
               success:function(data)
               {
                    $("#editBox>div>form>div>input").val('');
                    var gcr = [];
                    gcr.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['gcr'].length;i++)
                    {
                         gcr.push({value:data['gcr'][i]["clientName"]+'___'+data['gcr'][i]["GCRId"],label:data['gcr'][i]["clientName"]})
                    }

                    $( "#crm_gcr" ).autocomplete({
                         source: gcr,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                   
                    var corp = [];
                    for(i=0;i<data['corp'].length;i++)
                    {
                         corp.push({value:data['corp'][i]["company_name"]+'___'+data['corp'][i]["id"],label:data['corp'][i]["company_name"]})
                    }

                    $( "#crm_corp" ).autocomplete({
                         source: corp,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    var tam = [];
                    for(i=0;i<data['tam'].length;i++)
                    {
                         tam.push({value:data['tam'][i]["clientName"]+'___'+data['tam'][i]["clientId"]+'___'+data['tam'][i]["clientTypeMasterId"],label:data['tam'][i]["clientName"]})
                    }

                    $( "#crm_tam" ).autocomplete({
                         source: tam,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    
                    $("#crmEditBoxName").html(data['clientName']);
                    $("#crmgcrTotal").html(data['gcrCount']);
                    $("#crmcorpTotal").html(data['corpCount']);
                    $("#crmtamTotal").html(data['tamCount']);
                    $("#crmmaster").val(id);
                    $("#crmEditBox").addClass("in active");
                    fetchFromCRM(id);
                   
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function hobse(name,cityId,clientType,id)
     {    
          var source;
          if(clientType == '1')
          {
               source = '3';
          }
          else
          {
               source = '4';
          }
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/hobseEditBox',
               dataType:'json',
               data:{'hotelName':name,'cityId':cityId,'clientTypeId':clientType,'source':source},
               success:function(data)
               {
                    $("#editBox>div>form>div>input").val('');
                    
                    var gcr = [];
                    gcr.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['gcr'].length;i++)
                    {
                         gcr.push({value:data['gcr'][i]["clientName"]+'___'+data['gcr'][i]["GCRId"],label:data['gcr'][i]["clientName"]})
                    }

                    $( "#hobse_gcr" ).autocomplete({
                         source: gcr,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });
                    
                    

                    var corp = [];
                    for(i=0;i<data['corp'].length;i++)
                    {
                         corp.push({value:data['corp'][i]["company_name"]+'___'+data['corp'][i]["id"],label:data['corp'][i]["company_name"]})
                    }

                    $( "#hobse_corp" ).autocomplete({
                         source: corp,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    
                    var crm = [];
                    crm.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['crm'].length;i++)
                    {
                         crm.push({value:data['crm'][i]["clientName"]+'___'+data['crm'][i]["id"],label:data['crm'][i]["clientName"]})
                    }

                    $( "#hobse_crm" ).autocomplete({
                         source: crm,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    
                    $("#hobseEditBoxName").html(data['clientName']);
                    $("#hobsegcrTotal").html(data['gcrCount']);
                    $("#hobsecorpTotal").html(data['corpCount']);
                    $("#hobsecrmTotal").html(data['crmCount']);
                    $("#hobsemaster").val(id+'&'+clientType);
                    $("#hobseEditBox").addClass("in active");
                    if(clientType == '1')
                    {
                         fetchFromHM(id);
                    }
                    else
                    {
                         fetchFromTAM(id);
                    }
                   
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function customer(name,cityId,clientType,id)
     {    
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/customerEditBox',
               dataType:'json',
               data:{'hotelName':name,'cityId':cityId,'clientTypeId':clientType},
               success:function(data)
               {
                    $("#editBox>div>form>div>input").val('');
                    var gcr = [];
                    gcr.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['gcr'].length;i++)
                    {
                         gcr.push({value:data['gcr'][i]["clientName"]+'___'+data['gcr'][i]["GCRId"],label:data['gcr'][i]["clientName"]})
                    }

                    $( "#customer_gcr" ).autocomplete({
                         source: gcr,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });
                   
                    var corp = [];
                    for(i=0;i<data['corp'].length;i++)
                    {
                         corp.push({value:data['corp'][i]["company_name"]+'___'+data['corp'][i]["id"],label:data['corp'][i]["company_name"]})
                    }

                    $( "#customer_corp" ).autocomplete({
                         source: corp,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    var crm = [];
                    crm.push({value:'No Match'+'___'+'0',label:'No Match'})
                    for(i=0;i<data['crm'].length;i++)
                    {
                         crm.push({value:data['crm'][i]["clientName"]+'___'+data['crm'][i]["id"],label:data['crm'][i]["clientName"]})
                    }

                    $( "#customer_crm" ).autocomplete({
                         source: crm,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    var tam = [];
                    for(i=0;i<data['tam'].length;i++)
                    {
                         tam.push({value:data['tam'][i]["clientName"]+'___'+data['tam'][i]["clientId"]+'___'+data['tam'][i]["clientTypeMasterId"],label:data['tam'][i]["clientName"]})
                    }

                    $( "#customer_tam" ).autocomplete({
                         source: tam,
                         select: function(event, id) { id = id['item']['value'];readOnly(this,id);},
                         autoFocus:true,
                    });

                    $("#customerEditBoxName").html(data['clientName']);
                    $("#customergcrTotal").html(data['gcrCount']);
                    $("#customercorpTotal").html(data['corpCount']);
                    $("#customercrmTotal").html(data['crmCount']);
                    $("#customertamTotal").html(data['tamCount']);
                    $("#customermaster").val(id+'&'+clientType);
                    $("#customerEditBox").addClass("in active");
                    fetchFromCompanyReferred(id);
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function removeClass()
     {
          $("#editBox>div>form>div>input").val('').prop('readonly',false);
          $("#editBox>div").removeClass("in active");
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $("#cityLocality>div").removeClass('in active');
     }

     function readOnly(tag,val)
     {
          var id = tag['id'];
          var type = id.split('_');
          var value = val.split('___');
          if(value[1])
          {
               if(type[1] === 'crm')
               {
                    fetchFromCRM(value[1]);
               }
               else if(type[1] === 'tam')
               {
                    if(value[2] == '1')
                    {
                         fetchFromHM(value[1]);
                    }
                    else
                    {
                         fetchFromTAM(value[1]);
                    }
               }
               else if(type[1] === 'corp')
               {
                    fetchFromCORP(value[1]);
               }
               else if(type[1] === 'gcr')
               {
                    fetchFromGCR(value[1]);
               }
          }
          else 
          {
               alertify.error('Please Re-select to view the details...');
          }

     }

     function fetchFromCRM(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>globalSystem/crmReadOnly",
               data:{'id':id},
               dataType:'json',
               success:function(data)
               {
                    $("#crmReadOnlyName").html(data[0]['clientName']);
                    $("#crmReadOnlyType").val(data[0]['type']);
                    $("#crmReadOnlyCity").val(data[0]['cityName']);
                    $("#crmReadOnlyAddress").val(data[0]['address']);
                    $("#crmReadOnlyGcrId").val(data[0]['GCRId']);
                    $("#crmReadOnlyId").val(data[0]['id']);
                    $("#crmReadOnly").addClass("in active");
                    // console.log(data)
               },
               error:function(e)
               {
                    alertify.error('Please Re-select to view the details...')
               }
          })
     }

     function fetchFromCORP(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>globalSystem/corpReadOnly",
               data:{'id':id},
               dataType:'json',
               success:function(data)
               {
                    $("#corpReadOnlyName").html(data[0]['company_name']);
                    $("#corpReadOnlyType").val(data[0]['type']);
                    $("#corpReadOnlyCity").val(data[0]['cityName']);
                    $("#corpReadOnlyAddress").val(data[0]['address']);
                    $("#corpReadOnlyGcrId").val(data[0]['GCRId']);
                    $("#corpReadOnlyId").val(data[0]['id']);
                    $("#corpReadOnly").addClass("in active");
                    // console.log(data)
               },
               error:function(e)
               {
                    alertify.error('Please Re-select to view the details...')
               }
          })
     }

     function fetchFromHM(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>globalSystem/hmReadOnly",
               data:{'id':id},
               dataType:'json',
               success:function(data)
               {
                    $("#hmReadOnlyName").html(data[0]['hotelName']);
                    $("#hmReadOnlyType").val(data[0]['type']);
                    $("#hmReadOnlyCity").val(data[0]['cityName']);
                    $("#hmReadOnlyAddress").val(data[0]['address']);
                    $("#hmReadOnlyGcrId").val(data[0]['GCRId']);
                    $("#hmReadOnlyId").val(data[0]['hotelsMasterId']);
                    $("#hmReadOnlyHobSt").val(data[0]['hobseStatus']);
                    $("#hmReadOnly").addClass("in active"); 
                    // console.log(data)
               },
               error:function(e)
               {
                    alertify.error('Please Re-select to view the details...')
               }
          })
     }

     function fetchFromTAM(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>globalSystem/tamReadOnly",
               data:{'id':id},
               dataType:'json',
               success:function(data)
               {
                    $("#tamReadOnlyName").html(data[0]['travelAgencyName']);
                    $("#tamReadOnlyType").val(data[0]['type']);
                    $("#tamReadOnlyCity").val(data[0]['cityName']);
                    $("#tamReadOnlyAddress").val(data[0]['address']);
                    $("#tamReadOnlyGcrId").val(data[0]['GCRId']);
                    $("#tamReadOnlyId").val(data[0]['travelAgencyMasterId']);
                    $("#tamReadOnly").addClass("in active");
                    // console.log(data)
               },
               error:function(e)
               {
                    alertify.error('Please Re-select to view the details...')
               }
          })
          
     }

     function fetchFromGCR(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          if(id > 0)
          {
               $.ajax({
                    type:"POST",
                    url:"<?php echo base_url(); ?>globalSystem/gcrReadOnly",
                    data:{'id':id},
                    dataType:'json',
                    success:function(data)
                    {
                         $("#gcrReadOnlyName").html(data[0]['clientName']);
                         $("#gcrReadOnlyType").val(data[0]['type']);
                         $("#gcrReadOnlyCity").val(data[0]['cityName']);
                         $("#gcrReadOnlyAddress").val(data[0]['address']);
                         $("#gcrReadOnlyGcrId").val(data[0]['GCRId']);
                         $("#gcrReadOnlyRegId").val(data[0]['regId']);
                         $("#gcrReadOnlyCrmId").val(data[0]['crmId']);
                         $("#gcrReadOnlyCmId").val(data[0]['clientMasterId']);
                         $("#gcrReadOnlyhId").val(data[0]['hobseId']);
                         $("*#hId").val(data[0]['hobseId']);
                         if(data[0]['crmId'] > 0)
                         {
                              var crmid = data[0]['crmId'];
                              $.ajax({
                                   type:"POST",
                                   url:"<?php echo base_url(); ?>globalSystem/crmRecord",
                                   data:{'id':crmid},
                                   dataType:'json',
                                   success:function(data)
                                   {
                                        name = data[0]['clientName']+'___'+crmid;
                                        $("input[name='crm']").val(name).prop('readonly',true)
                                   },
                                   error:function(e)
                                   {
                                        alertify.error('Error');
                                   }
                              })
                         } 
                         if(data[0]['regId'] > 0)
                         {
                              var regid = data[0]['regId'];
                              $.ajax({
                                   type:"POST",
                                   url:"<?php echo base_url(); ?>globalSystem/corpRecord",
                                   data:{'id':regid},
                                   dataType:'json',
                                   success:function(data)
                                   {
                                        name = data[0]['company_name']+'___'+regid;
                                        $("input[name='corp']").val(name).prop('readonly',true)
                                   },
                                   error:function(e)
                                   {
                                        alertify.error('Error');
                                   }
                              })
                         } 
                         if(data[0]['clientMasterId'] > 0)
                         {
                              var clientMasterId = data[0]['clientMasterId'];
                              if(data[0]['type'] == 'Hotel')
                              {
                                   var type = '1';
                              }
                              else if(data[0]['type'] == 'Company')
                              {
                                   type = '3'
                              }
                              else if(data[0]['type'] == 'Travel Agent')
                              {
                                   type = '4'
                              }
                              $.ajax({
                                   type:"POST",
                                   url:"<?php echo base_url(); ?>globalSystem/hobseRecord",
                                   data:{'id':clientMasterId,'type':type},
                                   dataType:'json',
                                   success:function(data)
                                   {
                                        console.log(data);
                                        name = data[0]['clientName']+'___'+clientMasterId+'___'+type;
                                        $("input[name='tam']").val(name).prop('readonly',true)
                                   },
                                   error:function(e)
                                   {
                                        alertify.error('Error');
                                   }
                              })
                         } 
                         $("#gcrReadOnly").addClass("in active");
                         // console.log(data)
                    },
                    error:function(e)
                    {
                         alertify.error('Please Re-select to view the details...')
                    }
               })
          }
          else
          {
               $("*#hId").val('');
               $("div>form>div>input").val('').prop('readonly',false);
          }

     }

     function fetchFromCompanyReferred(id)
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>globalSystem/companyReferredReadOnly",
               data:{'id':id},
               dataType:'json',
               success:function(data)
               {
                    $("#crReadOnlyName").html(data[0]['companyName']);
                    $("#crReadOnlyType").val(data[0]['type']);
                    $("#crReadOnlyCity").val(data[0]['cityName']);
                    $("#crReadOnlyAddress").val(data[0]['address']);
                    $("#crReadOnlyReferredName").val(data[0]['referrerName']);
                    $("#crReadOnlyEmail").val(data[0]['email']);
                    // $("#crmReadOnlyId").val(data[0]['id']);
                    $("#crReadOnly").addClass("in active");
                    // console.log(data)
               },
               error:function(e)
               {
                    alertify.error('Please Re-select to view the details...')
               }
          })
     }
     
     $(".corpSubmit").submit(function() {
          $("#corpSubmit").prop('disabled',true);
     
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/corpSubmit',
               data:$(".corpSubmit").serialize(),
               success:function(data)
               {
                    if(data.toString().includes('MATCHAVAILABLE'))
                    {
                         alertify.error('Matching Available for CRM.....');
                    }
                    else if(data.toString().includes('ERRRR'))
                    {
                         alertify.error('Please Select Values to update...');
                    }
                    else
                    {
                         alertify.success(data);
                    }
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               },
               error:function(e)
               {
                    alertify.error('Please Check your selection....');
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               }
          })
          return false;
     })

     $(".crmSubmit").submit(function(){
          $("#crmSubmit").prop('disabled',true);
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/crmSubmit',
               data:$(".crmSubmit").serialize(),
               success:function(data)
               {
                    if(data.toString().includes('MATCHAVAILABLE'))
                    {
                         alertify.error('Matching Available for CRM.....');
                    }
                    else if(data.toString().includes('ERRRR'))
                    {
                         alertify.error('Please Select anyone Value to update...');
                    }
                    else
                    {
                         alertify.success(data);
                    }
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               },
               error:function(e)
               {
                    alertify.error('Error');
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               }
          })
          return false;
     })

     $(".hobseSubmit").submit(function(){
          $("#hobseSubmit").prop('disabled',true);
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/hobseSubmit',
               data:$(".hobseSubmit").serialize(),
               success:function(data)
               {
                    if(data.toString().includes('MATCHAVAILABLE'))
                    {
                         alertify.error('Matching Available for CRM.....');
                    }
                    else if(data.toString().includes('ERRRR'))
                    {
                         alertify.error('Please Select Values to update.....');
                    }
                    else 
                    {
                         alertify.success(data);
                    }
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               },
               error:function(e)
               {
                    alertify.error('Please Check your selection....');
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               }
          })
          return false;
     })

     $(".customerSubmit").submit(function(){
          $("#customerSubmit").prop('disabled',true);
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>globalSystem/customerSubmit',
               data:$(".customerSubmit").serialize(),
               success:function(data)
               {
                    if(data.toString().includes('MATCHAVAILABLE'))
                    {
                         alertify.error('Matching Available for CRM.....');
                    }
                    else if(data.toString().includes('ERRRR'))
                    {
                         alertify.error('Please Select Values to update...');
                    }
                    else if(data.toString().includes('mail'))
                    {
                         alertify.error('User Mail Already Exists...');
                    }
                    else
                    {
                         alertify.success(data);
                    }
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               },
               error:function(e)
               {
                    alertify.error('Please Check your selection....');
                    setTimeout(function(){location.href="<?php echo base_url(); ?>globalSystem/repository"} , 1100);
               }
          })
          return false;
     })

     $(".internalUpdate").submit(function(){
          var t = $(".internalUpdate").serialize();
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>internalUpdate/update",
               data:$(".internalUpdate").serialize(),
               success:function(data)
               {
                    alertify.success(data);
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
          // console.log(t);
          var Grid = $('#iGrid').data("kendoGrid");
          var Grid2 = $('#rGrid').data("kendoGrid");
          Grid2.dataSource.page(1);
          Grid.dataSource.page(1);
          Grid.dataSource.read();
          Grid2.dataSource.read();
          Grid.dataSource.read();
          Grid2.dataSource.read();

          $("#myModal").modal('hide');
          return false;
     })

     $(".cityUpdateSubmit").submit(function(){
          $("#citySubmit").prop('disabled',true);
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>internalUpdate/updateCityDetails',
               data:$(".cityUpdateSubmit").serialize(),
               success:function(data)
               {
                    alertify.success(data);
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
          setTimeout(function(){window.location.reload();} , 1100);
          return false;
     })

     $(".localityUpdateSubmit").submit(function(){
          $("#localitySubmit").prop('disabled',true);
          var cityMasterId = $("#localityCity").val();
          var locality = $("#cityLocalitySelect").val().split('&');
          var type = locality[0];
          var id = locality[1];
          if(type == '2')
          {
               var cityMasterState = $("#editBoxStateName").text().substring(7).toUpperCase();
               var localityMasterState = $("#editBoxLocalityState").text().substring(7).toUpperCase();

               if(cityMasterState === localityMasterState)
               {
                    localitySubmit(cityMasterId,type,id);
               }
               else
               {
                    $("#localitySubmit").prop('disabled',false);
                    alertify.error('State Mismatching');
                    return false;
               }
          }
          else if(type == '1')
          {
               localitySubmit(cityMasterId,type,id);
          }
          
     })

     $("#pinSub").click(function(){
          var pinCode = $("#pinCode").val();
          if(pinCode)
          {
               fetchLocalities(pinCode);
          }
          else
          {
               alertify.error('Please Enter Pincode...');
          }
     });

     function localitySubmit(cityMasterId,type,id)
     {
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>internalUpdate/updateLocalityDetails',
               data:$(".localityUpdateSubmit").serialize() + "&cityMasterId=" + cityMasterId + "&type=" + type + "&id=" + id,
               success:function(data)
               {
                    if(data.toString().includes('false'))
                    {
                         alertify.error('Please Check the City');
                    }
                    else
                    {
                         alertify.success(data);
                    }
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
          setTimeout(function(){window.location.reload();} , 1100);
          return false;
     }

     function test()
     {
          $("#readOnly>div>form>div>input").val('');
          $("#readOnly>div").removeClass("in active");
     }

     function filter()
     {
          var Grid = $('#iGrid').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read(); 
     } 

     function filter1()
     {
          var Grid = $('#rGrid').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read();     
     }

     function filter2()
     {
          var Grid = $('#corpTable').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read();     
     }

     function filter3()
     {
          var Grid = $('#crmTable').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read();     
     }

     function filter4()
     {
          var Grid = $('#hobseTable').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read();     
     }

     function filter5()
     {
          var Grid = $('#companyTable').data("kendoGrid");
          Grid.dataSource.page(1);
          Grid.dataSource.read();     
     }

     function companyFilter()
     {
          var op = "<option value=''>All Clients</option>";
          var clientType = $("#cType").val();
          if(clientType > 0)
          {
               $.ajax({
                    url:'<?php echo base_url(); ?>globalSystem/companyFilters',
                    type:'POST',
                    data: {'type':clientType},
                    dataType: 'json',
                    success:function(data)
                    {
                         for(i=0;i<data.length;i++)
                         {
                              op += '<option value='+data[i]['value']+'>'+data[i]['label']+'</option>';
                         }
                         $("#clients").html(op);
                         filter5();
                    },
                    error:function(e)
                    {
                         alertify.error('Error');
                    }
               })
          }
          else if(clientType == '')
          {
               $("#clients").html(op);
               filter5();
          }
     }

     function checkbox(hotelsMasterId)
     {
          var box = '';
          box = "<input type='checkbox' name='updateHotelStatus'  value='"+hotelsMasterId+"'>";
          return box;
     }

     function updates()
     {
          var n = $("input[name='updateHotelStatus']:checked").length;
          var hmasId = [];
          if(n > 0)
          {
               $('#myModal').modal('toggle');
               $.each($("input[type='checkbox']:checked"), function(){            
                    hmasId.push($(this).val());
               });
               $("#hmId").val(hmasId);
          }
          else
          {
               alertify.error('Please Select Hotels to make the changes');
          }
     }

     function checkHobseId(dataLabel)
     {
          var hobseId = $("[data-identity="+dataLabel+"]").val();
          $.ajax({
               url:'<?php echo base_url(); ?>globalSystem/checkHobseId',
               type:'POST',
               data: {'hobseId':hobseId},
               success:function(data)
               {
                    if(data.toString().includes('false'))
                    {
                         alertify.error('Hobse ID Already Exists');
                         $("[data-identity="+dataLabel+"]").val('');
                    }
               },
               error:function(e)
               {
                    alertify.error('Error');
               }

          })
     }

     function fetchStatesCities(type)
     {
          if(type == '1')
          {
               var country = $("#country").val(); 
          }
          else if(type == '2')
          {
               var country = $("#editBoxCityCountry").val(); 
          }
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>internalUpdate/cityUpdate',
               data:{'countryMasterId':country},
               dataType:'json',
               success:function(data)
               {    
                    if(type == '1')
                    {
                         $("#cityUpdateEditBox").removeClass("in active");
                         $("#cityUpdate").val('');
                         var opt = "<option value=''>All States</option>";
                         for(var i=0;i<data['state'].length;i++)
                         {
                              opt += '<option value='+data['state'][i]['stateMasterId']+'>'+data['state'][i]['stateName']+'</option>';
                         }
                         $("#state").html(opt);
                         
                         $("#cityUpdate").autocomplete({
                              source: data['data'],
                              select: function(event, ui) 
                                   { 
                                        $("#cityUpdate").val(ui['item']['label']);
                                        fetchCityData(ui['item']['value']);
                                        return false;
                                   },
                              autoFocus:true,
                         });

                         $("#badgeCount").text(data['data'].length);
                    }
                    else if (type == '2')
                    {
                         var option = '';
                         if(data['state'].length > 0)
                         {
                              for(var i=0;i<data['state'].length;i++)
                              {
                                   option += '<option value='+data['state'][i]['stateMasterId']+'>'+data['state'][i]['stateName']+'</option>';
                              }
                         }
                         else
                         {
                              option = '';
                         }
                         $("#editBoxCityState").html(option);
                    }
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function fetchCities()
     {
          $("#cityUpdateEditBox").removeClass("in active");
          $("#cityUpdate").val('');
          var country = $("#country").val(); 
          var state = $("#state").val();
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>internalUpdate/cityUpdate',
               data:{'countryMasterId':country,'stateMasterId':state},
               dataType:'json',
               success:function(data)
               {    
                    $("#cityUpdate").autocomplete({
                         source: data['data'],
                         select: function(event, ui) 
                              { 
                                   $("#cityUpdate").val(ui['item']['label']);
                                   fetchCityData(ui['item']['value']);
                                   return false;
                              },
                         autoFocus:true,
                    });

                    $("#badgeCount").text(data['data'].length);
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function fetchCityData(cityMasterId)
     {
          $.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>/internalUpdate/fetchCityDetails',
               data:{'cityMasterId':cityMasterId},
               dataType:'json',
               success:function(data)
               {
                    var city = data[0];
                    $("#editBoxCityMaster").val(city['cityMasterId'])
                    $("#editBoxCityName").val(city['cityName']);
                    $("#editBoxCityState").val(city['stateMasterId']);
                    $("#editBoxCityCountry").val(city['countryMasterId']);
                    $("#editBoxCityLat").val(city['lat']);
                    $("#editBoxCityLong").val(city['longitude']);
                    if(city['active'] == '1')
                    {
                         $("#spanCityMasterId").text('City Master ID: '+city['cityMasterId']).css("color","green");
                    }
                    else
                    {
                         $("#spanCityMasterId").text('City Master ID: '+city['cityMasterId']).css("color","red");
                    }
                    $("#cityUpdateEditBox").addClass('in active');
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function addNewCity()
     {
          $("#cityUpdate").val('');
          $("#cityUpdateEditBox>form>div>input").val('');
          $("#editBoxCityState").val(35);
          $("#editBoxCityCountry").val(101);
          $("#editBoxCityMaster").val(0);
          $("#spanCityMasterId").text('City Master ID: New').css('text-color','green');
          $("#cityUpdateEditBox").addClass("in active");
     } 

     function fetchLocalities(pinCode = '')
     {
          if(pinCode.length > 0)
          {
               $("#pinCode").val(pinCode);
          }
          else
          {
               $("#pinCode").val('');
          }
          $("#localityUpdateEditBox").removeClass("in active");
          $("#cityLocalitySelect").empty();
          $("#cityLocalitySelectCount").text('');
          var cityMasterId = $("#localityCity").val();
          var range = $("#radiusSlider").data();
          var km = range['from'];
          $.ajax({
               type:"POST",
               url:"<?php echo base_url(); ?>internalUpdate/fetchLocalities",
               data : {'cityMasterId':cityMasterId,'radius':km,'pinCode':pinCode},
               dataType : 'json',
               success:function(data)
               {
                    var opt = '';
                    var mapped = data['mapped'];
                    var unmapped = data['unmapped'];
                    if(data['count'] == '0')
                    {
                         opt += '<option value="">No Locality Found </option>';
                    }
                    else 
                    {
                         if(mapped.length > 0)
                         {
                              opt += '<optgroup style="color:green" label=Mapped>';
                              for(var i=0; i<mapped.length; i++)
                              {
                                   opt += '<option value='+mapped[i]['id']+'>'+mapped[i]['localityName']+'</option>';
                              }
                              opt += '</optgroup>';
                         }

                         if(unmapped.length > 0)
                         {
                              opt += '<optgroup style="color:#ab2f2f" label=Un-Mapped>';
                              for(var j=0;j<unmapped.length;j++)
                              {
                                   opt += '<option value='+unmapped[j]['id']+'>'+unmapped[j]['localityName']+'</option>';
                              }
                              opt += '</optgroup>';
                         }
                    }
                    $("#cityLocalitySelect").html(opt);
                    if(data['count'] > 0)
                    {
                         $("#cityLocalitySelectCount").text(data['count']);
                    }
                    else
                    {
                         $("#cityLocalitySelectCount").text('Please Check City Latitude & Longitude ');
                    }
                    fetchLocalityDetails();
               },
               error:function(e)
               {
                    alertify.error('Error');
               }
          })
     }

     function fetchLocalityDetails()
     {
          $("#localityUpdateEditBox>form>div>input").val('');
          var cityMasterId = $("#localityCity").val();
          var locality = $("#cityLocalitySelect").val().split('&');
          var type = locality[0];
          var id = locality[1];
          if(type > 0 && id > 0)
          {
               $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>internalUpdate/fetchLocalityDetails',
                    data: {'id':id,'type':type,'cityMasterId':cityMasterId},
                    dataType : 'json',
                    success:function(data)
                    {
                         var locality = data[1];
                         $("#editBoxLocalityName").val(locality['localityName']);
                         if(locality['accuracy'] == '4')
                         {
                              $("#editBoxLocalityLatitude").val(locality['latitude']);
                              $("#editBoxLocalityLongitude").val(locality['longitude']);
                         }

                         var city = data[0];
                         $("#editBoxStateName").text('State: '+city['stateName']).css("color","black");
                         if(city['active'] == '1')
                         {
                              $("#editBoxCityMasterId").text('City Master ID: '+city['cityMasterId']).css("color","green");;
                         }
                         else
                         {
                              $("#editBoxCityMasterId").text('City Master ID: '+city['cityMasterId']).css("color","red");;
                         }

                         if(type == '2')
                         {
                              $("#editBoxLocalityTaluk").text('Taluk: ' +locality['taluk']).css("color","black");
                              $("#editBoxLocalityDistrict").text('District: ' +locality['district']).css("color","black");
                              $("#editBoxLocalityState").text('State: ' +locality['state']).css("color","black");
                         }
                         else
                         {
                              $("#editBoxLocalityTaluk").text('');
                              $("#editBoxLocalityDistrict").text('');
                              $("#editBoxLocalityState").text('');
                         }

                         $("#localityUpdateEditBox").addClass("in active");
                    },
                    error:function(e)
                    {
                         alertify.error('Error');
                    }
               })
          }
          // else
          // {
          //      $("#localityUpdateEditBox").removeClass("in active");
          // }
     }
</script>
</body>
</html>