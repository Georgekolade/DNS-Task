<?php

namespace App\Actions;

class VerifyDomainAction
{
    protected $serverIpAddress;

    public function __construct($serverIpAddress)
    {
        $this->serverIpAddress = $serverIpAddress;
    }

    public function execute($domain)
    {
        // Get the IP addresses associated with the domain
        $domainIpAddresses = dns_get_record($domain, DNS_A);

        // Check if any IP address matches the server's IP address
        foreach ($domainIpAddresses as $record) {
            if ($record['ip'] === $this->serverIpAddress) {
                return true;
            }
        }

        return false;
    }
}
