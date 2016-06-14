<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>JVC - Email Konfirmasi reset password</title>
    <!-- Designed by https://github.com/kaytcat -->
    <!-- Header image designed by Freepik.com -->

    <style type="text/css">
    /* Take care of image borders and formatting */

    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important; }
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass {width:100%;}
    .backgroundTable {margin:0 auto; padding:0; width:100%;!important;}
    table td {border-collapse: collapse;}
    .ExternalClass * {line-height: 115%;}


    /* General styling */

    td {
      font-family: Arial, sans-serif;
      color: #5e5e5e;
      font-size: 16px;
      text-align: left;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #5e5e5e;
      font-weight: 400;
      font-size: 16px;
    }


    h1 {
      margin: 10px 0;
    }

    a {
      color: #2b934f;
      text-decoration: none;
    }


    .body-padding {
      padding: 0 75px;
    }


    .force-full-width {
      width: 100% !important;
    }

    .icons {
      text-align: right;
      padding-right: 30px;
    }

    .logo {
      text-align: left;
      padding-left: 30px;
    }

    .computer-image {
      padding-left: 30px;
    }

    .header-text {
      text-align: left;
      padding-right: 30px;
      padding-left: 20px;
    }

    .header {
      color: #232925;
      font-size: 24px;
    }



    </style>

    <style type="text/css" media="screen">
        @media screen {
          @import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700);
          /* Thanks Outlook 2013! */
          * {
            font-family: 'PT Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
      /* Mobile styles */
      @media only screen and (max-width: 599px) {

        table[class*="w320"] {
          width: 320px !important;
        }

        td[class*="icons"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="logo"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="computer-image"] {
          display: block !important;
          width: 230px !important;
          padding: 0 45px !important;
          border-bottom: 1px solid #e3e3e3 !important;
        }


        td[class*="header-text"] {
          display: block !important;
          text-align: center !important;
          padding: 0 25px!important;
          padding-bottom: 25px !important;
        }

        *[class*="mobile-hide"] {
          display: none !important;
          width: 0 !important;
          height: 0 !important;
          line-height: 0 !important;
          font-size: 0 !important;
        }


      }
    </style>
  </head>
  <body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" style="background-color:#ffffff" width="100%">

      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

              <table class="force-full-width" cellspacing="0" cellpadding="0" bgcolor="#232925">
                <tr>
                  <td style="background-color:#232925" class="logo">
                    <br>
                    <a href="#"><img src="<?php echo base_url().'assets/images/logo_email.png' ?>" alt="Logo"></a>
                  </td>
                  <td class="icons">
                    <br>
                    <a href="https://www.facebook.com/groups/jogjakartavixioncommunity/">
                    <img src="<?php echo base_url().'assets/images/fb.gif' ?>" alt="facebook"></a>
                    <a href="https://twitter.com/Vixion_JogCom"><img src="<?php echo base_url().'assets/images/twitter.gif' ?>" alt="twitter"></a>
                    <a href="https://plus.google.com/u/1/107840323681089244042"><img src="<?php echo base_url().'assets/images/gp.gif' ?>" alt="google+"></a>
                    <a href="https://www.instagram.com/jogjakartavixioncommunity/"><img src="<?php echo base_url().'assets/images/instagram.gif' ?>" alt="instagram"></a>
                  </td>
                </tr>
              </table>

              <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#232925">
                <tr>
                  <td class="computer-image">
                    <br>
                    <br class="mobile-hide" />
                    <img style="display:block;" width="224" height="213" src="<?php echo base_url().'assets/images/logo_jvc.png' ?>" alt="hello">
                  </td>
                  <td style="color: #ffffff;" class="header-text">
                    <br>
                    <br>
                    <span style="font-size: 24px;">Reset Password</span><br><br>
                    Klik tombol reset password untuk mendapatkan email berisi password baru.
                    <br>
                    <br>
                      <div><!--[if mso]>
                        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:40px;v-text-anchor:middle;width:150px;" stroke="f" fillcolor="#2b934f">
                          <w:anchorlock/>
                          <center>
                        <![endif]-->
                            <a href="<?php echo base_url().'members/reset/'.$id.'/'.$code ?>"
                        style="background-color:#2b934f;color:#ffffff;display:inline-block;font-family:Helvetcia, sans-serif;font-size:16px;font-weight:light;line-height:40px;text-align:center;text-decoration:none;width:150px;-webkit-text-size-adjust:none;">Reset Password</a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                        <![endif]-->
                      </div>
                  </td>
                </tr>
              </table>


              <table class="force-full-width" cellspacing="0" cellpadding="30" bgcolor="#ebebeb">
                <tr>
                  <td>
                    <table cellspacing="0" cellpadding="0" class="force-full-width">
                      <tr>
                        <td>
                          <span class="header">Pertanyaan?</span><br>
                          Jangan ragu untuk <a href="<?php echo base_url().'kontak' ?>">Kontak Kami</a> kapan saja untuk mengajukan pertanyaan tentang akun Anda.<br><br>
                          Salam Kekeluargaan,<br>
                          Keluarga Besar JVC
                          
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>


              <table class="force-full-width" cellspacing="0" cellpadding="20" bgcolor="#2b934f">
                <tr>
                  <td style="background-color:#2b934f; color:#ffffff; font-size: 14px; text-align: center;">
                    © 2016 All Rights Reserved
                  </td>
                </tr>
              </table>


            </td>
          </tr>
        </table>

      </center>
      </td>
    </tr>
  </table>
  </body>
</html>
