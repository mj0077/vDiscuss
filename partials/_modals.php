<!-- login modal here -->
<div class="modal fade" id="loginModal" aria-hidden="true" aria-labelledby="loginModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalToggleLabel">Log In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- LOGIN form here -->
      <div class="container modal-body">
        <form action="partials/_handlelogin.php" method="POST">
          <div class="mb-3">
            <label for="loginemail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="loginpass" class="form-label">Password</label>
            <input type="password" class="form-control" id="loginpass" name="loginpass">
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
      <p class="mx-3">Don't have an account yet?</p> 
        <button class="btn btn-success" data-bs-target="#signupModal" data-bs-toggle="modal" data-bs-dismiss="modal">Sign Up</button>
      </div>
    </div>
  </div>
</div>
<!-- signup modal here -->
<div class="modal fade" id="signupModal" aria-hidden="true" aria-labelledby="signupModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalToggleLabel">Sign Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Signup form here -->
      <div class="container modal-body">
        <form action="partials/_handlesignup.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" maxlength="16" id="username" name="username" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Username should be less than 16 characters.</div>
          </div>
          <div class="mb-3">
            <label for="signupemail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupemail" name="signupemail" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="signuppass" class="form-label">Password</label>
            <input type="password" class="form-control" id="signuppass" name="signuppass">
          </div>
          <div class="mb-3">
            <label for="signupcpass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="signupcpass" name="signupcpass">
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
      <p class="mx-3">Already registered with us?</p>
        <button class="btn btn-success" data-bs-target="#loginModal" data-bs-toggle="modal" data-bs-dismiss="modal">Log in</button>
      </div>
    </div>
  </div>
</div>
<!-- logout modal here -->
<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Log out?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to logout?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
        <a href="partials/_handlelogout.php" type="button" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div>
</div>