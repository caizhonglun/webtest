<?php

use Illuminate\Database\Seeder;
use App\WWW\PersonalDuty;

class WWWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 頁面新增
        Page::insert([
            ['title' => '市長的話', 'eng_title' => 'Words from the Mayor'],
            ['title' => '局長介紹', 'eng_title' => 'Director-general'],
            ['title' => '教育局組織架構', 'eng_title' => 'Organization'],
            ['title' => '教育現況', 'eng_title' => 'Status Quo-Education'],
            ['title' => '品格教育', 'eng_title' => 'Taoyuan Character Education'],
            ['title' => '隱私權保護政策宣告', 'eng_title' => 'Privacy Declare'],
            ['title' => '網站安全政策宣告', 'eng_title' => 'Security Policy Announcement'],
            ['title' => '為民服務窗口', 'eng_title' => 'Service'],
            ['title' => '檢舉管道', 'eng_title' => '']
        ]);

        PersonalDuty::insert([
            [
                'name' => '局長',
                'position' => '局長',
                'email' => 'first@email.com',
                'telephone' => '03-3333333',
                'telephone_extension' => '7575',
                'direct_telephone' => '03-3333333',
                'fax' => '03-333333',
                'unit_id' => 41
            ],
            [
                'name' => '副局長1',
                'position' => '副局長',
                'email' => 'second@email.com',
                'telephone' => '03-3333333',
                'telephone_extension' => '7575-7576',
                'direct_telephone' => '03-3333333',
                'fax' => '03-333333',
                'unit_id' => 33
            ],
            [
                'name' => '副局長2',
                'position' => '副局長',
                'email' => 'second2@email.com',
                'telephone' => '03-3333333',
                'telephone_extension' => '7575-7576',
                'direct_telephone' => '03-3333333',
                'fax' => '03-333333',
                'unit_id' => 33
            ],
            [
                'name' => '主任秘書',
                'position' => '主任秘書',
                'email' => 'third@email.com',
                'telephone' => '03-3333333',
                'telephone_extension' => '7575-7576',
                'direct_telephone' => '03-3333333',
                'fax' => '03-333333',
                'unit_id' => 29
            ]
        ]);

        // 便民服務 > 廉政專區 > 檔案專區
        Folder::insert(['name' => '廉政專區', 'layer' => 1]);
        $folderID = Folder::where('name', '廉政專區')->first()->id;
        Folder::insert([
            ['name' => '安全維護業務', 'above' => $folderID, 'layer' => 2],
            ['name' => '廉政宣導成果', 'above' => $folderID, 'layer' => 2],
            ['name' => '廉政法規', 'above' => $folderID, 'layer' => 2],
            ['name' => '請託關說登錄查察業務', 'above' => $folderID, 'layer' => 2],
        ]);

        // 便民服務 > 檔案下載
        Folder::insert(['name' => '檔案下載', 'layer' => 1]);

        // 便民服務 > 統計專區
        Folder::insert(['name' => '統計專區', 'layer' => 1]);
        $folderID = Folder::where('name', '統計專區')->first()->id;
        Folder::insert([
            ['name' => '公務統計報表', 'above' => $folderID, 'layer' => 2],
            ['name' => '教育性別統計', 'above' => $folderID, 'layer' => 2],
            ['name' => '教育統計分析', 'above' => $folderID, 'layer' => 2],
            ['name' => '教育統計方案', 'above' => $folderID, 'layer' => 2],
            ['name' => '其他', 'above' => $folderID, 'layer' => 2],
        ]);
    }
}
