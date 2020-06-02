<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class DiagnosisController extends AppController
{
    public function beforeFilter(Event $event)
    {
        //default deny
        parent::beforeFilter($event);
        $this->Auth->deny(['add','edit']);
        $this->set('Auth', $this->Auth);
    }

    public function isAuthorized($user)
    {
        //All registered users can add diagnosis table
        if(in_array($this->request->getParam('action'),['view','add','index'])){
            return true;
        }
        //User Identification
        if(in_array($this->request->getParam('action'),['view','index','edit'])){
            $diagnosisId = (int)$this->request->getParam('pass.0');
            if ($this->Diagnosis->isOwnedBy($diagnosisId, $user['id'])){
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    
    public function index()
    {
        //For ordinary users who are not managers, only their own writings can be viewed.
        $department_id = $this->Auth->user('department_id');

        if($department_id ==1){//for managers
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $diagnosis = $this->paginate($this->Diagnosis);
        }else{//for anoter user
            $user = $this->Auth->user('id');
            $data = $this->Diagnosis->find('all')->where(['user_id'=> $user]);
            $diagnosis = $this->paginate($data);
        }
        $this->set(compact('diagnosis'));
    }

    public function view($id = null)
    {
        $diagnosis = $this->Diagnosis->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('diagnosis', $diagnosis);
    }

    public function add()
    {
        $diagnosis = $this->Diagnosis->newEntity();
        if ($this->request->is('post')) {
            $diagnosis = $this->Diagnosis->patchEntity($diagnosis, $this->request->getData());
            //add user information
            $userData = 
                [
                'user_id'       => $this->Auth->user('id'),
                'department_id' => $this->Auth->user('department_id')
                ];
            $diagnosis = $this->Diagnosis->patchEntity($diagnosis, $userData);    
            //flash
            if ($this->Diagnosis->save($diagnosis)) {
                $this->Flash->success(__('The diagnosis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diagnosis could not be saved. Please, try again.'));
        }
        $users = $this->Diagnosis->Users->find('list', ['limit' => 200]);
        $this->set(compact('diagnosis', 'users'));
    }

    public function edit($id = null)
    {
        //edit information
        $diagnosis = $this->Diagnosis->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diagnosis = $this->Diagnosis->patchEntity($diagnosis, $this->request->getData());
            if ($this->Diagnosis->save($diagnosis)) {
                $this->Flash->success(__('The diagnosis has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diagnosis could not be saved. Please, try again.'));
        }
        $users = $this->Diagnosis->Users->find('list', ['limit' => 200]);
        $this->set(compact('diagnosis', 'users'));
    }

    public function delete($id = null)
    {
        //delete information
        $this->request->allowMethod(['post', 'delete']);
        $diagnosis = $this->Diagnosis->get($id);
        if ($this->Diagnosis->delete($diagnosis)) {
            $this->Flash->success(__('The diagnosis has been deleted.'));
        } else {
            $this->Flash->error(__('The diagnosis could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function departmentIndex($num){
        //Shows information divided by department.
        $department_id = $this->Auth->user('department_id');
        if($department_id ==1){
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $data = $this->Diagnosis->find('all')->where(['diagnosis.department_id' => $num]);
            $diagnosis = $this->paginate($data);
        }
        $this->set(compact('diagnosis'));
        //set the template
        $this->viewBuilder()->template('index');
    }

    public function search($num = null)
    {
        //It shows only certain users' information.
       $num= $this->request->getData('num');
       //check the value
       if ($num == null){
            $this->Flash->error(__('There are no members with this number.'));
            return $this->redirect(['action' => 'index']);
       }else {
            //shows only certain users' information.       
            $user_data = $this->Diagnosis->Users->find('all')->where(['user_num'=>$num])->first();
            $user_id = $user_data->id;
            //check the value
            if($user_id){
                $this->paginate = [
                    'contain' => ['Users'],
                ];
                $data = $this->Diagnosis->find('all')->where(['diagnosis.user_id'=> $user_id]);
                $diagnosis = $this->paginate($data);
            }else{
                    $this->Flash->error(__('There are no members with this number.'));
            }
            $this->set(compact('diagnosis'));
            //set the template
            $this->viewBuilder()->template('index');
        }
    }
}
