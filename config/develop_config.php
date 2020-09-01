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
                    'NUMBER' => 1,
                    'jp' => 'いい'
                ],
                'NOMAL' => [
                    'NUMBER' =>2,
                    'jp' => '普通'
                ],
                'BAD'   => [
                    'NUMBER' =>3,
                    'jp' => '悪い'
                ]
            ]    
        ],
        'temperature' => [
            'jp' => '体温',
            'FEVER_TEMPERATURE' => 37.5,
            'select' => [
                //범위 => [
                //  폼 밸류값           => **,
                //  기준이 되는 온도    => **,
                //  구분방법            => true (or false),//미만 - false 이상 - true
                //  일본어              => '**'
                //]
                1 => [//'nomal_temperature'
                    'NUMBER'                => 1,
                    'reference_temperature' => 37.5,
                    'produce_an_above_data' => false,
                    'jp'                    => '37.5度未満(正常)'

                ],
                2 => [//'have_beyond_a_slight_fever'
                    'NUMBER'                => 2,
                    'reference_temperature' => 37.5,
                    'produce_an_above_data' => true,
                    'jp'                    => '37.5度(微熱)以上'
                ],
                3 =>[//'have_a_high_fever'
                    'NUMBER'                => 3,
                    'reference_temperature' => 38.5,
                    'produce_an_above_data' => true,
                    'jp'                    => '38.5度(高熱)以上'

                ]
            ]
        ],
    ],
    'bol_symptoms' => [
        'cough' => '咳',
        'muscle_pain' => '筋肉痛',
        'headache' => '頭痛',
        'diarrhea' => '下痢',
        'chest_pain' => '胸の痛み',
        'dyspnea' => '呼吸困難',
    ]
]
?>