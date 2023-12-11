<style type="text/css">
    nav#top-menu{
        display: flex;
        width: 100%;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    nav#top-menu > a{
        min-width: 200px;
        max-width: min-content;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
        background-color:cornsilk;
        color: black;
        padding: 10px 0px;
    }

    nav#top-menu > a.selected{
        background-color:gainsboro;
        cursor: crosshair;
    }

</style>
<nav id="top-menu">
    <a href="/" @class(['selected'=>$navSelected == '/'])>List of Books</a>
    <a href="/top-ten" @class(['selected'=>$navSelected == '/top-ten'])>Top 10 Authors</a>
    <a href="/rate" @class(['selected'=>$navSelected == '/rate'])>Input Rating</a>
</nav>
<section id="notification" style="text-align: center; margin:20px auto;">
    @if(session()->has('post_status'))
    <table style="text-align: center; margin:20px auto;">
        <?php
            $arrStatus = session("post_status");
            $bgColor = $arrStatus["status"] ? "green" : "red";
            $strChar = $arrStatus["status"] ? "Yes" : "No";
            $strMessage = $arrStatus["status"] ? "Rating Value successfully saved" : ($arrStatus["validation"] ? "Unexpeced error when validating rating value input occured": "Unexpeced error when saving rating value input occured");
        ?>
        <tr>
            <td style="padding:10px 10px;font-family:sans-serif;background-color:{{$bgColor}}; min-width:30px; text-align:center; color:white; font-weight:700;">{{$strChar}}</td>
            <td>{{$strMessage}}</td>
        </tr>
    </table>
    @endif
</section>
