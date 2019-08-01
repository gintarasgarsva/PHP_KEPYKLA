<?php
namespace App\Drinks;
use \App\App;
class Model
{
    private $table_name = 'drinks';
    public function __construct()
    {
        App::$db->createTable($this->table_name);
    }
    /** 2uzd turi irasyti $drink i duombaze
     * @param Drink $drink
     */
    public function insert(Drink $drink)
    {
        return App::$db->insertRow($this->table_name, $drink->getData());
    }
    /**
     * 3uzd
     * @param array $conditions
     * @return Drink[]
     */
    public function get($conditions = [])
    {
        $drinks = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
//            $drinks[] = new Drink($row_data);
            if ($row_data['abarot'] < 30){
              $drinks[] = new LightDrink($row_data); 
            }else{
              $drinks[] = new StrongDrink($row_data);  
            }
        }
        return $drinks;
    }
    /**
     * 4uzd
     * @param Drink $drink
     * @return bool
     */
    public function update(Drink $drink)
    {
        return App::$db->updateRow($this->table_name, $drink->getId(), $drink->getData());
    }
    /**
     * 5uzd
     * @param Drink $drink
     * @return bool
     */
    public function delete(Drink $drink)
    {
        return App::$db->deleteRow($this->table_name, $drink->getId());
    }
    public function __destruct()
    {
        App::$db->save();
    }
}
?>