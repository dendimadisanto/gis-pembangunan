<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SumberDana;

class SumberDanaController extends Controller
{

   function get(){
       try{
            $table = new SumberDana();
            $res = $table->all();

            if($res){
                $out = [
                    'success' => true,
                    'data' => $res 
                ];
            }
            else{
                $out = [
                    'success' => false,
                    'msg' => 'Something wrong' 
                ];
            }
    
            return response()->json($out);
       }
       catch(Exception $error){
        return response()->json([
            'success' => false,
            'msg' => 'Error' 
        ]);
       }
   }

   function getById($id){
    try{
        $res = SumberDana::find($id);

         if($res){
             $out = [
                 'success' => true,
                 'data' => $res 
             ];
         }
         else{
             $out = [
                 'success' => false,
                 'msg' => 'Something wrong' 
             ];
         }
 
         return response()->json($out);
    }
    catch(Exception $error){
     return response()->json([
         'success' => false,
         'msg' => 'Error' 
     ]);
    }
}

   function addData(Request $request){
    try {
        $this->validate($request,[
            'sumber_dana' => 'required',
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        if($request->id==0){
            $filename='no_image.jpg';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path("upload/marker"), $filename);
            }
            $params = array(
                'nama' => $request->sumber_dana,
                'icon' => $filename
            );
            
            $res = SumberDana::create($params);
        }
       

        if($res){
            $out = [
                'success' => true,
                'msg' => 'Data Berhasil Disimpan' 
            ];
        }
        else{
            $out = [
                'success' => false,
                'msg' => 'Data Gagal Disimpan' 
            ];
        }

        return response()->json($out);
    } catch (Exception $error) {
       
        return response()->json([
            'success' => false,
            'msg' => 'Data Gagal Disimpan' 
        ]);
    }
   
   }
}
