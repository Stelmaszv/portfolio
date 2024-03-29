<?php
use CoreMain\sql;
trait singletonCreate {
    static function create($data=false) {
        static $instances = array();
        $calledClass = get_called_class();
        if (!isset($instances[$calledClass])) {
            $instances[$calledClass] = new $calledClass($data);
        }
        return $instances[$calledClass];
    }
}
trait faindTableT {
    function faindTable($table){
        $sql= new sql();
        $tableList=$sql->SqlloopAll('SHOW tables');
        foreach ($tableList as $el){
            if($el['Tables_in_'.config['dbname']]==$table){
                return true;
            }
        }
        return false;
    }
}
trait className{
    function classname(){
        return (new \ReflectionClass($this))->getShortName();
    }
}