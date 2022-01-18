<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use App\Action\Service;
    final class deleteProducto extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args):ResponseInterface{
            $isbn=$args["isbn"];
            $body=$req->getParsedBody();
            $parametros = array(
                'user'=>$body["username"],
                'contrasenia'=>$body["password"],
                'isbn'=>$isbn,
            );
            $this->getConexion($parametros);
            $result = $this->client->deleteProducto($parametros);
            if (!is_null($result)){
                $this->response["code"]=$result->deleteProductoResult->code;
                $this->response["message"]=$result->deleteProductoResult->message;
                $this->response["data"]=$result->deleteProductoResult->data;
                $this->response["status"]=$result->deleteProductoResult->status;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }
    }