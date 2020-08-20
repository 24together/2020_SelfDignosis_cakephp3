<?php
namespace App\Test\TestCase\Controller;

use App\Controller\DiagnosisController;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

use Cake\ORM\TableRegistry;
use App\Model\Table\DiagnosisTable;
use App\Model\Table\UsersTable;
/**
 * App\Controller\DiagnosisController Test Case
 *
 * @uses \App\Controller\DiagnosisController
 */
class DiagnosisControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Diagnosis',
        'app.Users',
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    public function testFiltering()
    {
        $Users      = TableRegistry::getTableLocator()->get('Users');
        $Diagnosis  = TableRegistry::getTableLocator()->get('Diagnosis');
        #유저 번호 있는지 
        $dummyData = [
            'tiredness'     => false,
            'temperature'   => true,
            'cough'         => true,
            'muscle_pain'   => false,
            'headache'      => false,
            'diarrhea'      => false,
            'chest_pain'    => false,
            'dyspnea'       => false,
            'department_id'    => 2, #디폴트가 1
            'user_num'      => null,
        ];
        $userNum        = $dummyData['user_num'];
        $dataArray      = array();
        $statusCheck    = true;
        
        if(!empty($userNum)){
            $userExists = $Users->exists(['Users.user_num'=>$userNum]);
            $this->assertNotNull($userExists);
            if($userExists){
                $userData   = $Users->find('all')->where(['user_num'=>$userNum])->first();
                $userId     = $userData->id;
                
                $dataArray  = $Diagnosis->find('all')->where(['Diagnosis.user_id'=>$userId]);
                    $this->assertNotNull($dataArray);
                #부서 확인    
                if($dummyData['department_id']!=1){
                    $userDepartment = $userData->department_id;
                    if($userDepartment!=$dummyData['department_id']){
                        #유저의 부서와 검색한 부서가 다를경우
                        $statusCheck = false;
                        $this->Flash->error(__('ユーザーの部署をもう一度確認してください。'));
                    }
                }
            }else{
            #존재하지 않는 유저면 플래쉬 띄우고 끝
                $statusCheck = false;
                $this->Flash->error(__('存在しないユーザーです'));
            }
        }else{
            $dataArray = $Diagnosis->find('all');
            $this->assertNotNull($dataArray);
        }

        if($statusCheck== true){
            $this->assertTrue($statusCheck);
                    if($dummyData['tiredness'])     { $dataArray = $dataArray->where(['tiredness ' => 3]); };
                    if($dummyData['temperature'])   { $dataArray = $dataArray->where(['temperature >=' => 37.5]); };
                    if($dummyData['cough'])         { $dataArray = $dataArray->where(['cough' => true]); };
                    if($dummyData['muscle_pain'])   { $dataArray = $dataArray->where(['muscle_pain' => true]); };
                    if($dummyData['headache'])      { $dataArray = $dataArray->where(['headache' => true]); };
                    if($dummyData['diarrhea'])      { $dataArray = $dataArray->where(['diarrhea' => true]); };
                    if($dummyData['chest_pain'])    { $dataArray = $dataArray->where(['chest_pain' => true]); };
                    if($dummyData['dyspnea'])       { $dataArray = $dataArray->where(['dyspnea' => true]); };    
                    if($dummyData['department_id']!=1){ $dataArray = $dataArray->where(['department_id'=>$dummyData['department_id']]); }
                    // default : if($dummyData[$i]){
                    //         $this->assertNotNull($dummyData[$i]);
                    //         $key = key($dummyData[$i]);
                    //         $dataArray = $dataArray->where([$key => true]);
                    // };
                        // break;
            $this->assertNotNull($dataArray);
        }

    }

    public function export(){
        $Diagnosis  = TableRegistry::getTableLocator()->get('Diagnosis')->find('all');
        $Users      = TableRegistry::getTableLocator()->get('Users');
        $resultData = array();
        foreach($Diagnosis as $diagnosis){
            $user_num = $Users->where(['id'=>$diagnosis->user_id])->first();
            $user_num = $user_num->user_num;
            switch($this->Number->format($diagnosis->department_id)){
                case 1:
                    $departmentId = "管理者"; break;
                case 2:
                    $departmentId = "個人"; break;
                case 3:
                    $departmentId = "法人"; break;
            }
            switch($this->Number->format($diagnosis->tiredness)){
                case 0:
                    $tiredness = "good"; break;
                case 1:
                    $tiredness = "nomal"; break;
                case 2:
                    $tiredness = "bad"; break;
            }
            $temperature = $this->Number->format($diagnosis->temperature);
            if(h($diagnosis->cough)         !=null) { $cough = 'あり';      } else{$cough = 'なし';}
            if(h($diagnosis->muscle_pain)   !=null) { $muscle_pain = 'あり';} else{$muscle_pain = 'なし';}
            if(h($diagnosis->headache)      !=null) { $headache = 'あり';   } else{$headache = 'なし';}
            if(h($diagnosis->diarrhea)      !=null) { $diarrhea = 'あり';   } else{$diarrhea = 'なし';}
            if(h($diagnosis->chest_pain)    !=null) { $chest_pain = 'あり'; } else{$chest_pain = 'なし';}
            if(h($diagnosis->dyspnea)       !=null) { $dyspnea = 'あり';    } else{$dyspnea = 'なし';}
            
            $this->assertNotNull($diagnosis->id, $user_num, $departmentId, $tiredness, $temperature, $cough, $muscle_pain, $headache, $diarrhea, $chest_pain, $dyspnea, $diagnosis->created, $diagnosis->modified);
            
            $array = [
                $diagnosis->id, $user_num, $departmentId, $tiredness, $temperature, $cough, $muscle_pain, $headache, $diarrhea, $chest_pain, $dyspnea, $diagnosis->created, $diagnosis->modified
            ];           
            $this->assertNotNull($array);
            array_push($resultData, $array);
        }
        $_serialize = 'resultData';
        $_header = ['番号','ユーザー番号','部署','疲労感','温度','咳','筋肉痛','頭痛','下痢','胸の痛み','呼吸困難','作成日','修正日'];

        $this->assertNotNull($resultData);
        $this->response = $this->response->withDownload('diagnosis.csv');
        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('resultData','_serialize','_header'));

    }
}

