<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21. 06. 2015
 * Time: 17:33
 */ 

/**
 * @method int getEntityId()
 * @method ES_DbProfiler_Model_Log setEntityId(int $value)
 * @method string getRequestTime()
 * @method ES_DbProfiler_Model_Log setRequestTime(string $value)
 * @method float getRenderTime()
 * @method ES_DbProfiler_Model_Log setRenderTime(float $value)
 * @method float getQueryTime()
 * @method ES_DbProfiler_Model_Log setQueryTime(float $value)
 * @method int getSlowQueries()
 * @method ES_DbProfiler_Model_Log setSlowQueries(int $value)
 * @method int getAllQueries()
 * @method ES_DbProfiler_Model_Log setAllQueries(int $value)
 * @method string getRequestUri()
 * @method ES_DbProfiler_Model_Log setRequestUri(string $value)
 */
class ES_DbProfiler_Model_Log extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('es_dbprofiler/log');
    }

}