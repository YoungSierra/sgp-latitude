<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $proj = Project::latest()
        ->take(10)
        ->get();

        $sumproj = 0.0;
        foreach ($proj as $item){
            $sumproj =  $sumproj + str_replace(".",'',$item->valor);            
        }
        
        //$proj = DB::table('projects')->get();

        $dataGrafica1 = array();
        foreach ($proj as $item){
            $valor = (str_replace(".",'',$item->valor) / $sumproj ) * 100;            
            array_push($dataGrafica1, array("label"=>$item->name, "y"=> $valor));
        }

        $dataGrafica2 = array();
        foreach ($proj as $item){
            $valor = str_replace(".",'',$item->valor);            
            array_push($dataGrafica2, array("label"=>$item->name, "y"=> $valor));
        }


        return view('home')
        ->with('dataGrafica1',$dataGrafica1)
        ->with('dataGrafica2',$dataGrafica2);
    }
}