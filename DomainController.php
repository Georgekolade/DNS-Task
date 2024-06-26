<?php

namespace App\Http\Controllers;

use execute;
use Illuminate\Http\Request;
use App\Actions\VerifyDomainAction;

class DomainController extends Controller
{
    public function verify(Request $request)
    {
        // Assuming $serverIpAddress holds your server's IP address
        $serverIpAddress = gethostbyname(gethostname());
        
        // Create an instance of the VerifyDomainConnection action class
        $verifyDomainConnection = new VerifyDomainAction($serverIpAddress);
        
        // Specify the domain you want to verify
        $domainToVerify = 'ns1.googptai.com';
        
        // Execute the action to check if the domain is connected to your server's IP
        $isConnected = $verifyDomainConnection->execute($domainToVerify);
        
        if ($isConnected) {
            echo "The domain $domainToVerify is connected to your server's IP address.";
        } else {
            echo "The domain $domainToVerify is not connected to your server's IP address.";
        }
    }
}
