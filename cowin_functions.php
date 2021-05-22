<?php
    namespace Cowin;
    function get_states(){
        try{
            $curl = curl_init("https://cdn-api.co-vin.in/api/v2/admin/location/states");
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            return json_decode(curl_exec($curl),true)['states'];
        }
        catch(\Exception $error){
            error_log("get_states error : {$error->getMessage()}",0);
        }
    }
    function get_districts($state_name){
        try{
            $state_id = null;
            foreach(get_states() as $state){
                if($state_name==$state['state_name']){
                    $state_id = $state['state_id'];
                }
            }
            if($state_id==null){
                return false;
            }
            else{
                $curl = curl_init("https://cdn-api.co-vin.in/api/v2/admin/location/districts/{$state_id}");
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                return json_decode(curl_exec($curl),true)['districts'];
            }
        }
        catch(Exception $error){
            error_log("get_districts error : {$error->getMessage()}",0);
        }
    }
    function get_sessions_by_pin($pincode,$date)
    {
        try{
            $curl = curl_init("https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByPin?pincode={$pincode}&date={$date}");
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $response = json_decode(curl_exec($curl),true);
            if(array_key_exists('errorCode',$response)){
                throw new \Exception("{$response['error']}");
            }
            $sessions = $response['sessions'];
            return $sessions;
        }
        catch(\Exception $error){
            error_log("get_pincode error : {$error->getMessage()}",0);
        }
    }
    function get_sessions_by_district($state,$district,$date){
        try{
            $district_id = null;
            foreach(get_districts($state) as $dist){
                if($district==$dist['district_name']){
                    $district_id = $dist['district_id'];
                }
            }
            if($district_id==null){
                return false;
            }
            else{
                $curl = curl_init("https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id={$district_id}&date={$date}");
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                $response = json_decode(curl_exec($curl),true);
                if(array_key_exists('errorCode',$response)){
                    throw new \Exception("{$response['error']}");
                }
                $sessions = $response['sessions'];
                return $sessions;
            }
        }
        catch(\Exception $error){
            error_log("get_slot_by_district error : {$error->getMessage()}",0);
        }
    }
    function get_calender_by_pin($pincode,$date){
        try{
            $curl = curl_init("https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode={$pincode}&date={$date}");
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            $response = json_decode(curl_exec($curl),true);
            if(array_key_exists('errorCode',$response)){
                throw new \Exception("{$response['error']}");
            }
            return $response['centers'];
        }
        catch(\Exception $error){
            error_log("get calender by pin error : {$error->getMessage()}",0);
        }
    }
    function get_calender_by_district($state,$district,$date){
        try{
            $district_id = null;
            foreach(get_districts($state) as $dist){
                if($district==$dist['district_name']){
                    $district_id = $dist['district_id'];
                }
            }
            if($district_id==null){
                return false;
            }
            else{
                $curl = curl_init("https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByDistrict?district_id={$district_id}&date={$date}");
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
                $response = json_decode(curl_exec($curl),true);
                if(array_key_exists('errorCode',$response)){
                    throw new \Exception("{$response['error']}");
                }
                return $response['centers'];
            }
        }
        catch(\Exception $error){
            error_log("get calender by pin error : {$error->getMessage()}",0);
        }
    }
?>