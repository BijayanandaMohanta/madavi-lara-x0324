<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Openboxwale</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #000;
            font-size: 12px;
        }

        table {
            width: 100%;
            /* border-collapse: collapse; */
            border-spacing: 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 7px;
            /*            text-align: left;*/
        }

        th {
            background-color: #f2f2f2;
        }

        @page {
            margin: 1mm;
        }
    </style>
</head>


<body>
    <div class="invoice-container" style="width: 700px; margin: 0 auto; padding: 20px;">
        <table style="margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; border: none;">
                    <img src="{{ 'file://' . public_path('frontend/open-box-wale-white-bg.jpg') }}" alt="logo"
                        style="width:350px;">
                </td>
                <td style="width: 50%; border: none; text-align: right;">
                    <h2 style="margin: 0; font-size: 16px;">Tax Invoice/Bill of Supply/Cash Memo</h2>
                    <p style="margin: 0;">Invoice No. : {{$invoice_no ?? 'N/A'}}</p>
                    <p style="margin: 0;">(Original for Recipient)</p>
                </td>
            </tr>
        </table>

        <table style="margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: top; border:0;">
                    <h3 style="margin: 0;">Sold By :</h3>
                    <p style="margin: 0;">
                        {{ $setting->site_name ?? '' }}<br>
                        {{ $setting->address ?? '' }}
                    </p> <br>
                    <p style="margin: 0;">
                        <strong>PAN No:</strong> AAJFO0613L<br>
                        <strong>GST Registration No:</strong> 36AAJFO0613L1Z8
                    </p>
                </td>
                <td style="width: 50%; vertical-align: top; border:0; text-align: right;">
                    <h3 style="margin: 0;">Billing Address :</h3>
                    <p style="margin: 0;">
                        {{ $billing_address->first_name ?? '' }} {{ $billing_address->last_name ?? '' }}<br>
                        {{ $billing_address->address ?? '' }}<br>
                        {{ $billing_address->apartment ?? '' }},{{ $billing_address->city }}<br>
                        {{ $billing_address->state }},{{ $billing_address->pincode }}<br>

                    </p>
                    <p style="margin: 0;"><strong>State/UT Code:</strong> {{ $billing_address->state }}</p>
                </td>
            </tr>
        </table>

        <table style="margin-bottom: 20px;">
            <tr>
                <td style="width: 50%; vertical-align: center; border:0;">
                    <p style="margin: 0;">
                        <strong>Order Number:</strong> {{ $order->order_id }}<br>
                        <strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y') }}<br>
                    </p>
                </td>
                <td style="width: 50%; vertical-align: top; border:0; text-align: right;">
                    <h3 style="margin: 0;">Shipping Address :</h3>
                    <p style="margin: 0;">
                        {{ $billing_address->first_name }} {{ $billing_address->last_name }}<br>
                        {{ $billing_address->address }}<br>
                        {{ $billing_address->apartment }},{{ $billing_address->city }}<br>
                        {{ $billing_address->state }},{{ $billing_address->pincode }}<br>
                    </p>
                    <p style="margin: 0;">
                        <strong>State/UT Code:</strong> {{ $billing_address->state }}<br>
                        {{-- <strong>Place of supply:</strong> TELANGANA<br> --}}
                        {{-- <strong>Place of delivery:</strong> TELANGANA <br> --}}
                        {{-- <strong>Invoice Number :</strong> IN-1831<br> --}}
                        {{-- <strong>Invoice Details :</strong> AP-1323878615-2425<br> --}}
                        {{-- <strong>Invoice Date :</strong> 06.07.2024 --}}
                    </p>
                </td>

            </tr>
        </table>
        @php
            $isTelangana = $billing_address->state == 'Telangana';
        @endphp
        <table>
            <tr>
                <th>Sl. No</th>
                <th>Description</th>
                <th>Unit Price</th>
                @if ($isTelangana)
                    <th>CGST (9%)</th>
                @endif
                <th>{{ $isTelangana ? 'SGST (9%)' : 'IGST (18%)' }}</th>
                <th>Qty</th>
                <th>Total GST</th>
                {{-- <th>Tax Type</th> --}}
                {{-- <th>Tax Amount</th> --}}
                <th>Total Amount</th>
            </tr>
            @php
                $total_order_quantity = \App\Cart::where('sid', $order->sid)->count();
            @endphp
             @php
    // Step 1: Calculate total order value (before coupon)
    $total_order_value = $order->grand_total; // This should be before applying coupon
