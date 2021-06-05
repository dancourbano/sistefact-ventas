<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 10 - 27 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
    <style>
        * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What is does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin:0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit !important;
            text-decoration: underline !important;
        }

        /* What it does: Prevents underlining the button text in Windows 10 */
        .button-link {
            text-decoration: none !important;
        }

    </style>

    <!-- Progressive Enhancements -->
    <style>

        /* What it does: Hover styles for buttons */
        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }
        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        /* Media Queries */
        @media screen and (max-width: 600px) {

            .email-container {
                width: 100% !important;
                margin: auto !important;
            }

            /* What it does: Forces elements to resize to the full width of their container. Useful for resizing images beyond their max-width. */
            .fluid {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

            /* What it does: Forces table cells into full-width rows. */
            .stack-column,
            .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            /* And center justify these ones. */
            .stack-column-center {
                text-align: center !important;
            }

            /* What it does: Generic utility class for centering. Useful for images, buttons, and nested tables. */
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }
            table.center-on-narrow {
                display: inline-block !important;
            }

        }

    </style>

</head>
<body width="100%" bgcolor="#222222" style="margin: 0; mso-line-height-rule: exactly;">
<center style="width: 100%; background: #222222;">


<!-- Visually Hidden Preheader Text : BEGIN -->
<div style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
    (Optional) This text will appear in the inbox preview, but not the email body.
</div>
<!-- Visually Hidden Preheader Text : END -->
<br>
<!-- Email Header : BEGIN -->
<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
    <!-- 1 Column Text + Button : BEGIN -->
    <tr>
        <td bgcolor="#ffffff">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <!-- Column : BEGIN -->
                    <td width="33.33%" class="stack-column-center">
                        <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td dir="ltr" valign="top" style="padding: 0 10px;">
                                    <img src="http://www.gpsjnisi.com/sistema/public/assets/images/gpsjnisi.png" width="170" height="170" alt="alt_text" border="0" class="center-on-narrow" style="height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                </td>
                            </tr>
                        </table>
                    </td>
                    <!-- Column : END -->
                    <!-- Column : BEGIN -->
                    <td width="66.66%" class="stack-column-center">
                        <table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td dir="ltr" valign="top" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px; text-align: left;" class="center-on-narrow">
                                    <strong style="color:#111111;">Envio de Factura Digital</strong>
                                    <br><br>
                                    GPS JNISI
                                    <br/>
                                    John F. Kennedy #472, Trujillo ,Perú
                                    <br/>
                                    Telefono: (044) 692727
                                    <br/>
                                    gps-jnisi@hotmail.com
                                    <br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <!-- Column : END -->
                </tr>
            </table>
        </td>
    </tr>
    <!-- 1 Column Text + Button : BEGIN -->

</table>
<!-- Email Header : END -->

<!-- Email Body : BEGIN -->
<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">


<!-- Background Image with Text : BEGIN -->
<tr>
    <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
    <td background="" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;">

        <!--[if gte mso 9]>
        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
            <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
            <v:textbox inset="0,0,0,0">
        <![endif]-->
        <br>
        <!--[if gte mso 9]>
        </v:textbox>
        </v:rect>
        <![endif]-->
    </td>
</tr>
<!-- Background Image with Text : END -->
<!-- 1 Column Text + Button : BEGIN -->
<tr>
    <td bgcolor="#ffffff">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                    <div >

                        <strong style="color:#111111;">Para:</strong>
                        <br><br>
                        <address>
                            {{"Sr(a): ".$invoice['invoice']->customerName." ".$invoice['invoice']->customerLastName."      DNI/RUC:".$invoice['invoice']->customerIdentification}}
                            <br/>
                            {{$invoice['invoice']->customerAddress.", ".$invoice['invoice']->customerCity}}
                            <br/>
                            {{"Telefono(s):  ".$invoice['invoice']->customerPhone1.",   ".$invoice['invoice']->customerPhone2}}
                            <br/>
                              {{$invoice['invoice']->customerEmail}}
                        </address>
                    </div>
                    <br><br>

                    <div >
                        <strong style="color:#111111;">Fechas:</strong>
                        <br>
                        <p >
                            <span >Fecha de Emision:</span>
                            <span >{{$invoice['invoice']->createdDate }}</span>
                        </p>
                        <p >
                            <span >Fecha de Vencimiento:</span>
                            <span >{{$invoice['invoice']->datePayMax}}</span>
                        </p>
                    </div>
                </td>
            </tr>

        </table>
    </td>
