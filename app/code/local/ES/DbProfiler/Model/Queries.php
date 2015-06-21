<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21. 06. 2015
 * Time: 17:34
 */ 


/**
 * @method int getEntityId()
 * @method ES_DbProfiler_Model_Queries setEntityId(int $value)
 * @method string getQuery()
 * @method ES_DbProfiler_Model_Queries setQuery(string $value)
 * @method string getQueryParams()
 * @method ES_DbProfiler_Model_Queries setQueryParams(string $value)
 * @method int getRequestId()
 * @method ES_DbProfiler_Model_Queries setRequestId(int $value)
 * @method float getExecutionTime()
 * @method ES_DbProfiler_Model_Queries setExecutionTime(float $value)
 */
class ES_DbProfiler_Model_Queries extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('es_dbprofiler/queries');
    }

}