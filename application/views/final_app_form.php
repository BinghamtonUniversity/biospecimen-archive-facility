<!DOCTYPE html>
<html>
  <head>
    <title>Biospecimen Archive Facility - Binghamton University</title>
    <!-- Bootstrap -->
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <h1>Final Application Form.</h1>
    <em>(<u>REMINDER</u>: In addtion to the form submissions, an IRB letter of approval and an MTA must be completed/recieved)</em>
    <br>
    <?php 
    $errors = validation_errors(); 
    if(strlen($errors) > 0) {
    ?>
      <div class="well">
        <?=$errors?>
      </div>
    <?php 
    }
    ?>
    <?php
    $attributes = array('class' => 'form', 'id' => 'my_final_form', 'method' => 'post');
    ?>
      <?=form_open('main/final_application', $attributes)?>
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
            Funding Information
          </td>
          <td colspan="1">
            <input type="textbox" id="fundingsource" name="fundingsource" placeholder="Funding-Source"  value="<?php echo set_value('fundingsource', ''); ?>"/>
          </td>
          <td colspan="2">
            <input type="textbox" id="fundingAmountDuration" name="fundingAmountDuration" placeholder="Funding Amount/Duration"  value="<?php echo set_value('fundingAmountDuration', ''); ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Shipping Information
          </td>
          <td colspan="3">
                <input type="textbox" style="width:100%;" id="address1" name="address1" placeholder="Street Address or P.O.Box, City" value="<?php echo set_value('address1', ''); ?>"/><br/>
                <input type="textbox" style="width:100%;" id="address2" name="address2" placeholder="State/Province | Zip Code | Country" value="<?php echo set_value('address2', ''); ?>"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Other Information
          </td>
          <td colspan="2">
            <textarea id="otherDesc" style="width:100%;" name="otherDesc" cols="100%"><?php echo set_value('otherDesc', ''); ?></textarea>
          </td>
          <td colspan="1">
            <button type="submit">Submit Application</button>
          </td>  
        </tr>
      </table>
    </form>
    <script src="<?=base_url()?>js/jquery.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
  </body>
</html>