</tr>
<!-- 1 Column Text + Button : BEGIN -->
<!-- Background Image with Text : BEGIN -->
<tr>
    <!-- Bulletproof Background Images c/o https://backgrounds.cm -->
    <td background="" bgcolor="#222222" valign="middle" style="text-align: center; background-position: center center !important; background-size: cover !important;">

        <!--[if gte mso 9]>
        <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
            <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
            <v:textbox inset="0,0,0,0">
        <![endif]-->
        <br>
        <!--[if gte mso 9]>
        </v:textbox>
        </v:rect>
        <![endif]-->
    </td>
</tr>
<!-- Background Image with Text : END -->
<tr>
    <td bgcolor="#ffffff">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
            <tr>
                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                    <strong style="color:#111111;">Factura #{{$invoice['invoice']->invoiceId}}</strong>
                    <br><br>
                    <table border="1" >
                        <thead style=" background: #000; color: #fff;">
                        <tr>
                            <th WIDTH="11%">#</th>
                            <th WIDTH="45%">Item</th>
                            <th WIDTH="11%">Precio</th>
                            <th WIDTH="11%">Cantidad</th>
                            <th WIDTH="11%">Vehiculo</th>
                            <th WIDTH="11%">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice['invoiceDetail'] as $detailInvoice)
                        <tr>
                            <td align="center">{{ $detailInvoice->detailinvoiceId }}</td>
                            <td>{{ $detailInvoice->description }}</td>
                            <td align="center">{{ $detailInvoice->price }}</td>
                            <td align="center">{{ $detailInvoice->quantity }}</td>
                            <td align="center">{{ $detailInvoice->vehicleId }}</td>
                            <td align="center">{{ $detailInvoice->quantity*$detailInvoice->price }}</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </td>

            </tr>
            <tr>
                <td class="stack-column-center">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 10px 10px; text-align: left;" class="center-on-narrow">
                                <table border="1"  WIDTH="40%">
                                    <tbody>
                                    <tr >
                                        <td colspan="2">Subtotal(S/.)</td>
                                        <td align="center">{{$invoice['invoice']->subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Descuento(S/.)</td>
                                        <td align="center">{{$invoice['invoice']->disccountValue}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">IGV 18% (S/.)</td>
                                        <td align="center">{{$invoice['invoice']->tax}}</td>
                                    </tr>
                                    <tr >
                                        <td colspan="2">Total a Pagar (S/.)</td>
                                        <td align="center">{{$invoice['invoice']->total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<!-- 2 Even Columns : BEGIN -->
<tr>
    <td bgcolor="#ffffff" align="center" valign="top" style="padding: 10px;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
            <br><br>
            <tr>
                <td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td">
                    <a  style="background: #47a447; border: 15px solid #47a447; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">
                        <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;El Total a Pagar es de S/{{$invoice['invoice']->total}} &nbsp;&nbsp;&nbsp;&nbsp;</span>
                    </a>
                </td>
            </tr>
            <tr>
                <td style="padding: 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                        <strong style="color:#111111;">Nota:</strong>
                        <p>Recuerde que de no cancelar hasta la fecha indicada, se sumará una mora, por cada dia.</p>
                        <br>
                        <p style="color:#111111; text-align: center;">Para asegurar que la información llegue a tu correo electrónico, favor agregue gpsjnisi@gmail.com a su lista de correos seguros.</p>
                </td>
            </tr>
        </table>
    </td>
</tr>


<!-- Clear Spacer : BEGIN -->
<tr>
    <td height="15" style="font-size: 0; line-height: 0;">
        &nbsp;
    </td>
</tr>
<!-- Clear Spacer : END -->

<!-- 1 Column Text + Button : BEGIN -->

<!-- 1 Column Text + Button : BEGIN -->

</table>
<!-- Email Body : END -->

<!-- Email Footer : BEGIN -->
<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="margin: auto;" class="email-container">
    <tr>
        <td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;">
            <webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">Email enviado desde www.gpsjnisi.com</webversion>
            <br><br>
            Consorcio Jaasiel SAC<br><span class="mobile-link--footer">John F. Kennedy #472, Trujillo ,Perú</span><br><span class="mobile-link--footer">(044) 692727</span>
            <br><br>

        </td>
    </tr>
</table>
<!-- Email Footer : END -->

</center>
</body>
</html>