<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;

class BrandController extends Controller
{
        public function index(Request $req){
            $brands = Brands::all();

            if($brands->count()>0){

                return response()->json([
                    'status'=> 200,
                    'brands' =>  $brands
                ], 200);

            }else{
                return response()->json([
                    'status'=> 404,
                    'message' =>  'no records found'
                ], 404);
            }
           
        }


        public function add(Request $req){
            $brands = new Brands;
            $brands->brandName = $req->brandName;
            $brands->ownerName = $req->ownerName;
            $brands->numberOfCrates = $req->numberOfCrates;
            $brands->save();
            return response()->json([
                'status'=> 200,
                'brands' =>  $brands
            ], 200);        }


            public function delete(Request $req) {
                try {
                    $brand = Brands::find($req->id);
                    if (!$brand) {
                        return response()->json([
                            'status' => 404,
                            'error' => 'Brand not found'
                        ], 404);
                    }
            
                    $brand->delete();
            
                    return response()->json([
                        'status' => 200,
                        'message' => 'Brand deleted successfully',
                        'brand' => $brand
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 500,
                        'error' => 'Internal server error: ' . $e->getMessage()
                    ], 500);
                }
            }
        
    


    

        public function update(Request $req, $id) {
            try {
                // Find the brand by ID
                $brand = Brands::findOrFail($id);
        
                // Validate the request data
                $req->validate([
                    'brandName' => 'required',
                    'ownerName' => 'required',
                    'numberOfCrates' => 'required'
                ]);
        
                // Update the brand with the provided data
                $brand->update([
                    'brandName' => $req->brandName,
                    'ownerName' => $req->ownerName,
                    'numberOfCrates' => $req->numberOfCrates,
                ]);
        
                // Return a success response
                return response()->json([
                    'status' => 200,
                    'message' => 'Brand updated successfully',
                    'brand' => $brand
                ], 200);
            } catch (\Exception $e) {
                // Return an error response if any exception occurs
                return response()->json([
                    'status' => 500,
                    'error' => 'Internal server error: ' . $e->getMessage()
                ], 500);
            }
        }
}