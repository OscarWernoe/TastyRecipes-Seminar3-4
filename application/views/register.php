<div class="container text-center">
  <h2>Register</h2>
</div>
<div class="container">
  <p>Please fill this form to create an account.</p>
  <form action="<?=base_url('pages/register')?>" method="post">
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
    <div class="form-group <?php echo (!empty($this->session->flashdata('confirm_password_error'))) ? 'has-error' : ''; ?>">
      <label for="confirm_password">Confirm Password:<sup>*</sup></label>
      <input type="password" name="confirm_password" class="form-control" title="Confirm Password">
      <span class="help-block"><?php echo $this->session->flashdata('confirm_password_error'); ?></span>
    </div>
    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Submit">
      <input type="reset" class="btn btn-default" value="Reset">
    </div>
  </form>
</div>