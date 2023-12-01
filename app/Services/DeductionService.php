<?php
namespace App\Services;

use App\Models\Deduction;

class DeductionService {


    /**
     * Get all deductions
     *
     * @return array
     */
    public function index(){
        $deductions = Deduction::where('company_id',auth('sanctum')->user()->company_id)->where('status','1')->get();
        return $deductions;
    }

    
    /**
     * store the deduction.
     *
     * @return array
     */
    public function store($request){
        $company_id = auth('sanctum')->user()->company_id;
        $isDeductionAvailable = Deduction::where('company_id',$company_id)->where('deduction_type',$request->deduction_type)->first();
        if(!$isDeductionAvailable){
            // create deduction data
            $deduction = new Deduction;
            $deduction->user_id = auth('sanctum')->id();
            $deduction->company_id = $company_id;
            $deduction->deduction_type = $request->deduction_type;
            $deduction->deduction_amount = $request->deduction_amount;
            if($deduction->save()){
                return $deduction;
            }
        } else {
            return false;
        }
    }
    
   
    /**
     * Get a deduction
     *
     * @return array
     */    
    public function show($id){
        $deduction = Deduction::find($id);
        if ($deduction) {
            return $deduction;
        } else {
            return false;
        }
    }


     /**
     * update the request to deductions
     *
     * @return array
     */
    public function update($request,$id){
        // update deduction data
        $deduction = Deduction::find($id);
        if($deduction){
            $deduction->deduction_type = $request->deduction_type;
            $deduction->deduction_amount = $request->deduction_amount;
            if($deduction->save()){
                return $deduction;
            } else{
                return false;
            }
        } else{
            return false;
        }
        
    }

    /**
     * Destroy a  deduction
     *
     * @return array
     */    
    public function destroy($id){
        $deductin = Deduction::find($id);
        if($deductin){
        $deductin->delete();
        return true;
        } else{
            return false;
        }
    }

     /**
     * Update deduction status
     *
     * @return array
     */    
    public function status($request,$id){
        $deduction = Deduction::find($id);
        if($deduction){
            $deduction->status = $request->status;
            $deduction->save();
            return true;
        } else{
            return false;
        }
    }
}