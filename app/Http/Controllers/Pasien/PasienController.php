<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Konsul;
use App\Models\Pasien;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasienController extends Controller
{
    //

    
    protected function initPaymentGateway()
    {
	// Set your Merchant Server Key
	\Midtrans\Config::$serverKey = 'SB-Mid-server-nF0FfCZfWF7W4OeOxvs1ZqA3';
	// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
	\Midtrans\Config::$isProduction = false;
	// Set sanitization on (default)
	\Midtrans\Config::$isSanitized = true;
	// Set 3DS transaction for credit card to true
	\Midtrans\Config::$is3ds = true;
    }


    public function prosesbooking(Request $request){

        $this->initPaymentGateway();

        $Pemesan = User::where('id',Auth::user()->id)->first();
        $Pasien = Pasien::where('user_id',Auth::user()->id)->first();
        $paket = Konsul::where('id',$request->konsul_id)->first();

        $Order_id = Str::random(5);
        
        $customerDetails = [
            'first_name' =>$Pemesan->nama,           
            'email' => $Pemesan->email,
            'phone' => $Pasien->no_telp,

        ]; 

        $params = [
            'enable_payments' => ['credit_card', 'mandiri_clickpay', 'cimb_clicks',
                                'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va',
                                'bca_va', 'bni_va', 'other_va', 'gopay', 'indomaret',
                                'danamon_online', 'akulaku'],
            'transaction_details' => [
                'order_id' => $Order_id,
                'gross_amount' => '20000',
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => 'days',
                'duration' => 7,
            ],
        ];


        $snap = \Midtrans\Snap::createTransaction($params);

        $book = new Pembayaran();

        $book->tanggal_pembayaran = $request->input('tanggal_booking');
        $book->pasien_id =$Pasien->id;
        $book->konsul_id = '1';
        $book->status_pemesanan = $request->input('status_pemesanan','pending');
        $book->payment_token = $snap->token;
        $book->payment_url = $snap->redirect_url;
        $book->save();

        $last_id = $book->id;


		// alert()->success('Berhasil','Menambahkan Data Profil');
		return redirect()->route('pemesan-bookingpending', $last_id)->with(['success' => 'Booking Berhasil']);

    }

    public function index(Request $request)
    {

        //melalkukan pengecekan status pembayaran
        $p = Pembayaran::where('user_id', auth()->user()->id)->first();
        if ($p->pembayaran == 'terbayar') {
            //jika terbayar ke halaman pendaftaran isi form atau bisa di ubah

           return 'bayar wes';
        } else {
            //jika belum maka melakukan konfig auth  buat merubah status
            $p = Pembayaran::where('user_id', auth()->user()->id)->first();
            $pasien = Pasien::where('user_id', auth()->user()->id)->first();

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-nF0FfCZfWF7W4OeOxvs1ZqA3';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            $order_id = Str::random(5);

            $p->update([
                'pembayaran' => 'menunggu pembayaran',
                'order_id' => $order_id,
            ]);
            $params = array(
                'transaction_details' => array(
                    'order_id' => $p->order_id,
                    // 'order_id' => $order_id,

                    'gross_amount' => 300000,
                ),
                'customer_details' => array(
                    'first_name' => auth()->user()->name,
                    'last_name' => '',
                    'email' => auth()->user()->email,
                    'phone' => $pasien->no_telp,
                ),
            );



                //bentuk cart yang akan dikirim ke midtrans
            $snapToken = \Midtrans\Snap::createTransaction($params);
            // return $snapToken;
            //kembalian nilai token untuk melakukaan pembayaran
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            // return $snapToken;

            return view('paymentgateway', ['snap_token' => $snapToken]);
        }
    }


    public function payment_post(Request $request)
    {
        //setting key server midtrans ya
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-nF0FfCZfWF7W4OeOxvs1ZqA3';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        //mengambil response dari midtrans
        $payload = $request->getContent();
        //melakukan parsing response dari midtrans
        $notification = json_decode($payload);
        // $json = json_decode($request->get('json')); //nama json dipanggil dari token yg awto kepanggil dari API
        // $order = new Siswa();


        //melakukan pengecekan status transaksi
        if ($notification->transaction_status == "settlement") {

            //mencari siswa berdasarkan order_id
            $p = Pembayaran::where('order_id', $notification->order_id)->first();

            //melakukan update pada siswa
            $c = [
                'pembayaran' => 'terbayar',
                'transaction_id' => $notification->transaction_id,
                // 'order_id' => $notification->order_id,
            ];
            //update pada siswa
            $p->update($c);
            // dd($notification);

            // return redirect('/siswa/create')->with('success', 'Pembayaran Berhasil');
        } else {
            //selain settlemned menunggu untuk melakukan pembayaran
            return 'menunggu pembayaran';
        }


    }

}
