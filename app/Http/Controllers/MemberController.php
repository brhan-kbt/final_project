<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Family;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   
     public function home(){

         return view('memberadmin.home');
         
     }
     
    public function index( Request $request)
    {
         $members=Member::all();
         return view('memberadmin.indexMember')->with('members', $members);

        // if ($request->ajax()) {
        //     $data = Member::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
        //                 $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
        //                 return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        // return view('memberadmin.indexMember');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memberadmin.registerform');
    }
    public function register(){
        return view('pages.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $this->validate($request, [
        //     'title'=> 'required',
        //     'body'=> 'required',
        //     'cover_image'=>'image|nullable|max:1999',
        // ]);



             $this->validate($request, [
               'mfullname'=>'required',
               'member-age'=>'required',
               'member-sex'=>'required|in:Male,Female',
               'gfathername'=>'required',
               'mothername'=>'required',
               'baptismalName'=>'required',
               'churchBaptized'=>'required',
               'repetanceFname'=>'required',
               'birthplace'=>'required',
               'phone'=>'required|unique:members,phone',
               'address'=>'required',
               'profileImg'=>'required|image',
               'username'=>'required|unique:user_accounts,username',
               'password'=>'required|min:6|max:12',


        //     'gender'=>'required',
        //     'birthDate'=>'required',
        //     'relationShip'=>'required',
         ]);

        //handle the file upload
         if($request->hasFile('profileImg')){
             //get file name extension

             $fienamewithExt=$request->file('profileImg')->getClientOriginalName();
                 //get file name
             $filename=pathinfo($fienamewithExt,PATHINFO_FILENAME);
                 //get file extension
             $extension=$request->file('profileImg')->getClientOriginalExtension();
                 //file name to store
            $fileNameToStore=$filename .'_'.time().'.'.$extension;

             $path=$request->file('profileImg')->storeAs('public/images',$fileNameToStore);


         }else{
             $fileNameToStore='noimage.jpg';
         }


       $member=new Member();
       $member->fullName=$request->input('mfullname');
       $member->age=$request->input('member-age');
       $member->sex=$request->input('member-sex');
       $member->grandName=$request->input('gfathername');
       $member->motherName=$request->input('mothername');
       $member->baptismalName=$request->input('baptismalName');
       $member->churchBaptize=$request->input('churchBaptized');
       $member->repetanceFatherName=$request->input('repetanceFname');
       $member->birthPlace=$request->input('birthplace');
       $member->phone=$request->input('phone');
       $member->address=$request->input('address');
       $member->profileImg=$fileNameToStore;
       $member->status='Not Active';
       $member->save();



       $pass=$request->input('password');
       $password=Hash::make($pass);

       $userAccount= new UserAccount();
       $userAccount->username=$request->input('username');
       $userAccount->password= $password;
       $userAccount->userType='member';
       $userAccount->member_id=$member->id;
       $userAccount->admin_id=0;//We can not register from user side so we don't have admin->id
       $userAccount->save();

       if ($request->has(['familyfullname1', 'familyage1', 'familysex1', 'familydob1', 'relationship'])) {
           $family= new Family();
           $family->fullName=$request->input('familyfullname1');
           $family->age=$request->input('familyage1');
           $family->gender=$request->input('familysex1');
           $family->birthDate=$request->input('familydob1');
           $family->relationShip=$request->input('relationship');
           $family->member_id=$member->id;
           $family->save();
       }

       return redirect('/register')->with('success',"Registered Successfully!");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member= Member::find($id);
        return view('memberadmin.EditMember')->with('member', $member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            $this->validate($request, [
               'mfullname'=>'required',
               'member-age'=>'required',
               'member-sex'=>'required|in:Male,Female',
               'gfathername'=>'required',
               'mothername'=>'required',
               'baptismalName'=>'required',
               'churchBaptized'=>'required',
               'repetanceFname'=>'required',
               'birthplace'=>'required',
               'phone'=>'required',
               'address'=>'required',
               'profileImg'=>'image|nullable',



        //     'gender'=>'required',
        //     'birthDate'=>'required',
        //     'relationShip'=>'required',
         ]);

        //handle the file upload
         if($request->hasFile('profileImg')){
             //get file name extension

             $fienamewithExt=$request->file('profileImg')->getClientOriginalName();
                 //get file name
             $filename=pathinfo($fienamewithExt,PATHINFO_FILENAME);
                 //get file extension
             $extension=$request->file('profileImg')->getClientOriginalExtension();
                 //file name to store
            $fileNameToStore=$filename .'_'.time().'.'.$extension;

             $path=$request->file('profileImg')->storeAs('public/images',$fileNameToStore);


         }else{
             $fileNameToStore='noimage.jpg';
         }


       $member=Member::find($id);

       $member->fullName=$request->input('mfullname');
       $member->age=$request->input('member-age');
       $member->sex=$request->input('member-sex');
       $member->grandName=$request->input('gfathername');
       $member->motherName=$request->input('mothername');
       $member->baptismalName=$request->input('baptismalName');
       $member->churchBaptize=$request->input('churchBaptized');
       $member->repetanceFatherName=$request->input('repetanceFname');
       $member->birthPlace=$request->input('birthplace');
       $member->phone=$request->input('phone');
       $member->address=$request->input('address');
       if($request->hasFile('profileImg')){
                  $member->profileImg=$fileNameToStore;
       }
    //   dd($member->families);

       $member->save();




        //  foreach ($member->families as $family) {
        //      $family= new Family();
        //      $family->fullName=$request->input('familyfullname1');
        //      $family->age=$request->input('familyage1');
        //      $family->gender=$request->input('familysex1');
        //      $family->birthDate=$request->input('familydob1');
        //      $family->relationShip=$request->input('relationship');
        //      $family->member_id=$member->id;
        //      $family->save();
        //  }
        // }

       return redirect('member/manage-members/')->with('success',"Registered Successfully!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}