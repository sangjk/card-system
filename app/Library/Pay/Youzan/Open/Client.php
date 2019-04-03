<?php
namespace App\Library\Pay\Youzan\Open; use Exception; class Client { private static $requestUrl = 'https://open.youzan.com/api/oauthentry/'; private $accessToken; public function __construct($sp86d993) { if ('' == $sp86d993) { throw new Exception('access_token不能为空'); } $this->accessToken = $sp86d993; } public function get($spb769a1, $sp19d892, $sp342eea = array()) { return $this->parseResponse(Http::get($this->url($spb769a1, $sp19d892), $this->buildRequestParams($spb769a1, $sp342eea))); } public function post($spb769a1, $sp19d892, $sp342eea = array(), $sp35ba91 = array()) { return $this->parseResponse(Http::post($this->url($spb769a1, $sp19d892), $this->buildRequestParams($spb769a1, $sp342eea), $sp35ba91)); } public function url($spb769a1, $sp19d892) { $spdbbb2f = explode('.', $spb769a1); $spb769a1 = '/' . $sp19d892 . '/' . $spdbbb2f[count($spdbbb2f) - 1]; array_pop($spdbbb2f); $spb769a1 = implode('.', $spdbbb2f) . $spb769a1; $sp81923e = self::$requestUrl . $spb769a1; return $sp81923e; } private function parseResponse($sp631cf0) { $spbda5b4 = json_decode($sp631cf0, true); if (null === $spbda5b4) { throw new Exception('response invalid, data: ' . $sp631cf0); } return $spbda5b4; } private function buildRequestParams($spb769a1, $sp3b13cb) { if (!is_array($sp3b13cb)) { $sp3b13cb = array(); } $sp4b79cc = $this->getCommonParams($this->accessToken, $spb769a1); foreach ($sp3b13cb as $sp783862 => $spce84f3) { if (isset($sp4b79cc[$sp783862])) { throw new Exception('参数名冲突'); } $sp4b79cc[$sp783862] = $spce84f3; } return $sp4b79cc; } private function getCommonParams($sp86d993, $spb769a1) { $sp342eea = array(); $sp342eea[Protocol::TOKEN_KEY] = $sp86d993; $sp342eea[Protocol::METHOD_KEY] = $spb769a1; return $sp342eea; } }