<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21. 06. 2015
 * Time: 17:34
 */ 
class ES_DbProfiler_Model_Resource_Queries_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('es_dbprofiler/queries');
    }

}