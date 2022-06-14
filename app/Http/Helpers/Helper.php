<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
/**
 *
 * Class Helper
 *
 * @author ÖMER MİRAÇ KÖKÇAM <omermirac.kokcam@gmail.com>
 */
class Helper
{
    /**
     * @param $data
     * @return string
     * strip all tags
     */
    public static function strip_tags($data){
        return strip_tags($data);
    }

    /**
     * @param $model
     * @param $first_column_titles
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * create an excel table of the table you want
     */
    public static function create_excel_table($table_name){
        try {
            $list = DB::table($table_name)->get();
        } catch (\Exception $e) {
            echo "Error!";
            echo $e->getMessage();
            return view('todo.index')->with('Download Excel Error');
            exit();
        }
        $spreadsheet = new Spreadsheet();
        // Add some data
        /* Set active worksheet to first */
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setTitle('List');
        $spreadsheet->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true); // makes the first line bold.
        /* Add some data to the worksheet */
        $columns = Schema::getColumnListing($table_name);
        $alphabet = ['A','B','C','D','E','F','G','H'];
        $row_number = 1;
        foreach ($columns as $key=>$column){
            $spreadsheet->getActiveSheet()->SetCellValue($alphabet[$key].$row_number, $column);
        }
        foreach ($list as $item){
            ++$row_number;
            foreach ($columns as $key=>$column) {
                $spreadsheet->getActiveSheet()->SetCellValue($alphabet[$key] . $row_number, $item->$column);
            }
        }
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ToDo List.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
