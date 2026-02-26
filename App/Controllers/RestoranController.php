<?php

namespace App\Controllers;

use App\Models\RestoranUser;
use App\Models\Feedback;
use Core\Request;

class RestoranController
{


    public function __construct()
    {
    }




    public function view(Request $request, ?string $segment1 = null, ?string $segment2 = null)
    {

        $modelRestoranUser = new RestoranUser();


        if ($modelRestoranUser->checkRestoran($segment1)){
            $restoran_id = $modelRestoranUser->getRestoranID($segment1)['id'];
            $modelRestoranUser->logQrVisit($restoran_id);
            $restoranData = $modelRestoranUser->getRestoran($restoran_id);
            $data['restoranID'] = $restoran_id;
            $data['restoranData'] = $restoranData;
            $data['restoranCategories'] = $modelRestoranUser->getRestoranCategories($restoran_id);
            $data['restoranMenu'] = $modelRestoranUser->getRestoranMenu($restoran_id);

        }else{
            return $this->page404($request);
        }


        return view([
            'restoran'
        ], $data );

    }


    public function api(Request $request)
    {
        $form_type = $request->input('form_type')??'';
        $feedbackModel = new Feedback();



        if ($form_type=="setCustomerFeedback"){
            $response = $feedbackModel->setCustomerFeedback();
            return json($response);
        }


        return json(['name' => $request->query('name')]);
    }




    public function page404(Request $request)
    {
        return view('page404')
            ->withStatus(404);
    }

}