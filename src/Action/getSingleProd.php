<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use \App\Action\Service;
    final class getSingleProd extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args){
            $isbn=$args["isbn"];
            $body=$req->getParsedBody();
            $parametros = array(
                'usuario'=>$body["username"],
                'contrasenia'=>$body["password"],
                'isbn'=>$isbn
            );
            $this->getConexion($parametros);
            $result = $this->client->getSingleProd($parametros);
            if (!is_null($result)) {
                $this->response["code"]=$result->getSingleProdResult->code;
                $this->response["message"]=$result->getSingleProdResult->message;
                $this->response["data"]=$result->getSingleProdResult->data;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }   
    }