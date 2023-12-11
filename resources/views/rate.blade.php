@extends('layouts.master-layout')

@section('content')
<script type="text/javascript">
    async function getAuthorOptions(objSelect){
        var objBookSelect = document.getElementById("book_name");
        var objInputRating = document.getElementById("rating");
        var objSubmit = document.getElementById("submit");

        objBookSelect.disabled = true;
        objInputRating.disabled = true;
        objSubmit.disabled = true;
        objBookSelect.innerHTML = "<option>Loading Book Names...</option>";

        await fetch('/api/book_by_author/'+objSelect.value).then(
            (response) => {
                return response.json();
            }
        ).then(
            (data) =>{
                var arrBooks = data.data;
                var numOptions = arrBooks.length;
                objBookSelect.innerHTML = "<option value='"+arrBooks[0].id+"' selected>"+arrBooks[0].book_name+"</option>";
                for(let i=1; i < numOptions; i++){
                    objBookSelect.innerHTML += "<option value='"+arrBooks[i].id+"'>"+arrBooks[i].book_name+"</option>";
                }
                objBookSelect.disabled = false;
                objInputRating.disabled = false;
                objSubmit.disabled = false;
            }
        );
    }
</script>
<h2 style="text-align: center;margin:20px auto">
    Insert Rating
</h2>
<section id="form-section">
    <form id="form-rating-input" action="/store-rating" method="POST">
        @csrf
        <table style="border: solid 1px black; margin: 20px auto;">
            <tr>
                <td>
                    <label for="author">
                        Book Author
                    </label>
                </td>
                <td>
                    <span>:</span>
                </td>
                <td>
                    <select
                        id="author"
                        name="author_id"
                        onchange="getAuthorOptions(this)"
                        style="width:100%"
                    >
                    @if(!empty($arrAuthors))
                        @foreach($arrAuthors as $oAuthor)
                            <option value="{{$oAuthor->getAuthorId()}}" @if($loop->first) selected @endif>{{$oAuthor->getAuthorName()}}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="book_name">
                        Book Name
                    </label>
                </td>
                <td>
                    <span>:</span>
                </td>
                <td>
                    <select
                        id="book_name"
                        name="book_name"
                        style="width:100%"
                    >
                    @if(!empty($arrFirstAuthorBooks))
                        @foreach($arrFirstAuthorBooks as $oBook)
                            <option value="{{$oBook->getBookId()}}" @if($loop->first) selected @endif>{{$oBook->getBookName()}}</option>
                        @endforeach
                    @endif
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="rating">
                        Rating Input
                    </label>
                </td>
                <td>
                    <span>:</span>
                </td>
                <td>
                     <input
                        type="number"
                        id="rating"
                        name="rating"
                        max=10
                        min=1
                        value=10
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
@endsection
