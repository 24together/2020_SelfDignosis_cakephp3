<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class DiagnosisTable extends Table
{
    public function initialize(array $config){
        $this->setTable('diagnosis');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp');

        //set association
        $this->belongsTo('Users')
             ->setForeignKey('user_id');
    }
    
    public function validationDefault(Validator $validator){
        return $validator
            ->notEmpty('user_id',       'A user_id filed is required')
            ->notEmpty('department_id', 'A department_id filed is required')
            ->notEmpty('tiredness',     'A tiredness filed is required')
            ->notEmpty('temperature',   'A temperature filed is required')
            ->notEmpty('cough',         'A cough filed is required')
            ->notEmpty('muscle_pain',   'A muscle_pain filed is required')
            ->notEmpty('headache',      'A headache filed is required')
            ->notEmpty('diarrhea',      'A diarrhea filed is required')
            ->notEmpty('chest_pain',    'A chest_pain filed is required')
            ->notEmpty('dyspnea',       'A dyspnea filed is required')
            ;
    }

    public function isOwnedBy($id, $userId){
        //This function checks if the writing is user's.
        return $this->exists(['id'=> $id, 'user_id'=>$userId]);
    }

}

?>