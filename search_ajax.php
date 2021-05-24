<?php
$searchForm =
'<div class="container">
    <div class="formbox">
        <div class="header">
            <h2>Bikt.se</h2>    
        </div>

        <!-- WELCOME MESSAGE -->
        <div class="paragraf">
            <p1 id="p-welcome"><i>Behöver du lätta på ditt hjärta?<br>Bikta dig anonymt online</i></p1>";
        </div>

        <div class="header">
            <h4>Sök poster</h4>    
        </div>

        <form class="form" id="form-search" name="form-search" onsubmit="checkLoginInput();" action="search_process.php" method="POST">
                                
            <div class="form-control">
            <label>Sökord</label>
            <input type="text" placeholder="ord..." name="search_text" id="search_text" autocomplete="off">
            <small>Error message</small>
            </div>
            
            <button type="submit" name="search" id="search">Sök</button>
                                   
        </form>
    </div>
</div>';

echo $searchForm;
?>