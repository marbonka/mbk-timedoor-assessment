@extends('layouts.master-layout')

@section('content')

<style type="text/css">
    form#form-search > table, section#table-view > table {
        border: solid 1px black;
        margin: 20px auto;
    }

    section#table-view > table td{
        border: solid 1px black;
    }

    section#table-view > table td:first-child, section#table-view > table td:nth-child(n+3){
        text-align: center;
    }
</style>
<section id="show-title" style="text-align: center;">
    <h2>
        List of Books
    </h2>
</section>
<section id="form-section">
    <form id="form-search" action="/" method="GET">
        <table>
            <tr>
                <td>
                    <label for="limit">
                        List Shown
                    </label>
                </td>
                <td>
                    <span>:</span>
                </td>
                <td>
                    <select
                        id="limit"
                        name="limit"
                    >
                    @for($i=10;$i<=100;$i++)
                        <option value="{{$i}}" @selected($currentLimit == $i)>{{$i}}</option>
                    @endfor
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="search">
                        Search
                    </label>
                </td>
                <td>
                    <span>:</span>
                </td>
                <td>
                    <input
                        type="text"
                        id="search"
                        name="search"
                        value="{{$currentSearch}}"
                    >
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">
                    <input
                        type="submit"
                        id="submit"
                    >
                </td>
            </tr>
        </table>
    </form>
</section>
<section id="table-view">
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author Name</th>
            <th>Average Rating</th>
            <th>Voter</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($arrBooks))
            @foreach ($arrBooks as $oBook )
        <tr>
            <td>
                {{$loop->iteration}}
            </td>
            <td>
                {{$oBook->getBookName()}}
            </td>
            <td>
                {{$oBook->getCategoryName()}}
            </td>
            <td>
                {{$oBook->getAuthorName()}}
            </td>
            <td>
                {{$oBook->getAverageRating()}}
            </td>
            <td>
                {{$oBook->getVoters()}}
            </td>
        </tr>
            @endforeach
        @else
        <tr>
            <td colspan="6">No data could be displayed</td>
        </tr>
        @endif
    </tbody>
</table>
</section>
@endsection
