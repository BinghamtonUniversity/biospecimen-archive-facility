<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <h1>Initial Application Form.</h1>
    <form class="form" enctype="multipart/form-data" method="post">
      <table class="table">
        <tr>
          <td colspan="1">
            Principal Investigator
          </td>
          <td colspan="1">
            <input type="textbox" id="fname" name="fname" placeholder="First Name"/>
          </td>
          <td colspan="1">
            <input type="textbox" id="fname" name="fname" placeholder="Last Name"/>
          </td>
          <td colspan="1">
            <input type="textbox" id="lanme" name="lanme" placeholder="Title"/>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Institution
          </td>
          <td colspan="3">
            <input type="textbox" id="institution" name="institution" />
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Contact Information
          </td>
          <td colspan="1">
            <input type="textbox" id="emailid" name="emailid" placeholder="emailid" />
          </td>
          <td colspan="1">
            <input type="textbox" id="" name="" placeholder="phone-number" />
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
            <textarea id="desc" name="desc" cols="100%" rows="6" ></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="1">
            Other Pertinent Information
          </td>
          <td colspan="3">
            <textarea id="otherDesc" name="otherDesc" cols="100%"></textarea>
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