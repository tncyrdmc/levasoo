
<div class="boxlogin">
    <br/>
    <div class="boxtitle">
      NUOVO CONSULENTE
    </div>

    <div class="formlogin">
        <div class="boxtitle boxsponsor">
          Sponsor: <img src="{SNIPPET::avatar}" class="avatar img_36_36" /> {SNIPPET::sponsor}  
        </div>
        <form id="frmNewUser" name="Login" action="<?php echo UriDispatch::getFullUri("user/usersave");?>" method="POST">
          <input type="hidden" name="parent" value="{SNIPPET::parent}" />
          <p>
              * Nome:<br/>
              <input type="text" name="nome" value="" size="40" class="login required"/>
          </p>
          <p>
              * Cognome:<br/>
              <input type="text" name="cognome" value="" size="40" class="login required"/>
          </p>
          <p>
              * Email:<br/>
              <input type="text" name="email" value="" size="40" class="login required"/>
          </p>
          <p>
              * Username:<br/>
              <input type="text" name="username" value="" size="40" class="login required"/>
          </p>
          <p>
              * Password:<br/>
              <input type="password" name="password" value="" size="40" class="login required"/>
          </p>
          <input type="submit" value="Salva" name="salva" class="button" onclick="return validateAll($('#frmNewUser'),'.login.required');" />
      </form>
    </div>
</div>
