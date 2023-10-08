<?php

class AHP{
    function __construct($data){
        $this->data = $data;        
        $this->baris_total();   
        $this->normal();
        $this->prioritas();
        $this->cm();
    }
    function baris_total(){
        $this->baris_total = array();        
        foreach($this->data as $key => $val){
            foreach($val as $k => $v){
                $this->baris_total[$k]+=$v;
            }
        }  
    } 
    function normal(){
        $this->normal = array();        
        foreach($this->data as $key => $val){
            foreach($val as $k => $v){
                $this->normal[$key][$k]=$v / $this->baris_total[$k];
            }
        }  
    } 
    function prioritas(){
        $this->prioritas = array();        
        foreach($this->normal as $key => $val){
            $this->prioritas[$key] = array_sum($val) / count($val);
        }  
    }  
    function cm(){
        $this->cm = array();        
        foreach($this->data as $key => $val){
            foreach($val as $k => $v){              
                $this->cm[$key]+=$v * $this->prioritas[$k];             
            }
            $this->cm[$key]/=$this->prioritas[$key];
        }  
    } 
}
class SAW {
    function __construct($data, $atribut, $bobot){
        $this->data = $data;
        $this->atribut = $atribut;
        $this->bobot = $bobot;
        $this->index_vikor = $index_vikor;   
        $this->minmax();           
        $this->normal();    
        $this->terbobot();  
        $this->total();
        $this->rank();
    }
    function rank(){        
        $data = $this->total;
        arsort($data);
        $no = 1;
        $this->rank = array();
        foreach($data as $key => $val){
            $this->rank[$key] = $no++;
        }
    }
    function total(){
        foreach($this->terbobot as $key => $val){
            $this->total[$key] = array_sum($val);
        }
    }
    function terbobot(){
        $arr = array();
        foreach($this->normal as $key => $val){
            foreach($val as $k => $v){
                $arr[$key][$k] = $v * $this->bobot[$k];
            }
        }
        $this->terbobot = $arr;
    }
    function normal(){
        $arr = array();
        foreach($this->data as $key => $val){
            foreach($val as $k => $v){
                if($this->atribut[$k]=='benefit')
                    $arr[$key][$k] =  $v / $this->minmax[$k]['max'];
                else{
                    $arr[$key][$k] =  $this->minmax[$k]['min'] / $v;
                }
            }
        }
        $this->normal = $arr;
    }
    function minmax(){
        $arr = array();
        foreach($this->data as $key => $val){
            foreach($val as $k => $v){
                $arr[$k][$key] = $v;
            }
        }
        $arr2 = array();
        foreach($arr as $key => $val){            
            $arr2[$key]['min'] = min($val);
            $arr2[$key]['max'] = max($val);
        }
        $this->minmax = $arr2;
    }
}