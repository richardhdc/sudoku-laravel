<?php

namespace App;

use Exception;

class SudokuSolver 
{
    private $parent = '';
    private $position = '';
    private $childrow = '';
    
    private $groups = [];
    private $tmpgroups = [];
    
    public function __construct()
    {
        $this->generateGroups();
    }
    
    private function generateGroups()
    {
        //check inputs
        //horizontal
        $group = [];
        $horizontal = 1;
        $hcnt = 0;
        $vertical = 1;
        $vcnt = 0;
        $box = 1;
        $bcnt = 0;
        $bhcnt = 0;
        for ($i = 1; $i <= 81; $i++ ) {
            //horizontal
            if ($hcnt == 9) {
                $horizontal++;
                $hcnt = 0;
            }
            $group['h'.$horizontal][] = $i;
            $hcnt++;
            //vertical
            if ($vcnt == 9) {
                $vertical = 1;
                $vcnt = 0;
            }
            $group['v'.$vertical][] = $i;
            $vertical++;
            $vcnt++;
            //box
            if ($bhcnt == 9) {
                if (count($group['b'.$box]) != 9) {
                    $box = $box - 3;
                }
                $bhcnt = 0;
            }
            if ($bcnt == 3) {
                $box++;
                $bcnt = 0;
            }
            
            $group['b'.$box][] = $i;
            $bcnt++;
            $bhcnt++;
        }
        
        ksort($group);
        $this->groups = $group;
    }
    
    public function solve($data) 
    {
        $arr = [1,2,3,4,5,6,7,8,9];
        $solution = [];
        //set all valid input
        for ($i = 1; $i <= 81; $i++ ) {
            $solution[$i] = $arr;
            if ($data[$i] != null) {
                $solution[$i] = (int) $data[$i];
            }
        }
        
        $solution = $this->process($solution);
        if (!$this->checkIfDone($solution)) {
            $solution = $this->randomTest($solution);
        }
        return $solution;
    }
    
    private function process($solution)
    {
        $old = [];
        while($old != $solution) {
            $old = $solution;
            $solution = $this->setSingleArrayAsFinalValueToSolution($solution);
            $solution = $this->setUniqueValueToSolution($solution);
        }
        return $solution;
    }
    
    private function randomTest($solution) 
    {
        $tmpSolution = $solution;
        $i = 1;
        $randomFlag = true;
        while($randomFlag) {
            $i++; 
            if ($i > 5000) {
                //dd('exit');
            }
            $random = 0;
            $flag = false;
            $tmp2 = $tmpSolution; 
            $tmp2 = array_filter($tmp2, function($k) {
                return is_array($k);
            });
            if (count($tmp2)) {
                $random = array_rand($tmp2, 1);
                $pickRandomKey = array_rand($tmpSolution[$random], 1);
                $tmpSolution[$random] = (int) $tmpSolution[$random][$pickRandomKey];
                $tmpSolution = $this->process($tmpSolution);
            }
            
            if (!$this->check($tmpSolution)) {
                //dd($tmpSolution, "error");
                $tmpSolution = $solution;
            }
            
            if (!$this->checkIfDone($tmpSolution)) {
                $randomFlag = true;
            } else {
                return $tmpSolution;
            }
        }
    }
    
    private function checkIfDone($solution)
    {
        foreach($solution as $sol) {
            if (is_array($sol)) 
                return false;
        }
        return true;
    }
    
    public function setSingleArrayAsFinalValueToSolution($solution) 
    {
        $old = [];
        $j = 0;
        
        while ($old != $solution) {
            $old = $solution;
            $j++;
            $flag = false;
            for ($i = 1; $i <= 81; $i++ ) {
                if (is_integer($solution[$i])) {
                    foreach ($this->groups as $groupids) {
                        if (in_array($i, $groupids)) {
                            foreach ($groupids as $gid) {
                                if ($i != $gid && is_array($solution[$gid])) {
                                    $solution[$gid] = array_diff($solution[$gid], [$solution[$i]]);
                                    if (count($solution[$gid]) == 1) {
                                        $solution[$gid] = (int) current($solution[$gid]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $solution;
    }
    
    private function setUniqueValueToSolution($solution) 
    {
        //check unique value per group
        $i = 0;
        foreach ($this->groups as $groupids) {
            
            $i++;
            $tmpArr = [];
            $arrValues = [];
            $keys = [];
            foreach ($groupids as $groupKey => $gid) {
                if (is_array($solution[$gid])) {
                    $tmpArr = array_merge($tmpArr, $solution[$gid]);
                    $arrValues = array_count_values($tmpArr);
                }
            }
            $keys = array_filter($arrValues, function($l) {
                return $l == 1;
            });
            if (count($keys) > 0) {
                foreach ($keys as $key => $cnt) {
                    foreach ($groupids as $gid) {
                        if (is_array($solution[$gid]) && array_search($key, $solution[$gid])) {
                            $solution[$gid] = [$key];
                        }
                    }
                }
                break;
            }
            
        }
        return $solution;
    }
    
    public function check($data)
    {
        foreach ($data as $id => $x) {
            if ($x != null) {
                foreach ($this->groups as $gindex => $groupids) {
                    if (in_array($id, $groupids)) {
                        foreach ($groupids as $gid) {
                            if ($id != $gid) {
                                if ($data[$gid] == $x) {
                                    
                                    //dd($id, $gid, $x, $groupids, $data);
                                    return false;
                                }
                            }
                        }
                    }
                }
            } else {
                if (is_array($x) && count($x) == 0) {
                    return false;
                }
            }
        }
        return true;
    }
    
    
}