<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Zebra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class ZebrasController extends Controller
{

    /**
     * Display a listing of the zebras.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $storage = Redis::connection();
        $storage->zRevRange();
        $zebras = Zebra::paginate(25);

        return view('zebras.index', compact('zebras'));
    }

    /**
     * Show the form for creating a new zebra.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('zebras.create');
    }

    /**
     * Store a new zebra in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $data = $this->getData($request);

            Zebra::create($data);

            return redirect()->route('zebras.zebra.index')
                ->with('success_message', 'Zebra was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified zebra.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $this->id = $id;
        $store = Redis::connection();
        if($store->zScore('zebraViews','Zebra:'.$id))
        {
            $store->pipeline(function ($pipe){
                $pipe->zIncrBy('zebraViews',1,'Zebra:'.$this->id);
                $pipe->incr('zebra:'.$this->id.":views");

            });

        }else
        {
            $views = $store->incr('zebra:'.$this->id.'views');
            $store->zIncrBy('zebraViews',$views,'Zebra:'.$this->id);
        }
        $view = $store->get('zebras'.$this->id.":views");
        $zebra = Zebra::findOrFail($id);
        echo $view;
        return view('zebras.show', compact('zebra'));
    }

    /**
     * Show the form for editing the specified zebra.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $zebra = Zebra::findOrFail($id);


        return view('zebras.edit', compact('zebra'));
    }

    /**
     * Update the specified zebra in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $data = $this->getData($request);

            $zebra = Zebra::findOrFail($id);
            $zebra->update($data);

            return redirect()->route('zebras.zebra.index')
                ->with('success_message', 'Zebra was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified zebra from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $zebra = Zebra::findOrFail($id);
            $zebra->delete();

            return redirect()->route('zebras.zebra.index')
                ->with('success_message', 'Zebra was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'title' => 'string|min:1|max:255|nullable',
            'body' => 'string|min:1|nullable',
        ];

        $data = $request->validate($rules);


        return $data;
    }

}
