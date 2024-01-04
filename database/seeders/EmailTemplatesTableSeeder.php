<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('email_templates')->delete();

        \DB::table('email_templates')->insert(array (
            0 =>
            array (
                'id' => 1,
                'parent_id' => NULL,
                'name' => 'Invoice',
                'slug' => 'invoice',
                'subject' => 'Your Invoice # {invoice_reference_no} from {company_name} has been created.',
                'body' => '<html>
                    <body style="background-color:#e2e1e0;color:#000;">
                      <table style="max-width:700px;margin:50px auto 10px;border: 1px solid black;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
                        <thead>
                          <tr>
                            <td colspan="2" style="text-align: justify;">
                              <p style="font-size: 16px"><strong>Hi {customer_name},</strong></p>
                              <p style="font-size: 16px" style="line-height: 2rem; text-align: justify;">Thank you for your order. Here’s a brief overview of your
                                invoice.<br />
                                Please, take a careful look-</p>
                            </td>
                          </tr>
                          <tr>
                            <td style="height:35px;"></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; font-size: 16px">{company_name}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="height:35px;"></td>
                          </tr>
                          <tr>
                            <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status:</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Invoice No:</span>
                                {invoice_reference_no}</p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Name:</span> {customer_name}
                              </p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Grand Total:</span>
                                {currency}{total_amount}</p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Paid Amount:</span>
                                {currency}{paid_amount}</p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Payment Method:</span>
                                {payment_method}</p>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="2">
                              <p style="font-size:16px; line-height: 1.5rem; text-align:justify"><strong>Disclaimer:</strong> This
                                confidential email with attached files are intended to use for the selected individual merely. If you got
                                this message wrongly or you are not the addressee of this concern, kindly erase this information from your
                                folder and inform us through a kind reply. Please, do not proclaim or copy this email to any other entity.
                              </p>
                              <br />
                              <hr>
                              <p style="text-align: center;">©{company_name}, all rights reserved</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </body>
                </html>',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'date, amount',
            ),
            1 =>
            array (
                'id' => 2,
                'parent_id' => NULL,
                'name' => 'User',
                'slug' => 'user',
                'subject' => 'Welcome to {company_name} as an user',
                'body' => '                  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {user_name},</strong></span></p>
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">A warm welcome to {company_name} family, please login to the <a href="{company_url}">portal</a> to see the details of your account.</span></p>
</div>
</div>
<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:20px;padding-left:25px;">
<h5> <u>Credentials</u>: </h5>
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">User ID: <span style="color: #555555;"><strong> {user_id}</strong></span></span></p>
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Password: <span style="color: #555555;"><strong> {user_pass}</strong></span></span></p>
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:20px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'user_name, company_url, company_name,user_pass,user_id',
            ),
            2 =>
            array (
                'id' => 3,
                'parent_id' => NULL,
                'name' => 'Update password',
                'slug' => 'update-password',
                'subject' => 'New Password Set',
                'body' => '<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Password Reset</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
/**
* Google webfonts. Recommended to include the .woff version for cross-client compatibility.
*/
@media screen {
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 400;
src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
}
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 700;
src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
}
}
/**
* Avoid browser level font resizing.
* 1. Windows Mobile
* 2. iOS / OSX
*/
body,
table,
td,
a {
-ms-text-size-adjust: 100%; /* 1 */
-webkit-text-size-adjust: 100%; /* 2 */
}
/**
* Remove extra space added to tables and cells in Outlook.
*/
table,
td {
mso-table-rspace: 0pt;
mso-table-lspace: 0pt;
}
/**
* Better fluid images in Internet Explorer.
*/
img {
-ms-interpolation-mode: bicubic;
}
/**
* Remove blue links for iOS devices.
*/
a[x-apple-data-detectors] {
font-family: inherit !important;
font-size: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
color: inherit !important;
text-decoration: none !important;
}
/**
* Fix centering issues in Android 4.4.
*/
div[style*="margin: 16px 0;"] {
margin: 0 !important;
}
body {
width: 100% !important;
height: 100% !important;
padding: 0 !important;
margin: 0 !important;
}
/**
* Collapse table borders to avoid space between cells.
*/
table {
border-collapse: collapse !important;
}
a {
color: #1a82e2;
}
img {
height: auto;
line-height: 100%;
text-decoration: none;
border: 0;
outline: none;
}
</style>

</head>
<body style="background-color: #e9ecef;">
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="center" valign="top" style="padding: 36px 24px;">
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
<h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center; color: cornflowerblue;">Updated Your Password</h1>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
<p style="margin: 0;">Hello {user_name},</p>
<p>You requested to update your password. Your new password has been set. You can check the update going through the <a href="{company_url}">portal</a>.</p>
<h5 style="margin-top:10px; margin-bottom:0px; "> <u>Credentials</u>: </h5>
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">User ID: <span style="color: #555555;"><strong> {user_id}</strong></span></span></p>
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Password: <span style="color: #555555;"><strong> {user_pass}</strong></span></span></p>
</div>
<p style="margin-top:10px;">Was it you or someone else? If it was not you, please inform us promptly.</p>
</td>
</tr>
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 0 24px 24px 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
<p style="margin: 0;">Thanks & Regards,<br> {company_name}</p>
<br/>
<hr>
<p style="text-align: center;">©{company_name}, all rights reserved</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'user_name,user_id,user_pass,company_name,company_url',
            ),
            3 =>
            array (
                'id' => 4,
                'parent_id' => NULL,
                'name' => 'Email Verification',
                'slug' => 'email-verification',
                'subject' => 'Active user information',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {user_name},</strong></span></p>
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">You\'re almost ready to get started. Please click on the button below to verify your email address and enjoy exclusive services with us!</span></p>
</div>
</div>
<div style="display: flex; justify-content: center; align-items: center; {otp_active}">
<span style="display:block;padding:4px 44px 13px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px;"><strong><span style="line-height: 19.2px; font-size: 16px;">Please use this OTP to active your account</span></strong></span></span>
</div>

<div style="display: flex; justify-content: center; align-items: center; {otp_active}">
<span style="display:block;padding:4px 44px 13px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px;"><strong><span style="line-height: 19.2px; font-size: 26px;">{verification_otp}</span></strong></span></span>
</div>

<div style="display: flex; justify-content: center; align-items: center; {token_otp_active}">
<span style="display:block;padding:4px 44px 13px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px;"><strong><span style="line-height: 19.2px; font-size: 16px;">Or</span></strong></span></span>
</div>

<div style="display: flex; justify-content: center; align-items: center; {token_active}">
<a href="{verification_url}" target="_blank" style="box-sizing: border-box;margin-top: 10px;display: inline-block;font-family:"Cabin",sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #ff6600; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
<span style="display:block;padding:14px 44px 13px;line-height:120%; background: #00f;"><span style="font-size: 16px; line-height: 19.2px;"><strong><span style="line-height: 19.2px; font-size: 16px; color: #fff;">Click Here</span></strong></span></span>
</a>
</div>
<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:20px;padding-left:25px;">
<h5> <u>Credentials</u>: </h5>
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">User ID: <span style="color: #555555;"><strong> {user_id}</strong></span></span></p>
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Password: <span style="color: #555555;"><strong> {user_pass}</strong></span></span></p>
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:20px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'user_name, verification_url, company_name,user_pass,user_id,  verification_otp, token_active, otp_active, token_otp_active',
            ),
            4 =>
            array (
                'id' => 5,
                'parent_id' => NULL,
                'name' => 'New Password Set',
                'slug' => 'new-password-set',
                'subject' => 'New Password Set',
                'body' => '                  <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Password Reset</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
/**
* Google webfonts. Recommended to include the .woff version for cross-client compatibility.
*/
@media screen {
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 400;
src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
}
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 700;
src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
}
}
/**
* Avoid browser level font resizing.
* 1. Windows Mobile
* 2. iOS / OSX
*/
body,
table,
td,
a {
-ms-text-size-adjust: 100%; /* 1 */
-webkit-text-size-adjust: 100%; /* 2 */
}
/**
* Remove extra space added to tables and cells in Outlook.
*/
table,
td {
mso-table-rspace: 0pt;
mso-table-lspace: 0pt;
}
/**
* Better fluid images in Internet Explorer.
*/
img {
-ms-interpolation-mode: bicubic;
}
/**
* Remove blue links for iOS devices.
*/
a[x-apple-data-detectors] {
font-family: inherit !important;
font-size: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
color: inherit !important;
text-decoration: none !important;
}
/**
* Fix centering issues in Android 4.4.
*/
div[style*="margin: 16px 0;"] {
margin: 0 !important;
}
body {
width: 100% !important;
height: 100% !important;
padding: 0 !important;
margin: 0 !important;
}
/**
* Collapse table borders to avoid space between cells.
*/
table {
border-collapse: collapse !important;
}
a {
color: #1a82e2;
}
img {
height: auto;
line-height: 100%;
text-decoration: none;
border: 0;
outline: none;
}
</style>

