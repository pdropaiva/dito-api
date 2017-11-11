<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    
    public function index(Request $request) {
        
        try {
            
            $this->validate($request, [
                'search' => 'required',
            ]);
            
        } catch (ValidationException $e) {
            return response()->json($e->response->getContent(), $e->response->getStatusCode());
            dd($e->response);
        }
        
        $data = DB::collection('events')
            ->where('event', $request->get('search'))
            ->get();
        
        return response()->json($data);
    }
    
    public function store(Request $request) {
        
        try {
         
            $this->validate($request, [
                'event' => 'required',
                'timestamp' => 'required|date'
            ]);
            
        } catch (ValidationException $e) {
            return response()->json($e->response->getContent(), $e->response->getStatusCode());
            dd($e->response);
        }
        
        DB::collection('events')->insert(['event' => $request->get('event'), 'timestamp' => $request->get('timestamp')]);
        
        return response()->json(['message' => 'Evento '.$request->get('event').' cadastrado']);    
        dd(Carbon::createFromTimestampUTC(strtotime($request->get('timestamp'))));
    }
    
    public function search(Request $request) {
        
        try {
            
            $this->validate($request, [
                'search' => 'required|min:2',
            ]);
            
        } catch (ValidationException $e) {
            return response()->json($e->response->getContent(), $e->response->getStatusCode());
            dd($e->response);
        }
        
        $data = DB::collection('events')
                    ->where('event', 'regexp', '/'.$request->get('search').'/')
                    ->groupBy('event')
                    ->limit(10)
                    ->lists('event');
        
        return response()->json($data);
    }
}

