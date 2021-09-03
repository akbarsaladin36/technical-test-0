<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class UsersController extends \Phalcon\Mvc\Controller
{

    public function getAction()
    {
        $this->view->disable();
        $user = Users::find();

        if(!$user) {
            $response = new Response;
            $result = [
                'code' => 400,
                'response' => 'failed',
                'message' => 'All data is not found! Please create your new data now!',
                'result' => $user
            ];
            $response->setStatusCode(400, 'Not Found');
            $response->setJsonContent($result);
            return $response;
        } else {
            $response = new Response;
            $result = [
                'code' => 200,
                'response' => 'success',
                'message' => 'Successfully get all of data!',
                'result' => $user
            ];
            $response->setStatusCode(200, 'OK');
            $response->setJsonContent($result);
            return $response;
        }
    }

    public function getIdAction($id)
    {
        $this->view->disable();
        $user = Users::findFirst(
        [
            'conditions' => 'id = :id:',
            'bind'       => [
                'id' => $id,
            ]
        ]
        );

    if(!$user) {
        $response = new Response;
        $result = [
            'code' => 400,
            'response' => 'failed',
            'message' => 'Your data with this id is not found!',
            'result' => $user
        ];
        $response->setStatusCode(400, 'Not Found');
        $response->setJsonContent($result);
        return $response;
    } else {
        $response = new Response;
        $result = [
            'code' => 200,
            'response' => 'success',
            'message' => 'Successfully get data from this id!',
            'result' => $user
        ];
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent($result);
        return $response;
    }
        
    }

    public function createAction() 
    {
        $this->view->disable();
        $request = $this->request->getJsonRawBody();
        $user = new Users;
        $user->name = $request->fullName;
        $user->sex = $request->gender;
        $user->religion = $request->religion;
        $user->phone = $request->phoneNumber;
        $user->address = $request->address;
        $user->nik = $request->NIK;
        $user->created_at = date('Y-m-d H:i:s');
        $user->save();

        if(!$user->save()){
            $response = new Response;
            $result = [
                'code' => 400,
                'response' => 'failed',
                'message' => 'Your data is not saved when you created a data!',
                'result' => $user
            ];
            $response->setStatusCode(400, 'Not Found');
            $response->setJsonContent($result);
            return $response;
        } else {
            $response = new Response;
            $result = [
                'code' => 200,
                'response' => 'success',
                'message' => 'Successfully created a new data!',
                'result' => $user
            ];
            $response->setStatusCode(200, 'OK');
            $response->setJsonContent($result);
            return $response;
        }
    }

    public function updateAction($id) 
    {
        $this->view->disable();
        $request = $this->request->getJsonRawBody();
        $user = Users::findFirst(
        [
            'conditions' => 'id = :id:',
            'bind'       => [
                'id' => $id,
            ]
        ]
        );

        if(!$user){
            $response = new Response;
            $result = [
                'code' => 400,
                'response' => 'error',
                'message' => 'Your data is not updated because your id is not found!',
                'result' => $user
            ];
            $response->setStatusCode(400, 'Not Found');
            $response->setJsonContent($result);
            return $response;
        } else {
            $user->name = $request->fullName;
            $user->sex = $request->gender;
            $user->religion = $request->religion;
            $user->phone = $request->phoneNumber;
            $user->address = $request->address;
            $user->nik = $request->NIK;
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
            $response = new Response;
            $result = [
                'code' => 200,
                'response' => 'success',
                'message' => 'Successfully updated a data with this id!',
                'result' => $user
            ];
            $response->setStatusCode(200, 'OK');
            $response->setJsonContent($result);
            return $response;
        }
    }

    public function deleteAction($id)
    {
        $this->view->disable();
        $user = Users::findFirstById($id);
        
        if($user) {
        $user->delete();
        $response = new Response;
        $result = [
            'code' => 200,
            'response' => 'success',
            'message' => 'Your data is deleted!',
            'result' => null
        ];
        $response->setStatusCode(200, 'OK');
        $response->setJsonContent($result);
        $response->send();
        return $response;
    }
    }
    
}

