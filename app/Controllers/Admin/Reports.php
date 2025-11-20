<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ReservationModel;
use App\Models\IngredientModel;
use App\Models\UserModel;
use App\Models\OrderItemModel;
use App\Models\MenuItemModel;

class Reports extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $reservationModel = new ReservationModel();
        $ingredientModel = new IngredientModel();
        $userModel = new UserModel();

        // Get filter parameters
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');
        $reportType = $this->request->getGet('report_type') ?? 'sales';
        $search = $this->request->getGet('search') ?? '';

        // Sales Report Data
        $data['total_sales'] = $orderModel->selectSum('total')
            ->where('status', 'Completed')
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->first()['total'] ?? 0;

        $data['total_orders'] = $orderModel
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->countAllResults();

        $data['total_reservations'] = $reservationModel
            ->where('date >=', $startDate)
            ->where('date <=', $endDate)
            ->countAllResults();

        $data['avg_order_value'] = $data['total_orders'] > 0 ? 
            $data['total_sales'] / $data['total_orders'] : 0;

        // Get daily sales for chart
        $dailySales = $orderModel
            ->select('DATE(created_at) as date, SUM(total) as total')
            ->where('status', 'Completed')
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->groupBy('DATE(created_at)')
            ->orderBy('date', 'ASC')
            ->findAll();

        $data['sales_chart_labels'] = array_column($dailySales, 'date');
        $data['sales_chart_data'] = array_column($dailySales, 'total');

        // Get detailed orders for table
        $ordersQuery = $orderModel
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59');
        
        if ($search) {
            $ordersQuery->like('customer_name', $search)
                       ->orLike('id', $search);
        }

        $data['orders'] = $ordersQuery->orderBy('created_at', 'DESC')->findAll();

        // Inventory Report Data
        $data['low_stock_items'] = $ingredientModel
            ->where('quantity <=', 10)
            ->findAll();

        $data['total_inventory_value'] = $ingredientModel
            ->selectSum('quantity')
            ->first()['quantity'] ?? 0;

        // Staff Performance Data
        $data['total_staff'] = $userModel->countAll();

        // Top selling items
        $orderItemModel = new OrderItemModel();
        $data['top_items'] = $orderItemModel
            ->select('order_items.menu_item_id, COUNT(*) as order_count')
            ->join('orders', 'orders.id = order_items.order_id')
            ->where('orders.created_at >=', $startDate)
            ->where('orders.created_at <=', $endDate . ' 23:59:59')
            ->groupBy('order_items.menu_item_id')
            ->orderBy('order_count', 'DESC')
            ->limit(5)
            ->findAll();

        // Pass filter values back to view
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        $data['report_type'] = $reportType;
        $data['search'] = $search;

        // Layout variables
        $data['title'] = 'Reports';
        $data['page_title'] = 'Reports & Analytics';
        $data['page_subtitle'] = 'View business insights and statistics';
        $data['active_menu'] = 'reports';

        return view('admin/reports', $data);
    }

    public function export()
    {
        $format = $this->request->getGet('format') ?? 'csv';
        $reportType = $this->request->getGet('report_type') ?? 'sales';
        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        $orderModel = new OrderModel();

        if ($format === 'csv') {
            return $this->exportCSV($orderModel, $startDate, $endDate);
        } elseif ($format === 'pdf') {
            return $this->exportPDF($orderModel, $startDate, $endDate);
        }

        return redirect()->back();
    }

    private function exportCSV($orderModel, $startDate, $endDate)
    {
        $orders = $orderModel
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $filename = 'sales_report_' . date('Y-m-d') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Headers
        fputcsv($output, ['Order ID', 'Customer Name', 'Total', 'Status', 'Date']);
        
        // Data
        foreach ($orders as $order) {
            fputcsv($output, [
                $order['id'],
                $order['customer_name'] ?? 'N/A',
                $order['total'],
                $order['status'],
                $order['created_at']
            ]);
        }
        
        fclose($output);
        exit;
    }

    private function exportPDF($orderModel, $startDate, $endDate)
    {
        // Simple HTML-based PDF export (for basic functionality)
        // In production, use a library like TCPDF or Dompdf
        
        $orders = $orderModel
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $totalSales = $orderModel->selectSum('total')
            ->where('status', 'Completed')
            ->where('created_at >=', $startDate)
            ->where('created_at <=', $endDate . ' 23:59:59')
            ->first()['total'] ?? 0;

        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Sales Report</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #667eea; color: white; }
                .header { text-align: center; margin-bottom: 30px; }
                .summary { background: #f0f0f0; padding: 15px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Sales Report</h1>
                <p>Period: ' . $startDate . ' to ' . $endDate . '</p>
            </div>
            <div class="summary">
                <h3>Summary</h3>
                <p><strong>Total Sales:</strong> $' . number_format($totalSales, 2) . '</p>
                <p><strong>Total Orders:</strong> ' . count($orders) . '</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>';
        
        foreach ($orders as $order) {
            $html .= '<tr>
                <td>#' . $order['id'] . '</td>
                <td>' . ($order['customer_name'] ?? 'N/A') . '</td>
                <td>$' . number_format($order['total'], 2) . '</td>
                <td>' . $order['status'] . '</td>
                <td>' . date('Y-m-d H:i', strtotime($order['created_at'])) . '</td>
            </tr>';
        }
        
        $html .= '</tbody></table></body></html>';

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="sales_report_' . date('Y-m-d') . '.pdf"');
        
        // For now, output as HTML (in production, convert to actual PDF)
        echo $html;
        exit;
    }
}
