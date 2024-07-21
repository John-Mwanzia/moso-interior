<?php
require_once 'dbh.inc.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Dompdf\Dompdf;

$format = $_GET['format'] ?? 'csv';

try {
    // Fetch contacts data
    $stmt = $pdo->query('SELECT first_name, last_name, email, message FROM contacts');
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    switch ($format) {
        case 'csv':
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename="contacts.csv"');

            $output = fopen('php://output', 'w');
            fputcsv($output, array('First Name', 'Last Name', 'Email', 'Message'));
            foreach ($contacts as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
            break;

        case 'pdf':
            $dompdf = new Dompdf();
            $html = '<h1>Contacts Report</h1><table border="1" cellpadding="5"><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Message</th></tr></thead><tbody>';
            foreach ($contacts as $row) {
                $html .= '<tr><td>' . $row['first_name'] . '</td><td>' . $row['last_name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['message'] . '</td></tr>';
            }
            $html .= '</tbody></table>';
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream('contacts.pdf');
            break;

        case 'excel':
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'First Name')->setCellValue('B1', 'Last Name')->setCellValue('C1', 'Email')->setCellValue('D1', 'Message');
            $rowNum = 2;
            foreach ($contacts as $row) {
                $sheet->setCellValue('A' . $rowNum, $row['first_name'])
                    ->setCellValue('B' . $rowNum, $row['last_name'])
                    ->setCellValue('C' . $rowNum, $row['email'])
                    ->setCellValue('D' . $rowNum, $row['message']);
                $rowNum++;
            }

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="contacts.xlsx"');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            break;

        default:
            echo 'Invalid format';
            break;
    }
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>
