<?php
    namespace App\Action;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use App\Action\Service;
    final class updateProducto extends Service{
        public function __invoke(ServerRequestInterface $req,ResponseInterface $res,$args):ResponseInterface{
            $isbn=$args["isbn"];
            $body=$req->getParsedBody();
            $parametros = array(
                'user'=>$body["username"],
                'contrasenia'=>$body["password"],
                'isbn'=>$isbn,
                'detalles'=>json_encode($body["detalles"])
            );
            $this->getConexion($parametros);
            $result = $this->client->updateProducto($parametros);
            if (!is_null($result)){
                $this->response["code"]=$result->updateProductoResult->code;
                $this->response["message"]=$result->updateProductoResult->message;
                $this->response["data"]=$result->updateProductoResult->data;
                $this->response["status"]=$result->updateProductoResult->status;
            }
            $res->getBody()->write(json_encode($this->response,true));
            return $res;
        }
    }