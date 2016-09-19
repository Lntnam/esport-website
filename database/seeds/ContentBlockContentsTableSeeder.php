<?php

use Illuminate\Database\Seeder;

class ContentBlockContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('content_block_contents')->delete();
        
        \DB::table('content_block_contents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'content_block_id' => 3,
                'locale' => 'vi_VN',
                'content' => '<h3>Tổ chức quản lý đội tuyển chuyên nghiệp đầu tiên ở Việt Nam.</h3>',
                'created_at' => '2016-09-19 08:31:24',
                'updated_at' => '2016-09-19 08:31:24',
            ),
            1 => 
            array (
                'id' => 2,
                'content_block_id' => 3,
                'locale' => 'en_US',
                'content' => '<h3>The first private-funded pro team management organization in Vietnam.</h3>',
                'created_at' => '2016-09-19 08:31:24',
                'updated_at' => '2016-09-19 08:31:24',
            ),
            2 => 
            array (
                'id' => 3,
                'content_block_id' => 4,
                'locale' => 'vi_VN',
                'content' => '<p class="lead">Được biết đến như đội DotA 2 mạnh nhất Việt Nam. Chúng tôi hướng đến đấu trường quốc tế, mà bắt đầu từ các giải đấu trong khu vực.</p>',
                'created_at' => '2016-09-19 08:44:08',
                'updated_at' => '2016-09-19 08:44:08',
            ),
            3 => 
            array (
                'id' => 4,
                'content_block_id' => 4,
                'locale' => 'en_US',
                'content' => '<p class="lead">Being known as the best DotA 2 team in Vietnam. We are aiming to conquer the world, starting with regional tournaments.</p>',
                'created_at' => '2016-09-19 08:44:08',
                'updated_at' => '2016-09-19 08:44:08',
            ),
            4 => 
            array (
                'id' => 5,
                'content_block_id' => 5,
                'locale' => 'vi_VN',
                'content' => '<p class="lead">Được hồi sinh từ đống ntro tàn, chúng tôi khao khát không ít hơn giải vô địch của mùa giải sắp tới. Hãy chờ đợi thông báo sắp tới về đội hình chính thức của team.</p>',
                'created_at' => '2016-09-19 08:46:22',
                'updated_at' => '2016-09-19 08:46:22',
            ),
            5 => 
            array (
                'id' => 6,
                'content_block_id' => 5,
                'locale' => 'en_US',
                'content' => '<p class="lead">Resurrected from the ash, we desire nothing but the first place of the coming season. Stay tuned for our roster announcement.</p>',
                'created_at' => '2016-09-19 08:46:22',
                'updated_at' => '2016-09-19 08:46:22',
            ),
            6 => 
            array (
                'id' => 7,
                'content_block_id' => 6,
                'locale' => 'vi_VN',
                'content' => 'Next Gen <sup>®</sup> DotA 2:<br>Những Nhà Vô Địch',
                'created_at' => '2016-09-19 08:49:42',
                'updated_at' => '2016-09-19 08:49:42',
            ),
            7 => 
            array (
                'id' => 8,
                'content_block_id' => 6,
                'locale' => 'en_US',
                'content' => 'Next Gen <sup>®</sup> DotA 2:<br>The Champions',
                'created_at' => '2016-09-19 08:49:42',
                'updated_at' => '2016-09-19 08:49:42',
            ),
            8 => 
            array (
                'id' => 9,
                'content_block_id' => 7,
                'locale' => 'vi_VN',
                'content' => 'Next Gen <sup>®</sup> League of Legends:<br>Những Người Thách Đấu',
                'created_at' => '2016-09-19 08:49:55',
                'updated_at' => '2016-09-19 08:49:55',
            ),
            9 => 
            array (
                'id' => 10,
                'content_block_id' => 7,
                'locale' => 'en_US',
                'content' => 'Next Gen <sup>®</sup> League of Legends:<br>The Challengers',
                'created_at' => '2016-09-19 08:49:55',
                'updated_at' => '2016-09-19 08:49:55',
            ),
            10 => 
            array (
                'id' => 11,
                'content_block_id' => 8,
                'locale' => 'vi_VN',
                'content' => 'Next Gen <sup>®</sup> E-sports<br/>Những Người Tiên Phong',
                'created_at' => '2016-09-19 08:52:16',
                'updated_at' => '2016-09-19 08:52:16',
            ),
            11 => 
            array (
                'id' => 12,
                'content_block_id' => 8,
                'locale' => 'en_US',
                'content' => 'Next Gen <sup>®</sup> E-sports<br/>The Vanguards',
                'created_at' => '2016-09-19 08:52:16',
                'updated_at' => '2016-09-19 08:52:16',
            ),
            12 => 
            array (
                'id' => 13,
                'content_block_id' => 9,
                'locale' => 'vi_VN',
                'content' => '<p class="lead">Chúng tôi là tổ chức đầu tiên ở Việt Nam đã xây dựng mô hình kinh doanh xoay quan các đội và chỉ các đội thể thao điện tử.</p>',
                'created_at' => '2016-09-19 08:53:28',
                'updated_at' => '2016-09-19 08:53:28',
            ),
            13 => 
            array (
                'id' => 14,
                'content_block_id' => 9,
                'locale' => 'en_US',
                'content' => '<p class="lead">We are the very first organization in Vietnam who truly builds our business around e-sport teams, and nothing else. </p>',
                'created_at' => '2016-09-19 08:53:28',
                'updated_at' => '2016-09-19 08:53:28',
            ),
            14 => 
            array (
                'id' => 15,
                'content_block_id' => 10,
                'locale' => 'vi_VN',
                'content' => 'Nhận cập nhật qua email:',
                'created_at' => '2016-09-19 08:56:53',
                'updated_at' => '2016-09-19 08:56:53',
            ),
            15 => 
            array (
                'id' => 16,
                'content_block_id' => 10,
                'locale' => 'en_US',
                'content' => 'Receive email updates:',
                'created_at' => '2016-09-19 08:56:53',
                'updated_at' => '2016-09-19 08:56:53',
            ),
        ));
        
        
    }
}
