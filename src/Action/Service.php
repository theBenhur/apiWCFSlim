<?php
namespace App\Action;
abstract class Service{
    protected $response,$client,$wsdl;
    public function __construct(){
        $this->response=array();
        $this->wsdl='https://firebasewcf20211114195847.azurewebsites.net/WSFirebase.svc?wsdl';
    }
    public function getConexion($params){
        $this->client=new \SoapClient($this->wsdl,$params);
    }
}