<div class="container text-center">
  <h2>Sign in</h2>
</div>
<div class="container">
  <p>Please fill in your credentials to sign in.</p>
  <form>
    <div class="form-group <?php echo (!empty($this->session->flashdata('username_error'))) ? 'has-error' : ''; ?>">
      <label for="username">Username:<sup>*</sup></label>
      <input type="text" name="username" class="form-control" title="Username">
      <span class="help-block"><?php echo $this->session->flashdata('username_error'); ?></span>
    </div>
    <div class="form-group <?php echo (!empty($this->session->flashdata('password_error'))) ? 'has-error' : ''; ?>">
      <label for="password">Password:<sup>*</sup></label>
      <input type="password" name="password" class="form-control" title="Password">
      <span class="help-block"><?php echo $this->session->flashdata('password_error'); ?></span>
    </div>
    <div class="form-group">
      <input id="sign-in" type="submit" class="btn btn-primary" value="Submit">
    </div>
  </form>
</div>