SIGNUP 
<br><br>

<form method="post" action="/user/signup">

    <input type="text" name="login" id="login"
    placeholder="Login"
    value="<?=isset($_SESSION['form_data']['login']) 
    ? h($_SESSION['form_data']['login']) : '' ;?>"><br>
    
    <input type="password" name="password" id="password"
    placeholder="Password"><br>
    
    <input type="text" name="email" id="email"
    placeholder="Email"
    value="<?=isset($_SESSION['form_data']['email']) 
    ? h($_SESSION['form_data']['email']) : '' ;?>"><br>
    
    <input type="text" name="name" id="name"
    placeholder="Name"
    value="<?=isset($_SESSION['form_data']['name']) 
    ? h($_SESSION['form_data']['name']) : '' ;?>"><br>

    <button type="submit">OK</button>
</form>
<?php if(isset($_SESSION['form_data']))
    unset($_SESSION['form_data']) ?>