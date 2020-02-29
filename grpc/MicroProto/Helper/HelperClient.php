<?php
// GENERATED CODE -- DO NOT EDIT!

namespace MicroProto\Helper;

/**
 */
class HelperClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param array $metadata metadata
     * @param array $options call options
     */
    public function GetDistributeId($metadata = [], $options = []) {
        return $this->_bidiRequest('/helper.Helper/GetDistributeId',
        ['\MicroProto\Helper\IdResponse','decode'],
        $metadata, $options);
    }

}
