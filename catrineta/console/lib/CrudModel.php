<?php

/*
 * Copyright (C) 2017 Luis Pinto <luis.nestesitio@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Catrineta\console\lib;

use \Catrineta\console\crud\ParseLoop;
use \Catrineta\console\crud\CrudTools;
use \Catrineta\orm\ModelTools;

/**
 * Description of CrudModel
 *
 * @author Luís Pinto / luis.nestesitio@gmail.com
 * Created @Sep 8, 2017
 */
class CrudModel extends \Catrineta\console\crud\ModelCrud
{

    
    
    private $migrate = [];
    
    private $migrateFk = [];

    /**
     * Create model file
     * @param string $class The namespace class
     */
    public function modelFile($class)
    {
        $this->template = RESOURCES_DIR . 'scaffold' . DS . 'model' . DS . 'model.tpl';
        $this->file = MODEL_DIR . 'models' . DS . $this->classname . '.php';
        $this->migrate = ['new'=> $this->columns];
        $this->migrateFk['new'] = ModelTools::getReferencedConstraints($this->constraints, $this->table);
        if(count($this->migrateFk['new']) == 0){
            $this->migrateFk = [];
        }
        
        $writearr = ['className'=>$this->classname, 'dateCreated'=>date('Y-m-d H:i'), 
            'dateUpdated'=>'Updated @' . date('Y-m-d H:i') . ' with columns ' . implode(", ", $this->col_names)];
        
        if(is_file($this->file)){
            echo $this->file . ' for class ' . $class . " exists \n";
            $info = CrudTools::getClassInfo($class);
            $writearr['created'] = $info->getClassComment('Created @');
            $writearr['updated'] = implode("\n * ", $info->getLines('Updated @'));
            
            $this->migrate = $this->migrateFk = [];
            $update = ModelTools::isModelUpdated
                    ($info->getProperty('fields'), $this->columns);
            if($update != false){
                $this->migrate = $update;
                $this->migrateFk = ModelTools::hasConstraintsToChange($this->migrateFk, $update);
                $writearr['updated'] .= "\n * Updated @" . date('Y-m-d H:i') . ' with ' . $this->migrate['resume'];
                
            }
            
        }
        $this->string = CrudTools::copyFile($this->template, $this->file, $writearr);

    }
    
    public function crudInfos()
    {
        $this->string = str_replace('%$tableName%', $this->table, $this->string);
        $this->string = str_replace('%$tableColumns%', implode("', '", $this->col_names), $this->string);
        
        $primaryKeys = $uniqueKeys = $constants = [];
        $increment = 'null';
        foreach ($this->columns as $field){
            if($field['Key']=='PRI'){
                $primaryKeys[] = $field['Field'];
                if($field['Extra'] == 'auto_increment'){
                    $increment = "'" . $field['Field'] . "'";
                }
            }elseif($field['Key']=='UNI'){
                $uniqueKeys[] = $field['Field'];
            }elseif($field['Comment'] == 'to-string' || strpos($field['Type'],'varchar')===0 && $field['Key'] != 'MUL'){
                $this->string = str_replace('%$toString%', ModelTools::buildModelName($field['Field']), $this->string);
            }
            
            $constants[] = 'const ' . ModelTools::getFieldConstant($this->table, $field['Field']) . " = '" . $this->table . '.' . $field['Field'] . "';";
        }
        $this->string = str_replace('$this->get%$toString%()', '1', $this->string);
        $this->string = str_replace('%$primaryKeys%', implode("', '", $primaryKeys), $this->string);
        $this->string = str_replace('%$incrementKey%', $increment, $this->string);
        $this->string = str_replace('#%$fieldconstant%', implode("\n    ", $constants), $this->string);
        $this->string = str_replace('%$foreignKeys%', $this->getFKInfo(), $this->string);
        $this->string = str_replace('%$constraints%', $this->constraints(), $this->string);
        
        file_put_contents($this->file, $this->string);
    }
    
    private function getFKInfo()
    {
        $fks = [];
   
        foreach ($this->constraints as $constrain){
            
            if($constrain['CONSTRAINED'] == $this->table){
                //print_r($constrain);
                $fks[] = $constrain['COLUMN_NAME'];
            }
        }
        if(count($fks) > 0){
            return "'". implode("', '", $fks) . "'";
        }

        return '';
    }
    
    private function constraints()
    {
        $arr = [];
   
        foreach ($this->constraints as $constrain){
            
            if($constrain['CONSTRAINED'] == $this->table){
                //print_r($constrain);
                $arr[] = "'" . $constrain['COLUMN_NAME'] . "' => ["
                        . "'table'=>'" . $constrain['REFERENCED_TABLE_NAME'] . "', "
                        . "'field'=>'" . $constrain['REFERENCED_COLUMN_NAME'] . "'"
                        . "]";
            }
        }
        if(count($arr) > 0){
            return implode(', ', $arr);
        }
    }


    public function parseLoops()
    {
        $parse = new ParseLoop($this->string);
        $this->loopColumns($parse);
        $this->loopJoins($parse);
        
        file_put_contents($this->file, $parse->parseWhile());
    }
    
    public function loopColumns(ParseLoop $parse)
    {
        foreach($this->columns as $field){
            $parse->setData('columns', [
                'method' => ModelTools::buildModelName($field['Field']),
                'tableColumn'=> 'self::' . ModelTools::getFieldConstant($this->table, $field['Field'])
                ]);
        }
        
    }
    
    public function loopJoins(ParseLoop $parse)
    {
        foreach($this->constraints as $constrain){
            $parse->setData('joins', [
                'tableJoin'=>ModelTools::buildModelName($constrain['REFERENCED_TABLE_NAME']),
            ]);
        }
    }
    
    /**
     * 
     * @return array
     */
    public function getMigrate()
    {
        return $this->migrate;
    }
    
    /**
     * 
     * @return array
     */
    public function getMigrateFk()
    {
        return $this->migrateFk;
    }


    

}
