<?php


namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Request;

class ResourceController
{
    /**
     * @Route("/res/{folder}/{resource}", name="res")
     */
    public function delete(Request $request, $folder, $resource)
    {
        $file =    file_get_contents('../../res/'.$folder."/".$resource);
//        exit($request->query->get('../../res/'.$folder."/".$resource));

        return $file;
    }

}