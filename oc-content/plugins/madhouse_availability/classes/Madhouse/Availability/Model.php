<?php
    class Madhouse_Availability_Model extends DAO
    {

        private static $instance ;
        
        private $mSearch;
        private $hasConditions;
        
        private $vSearch;
        private $duration;

        public static function newInstance()
        {
            if( !self::$instance instanceof self ) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        /**
         * Construct
         */
        function __construct()
        {
            parent::__construct();
            $this->setTableName('t_item_availability');
            $this->setFields( 
            array(
                'fk_i_item_id',
                'd_start',
                'd_end'
            ));
            $this->setPrimaryKey('fk_i_item_id');
            
            $this->mSearch       = Search::newInstance();
            
            $this->vSearch       = array();
            $this->duration      = 
            $this->hasConditions = false;
        }
        
        public function setVal($name, $val, $condition = '=') {
            if ($val != '') {
                $a = array('name' => $name,'val' => $val, 'condition' => $condition);
                array_push($this->vSearch, $a);
                $this->hasConditions = true;
            }
        }

        /**
         * Set min duration in days
         */
        public function setDurationMin($val) {
            if ($val != '') {
                $this->duration = $val;
                $this->hasConditions = true;
            }
        }
        
        private function _addConditions()
        {   
            $dao = $this;
            $this->mSearch->addConditions(array_map(function ($v) use ($dao) {
                if (is_numeric($v['val'])) {
                    return sprintf("%s.%s %s %d", $dao->getTableName(), $v['name'], $v['condition'], $v['val']);
                } else if ( $v['val'] == "true" || $v['val'] == "false") {
                    return sprintf("%s.%s %s %s", $dao->getTableName(), $v['name'], $v['condition'], $v['val']);
                } else {
                    return sprintf("%s.%s %s '%s'", $dao->getTableName(), $v['name'], $v['condition'], $v['val']);
                }
            }, $this->vSearch));
            
            if ($this->duration != "") {
                $this->mSearch->addConditions(sprintf("(%s.d_end >= date_add(%s.d_start, INTERVAL %s DAY) OR %s.d_end IS NULL)", $dao->getTableName(), $dao->getTableName(), $this->duration, $dao->getTableName()));
            }
        }
        
        /**
         * Make the SQL for the search with all the conditions and filters specified
         *
         * @access private
         * @since unknown
         */
        public function addSQL()
        {
            if($this->hasConditions) {
                $this->mSearch->addJoinTable($this->getTableName(),
                    $this->getTableName(),
                    sprintf("%st_item.pk_i_id = %s.fk_i_item_id ", DB_TABLE_PREFIX , $this->getTableName(), $this->getTableName()),
                    'INNER'
                );
                $this->_addConditions();
            }
        }
    }
?>