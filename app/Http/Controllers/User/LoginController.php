<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Goidichvu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Theloai;

class LoginController extends Controller
{
    public function getLogin()
    {
        $listtheloai = Theloai::all();
        return view('user.login', compact('listtheloai'));
    }

    public function postLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email_user' => 'required|email:filter',
                'pass_user' => 'required',
            ],
            [
                'email_user.required' => 'Vui lòng nhập Email',
                'pass_user.required' => 'Vui lòng nhập mật khẩu',
            ]
        );


        if (Auth::attempt([
            'email' => $request->input('email_user'),
            'password' => $request->input('pass_user'),
            // 'roll'=>0,
        ], $request->input('remember'))) {
            // $email=(string)$request->input('email');
            // $this->mainController->admin($email);
            return redirect()->route('trangchu');
            // return dd('alo');
        }

        session()->flash('error', 'Email hoặc Password không đúng!');
        return redirect()->back();
        // return dd('alo');
    }

    public function logout_user()
    {
        if (auth::logout()) {
            return redirect()->route('login_user');
        }
        return redirect()->back();
    }
    // Đăng ký user
    public function postdangky(Request $request)
    {
        // return dd($request);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email_dk');
        $user->password = bcrypt($request->input('pass_dk'));
        $user->save();
        // $user->user_theloai()->attach($request->input('theloai'));
        return redirect()->route('login_user')->with('success', 'Đăng ký thành công!');
    }
    // check email trùng khi đăng ký
    public function checkEmail(Request $request)
    {
        $email = (string)$request->input('email_dk');
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function getDangKy()
    {
        $goidichvu = Goidichvu::where('trangthai', 1)->orderBy('sapxephang', 'ASC')->get();
        return view('user.dangkygoi', compact('goidichvu'));
    }

    public function vnpay(Request $request)
    {
        $gia = (int)$request->input('gia');
        $goi_id = (int)$request->input('goi_id');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thanh-cong";
        $vnp_TmnCode = "FOU7AZZR"; //Mã website tại VNPAY 
        $vnp_HashSecret = "CGMYLXSCGNYWLWIQFTJTODWUPFEXDASX"; //Chuỗi bí mật

        $vnp_TxnRef = Carbon::now()->format('Y-m-d H:i:s'); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $goi_id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $gia * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate"=>$vnp_ExpireDate

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            $user = Auth::user();
            $thoigian = Goidichvu::find($goi_id);
            DB::table('user_goi')->insert([
                'user_id' => $user->id,
                'goi_id' => $goi_id,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays($thoigian->thoigian),

            ]);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    //Thanh toán thành công
    public function thanhcong(){
        $listtheloai = Theloai::all();

        return view('user.thanhcong',compact('listtheloai'));
    }

    public function dktheloai(Request $request){
        $user = Auth::user();
        $user->user_theloai()->attach($request->input('theloai'));
        return redirect()->route('trangchu');
    }

    //ADMIN
    public function getLoginAdmin()
    {
        return view('admin.login_admin');
    }
    public function postLoginAdmin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email_admin' => 'required|email:filter',
                'pass_admin' => 'required',
            ],
            [
                'email_admin.required' => 'Vui lòng nhập Email',
                'pass_admin.required' => 'Vui lòng nhập mật khẩu',
            ]
        );


        if (Auth::attempt([
            'email' => $request->input('email_admin'),
            'password' => $request->input('pass_admin'),
            'role' => 1,
        ], $request->input('remember'))) {

            return redirect()->route('trangchuadmin');
        }

        session()->flash('error', 'Email hoặc Password không đúng!');
        return redirect()->back();
    }

    public function logout_admin()
    {
        if (auth::logout()) {
            return redirect()->route('login_admin');
        }
        return redirect()->back();
    }
}
