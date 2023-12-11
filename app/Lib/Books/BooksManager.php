<?php
namespace App\Lib\Books;

use App\Models\Book as BookModel;
use Exception;

class BooksManager{

    public static function getBooksTableData($numLimit = 10, $strSearch=null){
        $arrBooks = [];

        $books = BookModel::withCount('ratings as ratings_count')
            ->withAvg('ratings as ratings_average','rating_value')
            ->withAggregate('category as category_name','category_name')
            ->withAggregate('author as author_name','author_name')
            ->limit($numLimit)
            ->orderByDesc('ratings_average')
            ->orderByDesc('ratings_count');
        if(!empty($strSearch)){
            $strSearch = strtolower(strip_tags($strSearch));
            $books = $books
            ->whereRaw("LOWER(book_name) LIKE '%".$strSearch."%'")
            ->orWhereHas("author",function($query) use (&$strSearch){
                $query->whereRaw("LOWER(author_name) LIKE '%".strtolower($strSearch)."%'");
            });
        }
        $books = $books->get()->toArray();


        foreach($books as $book){
            $oBook = new Book();
            $oBook->setBookId($book['id']);
            $oBook->setBookName($book['book_name']);
            $oBook->setAuthorName($book['author_name']);
            $oBook->setCategoryName($book['category_name']);
            $oBook->setAverageRating($book['ratings_average']);
            $oBook->setVoters($book['ratings_count']);
            $arrBooks[] = $oBook;
        }
        return $arrBooks;
    }

    public static function getBookByAuthorId(int $numAuthorId){
        $arrBooks = [];

        $books = BookModel::with('author')->whereHas('author',function($query) use(&$numAuthorId){
            $query->where('id','=',$numAuthorId);
        })->orderBy('book_name','ASC')->get()->toArray();

        foreach($books as $book){
            $oBook = new Book();
            $oBook->setBookId($book['id']);
            $oBook->setBookName($book['book_name']);
            $arrBooks[] = $oBook;
        }
        return $arrBooks;
    }
}
