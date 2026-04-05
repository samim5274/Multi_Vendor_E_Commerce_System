<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function getAuthUser(Request $request){

        try{
           $user = $request->user();
            $vendor = $user->vendor;

            if(!$vendor){
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor not found for this user.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $vendor
            ], 200);
        }catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Vendor fetched failed. ' . $e->getMessage()
            ], 500);
        }
    }

    public function editVendor(Request $request, $id){
        try{

            $user = $request->user();
            $vendor = $user->vendor;

            if (!$vendor) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor not found for this user.'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'shop_name'        => 'required|string|max:255',
                'shop_slug'        => 'required|string|max:255|unique:vendors,shop_slug,' . $request->vendor_id,
                'shop_description' => 'required|string|max:1000',
                'email'            => 'nullable|email|max:255',
                'phone'            => 'nullable|string|max:20',
                'address'          => 'nullable|string|max:500',
                'city'             => 'nullable|string|max:100',
                'state'            => 'nullable|string|max:100',
                'country'          => 'nullable|string|max:100',
                'postal_code'      => 'nullable|string|max:20',
                'shop_logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $vendor->update([
                'shop_name'        => $request->shop_name,
                'shop_slug'        => $request->shop_slug,
                'shop_description' => $request->shop_description,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'address'          => $request->address,
                'city'             => $request->city,
                'state'            => $request->state,
                'country'          => $request->country,
                'postal_code'      => $request->postal_code,
            ]);

            // Handle Logo Upload
            if ($request->hasFile('shop_logo')) {
                // Delete old logo if exists
                if ($vendor->shop_logo && \Storage::disk('public')->exists($vendor->shop_logo)) {
                    \Storage::disk('public')->delete($vendor->shop_logo);
                }

                $path = $request->file('shop_logo')->store("vendors/{$vendor->id}/logos", 'public');
                $vendor->shop_logo = $path;
                $vendor->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Vendor settings updated successfully',
                'data'    => $vendor
            ]);
        }catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Edited failed. ' . $e->getMessage()
            ], 500);
        }
    }
}