</head>
<body style="background-color: #e9ecef;">
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="center" valign="top" style="padding: 36px 24px;">
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
<h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center; color: cornflowerblue;">Updated Your Password</h1>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
<p style="margin: 0;">Hello {user_name},</p>
<p>You requested to update your password. Your new password has been set. You can check the update going through the <a href="{company_url}">portal</a>.</p>
<h5 style="margin-top:10px; margin-bottom:0px; "> <u>Credentials</u>: </h5>
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">User ID: <span style="color: #555555;"><strong> {user_id}</strong></span></span></p>
<p style="font-size: 15px; line-height: 1.5; font-family: inherit; word-break: break-word; mso-line-height-alt: 23px; margin: 0;"><span style="font-size: 15px;">Password: <span style="color: #555555;"><strong> {user_pass}</strong></span></span></p>
</div>
<p style="margin-top:10px;">Was it you or someone else? If it was not you, please inform us promptly.</p>
</td>
</tr>
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 0 24px 24px 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
<p style="margin: 0;">Thanks & Regards,<br> {company_name}</p>
<br/>
<hr>
<p style="text-align: center;">©{company_name}, all rights reserved</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'user_name, company_url, user_id, user_pass, company_name',
            ),
            5 =>
            array (
                'id' => 6,
                'parent_id' => NULL,
                'name' => 'Reset Password',
                'slug' => 'reset-password',
                'subject' => 'Reset Password',
                'body' => '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Password Reset</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
/**
* Google webfonts. Recommended to include the .woff version for cross-client compatibility.
*/
@media screen {
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 400;
src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
}
@font-face {
font-family: Source Sans Pro;
font-style: normal;
font-weight: 700;
src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
}
}
/**
* Avoid browser level font resizing.
* 1. Windows Mobile
* 2. iOS / OSX
*/
body,
table,
td,
a {
-ms-text-size-adjust: 100%; /* 1 */
-webkit-text-size-adjust: 100%; /* 2 */
}
/**
* Remove extra space added to tables and cells in Outlook.
*/
table,
td {
mso-table-rspace: 0pt;
mso-table-lspace: 0pt;
}
/**
* Better fluid images in Internet Explorer.
*/
img {
-ms-interpolation-mode: bicubic;
}
/**
* Remove blue links for iOS devices.
*/
a[x-apple-data-detectors] {
font-family: inherit !important;
font-size: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
color: inherit !important;
text-decoration: none !important;
}
/**
* Fix centering issues in Android 4.4.
*/
div[style*="margin: 16px 0;"] {
margin: 0 !important;
}
body {
width: 100% !important;
height: 100% !important;
padding: 0 !important;
margin: 0 !important;
}
/**
* Collapse table borders to avoid space between cells.
*/
table {
border-collapse: collapse !important;
}
a {
color: #1a82e2;
}
img {
height: auto;
line-height: 100%;
text-decoration: none;
border: 0;
outline: none;
}
</style>

