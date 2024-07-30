<?php
require_once 'dbh.inc.php';
require_once 'get_users.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Dompdf\Dompdf;

$format = $_GET['format'] ?? 'csv';

switch ($format) {
    case 'csv':
        generate_csv($pdo);
        break;
    case 'pdf':
        generate_pdf($pdo);
        break;

    case 'excel':
        generate_excel($pdo);
        break;

    default:
        echo 'Invalid format';
        break;
}

function generate_csv($pdo)
{
    $users = get_users($pdo);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=users_report.csv');

    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Username', 'Email', 'Role']);

    foreach ($users as $user) {
        $role = $user['isAdmin'] ? 'Admin' : 'User';
        fputcsv($output, [$user['id'], $user['username'], $user['email'], $role]);
    }

    fclose($output);
    exit();
}

function generate_pdf($pdo)
{
    $users = get_users($pdo);

    $dompdf = new Dompdf();
    $html = '<h1>Users Report</h1><table border="1" cellpadding="5"><thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr></thead><tbody>';
    foreach ($users as $user) {
        $role = $user['isAdmin'] ? 'Admin' : 'User';
        $html .= '<tr><td>' . $user['id'] . '</td><td>' . $user['username'] . '</td><td>' . $user['email'] . '</td><td>' . $role . '</td></tr>';
    }
    $html .= '</tbody></table>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('users_report.pdf');
    exit();
}

function generate_excel($pdo)
{
    $users = get_users($pdo);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'ID')
        ->setCellValue('B1', 'Username')
        ->setCellValue('C1', 'Email')
        ->setCellValue('D1', 'Role');

    $rowNum = 2;
    foreach ($users as $user) {
        $role = $user['isAdmin'] ? 'Admin' : 'User';
        $sheet->setCellValue('A' . $rowNum, $user['id'])
            ->setCellValue('B' . $rowNum, $user['username'])
            ->setCellValue('C' . $rowNum, $user['email'])
            ->setCellValue('D' . $rowNum, $role);
        $rowNum++;
    }

    ob_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="users_report.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
