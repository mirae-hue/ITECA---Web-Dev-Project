document.addEventListener("DOMContentLoaded", function () {
  const signUpButton = document.getElementById('signUpButton');
  const signInButton = document.getElementById('signInButton');
  const signInForm = document.getElementById('signIn');
  const signUpForm = document.getElementById('signup');

  function showSignUp() {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
  }

  function showSignIn() {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
  }

  if (signUpButton) signUpButton.addEventListener('click', showSignUp);
  if (signInButton) signInButton.addEventListener('click', showSignIn);

  const mode = new URLSearchParams(window.location.search).get('mode');
  console.log("Mode:", mode);

  if (mode === 'signUp') {
    showSignUp();
  } else if (mode === 'signIn') {
    showSignIn();
  } else {
    showSignIn();
  }

  const registered = new URLSearchParams(window.location.search).get('registered');
  if (registered === 'true') {
    alert("Registration successful! You can now sign in.");
  }
});
