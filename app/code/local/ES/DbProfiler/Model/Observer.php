<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21. 06. 2015
 * Time: 17:35
 */

class ES_DbProfiler_Model_Observer
{

    /**
     * @param $event
     * @throws Exception
     */
    public function controllerFrontSendResponseAfter($event)
    {

      //  die(Mage::getStoreConfig('admin/profiler_config/profiler_enabled'));

        if((int)Mage::getStoreConfig('admin/profiler_config/profiler_enabled') == 1 )
        {
            $con = Mage::getSingleton('core/resource')->getConnection('core_read');
            $prof = $con->getProfiler()->getQueryProfiles();

            $total_query_time = 0;
            $slow_running = array();
            $normal = array();

            foreach ($prof as $p) {
                /* @var $p Zend_Db_Profiler_Query */
                if ($p->getElapsedSecs() > 0.0009) {
                    $slow_running[] = $p;
                } else {
                    $normal[] = $p;
                }
                $total_query_time += $p->getElapsedSecs();
            }

            $long_queries = count($slow_running);
            $normal_queries = count($normal);
            $all_queries = $long_queries + $normal_queries;

            $server_request_time = $_SERVER['REQUEST_TIME_FLOAT'];
            $time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
            $url = Mage::app()->getRequest()->getOriginalRequest()->getRequestUri();

           // die(Mage::getStoreConfig('admin/profiler_config/profiler_treshold'));

            if($time * 1000 > (int)Mage::getStoreConfig('admin/profiler_config/profiler_treshold'))
            {
                $log = Mage::getModel('es_dbprofiler/log');

                $log->setRequestTime($server_request_time);
                $log->setRequestUri($url);
                $log->setRenderTime($time);
                $log->setSlowQueries($long_queries);
                $log->setQueryTime($total_query_time);
                $log->setAllQueries($all_queries);
                $log->save();

                if(Mage::getStoreConfig('admin/profiler_config/save_sql_queries') == 1)
                {
                    foreach ($slow_running as $s)
                    {
                        /* @var $s Zend_Db_Profiler_Query */
                        $query = Mage::getModel('es_dbprofiler/queries');
                        $query->setRequestId($log->getId());

                        $query->setQuery($s->getQuery());

                        $query->setExecutionTime($s->getElapsedSecs());

                        if(count($s->getQueryParams()) > 0)
                        {
                            $query->setQueryParams(print_r($s->getQueryParams(), true));
                        }
                        $query->save();
                    }
                }
            }
        }
    }

    const REGISTRY_KEY = "BS_PROFFILER_REG_KEY";
    public function controllerFrontInitBefore($event)
    {
        Mage::register(self::REGISTRY_KEY, microtime(true));
    }
}