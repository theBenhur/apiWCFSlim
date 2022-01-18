<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use App\Action\Service;
    final class Detalle extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args):ResponseInterface{
            $isbn=$args["isbn"];
            $body=$req->getParsedBody();
            $parametros=array(
                'usuario'=>$body["username"],
                'contrasenia'=>$body["password"],
                'isbn'=>$isbn
            );
            $this->getConexion($parametros);
            $result = $this->client->getAllDetais($parametros);
            if (!is_null($result)) {
                $this->response["code"]=$result->getAllDetaisResult->code;
                $this->response["message"]=$result->getAllDetaisResult->message;
                $this->response["data"]=$result->getAllDetaisResult->data;
                $this->response["status"]=$result->getAllDetaisResult->status;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }
    }