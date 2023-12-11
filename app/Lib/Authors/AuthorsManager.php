<?php
namespace App\Lib\Authors;

use App\Models\Author as AuthorModel;
use Exception;

class AuthorsManager{
    public static function getTopTenAuthors(){
        $arrAuthors = [];
        $authors = AuthorModel::
            leftJoin("books","books.author_id","=","authors.id")
            ->leftJoin("ratings","books.id","=","ratings.book_id")
            ->limit(10)
            ->withCount(['ratings as voters' => function($query){
                $query->distinct()->where("rating_value",">",5);
            }])
            ->groupBy('authors.id','authors.author_name')
            ->orderByDesc('voters')
            ->limit(10)
            ->get()
            ->toArray();

        foreach($authors as $author){
            $oAuthor = new Author();
            $oAuthor->setAuthorId($author['id']);
            $oAuthor->setAuthorName($author['author_name']);
            $oAuthor->setVoters($author['voters']);
            $arrAuthors[] = $oAuthor;
        }
        return $arrAuthors;
    }

    public static function getAllAuthors(){
        $arrAuthors = [];
        $authors = AuthorModel::orderBy('author_name','ASC')->get()->toArray();
        foreach($authors as $author){
            $oAuthor = new Author();
            $oAuthor->setAuthorId($author["id"]);
            $oAuthor->setAuthorName($author["author_name"]);
            $arrAuthors[] = $oAuthor;
        }
        return $arrAuthors;
    }
}
