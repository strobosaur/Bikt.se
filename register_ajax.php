<?php
$register_form =
    '<div class="container">
        <div class="formbox">
    
            <div class="header">
                <h2>Registrering</h2>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_process.php" method="POST">
                
                <div class="form-control">
                <label>Förnamn</label>
                <input type="text" placeholder="förnamn..." name="fname" id="fname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Efternamn</label>
                <input type="text" placeholder="efternamn..." name="lname" id="lname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Nickname</label>
                <input type="text" placeholder="nickname..." name="nname" id="nname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>E-post</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Lösenord</label>
                <input type="password" placeholder="lösenord..." name="password1" id="password1">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Bekräfta lösenord</label>
                <input type="password" placeholder="lösenord..." name="password2" id="password2">
                <small>Error message</small>
                </div>
                
                <button type="submit" name="submit" id="submit">Registrera</button>

                <?php
                    include_once "register_errors.php";
                ?>
                
            </form>
        </div>
    </div>';
    echo $register_form;
?>