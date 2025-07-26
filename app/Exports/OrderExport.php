<?php

namespace App\Exports;

use App\CartAddress;
use App\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    protected $orders;

    /**
     * Constructor to accept orders from the controller
     *
     * @param \Illuminate\Support\Collection $orders
     */
    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * Return the collection of orders
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->orders
        ->filter(function ($order) {
            return !empty($order['customer_name']); // Skip if customer_name is null or empty
        })
        ->map(function ($order) {
            // dd($order);
            if($order['order_from'] == 'Tele Order')
            {
                $tele_order_count = Order::where('order_from', 'Tele Order')->where('id','<',$order['id'])->count();
                $date = \Carbon\Carbon::parse($order['date']);
                $invoice_no = "INV-ST-".str_pad($tele_order_count + 1, 4, '0', STR_PAD_LEFT)."-".$date->format('M')."-".$date->format('Y');
                $invoice_no = strtoupper($invoice_no);
            }
            else{
                $tele_order_count = Order::where('order_from', NULL)->where('id','<',$order['id'])->count();
                $date = \Carbon\Carbon::parse($order['date']);
                $invoice_no = "INV-ON-".str_pad($tele_order_count + 1, 4, '0', STR_PAD_LEFT)."-".$date->format('M')."-".$date->format('Y');
                $invoice_no = strtoupper($invoice_no);
            }
            $cart_address = CartAddress::where('sid', $order['sid'])->first();
            return [
                'Invoice No' => $invoice_no ?? 'N/A', // Add this field if it exists
                'Order Id' => $order['order_id'],
                'Order Date' => $order['date'],
                'Transaction Id' => $order['txn_id'],
                'Razorpay Order Id' => $order['razorpay_order_id'],
                'Customer Name' => $order['customer_name'] ?? 'N/A',
                'Customer Email' => $order['customer_email'] ?? 'N/A',
                'Customer Phone' => $order['customer_phone'] ?? 'N/A',
                'Total Items' => $order['total_items'] ?? 'N/A', // Add this field if it exists
                'Total Quantity' => $order['total_quantity'] ?? 'N/A', // Add this field if it exists
                'Total Amount' => $order['grand_total'],
                'Discount Amount' => $order['coupon'] ?? 'N/A',
                'Payment Option' => $order['payment_option'],
                'Need to Pay' => $order['need_to_pay'],
                'Partial Paid' => $order['partial_amount'],
                'Billing Address' => $order['billing_address'] ?? 'N/A', // Add this field if it exists
                'Shipping Address' => $order['shipping_address'] ?? 'N/A', // Add this field if it exists
                'Shiprocket Id' => $order['shiprocket_order_id'],
                'Order Status' => $order['order_status'],
                'Payment Status' => $order['payment_status'],
                'State' => $cart_address ? $cart_address->state : 'N/A',
            ];
        });
    }

    /**
     * Define the headings for the Excel file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Invoice No',
            'Order Id',
            'Order Date',
            'Transaction Id',
            'Razorpay Order Id',
            'Customer Name',
            'Customer Email',
            'Customer Phone',
            'Total Items',
            'Total Quantity',
            'Total Amount',
            'Discount Amount',
            'Payment Option',
            'Need to Pay',
            'Partial Paid',
            'Billing Address',
            'Shipping Address',
            'Shiprocket Id',
            'Order Status',
            'Payment Status',
            'State',
        ];
    }
}