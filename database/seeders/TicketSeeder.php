<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use DateTime;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en_US');

        $category = [
            'hardware' => ['pc', 'printer'],
            'software' => ['os','apps','email'],
            'network' => ['connectivity', 'security'],
            'accountaccess' => ['useraccount', 'ecloud','networkaccessright'],
            'newuser' => ['createaccount'],
            'userreplacement' => ['userlocation'],
        ];
        $status = ['pending', 'inprogress', 'resolved', 'closed'];
        $priority = ['low', 'medium', 'high', 'critical'];
        $type = ['incident', 'servicerequest', 'changerequest'];
        $owner_id = [4,5,6,7,8];
        $responsible_id = [2,3];
        $number_strings = [];

        // Define the start and end dates
        $startDate = new DateTime('2024-01-01');
        $endDate = new DateTime('2024-6-31');

        // Get the timestamps for the start and end dates
        $startTimestamp = $startDate->getTimestamp();
        $endTimestamp = $endDate->getTimestamp();

        // Seed the tickets
        for ($i = 0; $i < 50; $i++) {
            // Generate a random timestamp between the start and end dates
            $randomTimestamp = mt_rand($startTimestamp, $endTimestamp);

            // Create a DateTime object from the random timestamp
            $randomDate = (new DateTime())->setTimestamp($randomTimestamp);
            // Format the dates to use in the database
            $formattedCreatedDate = $randomDate->format('Y-m-d H:i:s');

            // Generate a random number of days between 0 and 10
            $randomDays = mt_rand(0, 3);
            $updatedDate = $randomDate->modify("+{$randomDays} days");
            $formattedUpdatedDate = $updatedDate->format('Y-m-d H:i:s');

            $randomDays = mt_rand(0, 3);
            $closedDate = $updatedDate->modify("+{$randomDays} days");
            $formattedClosedDate = $closedDate->format('Y-m-d H:i:s');

            $randomStatus = $status[array_rand($status)];
            $randompriority = $priority[array_rand($priority)];
            $randomType = $type[array_rand($type)];
            $randomOwner_id = $owner_id[array_rand($owner_id)];
            $randomResponsible_id = $responsible_id[array_rand($responsible_id)];

            $number_strings[] = str_pad($i, 4, '0', STR_PAD_LEFT);

                // Get a random parent key
                $random_category = array_rand($category);
                
                // Get the subset for the selected parent key
                $subset = $category[$random_category];
                
                // Get a random child from the subset
                $random_subcategory = $subset[array_rand($subset)];

            DB::table('tickets')->insert(
                array(
                    'title' => $faker->sentence(3),
                    'content' => '<p>'.$faker->paragraph(2).'</p>',
                    'status' => $randomStatus,
                    'priority' => $randompriority,
                    'owner_id' => $randomOwner_id,
                    'responsible_id' => $randomResponsible_id,
                    'type' => $randomType,
                    'number' => $number_strings[$i],
                    'category' => $random_category,
                    'subcategory' => $random_subcategory,
                    'created_at' => $formattedCreatedDate,
                    'inprogress_at' => $formattedUpdatedDate,
                    'closed_at' => $formattedClosedDate,
                    'updated_at' => new \DateTime,
                )
            );
        }

        
        // Select a random string value
        

        // DB::table('tickets')->insert(
        //     array(
        //         'title' => 'Mouse rosak',
        //         'content' => '<p>Tikus ni asyik lari je</p>',
        //         'status' => 'resolved',
        //         'priority' => 'low',
        //         'owner_id' => 4,
        //         'responsible_id' => 2,
        //         'type' => 'Service Request',
        //         'number' => '0000',
        //         'category' => 'hardware',
        //         'subcategory' => 'pc',
        //         'created_at' => $formattedDate1,
        //         'updated_at' => new \DateTime,
        //     )
        // );
        
    }
}
