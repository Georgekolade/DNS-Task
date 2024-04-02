<?php

/*namespace App\Actions;

use execute;
use Illuminate\Support\Facades\Http;

class VerifyDomainAction
{
    public function execute(string $domain): bool
    {
        // Check if any 'A' records exist for the domain
        $dnsRecordsExist = checkdnsrr($domain, 'A');

        // If no 'A' records exist for the domain, return false
        if (!$dnsRecordsExist) {
            return false;
        }

        // Check if the resolved IP matches the server's IP
        $serverIpAddress = gethostbyname(gethostname());
        $resolvedIp = gethostbyname($domain);

        return $resolvedIp === $serverIpAddress;
    }
}

<?php*/

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