</head>
<body style="background-color: #e9ecef;">
<div class="preheader" style="display: none; color:black; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
</div>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="center" valign="top" style="padding: 36px 24px;">
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
<h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center; color: cornflowerblue;">Reset Your Password</h1>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center" bgcolor="#e9ecef">
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
<p style="margin: 0; color:black;">Dear {user_name},</p>
<p style=" color:black;">Someone has asked to reset the password of your KYC account. If you did not request a password reset, you can disregard this email. No changes have been made to your account.</p>
<p style=" color:black;">To reset your password, go to the following the button: </p>
</td>
</tr>
<tr>
<td align="left" bgcolor="#ffffff">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td align="center" bgcolor="#ffffff" style="padding: 12px;">
<table border="0" cellpadding="0" cellspacing="0">
<tr style="{otp_active}">
<td align="center" style="border-radius: 6px;">
<span style="display: inline-block; padding: 2px 16px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 18px; color: #000; text-decoration: none; border-radius: 6px;">Please enter this OTP to reset your password.</a>
</td>
</tr>
<tr style="{otp_active}">
<td align="center" style="border-radius: 6px;">
<span style="display: inline-block; padding: 2px 36px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 24px; color: #000; text-decoration: none; border-radius: 6px;">{password_reset_otp}</a>
</td>
</tr>
<tr style="{token_otp_active}">
<td align="center" style="border-radius: 6px;">
<span style="display: inline-block; padding: 2px 36px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 24px; color: #000; text-decoration: none; border-radius: 6px;">Or</a>
</td>
</tr>
<tr style="{token_active}">
<td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
<a href="{password_reset_url}" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">Click here</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: Source Sans Pro, Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
<p style="margin: 0;  color:black;">Thanks & Regards,<br> {company_name}</p>
<br />
<hr>
<p style="text-align: center;font-size:12px">©{company_name}, all rights reserved</p>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'user_name, password_reset_url, company_name, password_reset_otp, token_active, otp_active, token_otp_active',
            ),
            6 =>
            array (
                'id' => 7,
                'parent_id' => NULL,
                'name' => 'Accept refund request',
                'slug' => 'accept-refund-request',
                'subject' => 'Accept refund request',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-bottom: 5px;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {user_name},</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Your refund request has been accepted.</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 10px; margin-left: 0; margin-right: 20px; padding-bottom: 10px; border-bottom: 1px solid #888;"><span style="color: #2b303a; font-size: 18px;"><strong>Order Id: {order_id}</strong></span></p>
<!-- <hr> -->
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">Please accept our sincere apology for the inconvenience. We will process your refund request as soon as possible.<br>Have a good day!</span></p>
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-top: 10px;"><span style="color: #008080; font-size: 18px;">If you have further question, please contact with us with this mail: {vendor_email}</span></p>
</div>
</div>


<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:10px;padding-bottom:10px;padding-left:25px;">

</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'company_name, user_name, vendor_email, order_id',
            ),
            7 =>
            array (
                'id' => 8,
                'parent_id' => NULL,
                'name' => 'Reject refund request',
                'slug' => 'reject-refund-request',
                'subject' => 'Rejected refund request',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-bottom: 5px;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {user_name},</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Your refund request has been rejected.</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 10px; margin-left: 0; margin-right: 20px; padding-bottom: 10px; border-bottom: 1px solid #888;"><span style="color: #2b303a; font-size: 18px;"><strong>Order Id: {order_id}</strong></span></p>
<!-- <hr> -->
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">We are sorry to announce that your refund request is rejected due to your violation against the Refund and Return policy.</span></p>
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-top: 10px;"><span style="color: #008080; font-size: 18px;">If you have further question, please contact with us with this mail: {vendor_email}</span></p>
</div>
</div>


<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:10px;padding-bottom:10px;padding-left:25px;">

</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'company_name, user_name, order_id, vendor_email',
            ),
            8 =>
            array (
                'id' => 9,
                'parent_id' => NULL,
                'name' => 'Completed refund request',
                'slug' => 'completed-refund-request',
                'subject' => 'Completed refund request',
                'body' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-bottom: 5px;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {user_name},</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Your refund request has been completed.</strong></span></p>
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 10px; margin-left: 0; margin-right: 20px; padding-bottom: 10px; border-bottom: 1px solid #888;"><span style="color: #2b303a; font-size: 18px;"><strong>Order Id: {order_id}</strong></span></p>
<!-- <hr> -->
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">We have completed your refund process. We sent {money} to your wallet.<br>Have a good day!</span></p>
<p style="font-size: 18px; line-height: 1.5; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0; margin-top: 10px;"><span style="color: #008080; font-size: 18px;">If you have further question, please contact with us with this mail: {vendor_email}</span></p>
</div>
</div>


<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:10px;padding-bottom:10px;padding-left:25px;">

</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:5px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'company_name, user_name, order_id, vendor_email, money',
            ),
            9 =>
            array (
                'id' => 10,
                'parent_id' => NULL,
                'name' => 'Subscriber',
                'slug' => 'subscriber',
                'subject' => 'Subscription for newsletter',
                'body' => '                  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
<meta content="width=device-width" name="viewport"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<title>Task</title>
<style type="text/css">
body {
margin: 0;
padding: 0;
}
table,
td,
tr {
vertical-align: top;
border-collapse: collapse;
}
* {
line-height: inherit;
}
a[x-apple-data-detectors=true] {
color: inherit !important;
text-decoration: none !important;
}
.myButton {
background-color:#1aa19c;
border-radius:5px;
display:inline-block;
cursor:pointer;
color:#ffffff;
font-family:Trebuchet MS;
font-size:17px;
font-weight:bold;
padding:9px 28px;
text-decoration:none;
text-shadow:0px 1px 2px #3d768a;
}
.myButton:hover {
background-color:#408c99;
}
.myButton:active {
position:relative;
top:1px;
}
</style>
<style id="media-query" type="text/css">
@media (max-width: 660px) {
.block-grid,
.col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.block-grid {
width: 100% !important;
}
.col {
width: 100% !important;
}
.col>div {
margin: 0 auto;
}
img.fullwidth,
img.fullwidthOnMobile {
max-width: 100% !important;
}
.no-stack .col {
min-width: 0 !important;
display: table-cell !important;
}
.no-stack.two-up .col {
width: 50% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num8 {
width: 66% !important;
}
.no-stack .col.num4 {
width: 33% !important;
}
.no-stack .col.num3 {
width: 25% !important;
}
.no-stack .col.num6 {
width: 50% !important;
}
.no-stack .col.num9 {
width: 75% !important;
}
.video-block {
max-width: none !important;
}
.mobile_hide {
min-height: 0px;
max-height: 0px;
max-width: 0px;
display: none;
overflow: hidden;
font-size: 0px;
}
.desktop_hide {
display: block !important;
max-height: none !important;
}
}

</style>
</head>
<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #f8f8f9;">
<table bgcolor="#f8f8f9" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f8f8f9; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top;" valign="top">
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<div style="color:#555555;font-family:Pacifico, cursive;line-height:1.2;padding-top:35px;padding-right:0px;padding-bottom:20px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 18px; color: #555555; font-family: Pacifico, cursive; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: center; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 30px;">{company_name}</span></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f3fafa;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f3fafa;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 580px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:30px solid #FFFFFF; border-bottom:0px solid transparent; border-right:30px solid #FFFFFF; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 4px solid #1AA19C; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 35px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:15px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #2b303a; font-size: 18px;"><strong>Hello {email},</strong></span></p>
</div>
</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.2;padding-top:0px;padding-right:0px;padding-bottom:10px;padding-left:30px;">
<div style="line-height: 1.2; font-size: 12px; color: #555555; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; mso-line-height-alt: 14px;">
<p style="font-size: 18px; line-height: 1.2; word-break: break-word; text-align: left; mso-line-height-alt: 22px; margin: 0;"><span style="color: #008080; font-size: 18px;">Thanks for subscribing to our newsletter, please <a href="{company_url}">visit</a> our website to get upto 70% discount.</span></p>
</div>
</div>
<div style="margin-left:5px;color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:10px;padding-right:10px;padding-bottom:20px;padding-left:25px;">

</div>
<div style="color:#555555;font-family:Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif;line-height:1.5;padding-top:20px;padding-right:30px;padding-bottom:40px;padding-left:30px;">
<div style="line-height: 1.5; font-size: 12px; font-family: Montserrat, Trebuchet MS, Lucida Grande, Lucida Sans Unicode, Lucida Sans, Tahoma, sans-serif; color: #555555; mso-line-height-alt: 18px;">
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">Thank you,</span></p>
<p style="font-size: 15px; line-height: 1.5; word-break: break-word; text-align: left; font-family: inherit; mso-line-height-alt: 23px; margin: 0;"><span style="color: #2b303a; font-size: 15px;">{company_name}</span></p>
</div>
</div>
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #fff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#fff;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 60px; padding-right: 0px; padding-bottom: 12px; padding-left: 0px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!--[if (!mso)&(!IE)]><!-->
</div>
<!--<![endif]-->
</div>
</div>
</div>
</div>
</div>
<div style="background-color:transparent;">
<div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 640px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #f8f8f9;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color:#f8f8f9;">
<div class="col num12" style="min-width: 320px; max-width: 640px; display: table-cell; vertical-align: top; width: 640px;">
<div style="width:100% !important;">
<!--[if (!mso)&(!IE)]><!-->
<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
<!--<![endif]-->
<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px;" valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-top: 0px solid #BBBBBB; width: 100%;" valign="top" width="100%">
<tbody>
<tr style="vertical-align: top;" valign="top">
<td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</td>
</tr>
</tbody>
</table>
</body>
</html>
',
                'language_id' => 1,
                'status' => 'Active',
                'variables' => 'company_name, email, company_url',
            ),
            10 =>
                array (
                    'id' => 11,
                    'parent_id' => NULL,
                    'name' => 'Vendor Invoice',
                    'slug' => 'vendor-invoice',
                    'subject' => 'An Invoice # {invoice_reference_no} from {company_name} has been created.',
                    'body' => '                  <html>
                    <body style="background-color:#e2e1e0;color:#000;">
                      <table style="max-width:700px;margin:50px auto 10px;border: 1px solid black;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
                        <thead>
                          <tr>
                            <td colspan="2" style="text-align: justify;">
                              <p style="font-size: 16px"><strong>Hi {vendor_name},</strong></p>
                              <p style="font-size: 16px" style="line-height: 2rem; text-align: justify;">An invoice was created by{customer_name}<br />
                                Please, take a careful look-</p>
                            </td>
                          </tr>
                          <tr>
                            <td style="height:35px;"></td>
                          </tr>
                          <tr>
                            <th style="text-align:left; font-size: 16px">{company_name}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td style="height:35px;"></td>
                          </tr>
                          <tr>
                            <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Order status:</span><b style="color:green;font-weight:normal;margin:0">Success</b></p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Invoice No:</span>
                                {invoice_reference_no}</p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Name:</span> {customer_name}
                              </p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Grand Total:</span>
                                {currency}{total_amount}</p>
                              <p style="font-size:16px;margin:0 0 10px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Payment Method:</span>
                                {payment_method}</p>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="2">
                              <p style="font-size:16px; line-height: 1.5rem; text-align:justify"><strong>Disclaimer:</strong> This
                                confidential email with attached files are intended to use for the selected individual merely. If you got
                                this message wrongly or you are not the addressee of this concern, kindly erase this information from your
                                folder and inform us through a kind reply. Please, do not proclaim or copy this email to any other entity.
                              </p>
                              <br />
                              <hr>
                              <p style="text-align: center;">©{company_name}, all rights reserved</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </body>
                </html>',
                    'language_id' => 1,
                    'status' => 'Active',
                    'variables' => 'company_name, email, company_url',
                ),
        ));


    }
}
