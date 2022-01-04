<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasklist;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function AllTask(){
       

       $tasklists=Tasklist::latest()->paginate(10);// when we use pagination base query//
     
        $todays=Tasklist::whereDate('created_at'," >= " ,Carbon::today())->whereDate('created_at'," < " ,Carbon::tomorrow())->count();
         
         $current_weeks =Tasklist::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $months= Tasklist::whereMonth('created_at', date('m'))
         ->whereYear('created_at', date('Y'))
         ->count();

        return view('admin.task.index',compact('tasklists','todays','current_weeks','months'));

    }
    public function AddTask(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:tasklists|max:255',
            
        ],
        [
            'name.required' => 'Please Input Task Name',//custom message
            'name.max' => ' Tasklist Less Then 255 Character ',
            
        ]);
       
        Tasklist::insert([
            'name' => $request->name,
            'user_id'=>Auth::user()->id,
            'created_at' =>carbon::now()
        ]);
       


        return redirect()->back()->with('success', 'Tasklist Inserted Successfully' );
    }

    public function Edit($id){
      
             $tasklists= DB::table('tasklists')->where('id',$id)->first();
            return view('admin.task.edit',compact('tasklists'));
    }
    public function Update(Request $request,$id){
        
           
                $data=array();
                $data['name']=$request->name;
                $data['user_id']=Auth::user()->id;
                DB::table('tasklists')->where('id',$id)->update($data);
        return redirect()->route('all.tasklist')->with('success', 'Tasklist Update Successfully' );
    }

    public function status(Request $request,$status,$id){
        $model=Tasklist::find($id);
        $model->status=1;
        $model->save();
        return redirect()->route('all.tasklist')->with('success', 'Tasklist Status Completed Successfully' );
       }
       public function changeStatus(Request $request)
        {
            $user = Tasklist::find($request->user_id);
            $user->status = $request->status;
            $user->save();
      
            return response()->json(['success'=>'Status completed successfully.']);
        }
 
    public function Delete($id){
        $delete=  Tasklist::find($id)->delete();
      

        return redirect()->back()->with('success','Tasklist Permanently Deleted Successfully');

    }
}
