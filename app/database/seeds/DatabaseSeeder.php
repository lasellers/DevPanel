<?php
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Eloquent::unguard();
      $this->call('DoSeeder');
    }
  }
  //
  class DoSeeder extends Seeder
  {
    public function run()
    {

  }
}
}
?>