<?php
namespace App\Lib\Authors;

class Author{

    private int $_numAuthorId = 0;
    private string $_strAuthorName = "";
    private int $_numVoters = 0;

    public function getAuthorId():int
    {
        return $this->_numAuthorId;
    }

    public function setAuthorId(int $numAuthorId){
        $this->_numAuthorId = $numAuthorId;
    }

    public function getAuthorName():string
    {
        return $this->_strAuthorName;
    }

    public function setAuthorName(string $strAuthorName){
        $this->_strAuthorName = $strAuthorName;
    }

    public function getVoters():int
    {
        return $this->_numVoters;
    }

    public function setVoters(int $numVoters){
        $this->_numVoters = $numVoters;
    }


}
