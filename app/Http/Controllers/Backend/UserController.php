<?php 

namespace App\Http\Controllers\Backend;

use Auth;
use Validator;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Helpers\UploadHelper;

class UserController extends Controller {
    public function __construct()
    {
        $this->middleware('role:admin', ['except'=> [
            'getProfile',
            'postProfile'
        ]]);
        $this->middleware('permission:lock-user|unlock-user', ['only' => [
            'deleteBan', 
            'getUnlock'
        ]]);

        $this->middleware('csrf4Get', ['only'=>[
            'deleteBan',
            'getUnlock'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $users = User::where('status','<>',User::STT_INACTIVE)->paginate(env('ITEM_PER_PAGE',20));
        return view('backend.user.index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getAdd()
    {
        $user = new User();
        return view('backend.user.add', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserFormRequest  $request
     * @return Response
     */
    public function postStore(UserFormRequest $request)
    {
        $user = User::create($request->all());
        $user->password = Hash::make($request->get('password'));
        $user->status = User::STT_PENDING;

        if ( null !== $request->file('avatar') ) {
            $user->avatar = UploadHelper::image($request->file('avatar'), 'avatars');
        }  

        $user->save();
        foreach ($request->get('roles') as $key => $roleid) {
            $user->roles()->attach($roleid);
        }
        return redirect( route('backend::user.edit',[$user->id]) )->with('status', 'Thêm user thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getShow($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        return view('backend.user.edit', array('user'=>$user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserFormRequest  $request
     * @return Response
     */
    public function postUpdate(UserFormRequest $request)
    {        
        $user = User::whereId($request->get('id'))->firstOrFail();
        $user->fill($request->all());
        if ('' != $request->get('password')) {
          $user->password = Hash::make($request->get('password'));
        }
        
        //Xử lý avatar
        if (null !== $request->get('avatar_remove')) {
            UploadHelper::cleanOldImage(public_path().$user->avatar);
            $user->avatar = null;
        }
        if ( null !== $request->file('avatar') ) { 
            if (null !== $user->avatar){
                UploadHelper::cleanOldImage(public_path().$user->avatar);                
            }
            $user->avatar = UploadHelper::image($request->file('avatar'), 'avatars');
        }        

        // Lưu phân quyền
        $user->roles()->sync($request->get('roles'));

        $user->save();
        return redirect(route('backend::user.edit',[$user->id]) )->with('status', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteBan($id)
    {
        $user = User::whereId($id)->firstOrFail();   
        if (User::STT_INACTIVE == $user->status) {
            return array("hasError"=>true, 'message'=> '<i class="fa fa-times-circle"></i> Lỗi: User này đang bị khóa rồi. Không cần khóa lại!.');
        } 
        $user->status = User::STT_INACTIVE;
        if ($user->save()) {
            return array("hasError"=>false, 'message' => '<i class="fa fa-check"></i> Đã Khóa!');
        }
        return array("hasError"=>true, 'message'=> '<i class="fa fa-times-circle"></i> Lỗi: không khóa được.');
    }
    /**
     * Display list user was banned
     *
     * @return Response
     */
    public function getJail()
    {   
        $users =  $users = User::where('status','=',User::STT_INACTIVE)->paginate(env('ITEM_PER_PAGE',20));
        return view('backend.user.index', ['users' => $users]);
        
    }

    /**
     * Unlock user from the jail
     *
     * @param  int  $id
     * @return Response
     */
    public function getUnlock($id)
    {
        $user = User::whereId($id)->firstOrFail();        
        $user->status = User::STT_ACTIVE;
        if ($user->save())
            return redirect( route('backend::user.jail') )->with('status', ' Mở khóa thành công!');
        return redirect( route('backend::user.jail') )->with('error', ' Lỗi không thể mở khóa cho tài khoản '.$user->email);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getProfile()
    {
        $user = User::whereId(Auth::user()->id)->firstOrFail();
        return view('backend.user.profile', array('user'=>$user));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  UserFormRequest  $request
     * @return Response
     */
    public function postProfile(UserFormRequest $request)
    {        
        $user = User::whereId(Auth::user()->id)->firstOrFail();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if ('' != $request->get('password_current')) {
            if (!Hash::check($request->get('password_current'), $user->password)) {
                return redirect(route('backend::user.profile'))                    
                    ->with('error', 'Sai mật khẩu hiện tại');
            }
            $user->password = Hash::make($request->get('password'));
        }
        
        //Xử lý avatar
        if (null !== $request->get('avatar_remove')) {
            UploadHelper::cleanOldImage(public_path().$user->avatar);
            $user->avatar = null;
        }
        if ( null !== $request->file('avatar') ) { 
            if (null !== $user->avatar){
                UploadHelper::cleanOldImage(public_path().$user->avatar);                
            }
            $user->avatar = UploadHelper::image($request->file('avatar'), 'avatars');
        }

        $user->save();
        return redirect(route('backend::user.profile') )->with('status', 'Cập nhật thành công!');
    }
}