@endphp

            @foreach ($products as $index => $product)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td style="font-size: 11px;">{{ $product->product_name }}
                        {{-- <br>HSN:44140000 --}}
                    </td>
                    @php
            // Step 2: Get product's proportional value
            $product_value = $product->price * $product->quantity;

            // Step 3: Calculate product's share of the discount
            $discount_share = 0;
            if ($total_order_value > 0) {
                $discount_share = ($product_value / $total_order_value) * $order->coupon;
            }

            // Step 4: Calculate per-unit discounted price
            $discount_per_unit = $discount_share / $product->quantity;
            $discounted_price = max(0, $product->price - $discount_per_unit);

            // Step 5: GST Calculation
            $gst_rate = 15.254;
            $gstForPrice = ($discounted_price * $gst_rate) / 100;
            $cgst = $gstForPrice / 2;
            $sgst_igst = $gstForPrice / 2;

            // Step 6: Subtotal
            $subtotal = $product->quantity * $discounted_price;
        @endphp
                    <td align="center" style="white-space: nowrap;"><span style="font-family: DejaVu Sans;">₹</span>
                        {{ number_format($discounted_price, 2) }}</td>
                    @if ($isTelangana)
                        <td align="center" style="white-space: nowrap;"><span style="font-family: DejaVu Sans;">₹</span>
                        {{ number_format($cgst, 2) }}</td>
                    @endif
                    @if (!$isTelangana)
                        <td align="center" style="white-space: nowrap;"><span style="font-family: DejaVu Sans;">₹</span>
                        {{ number_format($sgst_igst+$cgst, 2) }}</td>
                    @else
                        <td align="center" style="white-space: nowrap;"><span style="font-family: DejaVu Sans;">₹</span>
                        {{ number_format($sgst_igst, 2) }}</td>
                    @endif
                    <td align="center">{{ $product->quantity }}</td>
                    <td align="center" style="white-space: nowrap;"><span style="font-family: DejaVu Sans;">₹</span>
                        {{ number_format($gstForPrice*$product->quantity, 2) }}</td>
                    {{-- <td>18%</td> --}}
                    {{-- <td>IGST</td> --}}
                    {{-- <td><span style="font-family: DejaVu Sans;">₹</span> 45.61</td> --}}
                    <td align="center"><span style="font-family: DejaVu Sans;">₹</span> {{ number_format($subtotal, 2) }}</td>

                </tr>
            @endforeach


            <tr>
                <td colspan="5" style="text-align: right;"><strong>Total Payable:</strong></td>
                <td colspan="3" align="center"><span style="font-family: DejaVu Sans;">₹</span> <span
                        id="grand_total">{{ number_format($order->sub_total, 2) }}</span></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right;"><strong>Shipping Charges:</strong></td>
                <td colspan="3" align="center"><span style="font-family: DejaVu Sans;">₹</span><span
                        id="grand_total">{{ number_format(($order->shipping_charges??0), 2) }}</span></td>
            </tr>
            <tr>
                <td colspan="9"><strong>Amount in Words:<strong style="text-transform: capitalize;">Rupee
                            {{ $amount_in_words }} only</strong></td>
            </tr>


            <tr>
                <td colspan="9" style="text-align: right;"><strong>For {{ $setting->site_name }}:</strong> <br>

                    {{-- <span>Sign</span> <br> --}}
                    <img src="{{ 'file://' . public_path('frontend/invoice-sign.jpg') }}" alt="signature"
                        style="width:80px;">
                    <div><strong>Authorized Signatory</strong></div>
                </td>
            </tr>

        </table>
        <p style="margin-top: 0;">Whether tax is payable under reverse charge - No</p>

        <table style="font-size: 10px;">
            <tr>
                <td><strong>Payment Transaction ID:</strong> <br>{{ $order->txn_id ?? 'Not Available' }}</td>
                <td><strong>Date & Time:</strong> <br>{{ $order->created_at }}</td>
                <td><strong>Invoice Value:</strong> <br>{{ $order->sub_total ?? 0 }}</td>
                <td><strong>Mode of Payment:</strong> <br>{{ $order->payment_option ?? 'N/A' }}</td>
            </tr>

        </table>
        </br>
        <div class="terms-conditions">
            <small style="color: #c6c6c6;">
                Terms & Conditions - We declare that the delivery challan shows the actual price of the goods described
                and that all particulars are true and correct. Goods once sold will not be taken back. All products
                carry a 7-day test warranty only. No warranty for burn & physical damages. Replacement may take 7-15
                working days. Warranty will be covered by the manufacturer & authorized service center(s) only.
            </small>
        </div>
        {{-- <p style="font-size: 0.8em; margin-top: 20px;">
            *ASSPL-Amazon Seller Services Pvt. Ltd.; ARIPL-Amazon Retail India Pvt. Ltd. (only where Amazon Retail India
            Pvt. Ltd. fulfillment center is co-located)<br>
            Customers desirous of availing input GST credit are requested to create a Business account and purchase on
            Amazon.in/business from Business eligible offers<br>
            Please note that this invoice is not a demand for payment
        </p> --}}
    </div>

</body>

</html>
