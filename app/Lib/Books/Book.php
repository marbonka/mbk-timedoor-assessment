<?php
namespace App\Lib\Books;

use Illuminate\Support\Arr;

class Book{

    private int $_numBookId = 0;
    private string $_strBookName = "";
    private string $_strCategoryName = "";
    private string $_strAuthorName = "";
    private float $_numAverageRating = 0;
    private int $_numVoters = 0;

    /**
     * @return string Name of the book getter
     */
    public function getBookName():string
    {
        return $this->_strBookName;
    }

    /**
     * @param  string $strBookName L Name of the book setter
     */
    public function setBookName(string $strBookName){
        $this->_strBookName = $strBookName;
    }

    /**
     * @return string Name of the book's author getter
     */
    public function getAuthorName():string
    {
        return $this->_strAuthorName;
    }

    /**
     * @param  string $strAuthorName : Name of the book's author setter
     */
    public function setAuthorName(string $strAuthorName){
        $this->_strAuthorName = $strAuthorName;
    }

    /**
     * @return string Name of the book's category getter
     */
    public function getCategoryName():string
    {
        return $this->_strCategoryName;
    }

    /**
     * @param  string $strCategoryName : Name of the book's category setter
     */
    public function setCategoryName(string $strCategoryName){
        $this->_strCategoryName = $strCategoryName;
    }

    /**
     * @return float Average rating of the book getter
     */
    public function getAverageRating():float
    {
        return $this->_numAverageRating;
    }

    /**
     * @param float $numAverageRating : Average rating of the book setter
     */
    public function setAverageRating(float $numAverageRating){
        $this->_numAverageRating = floatval(number_format($numAverageRating,2));
    }

    /**
     * @return int Voter count of the book getter
     */
    public function getVoters():int
    {
        return $this->_numVoters;
    }

    /**
     * @param float $numVoters : Voter count of the book setter
     */
    public function setVoters(int $numVoters){
        $this->_numVoters = $numVoters;
    }

    /**
     * @return int ID of the book getter
     */
    public function getBookId():int
    {
        return $this->_numBookId;
    }

    /**
     * @param float $numBookId : ID of the book setter
     */
    public function setBookId(int $numBookId){
        $this->_numBookId = $numBookId;
    }
}
