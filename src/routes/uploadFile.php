<?php

$app->post('/api/Openload/uploadFile', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['login','key','file']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $data['login'] = $post_data['args']['login'];
    $data['key'] = $post_data['args']['key'];
    
    $fileUrl = $post_data['args']['file'];
    $query_str = $settings['api_url'] . "file/ul";
    $client = $this->httpClient;

    $uploadLink = $client->get($query_str, [
        'query' => $data
    ]);
    $uploadLinkBody = $uploadLink->getBody()->getContents();
    if(json_decode($uploadLinkBody)->result->url){
        $uploadedLink = json_decode($uploadLinkBody)->result->url;
    }
    else{
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'a';
        $result['contextWrites']['to']['status_msg'] = json_decode($uploadLinkBody);
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
    }
    try {

        $resp = $client->post($uploadedLink, [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($fileUrl, 'r')
                ]
            ]
        ]);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});
