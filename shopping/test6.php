<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}

        * {
  box-sizing: border-box;
}

body,html {
  width: 288px;
}

.pos-receipt-print {
    text-align: left;
    direction: ltr;
    font-size: 27px;
    color: #000000;
    padding: 10px;
    background: #FFF;
    page-break-after: always;
}

.pos-receipt .pos-receipt-right-align {
    float: right;
}

.pos-receipt .pos-receipt-center-align {
    text-align: center;
    margin: 0;
}

.pos-receipt .pos-receipt-left-padding {
    padding-left: 2em;
}

.pos-receipt .pos-receipt-logo {
    width: 50%;
    display: block;
    margin: 0 auto;
}

.pos-receipt .pos-receipt-contact {
    text-align: center;
    font-size: 75%;
}

.pos-receipt .pos-receipt-order-data {
    text-align: center;
    font-size: 75%;
}

.pos-receipt .pos-receipt-amount {
    font-size: 125%;
    padding-left: 6em;
}

.pos-receipt .pos-receipt-title {
    font-weight: bold;
    font-size: 125%;
    text-align: center;
}

.pos-receipt .pos-receipt-header {
    font-size: 125%;
    text-align: center;
}

.pos-receipt .pos-order-receipt-cancel {
    color: red;
}

.pos-receipt .pos-receipt-customer-note {
    word-break: break-all;
}

.pos-payment-terminal-receipt {
    text-align: center;
    font-size: 75%;
}

.responsive-price {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}

.responsive-price > .pos-receipt-right-align {
    margin-left: auto;
}

.pos-receipt {
}
    </style>
</head>
<body>
    <div class="pos-receipt-print">
        <div class="pos-receipt">
            <h5 class="pos-receipt-center-align">
                PAWS FUR AND TAIL
            </h5>
            <div class="aku-pos-receipt-header" style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5;margin-top:10px;">
                <div class="aku-header-line">
                    <span style="float: left">Sai Harsha building</span>
                    <span style="float: right">22/07/2021</span>
                </div>
                <br />
                <div class="aku-header-line">
                    <span style="float: left">Old Post Office Rd,</span>
                    <span style="float: right">10:34 PM</span>
                </div>
                <br />
                <div class="aku-header-line">
                    <span style="float: left">Veethika, Udupi</span>
                </div>
                <br />
                <div class="aku-header-line">
                    <span style="float: left">Karnataka 576101</span>
                    <span style="float: right">GSTIN: 897876757G</span>
                </div>
                <br />
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div class="aku-pos-receipt-header" style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5;">
                <div class="aku-header-line">
                    <span style="float: left"><strong style="font-size: 12px;">BILL NO: #0113910772</strong></span>
                    <span style="float: right">Ajay Kumar</span>
                </div>
                <br />
                <div class="aku-header-line">
                    <span style="float: right">Ph: 8976667667</span>
                </div>
                <br />
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div class="orderlines" style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5;text-align: center;">
                <strong>
                  SALES INVOICE
                </strong>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div class="orderlines">
                <table style="width: 100%;font-family: 'Courier New', monospace;line-height: 1.2;font-size: 12px;">
                    <tr>
                        <th>Item</td>
                        <th>Qty</td>
                        <th style="text-align: center;">Amt</td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Bow Ties</td>
                        <td>1</td>
                        <td style="text-align: right;">1300.00</td>
                    </tr>
                    <tr>
                        <td>Maxi Breed Dry Food</td>
                        <td>1</td>
                        <td style="text-align: right;">1500.00</td>
                    </tr>
                    <tr>
                        <td>HUFT YIMT Chicken and Oats Dog Biscuits</td>
                        <td>4</td>
                        <td style="text-align: right;">199.00</td>
                    </tr>
                    <tr>
                        <td>Sara's Doggie Treats</td>
                        <td>2</td>
                        <td style="text-align: right;">330.00</td>
                    </tr>
                </table>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5; font-weight: 800">
                <div style="padding-left:0; font-size: 100%;" class="pos-receipt-amount receipt-change">
                    <span>Sub Total</span>        
                    <span class="pos-receipt-right-align" >4254.00</span>
                </div>
            </div>
            <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5; font-weight: 800">
                <div style="padding-left:0; font-size: 100%;" class="pos-receipt-amount receipt-change">
                    <span>Discount</span>        
                    <span class="pos-receipt-right-align" >147.50</span>
                </div>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5;">
                <div style="padding-left:0; font-size: 150%; font-weight:800;" class="pos-receipt-amount">
                    <span>GRAND TOTAL</span>
                    <span class="pos-receipt-right-align">4106.50</span>
                </div>
                <div style="padding-left:0; font-size: 100%;" class="pos-receipt-amount">
                    <span>Rounding</span>
                    <span  class="pos-receipt-right-align">- 0.50</span>
                </div>
                <div style="padding-left:0; font-size: 100%;" class="pos-receipt-amount">
                    <span>To Pay</span>
                    <span class="pos-receipt-right-align">4106.00</span>
                </div>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5;">
                <div>
                    <span>Amount Paid</span>
                    <span class="pos-receipt-right-align">5000.00</span>
                </div>
            </div>
            <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5; font-weight: 800">
                <div style="padding-left:0; font-size: 100%;" class="pos-receipt-amount receipt-change">
                    <span>CHANGE</span>        
                    <span class="pos-receipt-right-align" >- 893.00</span>
                </div>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
            <div class="before-footer" />
                <div style="font-family: 'Courier New', monospace; font-size: 12px; line-height: 1.5; text-align: center;">
                    <div>
                        <Strong>Thank You | Visit Again</strong>
                    </div>
                </div>
            </div>
            <hr style="border: none; height: 1px; background: #000; background: repeating-linear-gradient(90deg,#000,#000 4px,transparent 4px,transparent 8px);"/>
        </div>
    </div>
</body>
</html>