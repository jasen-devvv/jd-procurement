<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        /* Global Styling */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Header Styling */
        #header {
            background-color: #003366; /* Dark blue */
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 4px solid #2e6f97; /* Accent line */
        }

        #header img {
            max-height: 50px;
            vertical-align: middle;
            margin-right: 15px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2e6f97; /* Elegant blue */
            color: white;
            font-weight: bold;
        }

        /* Add striped rows for better readability */
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Footer and other sections */
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .footer p {
            margin: 0;
        }

        /* Print Styling */
        @media print {
            body {
                font-size: 12px;
                margin: 0;
                padding: 0;
            }

            #header {
                font-size: 20px;
                padding: 10px;
                text-align: center;
            }

            table {
                width: 100%;
                font-size: 12px;
            }

            th, td {
                padding: 8px;
                text-align: left;
            }

            /* Remove unnecessary elements for print */
            .footer {
                display: none;
            }

            /* Add a page break after the table for neatness */
            table {
                page-break-after: always;
            }

            hr {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div id="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo">
        E-Procurement
    </div>

    <hr />
    <hr />
    <hr />

    <div>
        <div>Name: January</div>
        <div>Date: 01/01/2025</div>
    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Column</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    <td>Total Suppliers</td>
                    <td>{{ $report->total_suppliers }}</td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Total Products</td>
                    <td>{{ $report->total_products }}</td>
                </tr>
                <tr>
                    <th>3</th>
                    <td>Total Orders</td>
                    <td>{{ $report->total_orders }}</td>
                </tr>
                <tr>
                    <th>4</th>
                    <td>Top Supplier</td>
                    <td>{{ $report->top_supplier_id ? $report->supplier->name : "empty" }}</td>
                </tr>
                <tr>
                    <th>5</th>
                    <td>Total Top Supplier</td>
                    <td>{{ $report->top_supplier_total }}</td>
                </tr>
                <tr>
                    <th>6</th>
                    <td>Top Product</td>
                    <td>{{ $report->top_product_id ? $report->product->name : "empty" }}</td>
                </tr>
                <tr>
                    <th>7</th>
                    <td>Total Top Product</td>
                    <td>{{ $report->top_product_total }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p><strong>Report Generated:</strong> {{ date('Y-m-d H:i:s') }}</p>
        <p><strong>Generated by:</strong> E-Procurement System</p>
        <p>Thank you for your attention. For any further inquiries, please contact us at support@eprocurement.com.</p>
    </div>
</body>
</html>
