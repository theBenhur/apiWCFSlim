<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use \App\Action\Service;

    final class Rol extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args){
            $body=$req->getParsedBody();
            $parametros = array(
                'username'=>$body["username"],
                'rol'=>$body["rol"]
            );
            $this->getConexion($parametros);
            $result = $this->client->comfirmRol($parametros);
            if (!is_null($result)) {
                $this->response["code"]=$result->comfirmRolResult->code;
                $this->response["message"]=$result->comfirmRolResult->message;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }   
    }