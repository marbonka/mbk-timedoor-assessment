<?php

namespace App\Http\Controllers;

use App\Lib\Authors\AuthorsManager;
use App\Lib\Books\BooksManager;
use App\Models\Rating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function show(Request $request){
        $arrBooks = null;
        $bIsValidated = false;
        $numLimit = 10;
        $strSearch = null;
        $arrFailedReasons = [];
        try{
            $request->validate([
                'limit' => 'integer|numeric|between:10,100',
                'search' => 'nullable|string'
            ]);
            $bIsValidated = true;
            $numLimit = empty($request->get('limit')) ? 10 : $request->get('limit');
            $strSearch = empty($request->get('search')) ? '' : $request->get('search');
        }
        catch(ValidationException $oValidationException){
            $arrFailedReasons["input"] = true;
        }

        try{
            $arrBooks = BooksManager::getBooksTableData($numLimit,$strSearch);
        }
        catch (Exception $oException){
            $arrFailedReasons["retrieval"] = true;
        }

        $arrDataView = [
            'strPageTitle' => "Book List View - Timedoor - Marcel Assessment",
            'navSelected' => '/',
            'arrBooks' => $arrBooks,
            'currentLimit' => $numLimit,
            'currentSearch' => $strSearch
        ];

        if(!empty($arrFailedReasons)) $arrDataView["arrFailedReasons"] = $arrFailedReasons;

        return view('show',$arrDataView);
    }

    public function showAuthors(Request $request){
        $arrFailedReasons = [];
        $arrAuthors = [];
        try{
            $arrAuthors = AuthorsManager::getTopTenAuthors();
        }
        catch(Exception $oException){
            $arrFailedReasons['retrieval'] = true;
        }
        $arrDataView = [
            'strPageTitle' => "Top Ten Authors - Timedoor - Marcel Assessment",
            'navSelected' => '/top-ten',
            'arrAuthors' => $arrAuthors,
            'arrFailedReasons' => $arrFailedReasons
        ];
        return view('topten',$arrDataView);
    }

    public function showRatings(Request $request){
        $arrAuthors = [];
        $arrFailedReasons = [];
        try{
            $arrAuthors = AuthorsManager::getAllAuthors();
            $arrFirstAuthorBooks = BooksManager::getBookByAuthorId($arrAuthors[0]->getAuthorId());
        }
        catch(Exception $oException){
            $arrFailedReasons['retrieval'] = true;
        }
        $arrDataView = [
            'strPageTitle' => "Input Rating - Timedoor - Marcel Assessment",
            'navSelected' => '/rate',
            'arrAuthors' => $arrAuthors,
            'arrFailedReasons' => $arrFailedReasons,
            'arrFirstAuthorBooks' => $arrFirstAuthorBooks
        ];
        return view('rate',$arrDataView);
    }

    public function storeRating(Request $request){
        $bIsValidated = false;
        $arrStatus = [];
        $numBookId = null;
        $numRatingValue = null;
        try{
            $request->validate([
                'book_name' => 'required|exists:App\Models\Book,id',
                'rating' => 'integer|numeric|between:1,10'
            ]);
            $bIsValidated = true;
            $numBookId = $request->get('book_name');
            $numRatingValue = $request->get('rating');
        }
        catch(ValidationException $oValidationException){
            $arrStatus['status'] = false;
        }

        $arrStatus['validation'] = $bIsValidated;
        $arrStatus['storing'] = false;

        if($bIsValidated){
            try{
                $oRating = new Rating();
                $oRating->book_id = $numBookId;
                $oRating->rating_value = $numRatingValue;
                $oRating->save();
                $arrStatus['storing'] = true;
                $arrStatus['status'] = true;
            }
            catch(Exception $oException){
                $arrStatus['storing'] = false;
                $arrStatus['status'] = false;
            }
        }
        session()->flash('post_status',$arrStatus);
        return redirect('/');
    }
}
