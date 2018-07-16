<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 縣市區域
    |--------------------------------------------------------------------------
    |
    | 設定區域
    |
    */
    'areas' => [
        'taoyuan' => '桃園區',
        'lujhu'   => '蘆竹區',
        'dayuan'  => '大園區',
        'gueishan'=> '龜山區',
        'bade'    => '八德區',
        'dasi'    => '大溪區',
        'chungli' => '中壢區',
        'pingjhen'=> '平鎮區',
        'yangmei' => '楊梅區',
        'sinwu'   => '新屋區',
        'guanyin' => '觀音區',
        'longtan' => '龍潭區',
        'fusing'  => '復興區',
    ],

    /*
    |--------------------------------------------------------------------------
    | 首頁MENU
    |--------------------------------------------------------------------------
    |
    | menu的key值是第一層類別的英文代號
    |
    |
    | title 必填，名稱
    | route 連結內部route，若是外部連結則不需要此項目
    | param 參數
    | next 下一層
    | url 外部連結，若是內部route則不需要此項目
    |
    */

    'menu' => [
        'intro' => [
            'title' => '組織介紹',
            'next' => [
                [
                    'title' => '市長的話',
                    'route' => 'page.index',
                    'param' => ['page' => 'mayor']
                ], [
                    'title' => '局長簡介',
                    'route' => 'director.index',
                    'param' => null
                ], [
                    'title' => '副局長簡介',
                    'route' => 'vicedirector.index',
                    'param' => null
                ], [
                    'title' => '主任秘書簡介',
                    'route' => 'chiefsecretary.index',
                    'param' => null
                ], [
                    'title' => '教育局組織架構',
                    'route' => 'page.index',
                    'param' => ['page' => 'organization']
                ], [
                    'title' => '組織業務人員簡介',
                    'route' => 'duty.index',
                    'param' => null
                ],
            ]
        ],
        'message' => [
            'title' => '訊息公告',
            'next' => [
                [
                    'title' => '最新消息',
                    'route' => 'news.index',
                    'param' => null
                ], [
                    'title' => '教育新聞',
                    'route' => 'edunews.index',
                    'param' => null
                ], [
                    'title' => '法規查詢',
                    'next' => [
                        [
                            'title' => '全國法規資料庫',
                            'url' => 'http://law.moj.gov.tw/',
                            'organizer' => '',
                            'contact_phone' => ''
                        ], [
                            'title' => '桃園市主管法規',
                            'url' => 'http://law.tycg.gov.tw/',
                            'organizer' => '',
                            'contact_phone' => ''
                        ], [
                            'title' => '行政規則(章)',
                            'route' => 'folder.index',
                            'param' => ['page' => 'Administrative_rules']
                        ],
                    ]
                ], [
                    'title' => '福利補助',
                    'url' => 'https://e-services.tycg.gov.tw/TycgOnline/02.jsp?ONLINE=N',
                    'organizer' => '',
                    'contact_phone' => ''
                ], [
                    'title' => '政策宣導',
                    'url' => 'https://www.tyc.edu.tw/policy',
                    'organizer' => '',
                    'contact_phone' => ''
                ],[
                    'title' => '業務專區',
                    'next' => [
                        [
                            'title' => '幼兒教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'preedu']
                        ], [
                            'title' => '國小教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'priedu']
                        ], [
                            'title' => '國中教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'secedu']
                        ], [
                            'title' => '高中教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'highedu']
                        ], [
                            'title' => '終身教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'alllifeedu']
                        ], [
                            'title' => '特殊教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'speedu']
                        ], [
                            'title' => '資訊教育科',
                            'route' => 'business.index',
                            'param' => ['page' => 'infoedu']
                        ], [
                            'title' => '體育保健科',
                            'route' => 'business.index',
                            'param' => ['page' => 'physicaledu']
                        ], [
                            'title' => '教育設施科',
                            'route' => 'business.index',
                            'param' => ['page' => 'facilityedu']
                        ], [
                            'title' => '學輔校安室',
                            'route' => 'business.index',
                            'param' => ['page' => 'schsafe']
                        ], [
                            'title' => '人事室',
                            'route' => 'business.index',
                            'param' => ['page' => 'personnel']
                        ], [
                            'title' => '會計室',
                            'route' => 'business.index',
                            'param' => ['page' => 'accounting']
                        ], [
                            'title' => '政風室',
                            'route' => 'business.index',
                            'param' => ['page' => 'political']
                        ], [
                            'title' => '秘書室',
                            'route' => 'business.index',
                            'param' => ['page' => 'secretary']
                        ]
                    ]
                ],
            ]
        ],
        'eduNow' => [
            'title' => '教育現況',
            'next' => [
                [
                    'title' => '教育現況',
                    'next' => [
                        [
                            'title' => '學校現況',
                            'route' => 'page.index',
                            'param' => ['page' => 'statusEdu']
                        ], [
                            'title' => '教育經費',
                            'route' => 'page.index',
                            'param' => ['page' => 'fundEdu']
                        ], [
                            'title' => '品格教育',
                            'route' => 'page.index',
                            'param' => ['page' => 'charedu']
                        ]
                    ]
                ], [
                    'title' => '施政目標',
                    'url' => 'http://www.tycg.gov.tw/ch/home.jsp?id=10241&parentpath=0,4&mcustomize=policy_list.jsp&qclass=201209230001',
                    'organizer' => '',
                    'contact_phone' => ''
                ], [
                    'title' => '施政成果',
                    'url' => 'http://www.tycg.gov.tw/ch/home.jsp?id=20&parentpath=0,4&mcustomize=policy_list.jsp&qclass=201209230001',
                    'organizer' => '',
                    'contact_phone' => ''
                ],
                        [
                            'title' => '各級學校(開發中)',
                            'route' => 'schools.index',
                            'param'=> []
                        ], [
                            'title' => '學區資訊',
                            'route' => 'district.index',
                            'param'=> []
                        ],  [
                    'title' => '市立幼兒園',
                    'next'  => [
                         [
                            'title' => '桃園幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'taoyuan']
                        ], [
                            'title' => '中壢幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'zhongli']
                        ],  [
                            'title' => '中壢高鐵幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'zhonglihsrail']
                        ],  [
                            'title' => '大溪幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'daxi']
                        ],  [
                            'title' => '楊梅幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'yangmei']
                        ],  [
                            'title' => '蘆竹幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'luzhu']
                        ],  [
                            'title' => '大園幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'dayuan']
                        ],  [
                            'title' => '龜山幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'guishan']
                        ],  [
                            'title' => '八德幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'bade']
                        ],  [
                            'title' => '龍潭幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'longtan']
                        ],  [
                            'title' => '平鎮幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'pingzhen']
                        ],  [
                            'title' => '新屋幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'xinwu']
                        ],  [
                            'title' => '觀音幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'guanyin']
                        ],  [
                            'title' => '南崁幼兒園',
                            'route' => 'citykg.index',
                            'param' => ['page' => 'nankan']
                        ], 
                    ]
                ], [
                    'title' => '幼兒園所資訊',
                    'next'  => [
                        [
                            'title' => '立案園所',
                            'route' => 'page.index',
                            'param' => ['page' => 'registerkg']
                        ], [
                            'title' => '未立案機構',
                            'route' => 'page.index',
                            'param' => ['page' => 'unregisterkg']
                        ], [
                            'title' => '符合補助要件園所',
                            'route' => 'page.index',
                            'param' => ['page' => 'allowancekg']
                        ],[
                            'title' => '績優園所',
                            'route' => 'page.index',
                            'param' => ['page' => 'exckg']
                        ],[
                            'title' => '撤銷/廢止園所',
                            'route' => 'page.index',
                            'param' => ['page' => 'abolishmentkg']
                        ]
                    ]
                ],
            ]
        ],
        'recruitment' => [
            'title'  => '人事徵聘',
            'next' => [],
        ],
        'people' => [
            'title' => '便民服務',
            'next' => [
                'statistics' => [
                    'title' => '統計資訊',
                    'next'  => [
                        [
                            'title' => '預告統計發布時間表',
                            'route' => 'page.index',
                            'param' => ['page' => 'preview']
                        ], [
                            'title' => '統計專區',
                            'route' => 'folder.index',
                            'param' => ['page' => 'statistics']
                        ]
                    ]
                ], [
                    'title' => '廉政服務專區',
                    'next' => [
                        [
                            'title' => '檢舉管道',
                            'route' => 'page.index',
                            'param' => ['page' => 'accuse']
                        ], [
                            'title' => '檔案專區',
                            'route' => 'folder.index',
                            'param' => ['page' => 'ethicsfolder']
                        ],
                        [
                            'title' => '影音宣導',
                            'route' => 'videolink.index',
                            'param' => []
                        ], 
                    ]
                ], [
                    'title' => '學區資訊',
                    'route' => 'district.index',
                    'param'=> []
                ], [
                 'title' => '為民服務窗口',
                 'route' => 'page.index',
                 'param' => ['page' => 'service']
                ],
                [
                            'title' => '意見反映',
                            'url'   => 'https://taotalk.tycg.gov.tw/',
                            'organizer' => '',
                            'contact_phone' => ''
                ],
                [
                 'title' => '檔案下載',
                 'route' => 'folder.index',
                 'param' => ['page' => 'download']
                ],
            ]
        ],
        'resource' => [
            'title' => '教學資源',
            'next' => []
        ],
        'official' => [
            'title' => '教育公務',
            'next' => []
        ],
        'other' => [
            'title' => '其他',
            'next' => [
                [
                    'title' => '個資保護公開作業',
                    'route' => 'pdata.index',
                    'param' => []
                ], [
                    'title' => '隱私權保護政策宣告',
                    'route' => 'page.index',
                    'param' => ['page' => 'privacy']
                ], [
                    'title' => '網站安全政策宣告',
                    'route' => 'page.index',
                    'param' => ['page' => 'safeweb']

                ],[
                    'title' => '資訊安全政策',
                    'route' => 'page.index',
                    'param' => ['page' => 'safeinfo']
                ],[
                    'title' => '性別主流化專區',
                    'route' => 'folder.index',
                    'param' => ['page' => 'genderarea']
                ],[
                    'title' => '政府資訊公開',
                    'route' => 'page.index',
                    'param' => ['page' => 'openinfo']
                ],[
                    'title' => '常見問題',
                    'route' => 'qa.index',
                    'param' => []
                ],

            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | 後端管理平台MENU
    |--------------------------------------------------------------------------
    |
    | title 必填，代表標題
    | route 連結內部route，若是外部連結則不需要此項目
    | next 子menu，建議最多第三層
    | url 外部連結，若是內部route則不需要此項目
    |
    */

    'backMenu' => [
        [
            'title' => '首頁',
            'next' => [
                [
                            'title' => '宣導影片(開發中)',
                            'route' => 'video.back',
                            'param' => []
                        ],
                [
                    'title' => '政策宣導',
                    'route' => 'policy.back',
                    'param'=> null
                ], [
                    'title' => '政府公開資訊',
                    'route' => 'link.subBack',
                    'param'=> ['page' => 'publicinfo']
                ], [
                    'title' => '幻燈片',
                    'route' => 'carousel.back',
                    'param'=> null
                ], [
                    'title' => '跑馬燈',
                    'route' => 'marquee.back',
                    'param'=> null
                ],
                [
                    'title' => '活動看板',
                    'route' => 'advimg.back',
                    'param'=> null
                ],
            ]
        ], [
            'title' => '組織介紹',
            'next' => [
                [
                    'title' => '市長的話',
                    'route' => 'page.back',
                    'param'=> ['page' => 'mayor']
                ], [
                    'title' => '局長簡介',
                    'route' => 'director.back',
                    'param'=> null
                ], [
                    'title' => '副局長簡介',
                    'route' => 'vicedirector.back',
                    'param'=> null
                ], [
                    'title' => '主任秘書簡介',
                    'route' => 'chiefsecretary.back',
                    'param'=> null
                ], [
                    'title' => '教育局組織架構',
                    'route' => 'page.back',
                    'param'=> ['page' => 'organization']
                ], [
                    'title' => '組織業務人員簡介',
                    'route' => 'duty.back',
                    'param'=> null
                ],
            ]
        ],
        'message' => [
            'title' => '訊息公告',
            'next' => [
                [
                    'title' => '最新消息',
                    'route' => 'news.back',
                    'param' => null
                ], [
                    'title' => '教育新聞',
                    'route' => 'edunews.back',
                    'param' => null
                ], [
                    'title' => '法規查詢',
                    'next' => [
                        [
                            'title' => '全國法規資料庫',
                            'url' => 'http://law.moj.gov.tw/',
                            'organizer' => '',
                            'contact_phone' => ''
                        ], [
                            'title' => '桃園市主管法規',
                            'url' => 'http://law.tycg.gov.tw/',
                            'organizer' => '',
                            'contact_phone' => ''
                        ], [
                            'title' => '行政規則(章)',
                            'route' => 'folder.back',
                            'param' => ['page' => 'Administrative_rules']
                        ],
                    ]
                ], [
                    'title' => '福利補助',
                    'url' => 'https://e-services.tycg.gov.tw/TycgOnline/02.jsp?ONLINE=N',
                    'organizer' => '',
                    'contact_phone' => ''
                ],[
                    'title' => '政策宣導',
                    'url' => 'https://www.tyc.edu.tw/policy',
                    'organizer' => '',
                    'contact_phone' => ''
                ],[
                    'title' => '業務專區',
                    'next' => [
                        [
                            'title' => '幼兒教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'preedu']
                        ], [
                            'title' => '國小教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'priedu']
                        ], [
                            'title' => '國中教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'secedu']
                        ], [
                            'title' => '高中教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'highedu']
                        ], [
                            'title' => '終身教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'alllifeedu']
                        ], [
                            'title' => '特殊教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'speedu']
                        ], [
                            'title' => '資訊教育科',
                            'route' => 'business.back',
                            'param' => ['page' => 'infoedu']
                        ], [
                            'title' => '體育保健科',
                            'route' => 'business.back',
                            'param' => ['page' => 'physicaledu']
                        ], [
                            'title' => '教育設施科',
                            'route' => 'business.back',
                            'param' => ['page' => 'facilityedu']
                        ], [
                            'title' => '學輔校安室',
                            'route' => 'business.back',
                            'param' => ['page' => 'schsafe']
                        ], [
                            'title' => '人事室',
                            'route' => 'business.back',
                            'param' => ['page' => 'personnel']
                        ], [
                            'title' => '會計室',
                            'route' => 'business.back',
                            'param' => ['page' => 'accounting']
                        ], [
                            'title' => '政風室',
                            'route' => 'business.back',
                            'param' => ['page' => 'political']
                        ], [
                            'title' => '秘書室',
                            'route' => 'business.back',
                            'param' => ['page' => 'secretary']
                        ]
                    ]
                ],
            ]
        ],
        [
            'title' => '教育現況',
            'next' => [
                [
                    'title' => '教育現況',
                    'route' => 'page.back',
                    'param' => ['page' => 'statusEdu']
                ], [
                    'title' => '教育經費',
                    'route' => 'page.back',
                    'param' => ['page' => 'fundEdu']
                ], [
                    'title' => '品格教育',
                    'route' => 'page.back',
                    'param'=> ['page' => 'charedu']
                ],  [
                        'title' => '各級學校(開發中)',
                        'route' => 'schools.back',
                        'param' => []
                        ], [
                        'title' => '學區資訊',
                        'route' => 'district.back',
                        'param'=> []
                        ],                [
                    'title' => '市立幼兒園',
                    'next'  => [
                        [
                            'title' => '桃園幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'taoyuan']
                        ], [
                            'title' => '中壢幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'zhongli']
                        ],  [
                            'title' => '中壢高鐵幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'zhonglihsrail']
                        ],  [
                            'title' => '大溪幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'daxi']
                        ],  [
                            'title' => '楊梅幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'yangmei']
                        ],  [
                            'title' => '蘆竹幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'luzhu']
                        ],  [
                            'title' => '大園幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'dayuan']
                        ],  [
                            'title' => '龜山幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'guishan']
                        ],  [
                            'title' => '八德幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'bade']
                        ],  [
                            'title' => '龍潭幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'longtan']
                        ],  [
                            'title' => '平鎮幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'pingzhen']
                        ],  [
                            'title' => '新屋幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'xinwu']
                        ],  [
                            'title' => '觀音幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'guanyin']
                        ],  [
                            'title' => '南崁幼兒園',
                            'route' => 'citykg.back',
                            'param' => ['page' => 'nankan']
                        ], 
                    ]
                ],
                [
                    'title' => '幼兒園所資訊',
                    'next'  => [
                        [
                            'title' => '立案園所',
                            'route' => 'page.back',
                            'param' => ['page' => 'registerkg']
                        ], [
                            'title' => '未立案機構',
                            'route' => 'page.back',
                            'param' => ['page' => 'unregisterkg']
                        ], [
                            'title' => '符合補助要件園所',
                            'route' => 'page.back',
                            'param' => ['page' => 'allowancekg']
                        ],[
                            'title' => '績優園所',
                            'route' => 'page.back',
                            'param' => ['page' => 'exckg']
                        ],[
                            'title' => '撤銷/廢止園所',
                            'route' => 'page.back',
                            'param' => ['page' => 'abolishmentkg']
                        ]
                    ]
                ],
            ]
        ], [
            'title' => '人事徵聘',
            'route' => 'link.subBack',
            'param'=> ['page' => 'recruitment']
        ], [
            'title' => '便民服務',
            'next' => [
                [
                    'title' => '統計資訊',
                    'next'  => [
                        [
                            'title' => '預告統計發布時間表',
                            'route' => 'page.back',
                            'param' => ['page' => 'preview']
                        ], [
                            'title' => '統計專區',
                            'route' => 'folder.back',
                            'param' => ['page' => 'statistics']
                        ]
                    ]
                ], [
                    'title' => '廉政服務專區',
                    'next'  => [
                        [
                            'title' => '檢舉管道',
                            'route' => 'page.back',
                            'param' => ['page' => 'accuse']
                        ], [
                            'title' => '影音宣導',
                            'route' => 'videolink.back',
                            'param' => []
                        ], [
                            'title' => '檔案專區',
                            'route' => 'folder.back',
                            'param' => ['page' => 'ethicsfolder']
                        ],
                    ]
                ], [
                    'title' => '常見問題',
                    'route' => 'qa.back',
                    'param' => []
                ],  [
                    'title' => '為民服務窗口',
                    'route' => 'page.back',
                    'param'=> ['page' => 'service']
                ], [
                    'title' => '意見反映',
                    'url' => 'https://taotalk.tycg.gov.tw/',
                    'organizer' => '',
                    'contact_phone' => ''
                ],[
                    'title' => '檔案下載',
                    'route' => 'folder.back',
                    'param' => ['page' => 'download']
                ],
            ]
        ], [
            'title' => '教學資源',
            'route' => 'link.back',
            'param' => ['page' => 'resource']
        ], [
            'title' => '教育公務',
            'route' => 'link.back',
            'param' => ['page' => 'official']
        ], [
            'title' => '其他',
            'next' => [
                [
                    'title' => '隱私權保護政策宣告',
                    'route' => 'page.back',
                    'param' => ['page' => 'privacy']
                ], [
                    'title' => '資訊安全政策',
                    'route' => 'page.back',
                    'param' => ['page' => 'safeinfo']
                ], [
                    'title' => '網站安全政策宣告',
                    'route' => 'page.back',
                    'param' => ['page' => 'safeweb']

                ], [
                    'title' => '政府資訊公開',
                    'route' => 'page.back',
                    'param' => ['page' => 'openinfo']

                ],[
                    'title' => '性別主流化專區',
                    'route' => 'folder.back',
                    'param' => ['page' => 'genderarea']
                ],[
                    'title' => '個資保護公開作業',
                    'route' => 'pdata.back',
                    'param' => []
                ],[
                    'title' => '常見問題',
                    'route' => 'qa.back',
                    'param' => []
                ],

            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 幻燈片數量
    |--------------------------------------------------------------------------
    |
    | 設定幻燈片數量，控制在一定的數量內，以防使用者破壞首頁美觀。
    |
    */
    'carouselLimit' => 5,
];
