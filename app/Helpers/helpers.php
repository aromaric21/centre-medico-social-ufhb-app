<?php

use Carbon\Carbon;

define("PAGELIST", "liste");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");

define("PAGELISTPATIENT", "liste");
define("PAGEEXPATIENTFORM", "ex-patient");
define("PAGESUITECONSULTATIONFORM", "suite-consultation");
define("PAGENEWPATIENT", "new-patient");

define("PAGELISTCONSULTATION", "liste");
define("PAGEDETAILCONSULTATION", "detail");


define("PAGELISTDEPENSE", "liste");
define("PAGECREATE", "create");
define("PAGEEDITDEPENSE", "edit");



function userFullName(){
    return auth()->user()->prenom.' '.auth()->user()->nom;
}

function getRoleServiceName(){
    return auth()->user()->role->service;
}

function setMenuActive($route){
    if (request($key = null, $default = null)->route()->getName() == $route) {
        return 'active';
    }else {
        return '';
    }
}

function dateTime($dateTime){
     
    if ($dateTime !== null) {
        if(isset(explode(" ",$dateTime)[1])){
            $date = Carbon::parse($dateTime)->format('d/m/Y H:i:s');
        }else {
            $date = Carbon::parse($dateTime)->format('d/m/Y');
        }
        return $date;
    }else{
        return ""; 
    }
}