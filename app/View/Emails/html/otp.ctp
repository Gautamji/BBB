<html>
<head>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div style="max-width:550px; min-width:320px;  background-color: white; border: 1px solid #DDDDDD; margin-right: auto; margin-left: auto;">
  <div style="margin-left:30px;margin-right:30px" >
   <div style="position: static;background-color: #109286;height: 50px;">
 <center>
<a href="www.bestbookbuddies.com"><img src="https://bestbookbuddies.com/theme/default/img/logo.png" height="59" width="50" style=" width: 160px;
    height: 26px;margin-top:10px;"></a></center>
</div>


    <hr style="margin-bottom:65px;border:none;border-bottom:1px solid red"/>
    <h1 style="font-family: Tahoma, Geneva, sans-serif; font-weight: normal; color: #2A2A2A; text-align: center; margin-bottom: 65px;font-size: 20px; letter-spacing: 6px;font-weight: normal; border: 2px solid black; padding: 15px;">Verify Your Registration</h1>
    <h3 style="font-family:Palatino Linotype, Book Antiqua, Palatino, serif;font-style:italic;font-weight:500"></span> Hello <?= $fname ?>, <b></b></h3>
    <p style="font-family:Palatino Linotype, Book Antiqua, Palatino, serif;font-size: 15px; margin-left: auto; margin-right: auto; text-align: justify;color: #666;line-height:1.5;margin-bottom:75px">We thank you for applying for registration of your library on our platform.
        This is as per <a href="<?php echo FULL_BASE_URL .$this->request->base."/files/Terms_and_Condition.pdf";?>" download>agreed terms and conditions</a>
        Please click on link given below to verify your registration. The link is valid only for one-time use.<br><br>
        Your link is : <a href="<?php echo FULL_BASE_URL .$this->request->base;//FULL_BASE_URL . $request->base?>/validate_email?token=<?= $token ?>"><?php echo FULL_BASE_URL .$this->request->base;//FULL_BASE_URL . $request->base?>/validate_email?token=<?= $token; ?></a><br> Please click on this link to verify your registration.<br>
        Clicking this link will verify your registration and start the process of implementing the library for you.
    <br>
    BestBookBuddies.com</p>
    <table style="width:100%;">
      <th>
        <td style="width:25%"></td>
        <center><td style="background-color:black;with:50%;text-align:center;padding:15px"><a href="bestbookbuddies.com" style="margin-left: auto; margin-right: auto;text-decoration:none;color: white;text-align:center;font-family:Courier New, Courier, monospace;font-weight:600;letter-spacing:2px;background-color:black;padding:15px">Visit</a></td></center>
        <td style="width:25%"></td>
      </th>
    </table>

    <hr style="margin-top:10px;margin-top:75px"/>
    <center>
      <a href="https://www.facebook.com/bestbookbuddies"><img src="https://bestbookbuddies.com/img/facebook.png" height="42" width="42"></a>
    <a href="https://www.linkedin.com/company/bestbookbuddies"><img src="https://bestbookbuddies.com/img/linkedin.png" height="42" width="42"></a>
    <a href="https://www.youtube.com/channel/UCqaRhYUYSJFK4zV6haM7xog"><img src="https://bestbookbuddies.com/img/youtube.png" height="42" width="42"></a>
    <a href="https://www.twitter.com/bestbookbuddies"><img src="https://bestbookbuddies.com/img/twitter.png" height="42" width="42"></a>   </center>
    <p>&nbsp;</p>
  </div>
</div>
</body>
</html>
