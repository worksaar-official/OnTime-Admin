<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreConfigController extends Controller
{
    /**
     * Check if extra packaging should be mandatory or optional based on StoreConfig
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkExtraPackagingRequirement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_id' => 'required|integer|exists:stores,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $storeId = $request->store_id;

        $store = Store::find($storeId);
        if (!$store) {
            return response()->json(['error' => 'Store not found'], 404);
        }

        $storeConfig = StoreConfig::firstOrNew(['store_id' => $storeId]);
        $isMandatory = (bool) $storeConfig->extra_packaging_default;

        return response()->json([
            'store_id' => $storeId,
            'extra_packaging_mandatory' => $isMandatory,
            'extra_packaging_default' => $storeConfig->extra_packaging_default,
            'extra_packaging_status' => $storeConfig->extra_packaging_status,
            'extra_packaging_amount' => $storeConfig->extra_packaging_amount,
            'message' => $isMandatory ? 'Extra packaging is mandatory' : 'Extra packaging is optional'
        ], 200);
    }
}