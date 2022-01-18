<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use App\Action\Service;

    final class setProducto extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args){
            $category=$args["categoria"];
            $body=$req->getParsedBody();
            $parametros = array(
                'usuario'=>$body["username"],
                'contrasenia'=>$body["password"],
                'categoria'=>$category,
                'producto'=>json_encode($body["producto"])
            );
            $this->getConexion($parametros);
            $result = $this->client->setProducto($parametros);
            if (!is_null($result)) {
                $this->response["code"]=$result->setProductoResult->code;
                $this->response["message"]=$result->setProductoResult->message;
                $this->response["data"]=$result->setProductoResult->data;
                $this->response["status"]=$result->setProductoResult->status;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }
    }
    // final class setProducto{
    //     private $response;
    //     public function __construct(){
    //         $this->response = array();
    //     }
    //     public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args){
    //         $category=$args["categoria"];
    //         $body=$req->getParsedBody();
    //         $parametros = array(
    //             'usuario'=>$body["username"],
    //             'contrasenia'=>$body["password"],
    //             'categoria'=>$category,
    //             'producto'=>json_encode($body["producto"])
    //         );
    //         $service='http://localhost:49201/WSFirebase.svc?wsdl';
    //         $client = new \SoapClient($service,$parametros); 
    //         $result = $client->setProducto($parametros);
    //         if (!is_null($result)) {
    //             $this->response["code"]=$result->setProductoResult->code;
    //             $this->response["message"]=$result->setProductoResult->message;
    //             $this->response["data"]=$result->setProductoResult->data;
    //             $this->response["status"]=$result->setProductoResult->status;
    //         }
    //         $res->getBody()->write(json_encode($this->response,true));
    //         return $res;
    //     }
    // }
    // final class setProducto{
    //     private $conexion,$response;
    //     public function __construct(){
    //         $this->conexion=new Conexion("apiserviciosweb-655cd-default-rtdb");
    //         $this->response = array(
    //             'code'    => 999,
    //             'message' => null,
    //             'data'    => null,
    //             'status'  => 'failure'
    //         );
    //     }
    //     public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args):ResponseInterface{
    //         $productDetails=$req->getParsedBody();
    //         $key=array_keys($productDetails)[0];
    //         $producto=[
    //             $key=>[
    //                 'ISBN'=>$key,
    //                 'titulo'=>$productDetails[$key]["Titulo"]
    //         ]];
    //         $toSendJson=json_encode($producto,true);
            
    //         $productos=$this->conexion->get("productos",$args["categoria"],$key);
    //         if(is_null($productos)){
    //             $this->conexion->patch("productos",$args["categoria"],json_encode($producto,true));
    //             $this->conexion->patch("detalles",null,json_encode($productDetails,true));
    //             $this->response["code"]=202;
    //             $this->response["message"]=self::getMessageCode(202);
    //             $this->response["data"]=date("Y-m-d\Th:i");
    //             $this->response['status']='success';
    //         }else{
    //             $this->response["code"]=302;
    //             $this->response["message"]=self::getMessageCode(302);
    //             $this->response['status'] = 'failure';
    //         }
    //         $res->getBody()->write(json_encode($this->response,true));
    //         return $res;
    //     }
    //     private function getMessageCode($code){
    //         return $this->conexion->get('respuestas',null,$code);
    //     }
    // }