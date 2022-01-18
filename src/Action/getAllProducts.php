<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use App\Action\Service;
    final class getAllProducts extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args){
            $category=$args["categoria"];
            $body=$req->getParsedBody();
            $parametros = array(
                'usuario'=>$body["username"],
                'contrasenia'=>$body["password"],
                'categoria'=>$category
            );
            $this->getConexion($parametros);
            $result = $this->client->getAllProds($parametros);
            if (!is_null($result)) {
                $this->response["code"]=$result->getAllProdsResult->code;
                $this->response["message"]=$result->getAllProdsResult->message;
                $this->response["data"]=$result->getAllProdsResult->data;
                $this->response["status"]=$result->getAllProdsResult->status;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }
    }