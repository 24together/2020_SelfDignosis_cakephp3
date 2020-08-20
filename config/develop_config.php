<?php
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

return [
    'DEPARTMENT' => [
        'MANAGER' => [
            'NUMBER' =>1,
            'jp' => '管理者'
        ],
        'INDIVIDUAL' => [
            'NUMBER' =>2,
            'jp' => '個人'
        ],
        'CORPORATE_BODY' => [
            'NUMBER' =>3,
            'jp' => '法人'
        ],
    ],
    'int_symptoms' => [
        'tiredness' => [
            'jp' => '疲労度',
            'select' => [
                'GOOD' => [
                    'NUMBER' => 0,
                    'jp' => 'いい'
                ],
                'NOMAL' => [
                    'NUMBER' =>1,
                    'jp' => '普通'
                ],
                'BAD'   => [
                    'NUMBER' =>2,
                    'jp' => '悪い'
                ]
            ]    
        ],
        'temperature' => [
            'jp' => '体温',
            'FEVER_TEMPERATURE' => 37.5,
        ],
    ],
    'bol_symptoms' => [
        'cough' => '咳',
        'muscle_pain' => '筋肉痛',
        'headache' => '頭痛',
        'diarrhea' => '下痢',
        'chest_pain' => '胸の痛み',
        'dyspnea' => '呼吸困難',
    ],
    
    // 'TIREDNESS_NUMBER'  => [
    //     'GOOD' => 0,
    //     'NOMAL' =>1,
    //     'BAD'   =>2
    // ]
]
?>