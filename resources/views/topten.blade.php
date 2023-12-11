@extends('layouts.master-layout')

@section('content')
<style>
    section#table-view table td{
        text-align: center;
    }
</style>
<section id="table-view">
    <div style="text-align: center;">
        <h2>
            Top 10 Most Famous Author
        </h2>
    </div>
    <table border="1" style="margin: 20px auto;">
        <thead>
            <tr>
                <th>No</th>
                <th>Author Name</th>
                <th>Voter</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($arrAuthors))
                @foreach ($arrAuthors as $oAuthor )
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$oAuthor->getAuthorName()}}
                    </td>
                    <td>
                        {{$oAuthor->getVoters()}}
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">No data could be displayed</td>
                </tr>
            @endif
        </tbody>
    </table>
</section>
@endsection
