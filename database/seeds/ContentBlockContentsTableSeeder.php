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
                'id' => '1',
                'content_block_id' => '2',
                'locale' => 'en_US',
                'content' => 'The first private-funded esport team management organization in Vietnam',
                'created_at' => '2016-09-20 18:55:31',
                'updated_at' => '2016-09-20 18:55:31',
            ),
            1 => 
            array (
                'id' => '2',
                'content_block_id' => '3',
                'locale' => 'en_US',
                'content' => 'Next Gen&nbsp;&reg;&nbsp;DotA 2:<br />
The Champions',
                'created_at' => '2016-09-20 19:00:16',
                'updated_at' => '2016-09-20 19:00:16',
            ),
            2 => 
            array (
                'id' => '3',
                'content_block_id' => '4',
                'locale' => 'en_US',
                'content' => 'Being known as the best DotA 2 team in Vietnam. We are aiming to conquer the world, starting with regional tournaments.',
                'created_at' => '2016-09-20 19:00:47',
                'updated_at' => '2016-09-20 19:00:47',
            ),
            3 => 
            array (
                'id' => '4',
                'content_block_id' => '5',
                'locale' => 'en_US',
                'content' => 'Next Gen&nbsp;&reg;&nbsp;League of Legends:<br />
The Challengers',
                'created_at' => '2016-09-20 19:01:10',
                'updated_at' => '2016-09-20 19:01:10',
            ),
            4 => 
            array (
                'id' => '5',
                'content_block_id' => '6',
                'locale' => 'en_US',
                'content' => 'Resurrected from the ash, we desire nothing but the first place of the coming season. Stay tuned for our roster announcement.',
                'created_at' => '2016-09-20 19:01:30',
                'updated_at' => '2016-09-20 19:01:30',
            ),
            5 => 
            array (
                'id' => '6',
                'content_block_id' => '7',
                'locale' => 'en_US',
                'content' => 'We are the very first organization in Vietnam who truly builds our business around e-sport teams, and nothing else.',
                'created_at' => '2016-09-20 19:01:49',
                'updated_at' => '2016-09-20 19:01:49',
            ),
            6 => 
            array (
                'id' => '7',
                'content_block_id' => '8',
                'locale' => 'en_US',
                'content' => 'Next Gen&nbsp;&reg;&nbsp;E-sports<br />
The Vanguards',
                'created_at' => '2016-09-20 19:01:50',
                'updated_at' => '2016-09-20 19:01:50',
            ),
            7 => 
            array (
                'id' => '8',
                'content_block_id' => '9',
                'locale' => 'en_US',
                'content' => 'Receive email updates:',
                'created_at' => '2016-09-20 19:02:06',
                'updated_at' => '2016-09-20 19:02:06',
            ),
            8 => 
            array (
                'id' => '9',
                'content_block_id' => '2',
                'locale' => 'vi_VN',
                'content' => 'Tổ chức quản lý đội tuyển esport chuyên nghiệp đầu tiên ở Việt Nam',
                'created_at' => '2016-09-20 19:03:41',
                'updated_at' => '2016-09-20 19:11:48',
            ),
            9 => 
            array (
                'id' => '10',
                'content_block_id' => '4',
                'locale' => 'vi_VN',
                'content' => 'Được biết đến như đội DotA 2 mạnh nhất Việt Nam. Chúng tôi hướng đến đấu trường quốc tế, mà bắt đầu từ các giải đấu trong khu vực.',
                'created_at' => '2016-09-20 19:04:04',
                'updated_at' => '2016-09-20 19:11:43',
            ),
            10 => 
            array (
                'id' => '11',
                'content_block_id' => '3',
                'locale' => 'vi_VN',
                'content' => 'Next Gen&nbsp;®&nbsp;DotA 2:<br />
Những Nhà Vô Địch',
                'created_at' => '2016-09-20 19:04:06',
                'updated_at' => '2016-09-20 19:11:45',
            ),
            11 => 
            array (
                'id' => '12',
                'content_block_id' => '5',
                'locale' => 'vi_VN',
                'content' => 'Next Gen&nbsp;®&nbsp;League of Legends:<br />
Những Kẻ Thách Đấu',
                'created_at' => '2016-09-20 19:04:55',
                'updated_at' => '2016-09-20 19:11:08',
            ),
            12 => 
            array (
                'id' => '13',
                'content_block_id' => '6',
                'locale' => 'vi_VN',
                'content' => 'Được hồi sinh từ đống tro tàn, điều chúng tôi luôn khao khát không ít hơn giải vô địch của mùa sắp tới. Hãy chờ đợi thông báo sắp tới về đội hình chính thức của team.',
                'created_at' => '2016-09-20 19:05:25',
                'updated_at' => '2016-09-20 19:11:19',
            ),
            13 => 
            array (
                'id' => '14',
                'content_block_id' => '8',
                'locale' => 'vi_VN',
                'content' => 'Next Gen&nbsp;®&nbsp;Esports<br />
Những Người Tiên Phong',
                'created_at' => '2016-09-20 19:05:38',
                'updated_at' => '2016-09-20 19:10:12',
            ),
            14 => 
            array (
                'id' => '15',
                'content_block_id' => '7',
                'locale' => 'vi_VN',
                'content' => 'Chúng tôi là tổ chức đầu tiên ở Việt Nam đang xây dựng mô hình kinh doanh xoay quanh các đội thể thao điện tử.',
                'created_at' => '2016-09-20 19:05:55',
                'updated_at' => '2016-09-20 19:10:51',
            ),
            15 => 
            array (
                'id' => '16',
                'content_block_id' => '9',
                'locale' => 'vi_VN',
                'content' => 'Nhận cập nhật qua email:',
                'created_at' => '2016-09-20 19:06:14',
                'updated_at' => '2016-09-20 19:06:14',
            ),
            16 => 
            array (
                'id' => '17',
                'content_block_id' => '10',
                'locale' => 'en_US',
                'content' => 'DotA 2 - Fixtures',
                'created_at' => '2016-09-20 19:33:18',
                'updated_at' => '2016-09-20 19:33:18',
            ),
            17 => 
            array (
                'id' => '18',
                'content_block_id' => '11',
                'locale' => 'en_US',
                'content' => 'Road to TI 69',
                'created_at' => '2016-09-20 19:34:02',
                'updated_at' => '2016-09-20 19:34:02',
            ),
            18 => 
            array (
                'id' => '20',
                'content_block_id' => '13',
                'locale' => 'en_US',
                'content' => 'Live Now',
                'created_at' => '2016-09-20 19:34:35',
                'updated_at' => '2016-09-20 19:34:35',
            ),
            19 => 
            array (
                'id' => '21',
                'content_block_id' => '14',
                'locale' => 'en_US',
                'content' => 'Upcoming',
                'created_at' => '2016-09-20 19:34:41',
                'updated_at' => '2016-09-20 19:34:41',
            ),
            20 => 
            array (
                'id' => '22',
                'content_block_id' => '15',
                'locale' => 'en_US',
                'content' => 'Recent Results',
                'created_at' => '2016-09-20 19:34:47',
                'updated_at' => '2016-09-20 19:34:47',
            ),
            21 => 
            array (
                'id' => '23',
                'content_block_id' => '16',
                'locale' => 'en_US',
                'content' => 'Receive &nbsp;Fixtures via Email',
                'created_at' => '2016-09-20 19:35:25',
                'updated_at' => '2016-09-20 19:35:25',
            ),
            22 => 
            array (
                'id' => '24',
                'content_block_id' => '10',
                'locale' => 'vi_VN',
                'content' => 'DotA 2 - Lịch Đấu',
                'created_at' => '2016-09-20 19:35:40',
                'updated_at' => '2016-09-20 19:35:40',
            ),
            23 => 
            array (
                'id' => '25',
                'content_block_id' => '11',
                'locale' => 'vi_VN',
                'content' => 'Đường đến TI 69',
                'created_at' => '2016-09-20 19:35:47',
                'updated_at' => '2016-09-20 19:35:47',
            ),
            24 => 
            array (
                'id' => '27',
                'content_block_id' => '13',
                'locale' => 'vi_VN',
                'content' => 'Đang Diễn Ra',
                'created_at' => '2016-09-20 19:36:09',
                'updated_at' => '2016-09-20 19:36:09',
            ),
            25 => 
            array (
                'id' => '28',
                'content_block_id' => '14',
                'locale' => 'vi_VN',
                'content' => 'Sắp Tới',
                'created_at' => '2016-09-20 19:36:17',
                'updated_at' => '2016-09-20 19:36:17',
            ),
            26 => 
            array (
                'id' => '29',
                'content_block_id' => '15',
                'locale' => 'vi_VN',
                'content' => 'Kết Quả Gần Đây',
                'created_at' => '2016-09-20 19:36:24',
                'updated_at' => '2016-09-20 19:36:24',
            ),
            27 => 
            array (
                'id' => '30',
                'content_block_id' => '16',
                'locale' => 'vi_VN',
                'content' => 'Đăng Ký Nhận Lịch Qua Email',
                'created_at' => '2016-09-20 19:36:32',
                'updated_at' => '2016-09-20 19:36:32',
            ),
            28 => 
            array (
                'id' => '31',
                'content_block_id' => '17',
                'locale' => 'en_US',
                'content' => 'All results of DotA 2 team',
                'created_at' => '2016-09-20 19:40:43',
                'updated_at' => '2016-09-20 19:41:21',
            ),
            29 => 
            array (
                'id' => '32',
                'content_block_id' => '18',
                'locale' => 'en_US',
                'content' => 'DotA 2 - Results',
                'created_at' => '2016-09-20 19:40:44',
                'updated_at' => '2016-09-20 19:41:05',
            ),
            30 => 
            array (
                'id' => '34',
                'content_block_id' => '18',
                'locale' => 'vi_VN',
                'content' => 'DotA 2 - Kết Quả',
                'created_at' => '2016-09-20 19:41:36',
                'updated_at' => '2016-09-20 19:41:36',
            ),
            31 => 
            array (
                'id' => '35',
                'content_block_id' => '17',
                'locale' => 'vi_VN',
                'content' => 'Tất cả kết quả của team DotA 2',
                'created_at' => '2016-09-20 19:41:45',
                'updated_at' => '2016-09-20 19:41:45',
            ),
            32 => 
            array (
                'id' => '37',
                'content_block_id' => '20',
                'locale' => 'vi_VN',
                'content' => 'Hãy đăng ký để nhận lịch đấu và các tin tức mới nhất',
                'created_at' => '2016-09-20 19:49:25',
                'updated_at' => '2016-09-20 19:49:25',
            ),
            33 => 
            array (
                'id' => '38',
                'content_block_id' => '21',
                'locale' => 'vi_VN',
                'content' => 'Nhận Email từ Next Gen&nbsp;<sup>®</sup>',
                'created_at' => '2016-09-20 19:49:27',
                'updated_at' => '2016-09-20 19:49:54',
            ),
            34 => 
            array (
                'id' => '39',
                'content_block_id' => '21',
                'locale' => 'en_US',
                'content' => 'Receive Emails from Next Gen&nbsp;<sup>®</sup>',
                'created_at' => '2016-09-20 19:49:48',
                'updated_at' => '2016-09-20 19:49:48',
            ),
            35 => 
            array (
                'id' => '40',
                'content_block_id' => '20',
                'locale' => 'en_US',
                'content' => 'Subscribe receive fixture updates and latest news',
                'created_at' => '2016-09-20 19:50:15',
                'updated_at' => '2016-09-20 19:50:15',
            ),
            36 => 
            array (
                'id' => '41',
                'content_block_id' => '22',
                'locale' => 'en_US',
                'content' => 'Hi there,<br />
<br />
You have successfully subscribed to our email updates.<br />
<br />
Thank you and see you soon.',
                'created_at' => '2016-09-20 19:55:49',
                'updated_at' => '2016-09-20 19:55:49',
            ),
            37 => 
            array (
                'id' => '42',
                'content_block_id' => '23',
                'locale' => 'en_US',
                'content' => 'Receive Emails from Next Gen <sup>®</sup>',
                'created_at' => '2016-09-20 19:55:51',
                'updated_at' => '2016-09-20 19:55:51',
            ),
            38 => 
            array (
                'id' => '43',
                'content_block_id' => '24',
                'locale' => 'en_US',
                'content' => 'Hi there,<br />
<br />
We are sorry that you have not successfully subscribed to our email updates.<br />
<br />
Please try again later, or with another email address. If the problem persists, feel free to contact our administrator.<br />
<br />
Thank you.',
                'created_at' => '2016-09-20 19:56:30',
                'updated_at' => '2016-09-20 19:56:30',
            ),
            39 => 
            array (
                'id' => '44',
                'content_block_id' => '25',
                'locale' => 'en_US',
                'content' => 'Confirmation',
                'created_at' => '2016-09-20 19:56:47',
                'updated_at' => '2016-09-20 19:56:55',
            ),
            40 => 
            array (
                'id' => '45',
                'content_block_id' => '22',
                'locale' => 'vi_VN',
                'content' => 'Chào bạn!<br />
<br />
Bạn đã đăng ký nhận email cập nhật thông tin thành công.<br />
<br />
Xin cảm ơn và hẹn gặp lại.',
                'created_at' => '2016-09-20 19:57:36',
                'updated_at' => '2016-09-20 19:57:36',
            ),
            41 => 
            array (
                'id' => '46',
                'content_block_id' => '23',
                'locale' => 'vi_VN',
                'content' => 'Nhận Email từ Next Gen <sup>®</sup>',
                'created_at' => '2016-09-20 19:57:53',
                'updated_at' => '2016-09-20 19:57:53',
            ),
            42 => 
            array (
                'id' => '47',
                'content_block_id' => '24',
                'locale' => 'vi_VN',
                'content' => 'Chào bạn!<br />
<br />
Xin cáo lỗi vì bạn chưa đăng ký nhận email thành công.<br />
<br />
Xin hãy thử lại sau, hoặc với một địa chỉ email khác. Nếu vẫn còn lỗi &nbsp;xảy ra bạn có thể liên hệ với admin của chúng tôi.<br />
<br />
Xin cảm ơn.',
                'created_at' => '2016-09-20 19:58:26',
                'updated_at' => '2016-09-20 19:58:26',
            ),
            43 => 
            array (
                'id' => '48',
                'content_block_id' => '25',
                'locale' => 'vi_VN',
                'content' => 'Xác nhận đăng ký hoàn tất',
                'created_at' => '2016-09-20 19:58:40',
                'updated_at' => '2016-09-20 19:58:40',
            ),
        ));
        
        
    }
}
