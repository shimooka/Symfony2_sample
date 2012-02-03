<?php
namespace Acme\TransportBundle;

class TransportChain
{
    protected $transports;

    public function __construct()
    {
        $this->transports = array();
    }

    public function addTransport(\Swift_Transport  $transport)
    {
        $this->transports[] = $transport;
    }

    public function getTransports()
    {
        return $this->transports;
    }
}