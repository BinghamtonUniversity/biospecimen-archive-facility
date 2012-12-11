<!DOCTYPE html>
<html>
  <head>
    <title>Biospecimen Archive Facility - Binghamton University</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <h1>Initial Application Form.</h1>
    <?php $errors = validation_errors(); 
    if(strlen($errors) > 0) {
    ?>
      <div class="well">
        <?=$errors?>
      </div>
    <?php 
    }
    ?>
    <?php
    $attributes = array('class' => 'form', 'id' => 'myform', 'method' => 'post');
    ?>
      <?=form_open_multipart('main', $attributes)?>
      <table class="table">
        <tr>
          <td colspan="1">
            Principal Investigator
          </td>
          <td colspan="1">
            <input type="textbox" id="fname" name="fname" placeholder="First Name" value="<?php echo set_value('fname', ''); ?>"/>
          </td>
          <td colspan="1">
            <input type="textbox" id="lname" name="lname" placeholder="Last Name" value="<?php echo set_value('lname', ''); ?>"/>
          </td>
          <td colspan="1">
            <input type="textbox" id="tname" name="tname" placeholder="Title" value="<?php echo set_value('tname', ''); ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Institution
          </td>
          <td colspan="3">
            <input type="textbox" id="institution" name="institution"  value="<?php echo set_value('institution', ''); ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Contact Information
          </td>
          <td colspan="1">
            <input type="textbox" id="emailid" name="emailid" placeholder="Email-ID"  value="<?php echo set_value('emailid', ''); ?>"/>
          </td>
          <td colspan="2">
            <input type="textbox" id="phno" name="phno" placeholder="Phone  number with area code"  value="<?php echo set_value('phno', ''); ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            CV of Principle Investigator
          </td>
          <td colspan="1">
            <input type="file" id="cvFile"/>
          </td>
          <td colspan="2">
            File Format (word or pdf)
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Research Synopsis
          </td>
          <td colspan="1">
            <input type="file" id="researchFile"/>
          </td>
          <td colspan="2">
            File Format (word or pdf)
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Breif Description of your Research Sample Needs (sample type,number,etc)
          </td>
          <td colspan="3">
            <textarea id="desc" name="desc" cols="100%" rows="6" ><?php echo set_value('desc', ''); ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Other Pertinent Information
          </td>
          <td colspan="3">
            <textarea id="otherDesc" name="otherDesc" cols="100%"><?php echo set_value('otherDesc', ''); ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <em>*Note: The Current fee is #9.72 per sample plus shipping.</em>
          </td>
          <td colspan="1">
            <button type="submit">Submit Application</button>
          </td>  
        </tr>
      </table>
    </form>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>