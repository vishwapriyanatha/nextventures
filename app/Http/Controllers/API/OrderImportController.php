<?php

namespace App\Http\Controllers\API;

use App\Core\BaseController;
use App\Helper\Helper;
use App\Jobs\ProcessOrderImport;
use Illuminate\Http\Request;

define('CSV_HEADER', ['order_number', 'customer_id', 'amount', 'status']);

class OrderImportController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:20480',
        ]);

        $file = $request->file('file');

        if ((fopen($file->getRealPath(), 'r')) === false) {
            return $this->errorResponse(
                'Failed to open uploaded file'
            );
        }

        $lines = file($file, FILE_IGNORE_NEW_LINES);

        $headerDiff = array_diff(Helper::stringToArrayFormat($lines[0]), CSV_HEADER);

        if (!empty($headerDiff)) {
            return $this->errorResponse(
                'File headers not match.'
            );
        }

        unset($lines[0]);

        $rowCount = 0;
        foreach ($lines as $line) {
            $dataArray = Helper::stringToArrayFormat($line);

            if (empty($dataArray)) {
                continue;
            }

            $response = [
                'order_number' => $dataArray[0] ?? "",
                'customer_id' => $dataArray[1] ?? "",
                'total' => (float)$dataArray[2] ?? 0,
                'status' => $dataArray[3] ?? 'pending',
                'item_id' => $dataArray[4] ?? "",
            ];

            ProcessOrderImport::dispatch($response);

            $rowCount++;
        }

        return $this->successResponse(
            "Queued {$rowCount} orders for import."
        );
    }

}
