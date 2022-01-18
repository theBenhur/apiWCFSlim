<?php 
    namespace App\Action;

    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
    use Slim\Psr7\Factory\ResponseFactory;

    class Auth{
        public function __invoke(Request $request, RequestHandler $handler){
            $authHeader=$_SERVER["HTTP_AUTHORIZATION"];
            $arr = explode(" ",$authHeader);
            $jwt = $arr[0];
            if($jwt){
                try {
                    $decoded = JWT::decode($jwt,'1234567', array('HS256'));
                    return $handler->handle($request);
                }catch (Exception $e){
                    $responseFactory = new ResponseFactory();
                    $response = $responseFactory->createResponse();
                    $response->getBody()->write(json_encode(array(
                        "message"=>"No tienes permiso"
                    )));
                    return $response;
                }
            }else{
                $responseFactory = new ResponseFactory();
                $response = $responseFactory->createResponse();
                $response->getBody()->write(json_encode(array(
                    "message"=>"No hay existencia de un token"
                )));
                return $response;
            }
        }
    }