<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function profile($id){
        $user =  User::find($id);
        if ( ! $user){
            abort(404);
        }

        $title = $user->name;
        return view(theme('profile'), compact('user', 'title'));
    }

    public function review($id){
        $review = Review::find($id);
        $title = 'Review by '. $review->user->name;

        return view(theme('review'), compact('review', 'title'));
    }

    public function updateWishlist(Request $request){
        $course_id = $request->course_id;

        $user = Auth::user();
        if ( ! $user->wishlist->contains($course_id)){
            $user->wishlist()->attach($course_id);
            $response = ['success' => 1, 'state' => 'added'];
        }else{
            $user->wishlist()->detach($course_id);
            $response = ['success' => 1, 'state' => 'removed'];
        }

        $addedWishList = DB::table('wishlists')->where('user_id', $user->id)->pluck('course_id');

        $user->update_option('wishlists', $addedWishList);

        return $response;
    }



    public function changePassword(){
        $title = __a('change_password');
        return view('admin.change_password', compact('title'));
    }

    public function changePasswordPost(Request $request){
        if(config('app.is_demo')){
            return redirect()->back()->with('error', 'This feature has been disable for demo');
        }
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
            'new_password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        if(Auth::check()) {
            $logged_user = Auth::user();

            if(Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();
                return redirect()->back()->with('success', __a('password_changed_msg'));
            }
            return redirect()->back()->with('error', __a('wrong_old_password'));
        }
    }


    public function users(Request $request){
        $ids = (array) $request->bulk_ids;

        if ( is_array($ids) && in_array(1, $ids)){
            return back()->with('error', __a('admin_non_removable'));
        }

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)){
            User::whereIn('id', $ids )->update(['active_status' => $request->status]);
            return back()->with('success', __a('bulk_action_success'));
        }

        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)){
            if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));

            User::whereIn('id', $ids )->delete();
            return back()->with('success', __a('bulk_action_success'));
        }

        $users = User::query();
        if ($request->q){
            $users = $users->where(function($q)use($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }

        if ($request->filter_user_group){
            $users = $users->where('user_type', $request->filter_user_group);
        }
        if ($request->filter_status){
            $users = $users->where('active_status', $request->filter_status);
        }


        $title = __a('instructors');
        $users = $users->where('user_type','instructor')->orderBy('id', 'desc')->paginate(100);

        return view('admin.users.index', compact('title', 'users'));
    }
    public function students(Request $request){
        $ids = (array) $request->bulk_ids;

        if ( is_array($ids) && in_array(1, $ids)){
            return back()->with('error', __a('admin_non_removable'));
        }

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)){
            User::whereIn('id', $ids )->update(['active_status' => $request->status]);
            return back()->with('success', __a('bulk_action_success'));
        }

        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)){
            if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));

            User::whereIn('id', $ids )->delete();
            return back()->with('success', __a('bulk_action_success'));
        }

        $users = User::query();
        if ($request->q){
            $users = $users->where(function($q)use($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }

        if ($request->filter_user_group){
            $users = $users->where('user_type', $request->filter_user_group);
        }
        if ($request->filter_status){
            $users = $users->where('active_status', $request->filter_status);
        }


        $title = __a('students');
        $users = $users->where('user_type','student')->orderBy('id', 'desc')->paginate(100);

        return view('admin.users.students', compact('title', 'users'));
    }
    public function addAdministrator(){
        $title = __a('add_instructor');
        return view('admin.users.add_user',compact('title'));
    }
    public function storeAdministrator(Request  $request){
        if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));
        $gender = "male";
        $rules = [
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'min:8'
        ];
        $this->validate($request, $rules);

        if($request->gender == 0){
            $gender = "female";
        }
        $data = [
            'name'               => clean_html($request->username),
            'email'         => clean_html($request->email),
            'password'        => Hash::make(clean_html($request->password)),
            'gender'           => $gender,
            'user_type'            => clean_html($request->user_type),
            'active_status' => 1
        ];
        $is_create = User::create($data);
        return back()->with('success', __a('user_created'));
    }
    public function editAdministrator($id){
        $title = __a('edit_instructor');
        $user = User::query();
        $instructor = $user->where('id',$id)->first();
        return view('admin.users.edit_user',compact('title','instructor'));
    }
    public function addStudent(){
        $title = __a('add_student');
        $instructors = User::all()->where('user_type','instructor');
        return view('admin.users.add_student', compact('title','instructors'));
    }
    public function storeStudent(Request  $request){
        if(config('app.is_demo')) return back()->with('error', __a('demo_restriction'));
        $gender = "male";
        $rules = [
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'min:8'
        ];
        $this->validate($request, $rules);

        if($request->gender == 0){
            $gender = "female";
        }
        $data = [
            'name'               => clean_html($request->username),
            'email'         => clean_html($request->email),
            'password'        => Hash::make(clean_html($request->password)),
            'gender'           => $gender,
            'user_type'            => clean_html($request->user_type),
            'instructor_id'         => $request->select_instructor,
            'active_status'       => 1
        ];
        $is_create = User::create($data);
        return back()->with('success', __a('user_created'));
    }
    public function editStudent($id){
        $title = __a('edit_student');
        $user = User::query();
        $instructor = $user->where('user_type','instructor');
        $student = $user->where('id',$id)->first();
        return view('admin.users.edit_student')->with('title','student','instructor');
    }
}
