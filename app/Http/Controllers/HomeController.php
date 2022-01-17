<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MesinMining;
use App\Models\IncomeUser;
use App\Models\Payment;
use App\Models\Datahasil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user   = Auth::User();
        $pilih  = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=', 'BCH')
        ->first();

        $user   = Auth::User();

        $payment = Payment::where('users_id', '=', $user->id)
        ->get();

        $tglawal = Payment::where('users_id', '=', $user->id)
        ->get()->last();
        $tglgl = date('Y-m-d', strtotime($tglawal->tglakhir. ' + 1 days'));
       
        //  dd($tglgl );

      

        $post   = MesinMining::where('users_id', '=', $user->id)->get();
        
        $url = Datahasil::selectRaw("coin")
        ->where('users_id', '=', $user->id)
        ->groupBy('coin')
        ->get();

        $listcoin= Datahasil::selectRaw("coin as coin")
        ->groupBy("coin")
        ->where('users_id',$user->id)
        ->first();

        $coinfirst = $listcoin->coin;

        $jmltgl = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=',  $coinfirst)
        ->groupBy('tgl')
        ->get();
      
        $pilih  = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=',  $coinfirst)
        ->first();

        $tgl = $pilih->tgl;

      
         $miner  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=',  $coinfirst)
        ->where('tgl', '=', $pilih->tgl)
        ->paginate(10);


        $total  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=',  $coinfirst)
        ->where('tgl', '=', $pilih->tgl)
        ->sum('INVERT_IDR');

        $totalcoin  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=',  $coinfirst)
        ->where('tgl', '=',$pilih->tgl )
        ->sum('nilaisbr');
       
        $post   = MesinMining::where('users_id', '=', $user->id)->get();

        $data = IncomeUser::selectRaw("sum(income) as sum,DATE_FORMAT(tgl, '%Y %m %d') tanggal")
        ->groupBy("tanggal")
        ->where('users_id',  $user->id)
        ->where('coin',  $coinfirst)  
        ->get();
        
        $group = MesinMining::where('users_id',  $user->id)
        ->where('watt',  "800")
        ->get();

        $totalweek  = Datahasil::selectRaw("sum(INVERT_IDR) as sum,
        sum(nilaisbr) as totalwallet,sum(listrik) as totallistrik,
        sum(ratelistrik) as ratelistrik,
        sum(hasillistrikkurang) as hslkrglistrik,
        sum(investor) as total,
        sum(manage) as totalmanage,
        coin as coin")
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->where('users_id', '=', $user->id)
        ->groupBy('coin')
        ->get();

       

      


        $investor = Datahasil::selectRaw("
        sum(INVERT_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();

        foreach($investor as $db )
        {
            $totalIncome = $db->totalwallet;
        }
        

        $manajer = Datahasil::selectRaw("
        sum(manage_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();

        foreach($manajer as $db )
        {
            $totalIncomeMNJ = $db->totalwallet;
        }

        return view('home',['post'=>$post,'tglgl'=>$tglgl,'coinfirst'=>$coinfirst,'miner'=>$miner,'total'=>$total,'data'=>$data,'group'=>$group,'tgl'=>$tgl,'jmltgl'=>$jmltgl,'totalweek'=>$totalweek,'totalcoin'=>$totalcoin,'totalIncome'=>$totalIncome,'totalIncomeMNJ'=>$totalIncomeMNJ,'url'=>$url,'payment'=>$payment,]);
    
    }



//page btc woi
    public function custom($coin)
    {
        $user   = Auth::User();
        $url = Datahasil::selectRaw("coin")
        ->where('users_id', '=', $user->id)
        ->groupBy('coin')
        ->get();

        $datacoin = $coin;
        $jmltgl = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->groupBy('tgl')
        ->get();

        $payment = Payment::where('users_id', '=', $user->id)
        ->get();

        $tglawal = Payment::where('users_id', '=', $user->id)
        ->get()->last();
        $tglgl = date('Y-m-d', strtotime($tglawal->tglakhir. ' + 1 days'));

        $pilih  = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->first();

        $tgl = $pilih->tgl;

        $totalcoin  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->where('tgl', '=', $pilih->tgl )
        ->sum('nilaisbr');
       
        $post   = MesinMining::where('users_id', '=', $user->id)->get();
        $miner  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->where('tgl', '=',$pilih->tgl )
        ->paginate(10);
        $total  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->where('tgl', '=', $pilih->tgl )
        ->sum('INVERT_IDR');

         $totalweek  = Datahasil::selectRaw("sum(INVERT_IDR) as sum,
        sum(nilaisbr) as totalwallet,sum(listrik) as totallistrik,
        sum(ratelistrik) as ratelistrik,
        sum(hasillistrikkurang) as hslkrglistrik,
        sum(investor) as total,
        sum(manage) as totalmanage,
        coin as coin")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->groupBy('coin')
        ->get();


        
        $investor = Datahasil::selectRaw("
        sum(INVERT_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();
        foreach($investor as $db )
        {
            $totalIncome = $db->totalwallet;
        }
        

        $manajer = Datahasil::selectRaw("
        sum(manage_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();

        foreach($manajer as $db )
        {
            $totalIncomeMNJ = $db->totalwallet;
        }

        
        return view('coincustom',['post'=>$post,'tglgl'=>$tglgl,'miner'=>$miner,'tgl'=>$tgl,'datacoin'=>$datacoin,'total'=>$total,'jmltgl'=>$jmltgl,'totalweek'=>$totalweek,'totalcoin'=>$totalcoin ,'totalIncome'=>$totalIncome,'totalIncomeMNJ'=>$totalIncomeMNJ,'url'=>$url,'payment'=>$payment,]);
       
    }


    public function ubahcoindate($coin,$tgld)
    {
        $user   = Auth::User();
        $url = Datahasil::selectRaw("coin")
        ->where('users_id', '=', $user->id)
        ->groupBy('coin')
        ->get();

        $jmltgl = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->groupBy('tgl')
        ->get();

        $tgl  = $tgld;
        $datacoin = $coin;
        $payment = Payment::where('users_id', '=', $user->id)
        ->get();

        $tglawal = Payment::where('users_id', '=', $user->id)
        ->get()->last();
        $tglgl = date('Y-m-d', strtotime($tglawal->tanggal. ' + 1 days'));
       

        $totalcoin  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', 'BTC')
        ->where('tgl', '=', $tgl )
        ->sum('nilaisbr');
       
        $post   = MesinMining::where('users_id', '=', $user->id)->get();
        $miner  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->where('tgl', '=', $tgl )
        ->paginate(10);
        $total  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', $coin)
        ->where('tgl', '=', $tgl )
        ->sum('INVERT_IDR');

        $totalweek  = Datahasil::selectRaw("sum(INVERT_IDR) as sum,
        sum(nilaisbr) as totalwallet,sum(listrik) as totallistrik,
        sum(ratelistrik) as ratelistrik,
        sum(hasillistrikkurang) as hslkrglistrik,
        sum(investor) as total,
        sum(manage) as totalmanage,
        coin as coin")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->groupBy('coin')
        ->get();


         
        $investor = Datahasil::selectRaw("
        sum(INVERT_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();
        foreach($investor as $db )
        {
            $totalIncome = $db->totalwallet;
        }
        

        $manajer = Datahasil::selectRaw("
        sum(manage_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->whereBetween('tgl', [ $tglgl,'CURDATE()'])
        ->get();

        foreach($manajer as $db )
        {
            $totalIncomeMNJ = $db->totalwallet;
        }


        return view('coindate',['post'=>$post,'tglgl'=>$tglgl,'datacoin'=>$datacoin,'coin'=>$coin,'miner'=>$miner,'total'=>$total,'tgl'=>$tgl,'jmltgl'=>$jmltgl,'totalweek'=>$totalweek,'totalcoin'=>$totalcoin,'totalIncome'=>$totalIncome,'totalIncomeMNJ'=>$totalIncomeMNJ,'url'=>$url,'payment'=>$payment,]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ubahtgl($tgld)
    {
        $user   = Auth::User();
        $jmltgl = Datahasil::selectRaw("tgl")
        ->where('users_id', '=', $user->id)
        ->where('coin', '=', 'BCH')
        ->groupBy('tgl')
        ->get();

        $url = Datahasil::selectRaw("coin")
        ->where('users_id', '=', $user->id)
        ->groupBy('coin')
        ->get();

        $payment = Payment::where('users_id', '=', $user->id)
        ->get();


        $tgl  = $tgld;
        $miner  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', 'BCH')
        ->where('tgl', '=', $tgl )
        ->paginate(10);

        

        $totalcoin  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', 'BCH')
        ->where('tgl', '=', $tgl )
        ->sum('nilaisbr');
        
        $total  = Datahasil::where('users_id', '=', $user->id)
        ->where('coin', '=', 'BCH')
        ->where('tgl', '=', $tgl )
        ->sum('INVERT_IDR');
        $post   = MesinMining::where('users_id', '=', $user->id)->get();

        $totalweek  = Datahasil::selectRaw("sum(INVERT_IDR) as sum,
        sum(nilaisbr) as totalwallet,sum(listrik) as totallistrik,
        sum(ratelistrik) as ratelistrik,
        sum(hasillistrikkurang) as hslkrglistrik,
        sum(investor) as total,
        sum(manage) as totalmanage,
        coin as coin")
        ->where('users_id', '=', $user->id)
      
        ->groupBy('coin')
        ->where('week', '=', '1')
        ->get();


        $incomeBCH  = Datahasil::selectRaw("
        sum(INVERT_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->where('coin', 'BCH') 
        ->where('week', '=', '1')
        ->get();

        $incomemanajemenBCH  = Datahasil::selectRaw("
        sum(manage_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->where('coin', 'BCH') 
        ->where('week', '=', '1')
        ->get();

        $incomeBTC  = Datahasil::selectRaw("
        sum(INVERT_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->where('coin', 'BTC') 
        ->where('week', '=', '1')
        ->get();

        $incomemanajemenBTC  = Datahasil::selectRaw("
        sum(manage_IDR) as totalwallet")
        ->where('users_id', '=', $user->id)
        ->where('coin', 'BTC') 
        ->where('week', '=', '1')
        ->get();

        $totalIncome = $incomeBCH[0]->totalwallet + $incomeBTC[0]->totalwallet;
        $totalIncomeMNJ = $incomemanajemenBCH[0]->totalwallet + $incomemanajemenBTC[0]->totalwallet;



        return view('hometgl',['post'=>$post,'miner'=>$miner,'total'=>$total,'tgl'=>$tgl,'jmltgl'=>$jmltgl,'totalweek'=>$totalweek,'totalcoin'=>$totalcoin,'totalIncome'=>$totalIncome,'totalIncomeMNJ'=>$totalIncomeMNJ,'url'=>$url,'payment'=>$payment,]);
    }
    public function adminHome()
    {
        $listinvestor = Auth::User()->where('is_admin',0)->get();

        return view('adminHome',['listinvestor'=>$listinvestor]);
    }
}