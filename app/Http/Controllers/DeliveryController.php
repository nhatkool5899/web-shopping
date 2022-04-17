<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\thanhpho;
use App\Models\quanhuyen;
use App\Models\xathitran;
use App\Models\feeship;

class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $thanhpho = thanhpho::orderby('matp', 'ASC')->get();
        $quanhuyen = quanhuyen::orderby('maqh', 'ASC')->get();
        return view('admin.delivery')->with(compact('thanhpho','quanhuyen'));
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
                $output.= '<option>----Chọn quận huyện----</option>';
                $select_province = quanhuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                foreach ($select_province as $key => $qh) {
                    $output .= '<option value="'.$qh->maqh.'">'.$qh->name_qh.'</option>';
                }
            }else{
                $output.= '<option>----Chọn xã phường----</option>';
                $select_wards = xathitran::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                foreach ($select_wards as $key => $xa) {
                    $output .= '<option value="'.$xa->xaid.'">'.$xa->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }

    public function select_feeship()
    {
        $feeship = feeship::orderby('fee_id', 'DESC')->get();
        // print_r($feeship);
        $output = '';
        $output .= '
        <div class="table-responsive">
            <table class="table table-bordered">
                <thread>
                    <tr>
                        <td>Tên thành phố</td>
                        <td>Tên quận huyện</td>
                        <td>Tên xã phường</td>
                        <td>Phí vận chuyển</td>
                    </tr>
                </thread>
                <tbody>
                ';
                foreach ($feeship as $key => $fee) {
                    $output .= '
                    <tr>
                        <td>'.$fee->city->name_tp.'</td>
                        <td>'.$fee->province->name_qh.'</td>
                        <td>'.$fee->wards->name_xa.'</td>
                        <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship-edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                    </tr>';
                }
                    
                $output .= '
                </tbody>
            </table>
        </div>';
        echo $output;
    }

    public function insert_delivery(Request $request)
    {   
        $data = $request->all();
        $fee_ship = new feeship;
        $fee_ship->fee_matp = $request->city;
        $fee_ship->fee_maqh = $request->province;
        $fee_ship->fee_xaid = $request->wards;
        $fee_ship->fee_feeship = $request->fee_ship;
        // print_r($data);
        $fee_ship->save();
    }

    public function update_delivery(Request $request)
    {   
        $data = $request->all();
        $fee_ship = feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['feeship_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
