<?php
/**
 * Exception handler
 */
namespace BEAR\Framework\scripts\excection_handler;

use BEAR\Framework\Exception\ResourceNotFound;
use BEAR\Resource\Exception\BadRequest,
    BEAR\Resource\Exception\MethodNotAllowed,
    BEAR\Resource\Exception\InvalidParameter,
    BEAR\Resource\Exception\InvalidScheme;

use Ray\Di\Exception\InvalidBinding;
use BEAR\Framework\Resource\Page\Error;

use BEAR\Framework\Output\HttpFoundation as Output;

set_exception_handler(function(\Exception $e) {
    $mode = isset($_ENV['BEAR_OUTPUT_MODE']) ? $_ENV['BEAR_OUTPUT_MODE'] : 'prod';
    try {
        $response = new Error;
        throw $e;
    } catch (NotFound $e) {
        $response->code = 404;
        $response->body = 'The requested URI was not found on this service.';
        goto NOT_FOUND;
    } catch (BadRequest $e) {
        $response->code = 400;
        $response->body = 'You sent a request that this service cound not understand.';
        goto METHOD_NOT_ALLOWED;
    } catch (InvalidParameter $e) {
        $response->code = 400;
        $response->body = 'You sent a request that query is not valid.';
        goto BAD_REQUEST;
    } catch (InvalidScheme $e) {
        $response->code = 400;
        $response->body = 'You sent a request that scheme is not valid.';
        goto BAD_REQUEST;
    } catch (MethodNotAllowed $e) {
        $response->code = 405;
        $response->body = 'The requested method is not allowed for this URI.';
        goto METHOD_NOT_ALLOWED;
    } catch (ResourceNotFound $e) {
        $response->code = 404;
        $response->body = 'The requested URI was not found on this service.';
        goto NOT_FOUND;
    } catch (InvalidBinding $e) {
        $response->code = 500;
        $response->body = 'Internal service error occured.';
    } catch (\Exception $e) {
        $response->code = 500;
        $response->body = 'Internal service error occured.';
        goto SERVER_ERROR;
    }

OK:
    (new Output)->setResource($response)->prepare()->output();
    exit(0);

NOT_FOUND:
BAD_REQUEST:
METHOD_NOT_ALLOWED:
SERVER_ERROR:
        $response->headers['X-EXCEPTION-CLASS'] = get_class($e);
        $response->headers['X-EXCEPTION-MESSAGE'] = $e->getMessage();
        $response->headers['X-EXCEPTION-CODE'] = $e->getCode();
        $response->headers['X-EXCEPTION-FILE-LINE'] = $e->getFile() . ':' . $e->getLine();
        $response->headers['X-EXCEPTION-PREVIOUS'] = $e->getPrevious();
(new Output)->setResource($response)->setException($e)->output();
    exit(1);
});