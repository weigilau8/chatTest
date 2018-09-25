<?php

namespace App\Http\Controllers;

use App\Host;
use App\PickUp;
use App\PickUpStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //
    function getPickUp()
    {
        $data = [];
        $results = PickUp::all();
        foreach ($results as $key=>$result){
            if ($result["pick_up_id"] == "0"){
                $name = "未選択";
                $src = "/storage/images/default.png";
                $id = "0";
            } else{
                $hostId = PickUpStore::where("store_id",$result["pick_up_id"])->first();
                $host = Host::where("id",$hostId["host_id"])->first();
                $name = $host["host_name"];
                $src = "/storage/images/Host/Host_".$hostId["host_id"].".jpg";
                $id = $host['id'];
            }

            $data[$key]["store_id"] = $result["pick_up_id"];
            $data[$key]["id"] = $id;
            $data[$key]["name"] = $name;
            $data[$key]["src"] = $src;
        }
        return response()->json(["status"=>1,"data"=>$data]);
    }
}
