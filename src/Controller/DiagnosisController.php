<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\I18n\Date;
use Cake\I18n\Time;
use DateTime;
use DatePeriod;
use DateInterval;
use Cake\ORM\TableRegistry;

class DiagnosisController extends AppController
{
    public function beforeFilter(Event $event)
    {
        //default deny
        parent::beforeFilter($event);
        $this->Auth->deny(['add','edit','filtering','export']);
        $this->set('Auth', $this->Auth);
        $this->Auth->allow(['viewSession']);
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

        $session = $this->request->getSession();
        if($department_id ==Configure::read('DEPARTMENT.MANAGER.NUMBER')){//for managers
            $this->paginate = [
                'contain' => ['Users'],
            ];
            $diagnosis = $this->paginate($this->Diagnosis);
            if($this->Auth->user('department_id')==Configure::read('DEPARTMENT.MANAGER.NUMBER')){
                $session->write('Diagnosis.data',$diagnosis);}
        }else{//for anoter user
            $user = $this->Auth->user('id');
            $data = $this->Diagnosis->find('all')->where(['Diagnosis.user_id'=> $user]);
            $this->paginate = [
                'contain' => ['Users'],
            ];
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

    public function filtering(){
        //The function to filter by symptom, user number, and department.
        $filteringList = $this->request->getData();
        $userNum        = $filteringList['user_num'];
        
        $session = $this->request->getSession();
        $session->write('Diagnosis.filtering',$filteringList);

        $dataArray      = array();
        $dataArray = $this->Diagnosis->find('all');
        if($userNum!=null){
            //If user information is entered
            $Users = TableRegistry::get('Users');

            $userExists = $Users->exists(['Users.user_num'=>$userNum]);
            if($userExists){
                $userData   = $Users->find('all')->where(['user_num'=>$userNum])->first();
                $userId     = $userData->id;
                $dataArray  = $dataArray->where(['Diagnosis.user_id'=>$userId]);
                
            }else {$this->Flash->error(__('Please check the user number again.'));}
        }
        //These are the int-symptoms. 
        //Because the input value varies from symptom to symptom, the code should be changed appropriately if the int symptom changes.
        if($filteringList['tiredness']!=0)     { $dataArray = $dataArray->where(['tiredness'        => $filteringList['tiredness']]); };
        if($filteringList['temperature']!=0)   { 
            $temperatureSelectValue = Configure::read('int_symptoms.temperature.select');
            $filteredTemperature    = $temperatureSelectValue[$filteringList['temperature']];
            
            if($filteredTemperature['produce_an_above_data']){
                    $whereMsg = 'temperature >=';
            }else{  $whereMsg = 'temperature <';}

            $dataArray = $dataArray->where([ $whereMsg  => $filteredTemperature['reference_temperature']]); 
        };
        //bol-symptoms
        foreach(Configure::read('bol_symptoms') as $keySymptom => $symptom  ){
            if($filteringList[$keySymptom]==1){ $dataArray = $dataArray->where([$keySymptom => true]);};
        }
  
        if($filteringList['department_id']!=0){ 
            $departmentId = (int)$filteringList['department_id'];
            $dataArray = $dataArray->where(['Diagnosis.department_id'=>$departmentId]);
        }

        //Search for a self-diagnostic table prepared within the date range entered.
        //Example 1)First Date:2020-09-01   Second Date:2020-09-02 => 2020-09-01 ~ 2020-09-02
        //Example 2)First Date:null         Second Date:2020-09-01 => 2020-09-01
        //Example 3)First Date:2020-09-01   Second Date:2019-03-01 => 2019-03-01 ~ 2020-09-01
        if($filteringList['first_date']!=0||$filteringList['second_date']!=0){
            if($filteringList['first_date']!=0){ 
                $firstDate  = new DateTime($filteringList['first_date']);
                $firstDate = $firstDate->format('Y-m-d H:i:s');
            }
            if($filteringList['second_date']!=0){ 
                $secondDate = new DateTime($filteringList['second_date']);
                $secondDate = $secondDate->format('Y-m-d H:i:s');
            }

            if($filteringList['first_date']==0){
                $firstDate = $secondDate;            }
            elseif($filteringList['second_date']==0){
                $secondDate = $firstDate;
            }
            elseif($firstDate>$secondDate){
                $tempDate   = $firstDate;
                $firstDate  = $secondDate;
                $secondDate = $tempDate;
            }
            
            $secondDate = new DateTime($secondDate);
            $secondDate = $secondDate->add(new DateInterval('P1D'))->format('Y-m-d H:i:s');
            $dataArray  = $dataArray->where(['Diagnosis.created >=' => $firstDate]);
            $dataArray  = $dataArray->where(['Diagnosis.created <' => $secondDate]);
            
        }
        $this->paginate = [
            'contain' => ['Users'],
        ];

        $diagnosis = $this->paginate($dataArray);
        $session = $this->request->getSession();
        $session->write('Diagnosis.data',$diagnosis);
        $this->set(compact('diagnosis'));
        $this->viewBuilder()->template('index');

    }

    public function export(){
        //function to convert symptom list to a csv file
        $session = $this->request->getSession();
        $Diagnosis = $this->request->session()->read('Diagnosis.data');
        if($Diagnosis == null){
            $this->Flash->error(__('セッション期間が過ぎました。再検索後、もう一度実行してください。'));
            return $this->redirect(['action' => 'index']);
        }
        $resultData = array();
        foreach($Diagnosis as $diagnosis){
            $userData    = $this->Diagnosis->Users->find('all')->where(['id'=>$diagnosis->user_id])->first();
            $user_num    = $userData->user_num;
            switch($diagnosis->department_id){
                //Output department details corresponding to number
                case Configure::read('DEPARTMENT.MANAGER.NUMBER'):
                    $departmentId = Configure::read('DEPARTMENT.MANAGER.jp'); break;
                case Configure::read('DEPARTMENT.INDIVIDUAL.NUMBER'):
                    $departmentId = Configure::read('DEPARTMENT.INDIVIDUAL.jp'); break;
                case Configure::read('DEPARTMENT.CORPORATE_BODY.NUMBER'):
                    $departmentId = Configure::read('DEPARTMENT.CORPORATE_BODY.jp'); break;
            }
            switch($diagnosis->triedness){
                //Outputs the physical condition corresponding to the fatigue level number.
                case Configure::read('int_symptoms.tiredness.select.GOOD.NUMBER'):
                    $tiredness = Configure::read('int_symptoms.tiredness.select.GOOD.jp'); break;
                case Configure::read('int_symptoms.tiredness.select.NOMAL.NUMBER'):
                    $tiredness = Configure::read('int_symptoms.tiredness.select.NOMAL.jp'); break;
                case Configure::read('int_symptoms.tiredness.select.BAD.NUMBER'):
                    $tiredness = Configure::read('int_symptoms.tiredness.select.BAD.jp'); break;
            }
            $temperature = $diagnosis->temperature;
            if(h($diagnosis->cough)         !=null) { $cough = 'あり';      } else{$cough = 'なし';}
            if(h($diagnosis->muscle_pain)   !=null) { $muscle_pain = 'あり';} else{$muscle_pain = 'なし';}
            if(h($diagnosis->headache)      !=null) { $headache = 'あり';   } else{$headache = 'なし';}
            if(h($diagnosis->diarrhea)      !=null) { $diarrhea = 'あり';   } else{$diarrhea = 'なし';}
            if(h($diagnosis->chest_pain)    !=null) { $chest_pain = 'あり'; } else{$chest_pain = 'なし';}
            if(h($diagnosis->dyspnea)       !=null) { $dyspnea = 'あり';    } else{$dyspnea = 'なし';}
                     
            array_push($resultData,[$diagnosis->id, $user_num, $departmentId, $tiredness, $temperature, $cough, $muscle_pain, $headache, $diarrhea, $chest_pain, $dyspnea, $diagnosis->created, $diagnosis->modified]);
        }
        $_serialize = 'resultData';
        $_header = ['番号','ユーザー番号','部署','疲労感','温度','咳','筋肉痛','頭痛','下痢','胸の痛み','呼吸困難','作成日','修正日'];

        // $this->viewBuilder()->template('index');
        $this->response = $this->response->withDownload('diagnosis.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('resultData','_serialize','_header'));
    }
}
