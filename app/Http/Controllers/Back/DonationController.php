<?php
namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Setting;

class DonationController extends BaseController
{
    public function index(Request $request)
    {
        $targets = Setting::getMasterList('donation-targets');
        $donations = [];
        foreach ($targets as $n => $v) {
            $donations[$n] = [
                'target' => $v,
                'sources' => Setting::getMasterListValue('donation-sources', $n)
            ];
        }

        if ($request->has('key')) {
            $input = $request->all();
            $key = $input['key'];
            $target = (int) $input['target'];

            try {
                Setting::saveMasterList('donation-targets', [$key => $target]);
            }
            catch (QueryException $ex) {
                return redirect()
                    ->back()
                    ->with('status', 'error')
                    ->with('message', 'Error saving [' . $key . ']: ' . $ex->getMessage());
            }

            $sources = [];
            for ($i = 0; $i < count($input['source']) ; $i ++) {
                if (isset($input['value'][$i]))
                    $sources[$input['source'][$i]] = (int) $input['value'][$i];
            }

            try {
                Setting::saveMasterList('donation-sources', [$key => $sources]);
            }
            catch (QueryException $ex) {
                return redirect()
                    ->back()
                    ->with('status', 'error')
                    ->with('message', 'Error saving sources for [' . $key . ']: ' . $ex->getMessage());
            }

            return redirect()
                ->back()
                ->with('status', 'success')
                ->with('message', 'Donation [' . $key . '] was updated.');
        }

        return view('payment.donation', ['donations' => $donations]);
    }
}
