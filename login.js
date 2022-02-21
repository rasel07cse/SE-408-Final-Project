document.getElementById('login-button').addEventListener('click',function(){
   const email= document.getElementById('email-field').value;
   let pass= document.getElementById('pass-field').value;

   if(email='rasel@gmail.com'){
    window.location.href='welcome.php';
   }

})